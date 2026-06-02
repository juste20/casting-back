<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('casting_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('casting_casting_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('casting_id')->constrained()->cascadeOnDelete();
            $table->foreignId('casting_category_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('casting_casting_category');
        Schema::dropIfExists('casting_categories');
    }
};