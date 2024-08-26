<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AppInfo;
use App\Models\StageList;
use App\Models\StageHistory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MkStageHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mk-stage-history';

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
        $stageList = StageList::get();
        foreach ($stageList as $stage) {
            for ($i = 0; $i < $NEXT_DAY_COUNT; $i++) {
                $day = Carbon::today()->addDays($i)->format('Y-m-d');
                $this->createRow($stage, $day);
            }
        }
    }

    protected function createRow($stage, $activeDate)
    {
        $exists = StageHistory::where('app_key', $stage['app_key'])
            ->where('active_date', $activeDate)
            ->where('level', $stage['level'])
            ->where('stage', $stage['stage'])
            ->exists();

        if (!$exists) {
            StageHistory::insert([
                'app_key' => $stage['app_key'],
                'active_date' => $activeDate,
                'level' => $stage['level'],
                'stage' => $stage['stage'],
            ]);
        }

    }
}
