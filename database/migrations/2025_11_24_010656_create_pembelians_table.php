<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // create parent table first
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pembelian')->unique();
            $table->date('tanggal');
            $table->foreignId('supplier_id')->constrained('suppliers')->cascadeOnDelete();
            $table->decimal('jumlah', 15, 2);
            $table->timestamps();
        });

        Schema::create('detail_pembelians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembelian_id')->constrained('pembelians')->cascadeOnDelete();
            $table->foreignId('komponen_id')->constrained('komponens')->cascadeOnDelete();
            $table->string('kode_pembelian');
            $table->string('nama_komponen');
            $table->integer('jumlah');
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // drop child table first to avoid foreign key errors
        Schema::dropIfExists('detail_pembelians');
        Schema::dropIfExists('pembelians');
    }
};