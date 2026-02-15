<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command('stock:check-low')->dailyAt('08:00');

Schedule::command('report:monthly-service-orders')->lastDayOfMonth('17:59');

Schedule::command('report:weekly-equipments')->mondays()->at('09:00');

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
