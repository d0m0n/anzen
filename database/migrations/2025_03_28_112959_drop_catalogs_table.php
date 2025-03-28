<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('catalogs'); // catalogsテーブルを削除
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id');
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
}
