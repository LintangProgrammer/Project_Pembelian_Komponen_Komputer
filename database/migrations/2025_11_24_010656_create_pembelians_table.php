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
     $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};