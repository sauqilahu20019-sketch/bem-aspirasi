<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aspirasi extends Model
{
    protected $primaryKey = 'id_aspirasi';

    protected $fillable = [
        'diajukan_oleh',
        'ditujukan_ke',
        'ke_warek',
        'aspirasi',
        'status'
    ];

    public function pengaju(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diajukan_oleh', 'id_user');
    }

    public function yangDituju(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ditujukan_ke', 'id_user');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(AspirasiNote::class, 'aspirasi_id', 'id_aspirasi');
    }

    #[Scope]
    protected function onlyPending($query)
    {
        return $query->where('status', 'pending');
    }
    #[Scope]
    protected function onlyAcc($query)
    {
        return $query->where('status', 'accepted');
    }
    #[Scope]
    protected function onlyRej($query)
    {
        return $query->where('status', 'rejected');
    }
    #[Scope]
    protected function onlyCom($query)
    {
        return $query->where('status', 'commented');
    }
}
