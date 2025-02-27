<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements FilamentUser, HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, InteractsWithMedia, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function getAvatarUrl(): string
    {
        if ($this->avatar && Storage::exists($this->avatar)) {
            return Storage::url($this->avatar);
        }

        $avatarUrl = $this->getFirstMediaUrl('users');

        $gravatarHash = md5(strtolower(trim($this->email)));

        return $avatarUrl ?: "https://www.gravatar.com/avatar/{$gravatarHash}?s=200&d=mp";
    }

    protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => Arr::first(explode(' ', $attributes['name'])),
        );
    }

    public function canAccessPanel(Panel $panel): bool
    {
        $allowedEmails = [
            'vladimir@codingwisely.com',
            'namru.mail@gmail.com',
            'namrata@gmail.com',
        ];

        return in_array($this->email, $allowedEmails, true);
    }
}
