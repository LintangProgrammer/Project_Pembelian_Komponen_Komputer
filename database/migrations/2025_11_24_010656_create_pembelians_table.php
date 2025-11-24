<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pembelian');
            $table->date('tanggal');
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')
                  ->references('id')
                  ->on('suppliers')
                  ->onDelete('cascade');
            $table->timestamps();            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
