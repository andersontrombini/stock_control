<?php

namespace App\Exports;

use App\Models\Equipment;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class EquipmentsExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    WithTitle,
    ShouldAutoSize
{
    public function collection()
    {
        return Equipment::select('name', 'quantity')
            ->orderBy('name')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Equipamento',
            'Quantidade',
        ];
    }

    /**
     * 🎨 Estilo do cabeçalho (igual Ordens de Serviço)
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => 'DCE6F1', // azul claro padrão
                    ],
                ],
            ],
        ];
    }

    /**
     * 🏷️ Nome da aba com mês/ano
     */
    public function title(): string
    {
        return 'Estoque ' . Carbon::now()->format('m-Y');
    }
}
