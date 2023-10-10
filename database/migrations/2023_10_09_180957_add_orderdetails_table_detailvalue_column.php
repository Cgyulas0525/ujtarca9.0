<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('orderdetails','detailvalue')) {
            return;
        }

        Schema::table('orderdetails', function (Blueprint $table) {
            $table->integer('detailvalue')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('orderdetails', function (Blueprint $table) {
            $table->dropColumn('detailvalue');
        });
    }
};
