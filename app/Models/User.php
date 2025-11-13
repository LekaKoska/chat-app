<?php

namespace App\Models;

use App\Enums\FriendStatus;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    public function posts(): HasMany
    {
        return $this->hasMany(related: Post::class, foreignKey: 'user_id', localKey: 'id');
    }

    public function followers(): BelongsToMany // Who follows this user
    {
        return $this->belongsToMany(related: User::class, table: 'subscriptions', foreignPivotKey: 'user_id', relatedPivotKey: 'subscriber_id')->withTimestamps();
    }

    public function following(): BelongsToMany // Who is being followed from this user
    {
        return $this->belongsToMany(related: User::class, table: 'subscriptions', foreignPivotKey: 'subscriber_id', relatedPivotKey: 'user_id')->withTimestamps();
    }
}
