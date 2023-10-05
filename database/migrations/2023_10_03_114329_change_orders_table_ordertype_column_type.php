<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('orders','ordertype')) {
            if (Schema::getColumnType('orders','ordertype') == 'integer') {
                Schema::table('orders', function (Blueprint $table) {
                    $table->string('ordertype', 25)->default('vevői')->change();
                });
            }
        }
    }

    public function down(): void
    {
        //
    }
};
