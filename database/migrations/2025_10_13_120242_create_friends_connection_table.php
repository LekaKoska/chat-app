<?php

use App\Enums\FriendStatus;
use App\Models\FriendConnectionModel;
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
        Schema::create(FriendConnectionModel::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'sender_id')->constrained(table: 'users')->cascadeOnDelete();
            $table->foreignId(column: 'receiver_id')->constrained(table: 'users')->cascadeOnDelete();
            $table->string(column: 'status')->default(value: FriendStatus::Pending->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(FriendConnectionModel::TABLE);
    }
};
