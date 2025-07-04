<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('on_home_page')
                ->default(false)
                ->after('brand_id');

            $table->integer('sorting')
                ->default(999)
                ->after('on_home_page');
        });
    }

    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('on_home_page');

                $table->dropColumn('sorting');
            });
        }
    }
};
