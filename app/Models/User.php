<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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
        'surname',
        'password',
        'fiscal_code',
        'date_of_birth',
        'email',
        'phone',
        'image',
        'is_active',
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
            'phone_verified_at' => 'datetime',
            'date_of_birth' => 'date',
            'password' => 'hashed',
        ];
    }

    public function getFilamentAvatarUrl(): ?string
    {
        // return $this->avatar_url;
    }

    public function setFiscalCodeAttribute($value)
    {
        $this->attributes['fiscal_code'] = strtoupper($value);
    }

    public function getFullNameAttribute()
    {
        return $this->name.' '.$this->surname;
    }

    public function getFullSurameAttribute()
    {
        return $this->surname.' '.$this->name;
    }

    public function getFilamentName(): string
    {
        return "{$this->name} {$this->surname}";
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }
}
