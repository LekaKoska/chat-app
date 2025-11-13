<?php

use App\Models\UserProvider;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(UserProvider::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'user_id')->constrained(table: 'users')->cascadeOnDelete();
            $table->string(column: 'provider_id', length: 64);
            $table->string(column: 'provider_name', length: 64);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(UserProvider::TABLE);
    }
};
