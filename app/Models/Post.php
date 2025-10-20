<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    const TABLE = 'posts';

    protected $table = self::TABLE;
    protected $fillable = ['user_id', 'content', 'status'];
    protected $casts = ['status' => PostStatus::class];

    public function ownerOfPosts(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'user_id');
    }
    public function comments(): HasMany
    {
        return $this->hasMany(related: Comment::class, foreignKey: 'post_id', localKey: 'id');
    }

}
