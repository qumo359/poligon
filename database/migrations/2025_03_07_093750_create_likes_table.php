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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Внешний ключ к таблице users
            $table->foreignId('blog_post_id')->constrained()->cascadeOnDelete(); // Внешний ключ к таблице blog_posts
            $table->timestamps();

            $table->unique(['user_id', 'blog_post_id'], 'unique_user_post_like'); // Уникальность лайка пользователя для поста
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
