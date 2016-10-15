<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_admin' => 'boolean',
    ];

    protected $appends = [ 'order' ];



    // Has Many Sales
    public function sales()
    {
        return $this->hasMany( 'App\Sale' );
    }

    // Has Many Invoices
    public function invoices()
    {
        return $this->hasMany( 'App\Invoice' );
    }

    // Activity
    public function isOnline()
    {
        return Cache::has( 'user_online_' . $this->id );
    }

    // Activity
    public function orders()
    {
        return $this->hasMany( 'App\Order' );
    }

    public function getOrderAttribute()
    {
        if( isset( $this->attributes['order'] ) )
            return $this->attributes['order'];
        
        return $this->attributes['order'] = $this->orders()->unConfirmed()->first();
    }

    public function isSafelyDelete()
    {
        // 1- Has No Sales, So Has No Invoices
        // 2- Has No orders
        $deletable = true;
        if( $this->sales()->first() )
            $deletable = false;

        if( $this->orders()->first() )
            $deletable = false;

        return $deletable;

    }

    public function scopeAdmin($query)
    {
        return $query->where( [
            ['is_admin', 1],
            ['is_admin', 1] ]
        );
    }

}
