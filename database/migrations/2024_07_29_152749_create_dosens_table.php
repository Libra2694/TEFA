<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosensTable extends Migration
{
    public function up()
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nidn');
            $table->enum('kelamin', ['laki-laki', 'perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('nomor_telepon');
            $table->string('prodi');
            $table->string('jabatan');
            $table->string('pangkat');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosens');
    }
}