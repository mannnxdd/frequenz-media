<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Tambahkan kolom order_id jika belum ada
            if (!Schema::hasColumn('projects', 'order_id')) {
                $table->unsignedBigInteger('order_id')->after('id')->nullable();
                $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            }

            // Kolom publish_at dan status jika belum ada
            if (!Schema::hasColumn('projects', 'publish_at')) {
                $table->timestamp('publish_at')->nullable()->after('order_id');
            }

            if (!Schema::hasColumn('projects', 'status')) {
                $table->string('status')->default('draft')->after('publish_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropColumn(['order_id', 'publish_at', 'status']);
        });
    }
};
