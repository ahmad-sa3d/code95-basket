<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use App\Product;
use App\Category;
use App\Order;
use App\Invoice;
use App\Sale;

class HomeController extends Controller
{

    /**
     * Register Order Middlewares
     */
    public function __construct()
    {
        $this->middleware( 'ajax', ['only' => [ 'openOrder', 'updateOrder', 'destroyOrder', 'confirmOrder' ] ] );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {

        if( $request->has( 'category_id' ) && $request->input( 'category_id' ) )
            $products = Category::findOrFail( $request->input( 'category_id' ) )->products()->paginate(12);
        else
            $products = Product::paginate(12);
        
        
        $categories = [ 0 => 'All Categories' ];
        Category::get( ['id', 'title'] )->each( function( $cat ) use( &$categories ){
            $categories[ $cat->id ] = $cat->title;
        } );

        $order = $request->user()->order;

        return view('home', compact( 'products', 'categories', 'order' ) );
    }

    
    /**
     * Open Order
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function openOrder( Request $request )
    {

        if( $request->user()->order )
            return Response::json( [ 'status' => 'error', 'message' => 'you already has an unconfirmed order' ] );
        
        if( !$request->user()->is_active )
            return Response::json( [ 'status' => 'error', 'message' => 'you cannot make orders' ] );

        // OK
        $order = new Order();
        $order->user_id = $request->user()->id;
        $order->data = [];

        if( $order->save() )
        {
            return Response::json( [ 'status' => 'success', 'order' => $order ] );
        }
        else
            return Response::json( [ 'status' => 'error', 'message' => 'couldnot create order' ] );


    }

    /**
     * Update Order
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateOrder( Request $request )
    {
        
        if( $request->has( 'items' ) )
        {
            if( is_array( $request->input('items') ) )
            {
                // $items =  $request->input('items');

                $items = array_filter( $request->input('items'), function( $quantity )
                {
                    return $quantity > 0 ? true : false;
                });
            }
            else
                return Response::json( [ 'status' => 'error', 'message' => 'items must be array' ] );
        }
        else
            $items = [];

        
        if( $order = $request->user()->order )
        {
            $data = $order->data;
            
            $items_ids = array_keys( $items );
            $data_ids = array_keys( $data );

            $deleted = array_values( array_diff( $data_ids, $items_ids ) );
            $added = array_values( array_diff( $items_ids, $data_ids ) );
            $existed = array_values( array_intersect( $data_ids, $items_ids ) );

            // User Has Open Order
            $order->data = $items;

            if( $order->save() )
            {
                $total = [
                    'quantity' => $order->items->sum('quantity'),
                    'net_price' => $order->items->sum('net_price')
                ];

                $data = $order->items->map( function($item){
                    return $item['quantity'];
                } );

                return Response::json( [
                    'status' => 'success',
                    'items' => $order->items,
                    'total' => $total,
                    'deleted' => $deleted,
                    'added' => $added, 
                    'existed' => $existed,
                    'data' => $data,
                    'order_id' => $order->id
                    ] );
            }
            else
                return Response::json( [ 'status' => 'error', 'message' => 'couldnot update order' ] );

        }
        else
            return Response::json( [ 'status' => 'error', 'message' => 'there are no opened order' ] );

    }

    /**
     * Delete Order
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function destroyOrder( Request $request )
    {
        if( $request->user()->order )
        {
            if( $request->user()->order->delete() )
                return Response::json( [ 'status' => 'success' ] );
            else
                return Response::json( [ 'status' => 'error', 'message' => 'Couldnot delete order' ] );
        }
            return Response::json( [ 'status' => 'error', 'message' => 'No order exists to delete' ] );
            
    }

    public function confirmOrder( Request $request )
    {
        if( $order = $request->user()->order )
        {
            // Check If Order Has Items
            $data = $order->data;

            if( !$data || array_sum( $data ) == 0 )
            {
                // Empty Order
                $order->delete();
                return Response::json( ['status' => 'error', 'message' => 'Order Is Empty, No items Or Items With no Quantity'] );

            }

            // Here Ok
            
            $order->confirmed = true;
            if( $order->save() )
            {
                // Make New Invoice
                $invoice = new Invoice();
                $invoice->user_id = $request->user()->id;
                $invoice->total = 0;
                $invoice->total_discount =0;
                $invoice->net = 0;

                if( $invoice->save() )
                {
                    // Make sales
                    Product::whereIn( 'id', array_keys( $data ) )->each( function( $product ) use( &$invoice, $data ){

                        $quantity = ( $data[ $product->id ] > $product->instock_quantity ) ? $product->instock_quantity : ( $data[ $product->id ] > 0 ? $data[ $product->id ] : 0 );

                        if( $product->instock_quantity > 0 )
                        {
                            // Save sale
                            $sale = new Sale();
                            $sale->user_id = $invoice->user_id;
                            $sale->invoice_id = $invoice->id;
                            $sale->product_id = $product->id;
                            $sale->quantity = $quantity;
                            $sale->unit_price = $product->price;
                            $sale->unit_discount = $product->getDiscountValue();
                            
                            // Update instock Quantity
                            $product->instock_quantity -= $quantity;

                            // Update Invoice
                            if( $sale->save() && $product->save() )
                            {
                                $invoice->total += $quantity * $product->price;
                                $invoice->total_discount += $quantity * $sale->unit_discount;
                                $invoice->net += $quantity * ( $product->price - $sale->unit_discount );
                            }
                            else
                                return Response::json( ['status' => 'error', 'message' => 'Error saving Product Or Sale' ] );

                        }

                    } );
                    // foreach( $order->data as $product_id => $quantity )
                    // {
                    //     $product = Product::findOrFail( $product_id );
                    //     $quantity = ( $quantity > $product->instock_quantity ) ? $product->instock_quantity : $quantity;

                    //     if( $product->instock_quantity > 0 )
                    //     {
                    //         // Save sale
                    //         $sale = new Sale();
                    //         $sale->user_id = $invoice->user_id;
                    //         $sale->invoice_id = $invoice->id;
                    //         $sale->product_id = $product->id;
                    //         $sale->quantity = $quantity;
                    //         $sale->unit_price = $product->price;
                    //         $sale->unit_discount = $product->getDiscountValue();
                            
                    //         // Update instock Quantity
                    //         $product->instock_quantity -= $quantity;

                    //         // Update Invoice
                    //         if( $sale->save() && $product->save() )
                    //         {
                    //             $invoice->total += $quantity * $product->price;
                    //             $invoice->total_discount += $quantity * $sale->unit_discount;
                    //             $invoice->net += $quantity * ( $product->price - $sale->unit_discount );
                    //         }
                    //         else
                    //             return Response::json( ['status' => 'error', 'message' => 'Error saving Product Or Sale' ] );

                    //     }
                        
                    // }
                    
                    // $order->items->each( function( $item ) use( &$invoice ){

                    //     // Make Sales
                    //     if( $item['quantity'] > 0 )
                    //     {
                    //         $sale = new Sale();
                    //         $sale->user_id = $invoice->user_id;
                    //         $sale->invoice_id = $invoice->id;
                    //         $sale->product_id = $item['id'];
                    //         $sale->quantity = $item['quantity'];
                    //         $sale->unit_price = $item['unit_price'];
                    //         $sale->unit_discount = $item['unit_discount'];

                    //         $product = Product::findOrFail( $item['id'] );
                    //         $product->instock_quantity -= $item['quantity'];

                    //         if( $sale->save() && $product->save() )
                    //         {
                    //             $invoice->total += $item['quantity'] * $item['unit_price'];
                    //             $invoice->total_discount += $item['quantity'] * $item['unit_discount'];
                    //             $invoice->net += $item['net_price'];
                    //         }
                    //     }

                    // } );

                    // Save Invoice Again
                    if( $invoice->save() )
                        return Response::json( ['status' => 'success', 'invoice_id' => $invoice->id] );
                    else
                        return Response::json( ['status' => 'error', 'message' => 'Error Updating Invoice after saving Products and sales.' ] );
                    
                }
                else
                    return Response::json( ['status' => 'error', 'message' => 'Error saving Invoice' ] );
                    
            }
            else
                return Response::json( ['status' => 'error', 'message' => 'Couldnot confirm order'] );
        }
        else
            return Response::json( ['status' => 'success', 'message' => 'There are no opened orders'] );
    }

    public function invoice( $invoice, Request $request )
    {

        $invoice->load( 'sales.product' );
        $order = $request->user()->order;

        return View::make( 'invoice', compact( 'invoice', 'order' ) );
    }
}
