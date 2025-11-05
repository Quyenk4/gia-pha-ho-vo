<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id('StatisticID');
            $table->integer('TotalMembers')->default(0);
            $table->integer('MaleCount')->default(0);
            $table->integer('FemaleCount')->default(0);
            $table->integer('TotalMarriages')->default(0);
            $table->integer('TotalEvents')->default(0);
            $table->timestamp('LastUpdated')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('statistics');
    }
};
