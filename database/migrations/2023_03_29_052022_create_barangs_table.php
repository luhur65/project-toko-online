<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();

            $table->string('kode');
            $table->string('nama');
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->integer('harga');
            $table->integer('stok');
            $table->string('gambar');
            $table->string('keterangan');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
};
