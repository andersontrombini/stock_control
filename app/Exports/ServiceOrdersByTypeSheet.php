<?php

namespace App\Exports;

use App\Models\ServiceOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ServiceOrdersByTypeSheet implements FromCollection, WithHeadings, WithTitle
{
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function collection()
    {
        return ServiceOrder::where('type', $this->type)
            ->select('client_name', 'client_address', 'client_plan', 'updated_at')
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Cliente',
            'Endereço',
            'Plano',
            'Última Atualização',
        ];
    }

    public function title(): string
    {
        return ucfirst($this->type);
    }
}
