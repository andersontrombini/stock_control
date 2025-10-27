<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Technical extends Model
{
    protected $table = 'technical';
    
    protected $fillable = [
        'user_id',
        'phone',
        'specialty'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function serviceOrders(): HasMany
    {
        return $this->hasMany(ServiceOrder::class);
    }
}
