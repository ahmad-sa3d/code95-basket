<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [ 'name', 'description', 'instock_quantity' ];
    protected $appends = [ 'discount', 'short_description' ];
    

    /**
     * Belongs To Many Category RelashionShip
     * @return Eloquent Relationship
     */
    public function categories()
    {
    	return $this->belongsToMany( 'App\Category' );
    }

    /**
     * Has Many Sales RelashionShip
     * @return Eloquent Relationship
     */
    public function sales()
    {
        return $this->hasMany( 'App\Sale' );
    }

    /**
     * Get Discount Value
     *
     * Should Only Used In Reading Cases Only like in views, or arrays or json
     * Calling it in write mode will cause eloquent error if save() method is called after
     * @return Number
     */
    public function getDiscountAttribute()
    {
    	return $this->attributes[ 'discount' ] = $this->getDiscountValue();
    }

    /**
     * Get Short Description
     * @return String
     */
    public function getShortDescriptionAttribute()
    {
        return $this->attributes[ 'short_description' ] = join( ' ', array_slice( str_word_count( $this->description, true ), 0, 3 ) ) . ' ...';
    }

    /**
     * Get Discount Value
     *
     * This Method Should be used instead of discount Property
     * while saving Operations, as property discount will cause eloquent error as it will
     * concider that 'discount' is a table field, while it isnot, But this method will not
     * add 'discount' property in attributes array
     * @return String
     */
    public function getDiscountValue()
    {
        return $this->discount_percent ? number_format( $this->price * $this->discount_percent / 100, 2, '.', '' ) : 0;
    }

    public function isSafelyDelete()
    {
        // 1- Has No Sales
        // 2- Has No Opened Order
        $deletable = true;
        if( $this->sales()->first() )
            $deletable = false;

        return $deletable;

    }

    public function scopeCritical( $query, $critical_value = 5 )
    {
        return $query->where( 'instock_quantity' , '<=', $critical_value  );
    }

}
