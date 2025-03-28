<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id'); // 外部キー
            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('status_id');
            $table->string('county_name');
            $table->string('location_name');
            $table->text('copy');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->text('note')->nullable();
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
        Schema::dropIfExists('catalogs');
    }
}
