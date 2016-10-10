<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'invoices', function( Blueprint $table ){

            $table->foreign( 'user_id' )
                    ->references( 'id' )
                    ->on( 'users' );
                    
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'invoices', function( Blueprint $table ){

            $table->dropForeign( 'invoices_user_id_foreign' );
                    
        } );
    }
}
