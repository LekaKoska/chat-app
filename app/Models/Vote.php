<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    use HasFactory;

    const TABLE = 'votes';
    protected $table = self::TABLE;
    protected $fillable = [
        'user_id',
        'post_id',
        'vote'
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(related: Post::class, foreignKey: 'post_id', ownerKey: 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'user_id', ownerKey: 'id');
    }
}
