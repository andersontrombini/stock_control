<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use Carbon\Carbon;

class DashBoardController extends Controller
{
    public function index()
    {
        Carbon::setLocale('pt_BR');
        setlocale(LC_TIME, 'pt_BR.UTF-8');
        
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Agrupar por tipo de serviço
        $servicesByType = ServiceOrder::selectRaw('type, COUNT(*) as total')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->groupBy('type')
            ->pluck('total', 'type')
            ->toArray();

        return view('dashboard', [
            'servicesByType' => $servicesByType,
            'monthName' => Carbon::now()->translatedFormat('F'),
        ]);
    }
}
