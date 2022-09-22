<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlentyarticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plentyarticles', function (Blueprint $table) {
            $table->id();
            $table->string('itemId');
            $table->string('variationId');
            $table->string('externalId');
            $table->string('price');
            $table->string('priceGross');
            $table->string('stock');
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
        Schema::dropIfExists('plentyarticles');
    }
}
