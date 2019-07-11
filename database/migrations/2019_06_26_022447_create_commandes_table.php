<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->double('montant');
            $table->boolean('traiter')->default(false);
            $table->timestamps();
            
            $table->foreign('client_id')->references('id')
                ->on('clients')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commandes', function (Blueprint $table) {
            
            $table->dropForeign('commandes_client_id_foreign');
        });
        Schema::dropIfExists('commandes');
    }
}
