<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\BelongsToRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AspirasiNote extends Model
{
    protected $primaryKey = 'id_aspirasi_note';

    protected $fillable = [
        'note',
        'aspirasi_id',
        'oleh'
    ];

    public function aspirasi(): BelongsTo
    {
        return $this->belongsTo(Aspirasi::class, 'aspirasi_id', 'id_aspirasi');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'oleh', 'id_user');
    }
}
