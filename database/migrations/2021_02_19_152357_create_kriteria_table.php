<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKompetensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kompetensi', function (Blueprint $table) {
            $table->string('kode_kompetensi', 16)->primary();
            $table->string('nama_kompetensi')->nullable();
            $table->double('bobot')->nullable();
            $table->string('atribut', 16)->nullable();
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
        Schema::dropIfExists('tb_kompetensi');
    }
}
