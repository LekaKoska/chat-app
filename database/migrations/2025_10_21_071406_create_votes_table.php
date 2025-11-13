<?php

use App\Models\Post;
use App\Models\Vote;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(Vote::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'user_id')->constrained(table: 'users')->cascadeOnDelete();
            $table->foreignId(column: 'post_id')->constrained(table: Post::TABLE)->cascadeOnDelete();
            $table->tinyInteger(column: 'vote');
            $table->unique(columns: ['user_id', 'post_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Vote::TABLE);
    }
};
