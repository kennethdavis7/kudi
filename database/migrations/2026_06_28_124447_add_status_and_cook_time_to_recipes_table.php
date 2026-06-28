<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
            $table->integer('status')->default(1);
            $table->integer('cook_time')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->text('description')->nullable(false)->change();
            $table->dropColumn(['status', 'cook_time']);
        });
    }
};
