<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserLogin;
use App\Models\SecessionUser;

class UserStateUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:user-state-update';

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
        $date = date("Y-m-d H:i:s");
        $dateFifteenDaysAgo = strtotime("-15 days");

        $userLoginQuery = UserLogin::where('login_type', 1)->where('run_state', 4);
        $userLoginExists = $userLoginQuery->exists();
        $userLogin = $userLoginQuery->get();
        if($userLoginExists)
        {
            foreach($userLogin as $key => $val)
            {
                $secessionUserQuery = SecessionUser::where('login_key', $val['login_key'])->where('run_state', 1);
                $secessionUser = $secessionUserQuery->first();
                if($secessionUser)
                {
                    $userCreateDate = strtotime($secessionUser['create_date']);

                    if ($userCreateDate <= $dateFifteenDaysAgo)
                    {
                        $secessionUserQuery->update(['run_state' => 2]);
                        UserLogin::where('seq', $val['seq'])->delete();
                    }
                }
            }
        }

    }
}
