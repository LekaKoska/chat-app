<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
