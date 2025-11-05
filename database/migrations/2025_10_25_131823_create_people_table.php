<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('people', function (Blueprint $table) {
            $table->id('PersonalID');
            $table->string('FullName', 255);
            $table->enum('Gender', ['Nam', 'Nữ', 'Khác']);
            $table->date('DateOfBirth')->nullable();
            $table->date('DateOfDeath')->nullable();
            $table->string('PlaceOfBirth', 255)->nullable();
            $table->string('CurrentAddress', 255)->nullable();
            $table->string('Occupation', 255)->nullable();
            $table->string('Phone', 50)->nullable();
            $table->string('Email', 255)->nullable();
            $table->text('Biography')->nullable();
            $table->string('Avatar', 255)->nullable();
            $table->integer('Generation')->nullable(); // ✅ thế hệ: 1,2,3...
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('people');
    }
};
