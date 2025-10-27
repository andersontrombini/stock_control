<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'quantity',
        'status',
        'low_stock_threshold',
    ];

    public function serviceOrders(): BelongsToMany
    {
        return $this->belongsToMany(ServiceOrder::class, 'equipment_service_order')
            ->withPivot('quantity_used')
            ->withTimestamps();
    }

    public function getIsMeasuredInMetersAttribute(): bool
    {
        return in_array(strtolower($this->name), ['cabo de rede', 'bobina']);
    }

    public function getFormattedQuantityAttribute(): string
    {
        return $this->is_measured_in_meters
            ? $this->quantity . ' M'
            : (string) $this->quantity;
    }

    public function getFormattedLowStockThresholdAttribute(): string
    {
        return $this->is_measured_in_meters
            ? $this->low_stock_threshold . ' M'
            : (string) $this->low_stock_threshold;
    }
}
