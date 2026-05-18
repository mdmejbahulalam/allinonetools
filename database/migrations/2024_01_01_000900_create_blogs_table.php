<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->text('excerpt');
            $table->string('featured_image')->nullable();
            $table->unsignedBigInteger('author_id');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('keywords')->nullable();
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('admins')->onDelete('cascade');
            $table->index('status');
            $table->index('published_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
