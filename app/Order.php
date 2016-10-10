<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    protected $casts = [ 'data' => 'array' ]; 
    protected $appends = [ 'quantity', 'items' ];


    // Belongs to User
    public function user()
    {
    	return $this->belongsTo( 'App\User' );
    }

    // UnConfirmed Orders, Basket Order
    public function scopeUnConfirmed( $query )
    {
    	return $query->whereNull( 'confirmed' )->orWhere( 'confirmed', 0 );
    }

    public function getQuantityAttribute()
    {
        if( isset( $this->attributes[ 'quantity' ] ) )
            return $this->attributes[ 'quantity' ];

        return $this->attributes[ 'quantity' ] = array_sum( $this->data );
    }


    // UnConfirmed Orders, Basket Order
    public function getItemsAttribute()
    {

        if( isset( $this->attributes['items'] ) )
            return $this->attributes['items'];

        $items = collect();

        $data =  $this->data;

        if( $data )
        {
             Product::whereIn( 'id', array_keys( $data ) )->get()->each( function( $product ) use( &$items ){
                
                $arr = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'quantity' => ( $this->data[ $product->id ] > $product->instock_quantity && $this->data[ $product->id ] ) ? $product->instock_quantity : (int) $this->data[ $product->id ],
                        'unit_price' => $product->price,
                        'unit_discount' => $product->discount,
                        'instock_quantity' => $product->instock_quantity,
                    ];

                    $arr[ 'net_price' ] = $arr[ 'quantity' ] * ( $product->price - $product->discount );

                // if( $arr[ 'quantity' ] )
                $items->push( $arr );

            } );
        }
           

        return $this->attributes[ 'items' ] = $items->keyBy( 'id' );
    }

}
