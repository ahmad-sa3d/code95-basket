<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
	public function index()
	{
		$users = User::paginate( 10 );
		return View::make( 'admin.users.index', compact('users') );
	}

	public function show( $user )
	{
		return View::make( 'admin.users.show', compact('user') );
	}

	public function edit( $user )
	{
		return View::make( 'admin.users.edit', compact('user') );
	}

	public function create( Request $request )
	{
		return View::make( 'admin.users.create' );
	}

	public function store( Request $request )
	{
		$this->validate( $request, [
				'username' => 'required|alpha_dash|min:5|unique:users',
				'password' => 'required|min:6|max:10|confirmed',
				'is_admin' => 'boolean',
				'is_active' => 'boolean'
			] );

		$user = new User( [
			'username' => $request->input('username'),
			'password' => bcrypt( $request->input('password') ),
			] );

		if( $request->has( 'is_admin' ) )
			$user->is_admin = true;
		else
			$user->is_admin = false;

		if( $request->has( 'is_active' ) )
			$user->is_active = true;
		else
			$user->is_active = false;

		
		if( $user->save() )
		{
			$this->makeSuccessNotification( 'User <strong>' . $user->username . '</strong> Has Been successfully Created.' );

			return Redirect::route( 'admin.users.show', $user->id );
		}
		else
		{
			$this->makeErrorNotification( 'Couldnot Create User ' . $user->username . ' Please try again later.' );

			return Redirect::back();
		}
	}

	public function update( $user, Request $request )
	{
		$this->validate( $request, [
				'username' => 'required|alpha_dash|min:5|unique:users,username,'.$user->id,
				'password' => 'required|min:6|max:10|confirmed'
			] );

		// OK
		$user->username = $request->input('username');
		$user->password = bcrypt( $request->input('password') );

		$user->touch();

		if( $user->save() )
		{
			$this->makeSuccessNotification( 'User ' . $user->username . ' Has Been successfully Updated.' );

			if( $user->id === $request->user()->id )
				$request->session()->regenerate();

			return Redirect::route( 'admin.users.show', $user->id );
		}
		else
		{
			$this->makeErrorNotification( 'Couldnot Update user ' . $user->username . ' Please try again later.' );

			return Redirect::back();
		}
	}

	public function updateSettings( $user, Request $request )
	{
		$this->validate( $request, [
				'is_admin' => 'boolean',
				'is_active' => 'boolean'
			] );

		if( $user->id === $request->user()->id )
		{
			$this->makeErrorNotification( 'Sorry You Cannot Change Your Account Settings By Yourself For App Security.' );
			return Redirect::back();
		}

		if( $request->has( 'is_admin' ) )
			$user->is_admin = true;
		else
			$user->is_admin = false;

		if( $request->has( 'is_active' ) )
			$user->is_active = true;
		else
			$user->is_active = false;

		$user->touch();

		if( $user->save() )
		{
			$this->makeSuccessNotification( 'User ' . $user->username . ' Has Been successfully Updated.' );

			if( $user->id === $request->user()->id )
				$request->session()->regenerate();

			return Redirect::route( 'admin.users.show', $user->id );
		}
		else
		{
			$this->makeErrorNotification( 'Couldnot Update Settings For user ' . $user->username . ' Please try again later.' );

			return Redirect::back();
		}

	}

	public function delete( $user )
	{
		return View::make( 'admin.users.delete', compact( 'user' ) );
	}

	public function destroy( $user, Request $request )
	{
		// Check saftey
		if( $user->id === $request->user()->id )
		{
			$this->makeErrorNotification( 'Sorry You Cannot Delete Your Account .' );
			return Redirect::back();
		}

		if( !$user->isSafelyDelete() )
		{
			$this->makeErrorNotification( 'user <strong>'. $user->username .'</strong> has related data, Like Invoices, Sales and Orders so isnot deletable.' );
			return Redirect::back();
		}

		// Ok Destroy
		if( $user->delete() )
		{
			$this->makeSuccessNotification( 'User <strong>' . $user->username . '</strong> Has Been Successfully deleted.' );
			return Redirect::route( 'admin.users.index' );
		}
		else
		{
			$this->makeErrorNotification( 'Couldnot Delete User <strong>' . $user->username . '</strong> Please try again later.' );
			return Redirect::route( 'admin.users.show', $user->id );
		}
	}
}