<?php

use App\Models\Message;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(Message::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'sender_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId(column: 'receiver_id')->constrained('users')->cascadeOnDelete();
            $table->text(column: 'message');
            $table->boolean(column: 'read')->default(value: false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Message::TABLE);
    }
};
