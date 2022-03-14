<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKoSureddosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ko_sureddos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sureddo_id')->nullable(false)->comment('親スレッドID');
            $table->integer('user_id')->nullable(false)->comment('ユーザーID');
            $table->string('text', 1000)->nullable(false)->comment('本文');
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
        Schema::dropIfExists('ko_sureddos');
    }
}
