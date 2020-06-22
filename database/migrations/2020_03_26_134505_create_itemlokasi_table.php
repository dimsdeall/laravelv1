<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemlokasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemlokasi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('item')->onDelete('cascade');
            $table->integer('lokasi_id')->unsigned();
            $table->foreign('lokasi_id')->references('id')->on('lokasi')->onDelete('cascade');
            $table->double('diskon')->default(0);
            $table->double('hargabel')->default(0);
            $table->double('hargajul')->default(0);
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('itemlokasi');
    }
}
