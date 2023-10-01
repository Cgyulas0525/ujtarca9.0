<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('partners','active')) {
            if (Schema::getColumnType('partners','active') == 'integer') {
                Schema::table('partners', function (Blueprint $table) {
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
