<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\MonthlyServiceOrdersReportMail;
use App\Exports\ServiceOrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class SendMonthlyServiceOrdersReport extends Command
{
    protected $signature = 'report:monthly-service-orders';

    protected $description = 'Envia relatório mensal de ordens de serviço por e-mail';

    public function handle()
    {
        $fileName = 'ordens_de_servico_' . now()->format('m_Y') . '.xlsx';

        $fileContent = Excel::raw(
            new ServiceOrdersExport,
            \Maatwebsite\Excel\Excel::XLSX
        );

        Mail::to(['ander23br03@gmail.com'])
            ->send(new MonthlyServiceOrdersReportMail($fileContent, $fileName));

        return Command::SUCCESS;
    }
}
