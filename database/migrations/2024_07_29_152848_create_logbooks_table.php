<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogbooksTable extends Migration
{
    public function up()
    {
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_id')->constrained()->onDelete('cascade');
            $table->date('tanggal');
            $table->text('kegiatan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('logbooks');
    }
}