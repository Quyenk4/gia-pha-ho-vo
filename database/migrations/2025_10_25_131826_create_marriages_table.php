<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('marriages', function (Blueprint $table) {
            $table->id('MarriageID');
            $table->unsignedBigInteger('HusbandID')->nullable();
            $table->unsignedBigInteger('WifeID')->nullable();
            $table->date('MarriageDate')->nullable();
            $table->enum('Status', ['Đang sống chung', 'Ly hôn', 'Mất vợ', 'Mất chồng'])->default('Đang sống chung');
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('HusbandID')->references('PersonalID')->on('people')->onDelete('cascade');
            $table->foreign('WifeID')->references('PersonalID')->on('people')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('marriages');
    }
};
