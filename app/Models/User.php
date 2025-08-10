<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Boolean;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_user';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_name',
        'nim',
        'prodi',
        'role_id',
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

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->full_name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id_role');
    }

    public function aspirasiSaya(): HasMany
    {
        return $this->hasMany(Aspirasi::class, 'diajukan_oleh', 'id_user');
    }

    public function aspirasiKeSaya(): HasMany
    {
        return $this->hasMany(Aspirasi::class, 'ditujukan_ke', 'id_user');
    }

    #[Scope]
    protected function onlyAdmin($query)
    {
        $query->whereHas('role', function ($query) {
            $query->where('role_name', 'Admin');
        });
    }

    #[Scope]
    protected function onlyRektor($query)
    {
        $query->whereHas('role', function ($query) {
            $query->where('role_name', 'Rektor');
        });
    }

    #[Scope]
    protected function onlyWarek($query)
    {
        $query->whereHas('role', function ($query) {
            $query->where('role_name', 'Wakil Rektor I') || $query->where('role_name', 'Wakil Rektor II') || $query->where('role_name', 'Wakil Rektor III');
        });
    }

    #[Scope]
    protected function onlyMahasiswa($query)
    {
        $query->whereHas('role', function ($query) {
            $query->where('role_name', 'Mahasiswa');
        });
    }
}
