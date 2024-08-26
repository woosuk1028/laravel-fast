<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AppInfo;
use App\Models\FcmMessage;
use Illuminate\Support\Facades\DB;

class CheckFcm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-fcm';

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
//        error_log("CheckFcm");
        $now = date("Y-m-d H:i:s");

        $arMsgType = array(
            101 => 'APPOPEN',
            102 => 'PAGEOPEN',
            103 => 'OUTLINK',
            104 => 'NOTICE'
        );

        $term_time = "-10 minutes";
        $timestamp = time();
        $cur_time = date('Y-m-d H:i:s', $timestamp);
        $start_time = date('Y-m-d H:i:s', strtotime($term_time, $timestamp));

        $fcmMessageQuery = FcmMessage::where(function($query) use ($start_time, $cur_time) {
            $query->where('reserved_time', '>=', $start_time)
                ->where('reserved_time', '<=', $cur_time)
                ->where(function($q) {
                    $q->where('send_state', 1)
                        ->orWhere('send_state', 4);
                });
        })
            ->orWhere(function($query) {
                $query->where('send_state', 1)
                    ->orWhere('send_state', 4);
            })
            ->orderBy('reserved_time')
            ->get()
            ->toArray();

        $arMsg = array();
        if($fcmMessageQuery)
        {
            foreach($fcmMessageQuery as $key => $val)
            {
                $ar = array();
                $ar['seq']          = $val['seq'];
                $ar['app_key']      = $val['app_key'];
                $ar['msg_type']     = $arMsgType[$val['msg_type']];
                $ar['title']        = $val['title'];
                $ar['message']      = $val['message'];
                $ar['minver']		= $val['minver'];
                $ar['maxver']		= $val['maxver'];
                if($val['msg_type'] == 103)
                    $ar['wkey']		= _URL_HOME.'/fcm_popup.php?fkey='.$val['wkey'];
                else
                    $ar['wkey']		= $val['wkey'];
                $ar['link']			= $val['link'];
                $ar['wdate']		= $val['wdate'];
                $ar['send_type']	= $val['send_type'];
                $ar['send_state']	= $val['send_state'];

                $arMsg[] = $ar;
            }

            for($i=0; $i<count($arMsg); $i++)
            {
                $msg = $arMsg[$i];
                FcmMessage::where('seq', $msg['seq'])->update(['send_state' => 2]);
            }

            for($i=0; $i<count($arMsg); $i++)
            {
                $msg = $arMsg[$i];
                $success = $this->send_msg($msg);
                if($success)
                {
                    FcmMessage::where('seq', $msg['seq'])->update([
                        'send_state' => 3,
                        'send_time' => $now
                    ]);
                }
                else
                {
                    FcmMessage::where('seq', $msg['seq'])->update([
                        'send_state' => 4,
                        'fail_count' => DB::raw('fail_count + 1')
                    ]);
                }
            }
        }
    }

    protected function send_msg($msg)
    {
        $appInfoQuery = AppInfo::where('app_key', trim($msg['app_key']))->first();
        if($appInfoQuery)
        {
            if(empty($appInfoQuery->fcm_topic))
                return false;

            if(empty($appInfoQuery->fcm_server_key))
                return false;

            $fcm_topic = $appInfoQuery->fcm_topic;
            $server_key = $appInfoQuery->fcm_server_key;
            
            $success = false;

            $arMessage = array();
            $arMessage['to'] = "/topics/$fcm_topic";

            $data['type'] 	    = $msg['msg_type'];
            $data['title']		= $msg['title'];
            $data['message']	= $msg['message'];
            $data['minver']		= $msg['minver'];
            $data['maxver']		= $msg['maxver'];
            $data['wkey']       = $msg['wkey'];
            $data['link']		= $msg['link'];
            $data['seq']        = $msg['seq'];
            $arMessage['data']  = $data;

            echo json_encode($arMessage);

            $headers = array('Authorization:key='.$server_key,'Content-Type: application/json');

            $url = 'https://fcm.googleapis.com/fcm/send';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arMessage));
            $result = curl_exec($ch);
            error_log($result);
            if ($result === FALSE) {
                $success=false;
            }
            else
            {
                $success = true;
            }
            curl_close($ch);

            return $success;
        }
    }
}
