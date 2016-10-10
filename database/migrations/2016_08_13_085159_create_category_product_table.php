<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {

            $table->integer( 'product_id' )->unsigned();
            $table->integer( 'category_id' )->unsigned();

            // Composite Key
            $table->primary( [ 'product_id', 'category_id' ] );
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop( 'category_product' );
    }
}
