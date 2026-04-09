<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    const TABLE = 'posts';

    protected $table = self::TABLE;
    protected $fillable = ['user_id', 'content', 'status', 'slug'];
    protected $casts = ['status' => PostStatus::class];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = Str::slug(Str::limit($post->content, limit: 50));
        });

        static::updating(function ($post) {
            $post->slug = Str::slug(Str::limit($post->content, limit: 50));
        });
    }

    public function ownerOfPost(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(related: Comment::class, foreignKey: 'post_id', localKey: 'id');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(related: Vote::class, foreignKey: 'post_id', localKey: 'id');
    }

}
