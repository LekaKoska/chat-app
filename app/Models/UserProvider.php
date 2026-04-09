<?php

namespace App\Models;

use App\Enums\Socialite\ProvidersEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProvider extends Model
{
    const TABLE = 'user_providers';

    protected $fillable = ['user_id', 'provider_id', 'provider_name'];
    protected $casts = ['provider_name' => ProvidersEnum::class];

    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'user_id', ownerKey: 'id');
    }
}
