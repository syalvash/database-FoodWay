<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resto', function (Blueprint $table) {
            $table->id();
            $table->String('email');
            $table->String('password');
            $table->String('nama_pemilik');
            $table->String('no_ktp');
            $table->String('no_hp');
            $table->String('nama_outlet');
            $table->String('no_telp_outlet');
            $table->String('alamat');
            $table->String('no_rek');
            $table->String('bank');
            $table->softDeletes();
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
        Schema::dropIfExists('resto');
    }
}
