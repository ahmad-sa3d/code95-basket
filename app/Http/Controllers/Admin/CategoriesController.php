<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
	public function index()
	{
		$categories = Category::main()->with( 'childs', 'parent' )->get();
		return View::make( 'admin.categories.index', compact('categories') );
	}

	public function show( $category )
	{
		return View::make( 'admin.categories.show', compact('category') );
	}

	public function edit( $category )
	{
		$parents = [ 0 => '---' ];

		$category->validParents( ['id', 'title'] )->each( function( $category ) use( &$parents ) {
			$parents[ $category->id ] = $category->title;
		} );

		return View::make( 'admin.categories.edit', compact('category', 'parents') );
	}

	public function create( Request $request )
	{
		$parents = [ 0 => '---' ];
		Category::all()->each( function( $category ) use( &$parents ){
			$parents[ $category->id ] = $category->title;
		} );
		return View::make( 'admin.categories.create', compact( 'parents' ) );
	}

	public function store( Request $request )
	{
		$this->validate( $request, [
				'title' => 'required|min:5|unique:categories',
				'description' => 'required|min:10',
				'parent_id' => 'numeric|min:0',
			] );

		$category = new Category( [
			'title' => $request->input('title'),
			'description' => $request->input('description'),
			] );

		if( $request->has( 'parent_id' ) && $request->input( 'parent_id' ) )
			$category->parent_id = $request->input( 'parent_id' );

		
		if( $category->save() )
		{
			$this->makeSuccessNotification( 'Category <strong>' . $category->title . '</strong> Has Been successfully Created.' );

			return Redirect::route( 'admin.categories.show', $category->id );
		}
		else
		{
			$this->makeErrorNotification( 'Couldnot Create Category ' . $category->title . ' Please try again later.' );

			return Redirect::back();
		}
	}

	public function update( $category, Request $request )
	{
		$this->validate( $request, [
				'title' => 'required|min:5|unique:categories,title,' . $category->id,
				'description' => 'required|min:10',
				'parent_id' => 'numeric|min:0',
			] );

		$category->fill( [
			'title' => $request->input('title'),
			'description' => $request->input('description'),
			] );

		if( $request->has( 'parent_id' ) && $request->input( 'parent_id' ) )
			// $category->parent_id = $request->input( 'parent_id' );
			$category->parent()->associate( $request->input( 'parent_id' ) );
		else
			$category->parent_id = NULL;

		
		if( $category->save() )
		{
			$this->makeSuccessNotification( 'Category <strong>' . $category->title . '</strong> Has Been successfully Updated.' );

			return Redirect::route( 'admin.categories.show', $category->id );
		}
		else
		{
			$this->makeErrorNotification( 'Couldnot Update Category ' . $category->title . ' Please try again later.' );

			return Redirect::back();
		}
	}

	public function updateSettings( $category, Request $request )
	{
		$this->validate( $request, [
				'is_admin' => 'boolean',
				'is_active' => 'boolean'
			] );

		if( $category->id === $request->category()->id )
		{
			$this->makeErrorNotification( 'Sorry You Cannot Change Your Account Settings By Yourself For App Security.' );
			return Redirect::back();
		}

		if( $request->has( 'is_admin' ) )
			$category->is_admin = true;
		else
			$category->is_admin = false;

		if( $request->has( 'is_active' ) )
			$category->is_active = true;
		else
			$category->is_active = false;

		$category->touch();

		if( $category->save() )
		{
			$this->makeSuccessNotification( 'Category ' . $category->title . ' Has Been successfully Updated.' );

			if( $category->id === $request->category()->id )
				$request->session()->regenerate();

			return Redirect::route( 'admin.categories.show', $category->id );
		}
		else
		{
			$this->makeErrorNotification( 'Couldnot Update Settings For category ' . $category->title . ' Please try again later.' );

			return Redirect::back();
		}

	}

	public function delete( $category )
	{
		return View::make( 'admin.categories.delete', compact( 'category' ) );
	}

	public function destroy( $category, Request $request )
	{
		// Check saftey
		if( !$category->isSafelyDelete() )
		{
			$this->makeErrorNotification( 'Sorry Category <strong>' . $category->title . '</strong> Couldnot be Deleted as it has dependency Like related products or sub categories.' );
			return Redirect::route( 'admin.categories.show', $category->id );
		}

		// Ok Destroy
		if( $category->delete() )
		{
			$this->makeSuccessNotification( 'Category <strong>' . $category->title . '</strong> Has Been Successfully deleted.' );
			return Redirect::route( 'admin.categories.index' );
		}
		else
		{
			$this->makeErrorNotification( 'Couldnot Delete Category <strong>' . $category->title . '</strong> Please try again later.' );
			return Redirect::route( 'admin.categories.show', $category->id );
		}
	}
}