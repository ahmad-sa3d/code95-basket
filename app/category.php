<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    
    protected $fillable = [ 'title', 'description' ];
    protected $appends = [ 'descendents_ids', 'childs_ids' ];
    protected $table = 'categories';

    
    /**
     * Children Relationship
     * 
     * @return  Collection 		App\Category 	Children Collection
     */
    public function children()
    {
    	return $this->hasMany( 'App\Category', 'parent_id' );
    }

    /**
     * Children Recursive RelationshipShip
     * 
     * @return Collection 	App\Category 	Childs Collection , And Loads Its Childs And So On
     */
    public function childs()
    {
    	return $this->children()->with( 'childs', 'parent' );
    }

    /**
     * Parent category Relashionship
     * 
     * @return App\Category 	Parent category If Has
     */
    public function parent()
    {
    	return $this->belongsTo( 'App\Category', 'parent_id' );
    }

    /**
     * Many To many Relationship With Product
     * 
     * @return Collection App\Products Collection Or Empty collection
     */
    public function products()
    {
    	return $this->belongsToMany( 'App\Product' );
    }

    /**
     * Scope To Get Main Categories Only
     * @param  QueryBuilder $query QueryBuilder Instance
     * @return QueryBuilder        Instance
     */
    public function scopeMain( $query )
    {
    	return $query->whereNull( 'parent_id' )->orWhere( 'parent_id', '=', 0 );
    }

     /**
     * get array of all descendents ( direct and indirect childs )
     * 
     * @return Array 	All Descendents Ids
     */
    protected function getDescendentsIds()
    {
        $ids = $this->childs_ids;

        $this->children->each( function( $child ) use( &$ids ) 
        // $this->childs->each( function( $child ) use( &$ids ) 
        {            
            if( $child->children->count() )
            // if( $child->childs->count() )
                $ids = array_merge( $ids, $child->descendents_ids );
        });
      
        return $ids;
    }

    /**
     * Accessor To Get descendents_ids Array
     * 
     * @return Array  	Array of all descendents ids
     */
    protected function getDescendentsIdsAttribute()
    {
        return $this->attributes[ 'descendents_ids' ] = $this->getDescendentsIds();
    }

    /**
     * Accessor To Get childs_ids Array (Direct Childs Ids Array)
     * 
     * @return Array  	Array of all Direct children ids
     */
    protected function getChildsIdsAttribute()
    {
        // return $this->attributes[ 'childs_ids' ] = $this->childs->pluck('id')->all();
        return $this->attributes[ 'childs_ids' ] = isset( $this->relations['childs'] ) ? $this->childs->pluck('id')->all() : $this->children->pluck('id')->all();
    }

    
    /**
     * Get Collection Of Valid Categories, That Isnot A Descendent Of Current instance
     * @param  Array|array $fields Fields To get
     * @return collection              Collection Of App\Category
     */
    public function validParents( Array $fields = [] )
    {
    	$descendents_ids = $this->descendents_ids;

    	array_push( $descendents_ids, $this->id );

    	$query = $this->whereNotIn( 'id', $descendents_ids );
    	
    	return $fields ? $query->get( $fields ) : $query->get();
    }

    /**
     * Check If Instance Has No Dependencies So It can Be Deleted safely
     * 
     * @return boolean Safely Or Not
     */
    public function isSafelyDelete()
    {
    	return ( $this->childs_ids || $this->products->count() ) ? false : true;
    }
}
