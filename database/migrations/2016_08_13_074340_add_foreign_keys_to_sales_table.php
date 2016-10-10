<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'sales', function( Blueprint $table ){

            $table->foreign( 'product_id' )
                    ->references( 'id' )->on( 'products' )
                    ->onDelete( 'cascade' );

            $table->foreign( 'user_id' )
                    ->references( 'id' )->on( 'users' );

            $table->foreign( 'invoice_id' )
                    ->references( 'id' )->on( 'invoices' )
                    ->onDelete( 'cascade' );
                    
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'sales', function( Blueprint $table ){

            $table->dropForeign( 'sales_product_id_foreign' );
            $table->dropForeign( 'sales_user_id_foreign' );
            $table->dropForeign( 'sales_invoice_id_foreign' );
                    
        } );
    }
}
