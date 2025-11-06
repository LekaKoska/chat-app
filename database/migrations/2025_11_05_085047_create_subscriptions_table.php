<?php

use App\Models\Subscription;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(Subscription::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'user_id')->constrained(table: 'users')->cascadeOnDelete();
            $table->foreignId(column: 'subscriber_id')->constrained(table: 'users')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['user_id', 'subscriber_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Subscription::TABLE);
    }
};
