<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
	public function index()
	{
		$products = Product::paginate(10);
		return View::make( 'admin.products.index', compact('products') );
	}

	public function show( $product )
	{
		return View::make( 'admin.products.show', compact('product') );
	}

	public function edit( $product )
	{
		$categories = [];
		Category::get( ['id', 'title' ] )->each( function( $cat ) use( &$categories ){
			$categories[ $cat->id ] = $cat->title;
		} );
		return View::make( 'admin.products.edit', compact('product', 'categories') );
	}

	public function create( Request $request )
	{
		$categories = [];
		Category::get( ['id', 'title' ] )->each( function( $cat ) use( &$categories ){
			$categories[ $cat->id ] = $cat->title;
		} );
		return View::make( 'admin.products.create', compact( 'categories' ) );
	}

	public function store( Request $request )
	{
		$this->validate( $request, [
				'name' => 'required|min:5|unique:products',
				'description' => 'required|min:10',
				'price' => 'required|numeric|min:0',
				'instock_quantity' => 'required|integer|min:0',
				'discount_percent' => 'integer|min:0|max:100',
				'categories' => 'required|array|min:1',
				'categories.*' => 'numeric|min:0',
			] );

		$product = new Product( $request->only( ['name', 'description', 'instock_quantity'] ) );

		$product->price = number_format( $request->input('price'), 2, '.', '' );

		if( $request->has( 'discount_percent' ) )
			$product->discount_percent  = $request->input( 'discount_percent' );

		
		if( $product->save() )
		{
			// Attach Categories
			if( $request->has( 'categories' ) )
				$product->categories()->attach( $request->input( 'categories' ) );

			$this->makeSuccessNotification( 'Product <strong>' . $product->name . '</strong> Has Been successfully Created.' );

			return Redirect::route( 'admin.products.show', $product->id );
		}
		else
		{
			$this->makeErrorNotification( 'Couldnot Create Product ' . $product->name . ' Please try again later.' );

			return Redirect::back();
		}
	}

	public function update( $product, Request $request )
	{
		$this->validate( $request, [
				'name' => 'required|min:5|unique:products,name,'.$product->id,
				'description' => 'required|min:10',
				'price' => 'required|numeric|min:0',
				'instock_quantity' => 'required|integer|min:0',
				'discount_percent' => 'integer|min:0|max:100',
				'categories' => 'required|array|min:1',
				'categories.*' => 'numeric|min:0',
			] );

		$product->fill( $request->only( ['name', 'description', 'instock_quantity'] ) );

		$product->price = number_format( $request->input('price'), 2, '.', '' );

		// Check Discount
		if( $request->has( 'discount_percent' ) && $request->input( 'discount_percent' ) )
			$product->discount_percent  = $request->input( 'discount_percent' );
		else
			$product->discount_percent = NULL;

		// Sync categories
		$product->categories()->sync( $request->input( 'categories' ) );
		
		if( $product->save() )
		{		

			$this->makeSuccessNotification( 'Product <strong>' . $product->name . '</strong> Has Been successfully Updated.' );

			return Redirect::route( 'admin.products.show', $product->id );
		}
		else
		{
			$this->makeErrorNotification( 'Couldnot Create Product ' . $product->name . ' Please try again later.' );

			return Redirect::back();
		}
	}

	public function delete( $product )
	{
		return View::make( 'admin.products.delete', compact( 'product' ) );
	}

	public function destroy( $product, Request $request )
	{
		// Check saftey
		if( !$product->isSafelyDelete() )
		{
			$this->makeErrorNotification( 'Sorry Product <strong>' . $product->name . '</strong> Couldnot be Deleted as it has dependency Like Sales, Invoices, Orders.' );
			return Redirect::route( 'admin.products.show', $product->id );
		}

		// Ok Destroy
		if( $product->delete() )
		{
			// Detach Categories
			$product->categories()->detach();
			
			$this->makeSuccessNotification( 'Product <strong>' . $product->name . '</strong> Has Been Successfully deleted.' );
			return Redirect::route( 'admin.products.index' );
		}
		else
		{
			$this->makeErrorNotification( 'Couldnot Delete Product <strong>' . $product->name . '</strong> Please try again later.' );
			return Redirect::route( 'admin.products.show', $product->id );
		}
	}
}