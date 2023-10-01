<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('products','active')) {
            if (Schema::getColumnType('products','active') == 'integer') {
                Schema::table('products', function (Blueprint $table) {
                    $table->string('active', 25)->default('aktív')->change();
                });
            }
        }
    }

    public function down(): void
    {
        //
    }
};
