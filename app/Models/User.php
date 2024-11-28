<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\Searchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use Searchable;
    use HasApiTokens;

    protected $fillable = [
        'name',
        'nim',
        'foto',
        'email',
        'Prodi',
        'tanggal',
        'password',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'tanggal' => 'date',
        'email_verified_at' => 'datetime',
    ];

    public function isSuperAdmin(): bool
    {
        return in_array($this->email, config('auth.super_admins'));
    }
}
