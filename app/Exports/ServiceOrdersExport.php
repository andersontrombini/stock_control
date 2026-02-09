<?php

namespace App\Exports;

use App\Models\ServiceOrder;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ServiceOrdersExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [];

        $types = ServiceOrder::select('type')->distinct()->pluck('type');

        foreach ($types as $type) {
            $sheets[] = new ServiceOrdersByTypeSheet($type);
        }

        return $sheets;
    }
}
