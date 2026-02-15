<?php

namespace App\Exports;

use App\Models\ServiceOrder;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ServiceOrdersExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [];

        $types = ServiceOrder::whereMonth('updated_at', now()->month)
            ->whereYear('updated_at', now()->year)
            ->select('type')
            ->distinct()
            ->pluck('type');

        foreach ($types as $type) {
            $sheets[] = new ServiceOrdersByTypeSheet($type);
        }

        return $sheets;
    }
}
