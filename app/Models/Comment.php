<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;
    const TABLE = 'comments';
    protected $table = self::TABLE;

    protected $fillable = [
        'post_id',
        'user_id',
        'comment'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'user_id', ownerKey: 'id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(related: ReplyComment::class, foreignKey: 'comment_id', localKey: 'id');
    }

    public function posts(): BelongsTo
    {
        return $this->belongsTo(related: Post::class, foreignKey: 'post_id', ownerKey: 'id');
    }

}
