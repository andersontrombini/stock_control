<?php

namespace App\Exports;

use App\Models\ServiceOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ServiceOrdersByTypeSheet implements
    FromCollection,
    WithHeadings,
    WithTitle,
    WithStyles,
    WithColumnFormatting,
    ShouldAutoSize
{
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     * 📊 Dados da planilha
     */
    public function collection()
    {
        return ServiceOrder::where('type', $this->type)
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($order) {
                return [
                    $order->client_name,
                    $order->client_address,
                    $order->client_plan,
                    Date::dateTimeToExcel($order->updated_at), // ✅ data real do Excel
                ];
            });
    }

    /**
     * 🧾 Cabeçalho
     */
    public function headings(): array
    {
        return [
            'Cliente',
            'Endereço',
            'Plano',
            'Última Atualização',
        ];
    }

    /**
     * 🎨 Estilo do cabeçalho
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [ // linha do cabeçalho
                'font' => [
                    'bold' => true,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => 'DCE6F1', // azul claro
                    ],
                ],
            ],
        ];
    }

    /**
     * 📅 Formatação das colunas
     */
    public function columnFormats(): array
    {
        return [
            'D' => 'dd/mm/yyyy hh:mm', // padrão brasileiro
        ];
    }

    /**
     * 🗂️ Nome da aba (usando helper)
     */
    public function title(): string
    {
        return service_type_label($this->type);
    }
}
