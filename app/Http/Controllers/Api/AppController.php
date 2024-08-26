<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppInfo;

use App\Traits\ApiTraits;


class AppController extends Controller
{
    use ApiTraits;

    public function __construct()
    {

    }

    public function heartbeat(Request $request)
    {
        $data = $this->requestParam($request);

        $p = array();
        $p['app_key']       = $this->fileGetParam($data, 'app_key');

        //....

        $arr['res_code']    = config('error_code._ER_OK');
        $arr['res_msg']     = config('error_code._ERM_OK');
        $this->writeArray($arr);
    }
}
