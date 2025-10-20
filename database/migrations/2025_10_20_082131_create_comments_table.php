<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'post_id')->constrained(table: Post::TABLE)->cascadeOnDelete();
            $table->foreignId(column: 'user_id')->constrained(table: 'users')->cascadeOnDelete();
            $table->string(column: 'comment');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
