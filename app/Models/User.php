<?php

namespace App\Models;

use App\Enums\FriendStatus;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sendFriend(): BelongsToMany
    {
        return $this->belongsToMany(related: User::class, table: FriendConnectionModel::TABLE, foreignPivotKey: 'sender_id', relatedPivotKey: 'receiver_id')
            ->withPivot(columns: 'status')
            ->withTimestamps();
    }

    public function receiveFriend(): BelongsToMany
    {
        return $this->belongsToMany(related: User::class, table: FriendConnectionModel::TABLE, foreignPivotKey: 'receiver_id', relatedPivotKey: 'sender_id')
            ->withPivot(columns: 'status')
            ->withTimestamps();
    }
    public function getFriendsAttribute()
    {
        $sent = $this->sendFriend()->wherePivot(column: 'status', operator: FriendStatus::Accepted)->get();
        $received = $this->receiveFriend()->wherePivot(column: 'status', operator: FriendStatus::Accepted)->get();

        return $sent->merge($received);
    }

    public function posts()
    {
        return $this->hasMany(related: Post::class, foreignKey: 'user_id', localKey: 'id');
    }
}
