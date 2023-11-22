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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama',100);
            $table->String('ukuran');
            $table->string('warna', 100);
            $table->string('link_shop', 100);
            $table->string('harga', 50);
            $table->string('kategori', 50);
            $table->string('fotobaju_satu');
            $table->string('fotobaju_dua');
            $table->string('fotobaju_tiga');
            $table->text('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
