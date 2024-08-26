<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AppInfo;
use App\Models\AppDau;
use App\Models\Company;
use App\Models\GroupList;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MkDau extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mk-dau';

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
        $NEXT_DAY_COUNT = 5;
        $appKeys = AppInfo::where('run_state', 1)->pluck('app_key');

        foreach ($appKeys as $appKey) {
            for ($i = 0; $i < $NEXT_DAY_COUNT; $i++) {
                $day = Carbon::today()->addDays($i)->format('Y-m-d');
                $this->createRow($appKey, $day);
            }
        }
    }

    protected function createRow($appKey, $activeDate)
    {
        $exists = AppDau::where('app_key', $appKey)
            ->where('active_date', $activeDate)
            ->exists();

        if (!$exists) {
            AppDau::insert([
                'app_key' => $appKey,
                'active_date' => $activeDate,
                'create_count' => 0,
                'login_count1' => 0,
                'login_count2' => 0,
                'active_count' => 0,
                'total_install' => 0,
                'hit_count1' => 0,
                'hit_count2' => 0,
                'hit_count3' => 0
            ]);
        }

    }
}
