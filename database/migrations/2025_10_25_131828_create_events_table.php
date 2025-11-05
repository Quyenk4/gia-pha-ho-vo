<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('events', function (Blueprint $table) {
            $table->id('EventID');
            $table->unsignedBigInteger('EventTypeID')->nullable();
            $table->string('Title', 255);
            $table->text('Description')->nullable();
            $table->date('EventDate')->nullable();
            $table->string('Location', 255)->nullable();
            $table->timestamps();

            $table->foreign('EventTypeID')->references('EventTypeID')->on('event_types')->onDelete('set null');
        });
    }

    public function down(): void {
        Schema::dropIfExists('events');
    }
};
