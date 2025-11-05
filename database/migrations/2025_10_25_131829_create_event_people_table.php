<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('event_people', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('EventID');
            $table->unsignedBigInteger('PersonalID');
            $table->string('Role', 100)->nullable(); // người tham gia, khách mời, chủ trì...
            $table->timestamps();

            $table->foreign('EventID')->references('EventID')->on('events')->onDelete('cascade');
            $table->foreign('PersonalID')->references('PersonalID')->on('people')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('event_people');
    }
};
