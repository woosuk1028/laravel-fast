<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AppInfo;
use App\Models\AppDau;
use App\Models\DailyHit;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MkDailyHit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mk-daily-hit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $appKeys = AppInfo::where('run_state', 1)->pluck('app_key');
        $currentDate = now();

        for ($i = 0; $i <= 5; $i++) {
            $date = $currentDate->addDays($i)->format('Y-m-d');

            foreach ($appKeys as $appKey) {
                if (DailyHit::where('app_key', $appKey)->where('active_date', $date)->where('time_hour', 0)->exists())
                {
                    continue;
                }

                for ($hour = 0; $hour < 24; $hour++) {
                    DailyHit::create([
                        'app_key' => $appKey,
                        'active_date' => $date,
                        'time_hour' => $hour
                    ]);
                }
            }
        }
    }
}
