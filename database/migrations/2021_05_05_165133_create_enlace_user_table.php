<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnlaceUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('enlace_user');
        Schema::create('enlace_user', function (Blueprint $table) {
            
            $table->integer('enlaces_id')->unsigned();
            $table->integer('user_id')->unsigned();
        
            $table->foreign('enlaces_id')->references('id')->on('enlaces')
                        ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                        ->onUpdate('cascade')->onDelete('cascade');
        
            $table->primary(['enlaces_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enlace_user');
    }
}
