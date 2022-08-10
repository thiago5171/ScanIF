<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {



            $table->id();
            $table->string('tombamento')->unique();
            $table->string('denominacao')->nullable();
            $table->string('termo')->nullable();
            $table->string('valor')->nullable();
            $table->string('tomb_antigo')->nullable();
            $table->string('estado')->nullable();
            $table->string('situacao')->nullable();
            $table->string('n_serie')->nullable();
            $table->string('observacao')->nullable();
            $table->string('localidade')->nullable();
            $table->timestamps();

            $table->foreignId('status_id');

            $table->foreign('status_id')->references('id')->on('status_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
