<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('set_id')->unsigned();
            $table->foreign('set_id')->references('id')->on('sets')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->date('created_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
