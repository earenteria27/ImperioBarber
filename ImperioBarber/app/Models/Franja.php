<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Franja extends Model
{
    protected $fillable = [
        'barbero_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
        ];
    }

    public function barbero(): BelongsTo
    {
        return $this->belongsTo(User::class, 'barbero_id');
    }
}
