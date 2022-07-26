<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('denominacao');
            $table->string('termo');
            $table->float('valor');
            $table->string('tomb_antigo');
            $table->string('estado');
            $table->string('situacao');
            $table->string('n_serie');
            $table->string('obsercao');
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
};
