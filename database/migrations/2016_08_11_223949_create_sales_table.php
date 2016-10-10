<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            // Represents single selling info, while making an invoice

            // Product price during selling process
            $table->decimal( 'unit_price', 9, 2 )->unsigned();
            
            $table->decimal( 'unit_discount', 9, 2 )->unsigned()->nullable();

            // product units ammount
            $table->integer( 'quantity' )->unsigned();

            // Belongs to a product
            $table->integer( 'product_id' )->unsigned();

            // Belongs To a Seller
            $table->integer( 'user_id' )->unsigned();
                        
            // Belongs to an invoice
            $table->integer( 'invoice_id' )->unsigned();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sales');
    }
}
