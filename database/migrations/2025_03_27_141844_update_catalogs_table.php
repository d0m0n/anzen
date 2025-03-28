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
        Schema::table('catalogs', function (Blueprint $table) {
            // provider_id を string から unsignedBigInteger に変更
            $table->unsignedBigInteger('provider_id')->change();

            // status_id を string から unsignedBigInteger に変更
            $table->unsignedBigInteger('status_id')->change();

            // price を string から decimal に変更
            $table->decimal('price', 10, 2)->change();

            // note を nullable に変更
            $table->text('note')->nullable()->change();

            // image を nullable に変更
            $table->string('image')->nullable()->change();

            // 外部キー制約の追加
            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('catalogs', function (Blueprint $table) {
            // 修正内容を元に戻します（省略可能）
            $table->string('provider_id')->change();
            $table->string('status_id')->change();
            $table->string('price')->change();
            $table->string('note')->change();
            $table->string('image')->change();
        });
    }
};
