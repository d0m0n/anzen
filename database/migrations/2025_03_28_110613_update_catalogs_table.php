<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalogs', function (Blueprint $table) {
            // 必要なカラムが存在しない場合に追加
            if (!Schema::hasColumn('catalogs', 'provider_id')) {
                $table->unsignedBigInteger('provider_id')->after('id');
                $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade');
            }

            if (!Schema::hasColumn('catalogs', 'status_id')) {
                $table->unsignedBigInteger('status_id')->after('provider_id');
            }

            if (!Schema::hasColumn('catalogs', 'county_name')) {
                $table->string('county_name')->after('status_id');
            }

            if (!Schema::hasColumn('catalogs', 'location_name')) {
                $table->string('location_name')->after('county_name');
            }

            if (!Schema::hasColumn('catalogs', 'copy')) {
                $table->text('copy')->after('location_name');
            }

            if (!Schema::hasColumn('catalogs', 'description')) {
                $table->text('description')->after('copy');
            }

            if (!Schema::hasColumn('catalogs', 'price')) {
                $table->decimal('price', 8, 2)->after('description');
            }

            if (!Schema::hasColumn('catalogs', 'note')) {
                $table->text('note')->nullable()->after('price');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catalogs', function (Blueprint $table) {
            // up() メソッドで追加したカラムを削除
            if (Schema::hasColumn('catalogs', 'provider_id')) {
                $table->dropForeign(['provider_id']);
                $table->dropColumn('provider_id');
            }

            if (Schema::hasColumn('catalogs', 'status_id')) {
                $table->dropColumn('status_id');
            }

            if (Schema::hasColumn('catalogs', 'county_name')) {
                $table->dropColumn('county_name');
            }

            if (Schema::hasColumn('catalogs', 'location_name')) {
                $table->dropColumn('location_name');
            }

            if (Schema::hasColumn('catalogs', 'copy')) {
                $table->dropColumn('copy');
            }

            if (Schema::hasColumn('catalogs', 'description')) {
                $table->dropColumn('description');
            }

            if (Schema::hasColumn('catalogs', 'price')) {
                $table->dropColumn('price');
            }

            if (Schema::hasColumn('catalogs', 'note')) {
                $table->dropColumn('note');
            }
        });
    }
}
