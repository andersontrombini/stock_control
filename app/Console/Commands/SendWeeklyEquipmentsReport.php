<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\WeeklyEquipmentsReportMail;
use App\Exports\EquipmentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class SendWeeklyEquipmentsReport extends Command
{
    protected $signature = 'report:weekly-equipments';

    protected $description = 'Envia relatório semanal de equipamentos por e-mail';

    public function handle()
    {
        $fileName = 'equipamentos_' . now()->format('d_m_Y') . '.xlsx';

        $fileContent = Excel::raw(
            new EquipmentsExport,
            \Maatwebsite\Excel\Excel::XLSX
        );

        Mail::to(['ander23br03@gmail.com'])
            ->send(new WeeklyEquipmentsReportMail($fileContent, $fileName));
    }
}
