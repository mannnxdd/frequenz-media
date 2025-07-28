<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->string('judul');
    $table->text('deskripsi');
    $table->enum('jenis', ['desain', 'foto']);
    $table->enum('status', ['menunggu', 'proses', 'selesai'])->default('menunggu');
    $table->date('tanggal_pesanan');
    $table->date('deadline_pesanan');
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
