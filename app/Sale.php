<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

	protected $appends = [
		'total_price',
		'total_discount',
		'total_net_price',
	];

	/**
	 * Product Relationship
	 * @return Eloquent Relationship [description]
	 */
	public function product()
	{
		return $this->belongsTo( 'App\Product' );
	}

	/**
	 * User Relationship
	 * @return Eloquent Relationship [description]
	 */
	public function user()
	{
		return $this->belongsTo( 'App\User' );
	}

	/**
	 * Invoice Relationship
	 * @return Eloquent Relationship [description]
	 */
	public function invoice()
	{
		return $this->belongsTo( 'App\Invoice' );
	}

	public function getTotalPriceAttribute()
	{
		if( isset( $this->attributes['total_price'] ) )
			return $this->attributes['total_price'];

		return $this->attributes[ 'total_price' ] = $this->unit_price * $this->quantity;
	}

	public function getTotalDiscountAttribute()
	{
		if( isset( $this->attributes['total_discount'] ) )
			return $this->attributes['total_discount'];

		return $this->attributes[ 'total_discount' ] = $this->unit_discount * $this->quantity;
	}

	public function getTotalNetPriceAttribute()
	{
		if( isset( $this->attributes['total_net_price'] ) )
			return $this->attributes['total_net_price'];

		return $this->attributes[ 'total_net_price' ] = $this->total_price - $this->total_discount;
	}

	public function scopeToday($query)
	{
		return $query->where( 'created_at', '>=', \Carbon\Carbon::now()->startOfDay() );
	}
}
