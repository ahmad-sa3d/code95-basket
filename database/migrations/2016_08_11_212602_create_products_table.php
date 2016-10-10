<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            
            $table->timestamps();
           
            $table->string( 'name', 100 )->unique();
            
            $table->string( 'description', 500 );

            // Max price 9999999.99
            $table->decimal( 'price', 9, 2 )->unsigned();
            
            // Current Existed ammount
            $table->integer( 'instock_quantity' )->unsigned();

            // Store Relation, optional
            $table->integer( 'discount_percent' )->unsigned()->nullable();

            // Many To Many With Categories

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
