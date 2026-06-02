<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('castings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('country');
            $table->date('date');
            $table->time('time');
            $table->text('description');
            $table->string('poster')->nullable();
            $table->string('promoter_email');
            $table->string('promoter_phone')->nullable();;
            $table->enum('status', ['pending','validated','rejected','archived'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('castings');
    }
};