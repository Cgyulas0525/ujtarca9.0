<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumns('orders',['order_status', 'delivered_date'])) {
            return;
        }

        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_status', 25)->nullable()->default('megrendelt')->after('description');
            $table->date('delivered_date')->nullable()->after('order_status');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('order_status');
            $table->dropColumn('delivered_date');
        });
    }
};
