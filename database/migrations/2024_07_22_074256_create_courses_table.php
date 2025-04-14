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
        Schema::create('tbl_courses', function (Blueprint $table) {
            $table->id();
            // Foreign key constraint
            $table->foreignId('mentor_id')->constrained('users')->onDelete('cascade');
            $table->string('category')->nullable(false);
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->text('cover')->nullable(false);
            $table->enum('type', ['free', 'premium']);
            $table->enum('status', ['draft', 'published']);
            $table->integer('price')->nullable(false);
            $table->enum('level', ['beginner', 'intermediate', 'expert']);
            $table->text('sort_description')->nullable(false);
            $table->text('long_description')->nullable(false);
            $table->text('link_resources')->nullable(true);
            $table->text('link_groups')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_courses');
    }
};
