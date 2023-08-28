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
        Schema::table('ingredient_types', function (Blueprint $table) {
            $table->foreignId('unit_category_id');
            $table->foreign('unit_category_id')->references('id')->on('unit_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingredient_types', function (Blueprint $table) {
            $table->dropForeign(['unit_category_id']);
            $table->dropColumn('unit_category_id');
        });
    }
};
