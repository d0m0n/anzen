<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->string('alpha2');
            $table->string('alpha3');
            $table->string('numeric');
            $table->string('country_name_jp');
            $table->string('country_name_en');
            $table->string('location');
            $table->string('lat');
            $table->string('lon');
            $table->timestamps();
            $table->primary('alpha2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
