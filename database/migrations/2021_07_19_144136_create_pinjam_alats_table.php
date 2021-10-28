<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamAlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjam_alats', function (Blueprint $table) {
            $table->id('id');
            $table->string('praktikum')->nullable();
            $table->integer('customer_id');
            $table->string('nim')->nullable();
            $table->string('kelas')->nullable();
            $table->string('semester')->nullable();
            $table->string('tanggal_pinjam')->nullable();
            $table->string('tanggal_kembali')->nullable();
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
        Schema::dropIfExists('pinjam_alats');
    }
}
