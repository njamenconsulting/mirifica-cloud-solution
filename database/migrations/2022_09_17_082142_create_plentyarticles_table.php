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
            $table->string('variationId')->unique();
            $table->string('externalId');
            $table->string('price')->nullable();
            $table->string('priceGross')->nullable();
            $table->string('stock')->nullable();
            $table->string('warehouseVariationId')->nullable();
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
