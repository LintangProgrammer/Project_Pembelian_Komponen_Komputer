<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('details_pembelians', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pembelian_id')->constrained('pembelians')->cascadeOnDelete();
    $table->foreignId('komponen_id')->constrained('komponens')->cascadeOnDelete();
    $table->integer('jumlah');
    $table->integer('subtotal');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pembelians');
    }
};