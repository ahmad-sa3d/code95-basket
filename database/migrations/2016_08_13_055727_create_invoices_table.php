<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            // Total Invoice Without Discounts
            $table->decimal( 'total', 9, 2 )->unsigned();

            // Total Discount for ammount
            $table->decimal( 'total_discount', 9, 2 )->unsigned()->nullable();
            
            // Invoice Cash After Subtracting Discounts
            $table->decimal( 'net', 9, 2 )->unsigned();
            
            // Belongs To User, Seller
            $table->integer( 'user_id' )->unsigned();

            // Has Many Sales
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invoices');
    }
}
