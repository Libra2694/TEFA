<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_id')->constrained()->onDelete('cascade');
            $table->string('judul');
            $table->date('tanggal_upload');
            $table->enum('jenis_proposal', ['penelitian kualitatif', 'penelitian pengembangan', 'pengabdian masyarakat']);
            $table->enum('jenis', ['penelitian', 'pengabdian']);
            $table->string('file');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proposals');
    }
}