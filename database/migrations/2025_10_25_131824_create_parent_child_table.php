<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {Schema::create('parent_child', function (Blueprint $table) {
    $table->id('RelationID');
    $table->unsignedBigInteger('ParentID')->nullable();
    $table->unsignedBigInteger('ChildID');
    $table->enum('RelationType', ['Cha - Con', 'Mẹ - Con', 'Cha Mẹ - Con', 'Mồ côi'])->default('Cha Mẹ - Con');
    $table->timestamps();

    // Khóa ngoại
    $table->foreign('ParentID')->references('PersonalID')->on('people')->onDelete('cascade');
    $table->foreign('ChildID')->references('PersonalID')->on('people')->onDelete('cascade');
});

    }

    public function down(): void
    {
        Schema::dropIfExists('parent_child');
    }
};
