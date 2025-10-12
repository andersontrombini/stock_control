<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ServiceOrder extends Model
{
    protected $fillable = [
        'technicial_id',
        'client_name',
        'client_address',
        'client_plan',
        'type',
        'description',
        'status',
    ];

    public function technician(): BelongsTo
    {
        return $this->belongsTo(Technicial::class);
    }

    public function equipment(): BelongsToMany
    {
        return $this->belongsToMany(Equipment::class, 'equipment_service_order')
                    ->withPivot('quantity_used')
                    ->withTimestamps();
    }
}
