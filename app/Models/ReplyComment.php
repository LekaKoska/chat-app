<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReplyComment extends Model
{
    use HasFactory;

    const TABLE = 'reply_comments';

    protected $table = self::TABLE;
    protected $fillable = ['user_id', 'comment_id', 'reply_comment'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class);
    }

    protected function replyComment(): Attribute
    {
        return Attribute::make(
            set: fn($value) => strtolower($value)
        );
    }
}
