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
        Schema::create('favourite_file', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('storageId');
            $table->string('path');
            $table->unsignedBigInteger('typeId');

            $table->foreign('typeId')->references('id')->on('file_type');
            $table->foreign('storageId')->references('id')->on('storage');

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
        Schema::dropIfExists('favourite_file');
    }
};
