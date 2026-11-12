<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cita extends Model
{
    protected $fillable = [
        'cliente_id',
        'barbero_id',
        'servicio_id',
        'franja_id',
        'estado',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function barbero(): BelongsTo
    {
        return $this->belongsTo(User::class, 'barbero_id');
    }

    public function servicio(): BelongsTo
    {
        return $this->belongsTo(Servicio::class);
    }

    public function franja(): BelongsTo
    {
        return $this->belongsTo(Franja::class);
    }
}
