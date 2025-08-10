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
        Schema::create('aspirasis', function (Blueprint $table) {
            $table->id('id_aspirasi');
            $table->unsignedBigInteger('diajukan_oleh');
            $table->unsignedBigInteger('ditujukan_ke');
            $table->text('aspirasi');
            $table->enum('status', ['pending','accepted', 'rejected', 'commented']);
            $table->foreign('diajukan_oleh')->references('id_user')->on('users');
            $table->foreign('ditujukan_ke')->references('id_user')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};
