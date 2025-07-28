<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('bukti_pembayaran')->nullable()->after('hasil_file');
            $table->string('status_pembayaran')->default('menunggu')->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('bukti_pembayaran');
            $table->dropColumn('status_pembayaran');
        });
    }
};