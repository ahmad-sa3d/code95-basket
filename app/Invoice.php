<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
     * App\User Relation
     * @return Eloquent Relationship [description]
     */
    public function user()
    {
    	return $this->belongsTo( 'App\User' );
    }

    /**
     * App\Sale Relation
     * @return Eloquent Relationship [description]
     */
    public function sales()
    {
    	return $this->hasMany( 'App\Sale' );
    }

}
