<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use App\Invoice;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
	public function index()
	{
		$invoices = Invoice::paginate(10);

		return View::make( 'admin.invoices.index', compact('invoices') );
	}

	public function show( $invoice )
	{
		return View::make( 'admin.invoices.show', compact('invoice') );
	}

	public function edit( $invoice )
	{
		
		return View::make( 'admin.invoices.edit' );
	}

	public function create( Request $request )
	{
		
		return View::make( 'admin.invoices.create' );
	}

	public function store( Request $request )
	{
		
	}

	public function update( $invoice, Request $request )
	{
		
	}

	public function delete( $invoice )
	{
		return View::make( 'admin.invoices.delete', compact( 'invoice' ) );
	}

	public function destroy( $invoice, Request $request )
	{
		
	}
}