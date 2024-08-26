<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppInfo;
use Illuminate\Http\Request;
use App\Traits\ApiTraits;
use Illuminate\Support\Facades\DB;

class TesterController extends Controller
{
    use ApiTraits;

    public function __construct()
    {

    }

    public function index()
    {
        $data = array();

        $data['splash'] = [
            'app_key',
            //...
        ];

        return view('tester.tester', $data);
    }

    public function api_test(Request $request)
    {
        $p = array();
        $data = array();
        $data['url'] = $request->input('url');

        foreach($request->all() as $key => $val)
        {
            $p[$key] = $val;
        }

        unset($p['url']);
        unset($p['_token']);

        $jsonData = json_encode($p, JSON_UNESCAPED_UNICODE);
        $encodeData = $this->encodeText($jsonData);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => config('variables.url2').$data['url'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $encodeData,
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $data['request'] = $jsonData;
        $data['response'] = $this->decodeText($response);

        return response()->json($data);
    }

}
