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
    Schema::create('hasil_itsa', function (Blueprint $table) {
        $table->id();

        $table->unsignedBigInteger('formulir_id')->unique();
        $table->foreign('formulir_id')->references('id')->on('formulir')->onDelete('cascade');
        $table->string('image')->nullable();   
        $table->text('deskripsi')->nullable();    
        $table->string('tautan')->nullable();                     
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_itsa');
    }
};
