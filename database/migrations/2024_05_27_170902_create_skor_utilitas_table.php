<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('supplier_kriterias', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('supplier_id');
    $table->unsignedBigInteger('kriteria_id');
    $table->float('bobot');
    $table->float('SkorUtilitas');
    $table->timestamps();
    $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
    $table->foreign('kriteria_id')->references('id')->on('kriterias')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skor_utilitas');
    }
};
