<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aspirasi extends Model
{
    protected $primaryKey = 'id_aspirasi';

    protected $fillable = [
        'diajukan_oleh',
        'ditujukan_ke',
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
}
