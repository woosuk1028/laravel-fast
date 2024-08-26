<?php
namespace App\Traits;
use Illuminate\Support\Facades\Validator;
trait ApiTraits
{
    private function requestParam($request)
    {
        $json = $request->getContent();

        // "\n" 문자 제거
        $json = str_replace("\n", "", $json);

        // "\u003d"를 "="로 변환
        $json = json_decode('"' . $json . '"');

        // 암호화된 문자열 디코드
        $decodedData = $this->decodeText($json);

//         디코드된 데이터를 JSON으로 파싱
        $data = json_decode($decodedData, true);

//        $data = json_decode($json, true);

        if (empty($data['app_key']) || empty($data['version']))
        {
            error_log("app_key or version empty");
            $this->writeErrorAndExit(config('error_code._ER_PARAM_ERROR'), config('error_code._ERM_PARAM_ERROR'));
        }


        return $data;
    }

    private function requestParamTest($request)
    {
        $json = $request->getContent();
        $data = json_decode($json, true);

        if(empty($data['app_key']) || empty($data['version']))
        {
            $this->writeErrorAndExit(config('error_code._ER_PARAM_ERROR'), config('error_code._ERM_PARAM_ERROR'));
        }

        return $data;
    }

    private function encodeText($plain_text)
    {
        $aes_key = config('variables.AesKey');
        if(empty($plain_text))
            return "";

        $text = base64_encode(openssl_encrypt($plain_text, "aes-256-cbc", $aes_key, true, str_repeat(chr(0), 16)));
        return $text;
    }

    private function decodeText($base64_text)
    {
        $aes_key = config('variables.AesKey');
        if(empty($base64_text))
            return "";

        return openssl_decrypt(base64_decode($base64_text), "aes-256-cbc", $aes_key, true, str_repeat(chr(0), 16));
    }

    private function admin_encodeText($plain_text)
    {
        $aes_key = config('variables.WAES_KEY');
        if(empty($plain_text))
            return "";

        $text = base64_encode(openssl_encrypt($plain_text, "aes-256-cbc", $aes_key, true, str_repeat(chr(0), 16)));

        return $text;
    }

    private function admin_decodeText($plain_text)
    {
        $aes_key = config('variables.WAES_KEY');
        if(empty($plain_text))
            return "";

        $text = $plain_text;
        return openssl_decrypt(base64_decode($text), "aes-256-cbc", $aes_key, true, str_repeat(chr(0), 16));
    }

    private function writeError($errNo, $errMsg)
    {
        $arr['res_code'] = $errNo;
        $arr['res_msg'] = $errMsg;
        $res = $this->encodeText(json_encode($arr));

        echo($res);
    }

    private function writeErrorAndExit($errNo, $errMsg)
    {
        $arr['res_code'] = $errNo;
        $arr['res_msg'] = $errMsg;
        $res = $this->encodeText(json_encode($arr));

        echo($res);

        exit();
    }

    private function writeArray($arr)
    {
        $res = $this->encodeText(json_encode($arr, JSON_UNESCAPED_UNICODE));
        echo($res);
    }

    private function writeArrayAndExit($arr)
    {
        $res = $this->encodeText(json_encode($arr, JSON_UNESCAPED_UNICODE));
        echo($res);
        exit();
    }

    private function fileGetParam($array, $key, $default = '') {
        return isset($array[$key]) ? $array[$key] : $default;
    }

    private function custom_sort_array($row, $type=2)
    {
        if (!$row) {
            return [];  // 혹은 적절한 오류 처리를 추가할 수 있습니다.
        }

        $states = array();
        $sortKeys = ['emerge', 'admin', 'all_ch'];

        if($type == 3 || $type == 4)
            $sortKeys = ['all_ch'];

        foreach ($sortKeys as $key) {
            $stateKey = "{$key}_state";
            $sortValueKey = "{$key}_sort";

            if ($row->$stateKey == 1) {
                $states[$key] = $row->$sortValueKey;
            }
        }

        asort($states);
        $sortedKeys = array_keys($states);

        return $sortedKeys;
    }

    private function getValueOrDefault($query, $attribute, $default = "")
    {
        return isset($query->$attribute) ? $query->$attribute : $default;
    }

    //두 좌표간의 거리를 구하기(WGS84 기준)
    //Get distance between coordinates in km
    //@param double $lat1 : 좌표1 위도
    //@param double $lon1 : 좌표1 경도
    //@param double $lat2 : 좌표2 위도
    //@param double $lon2 : 좌표2 경도
    //return double

    private function get_distance($lat1, $lon1, $lat2, $lon2)
    {
        /* WGS84 stuff */
        $a = 6378137;
        $b = 6356752.3142;
        $f = 1/298.257223563;
        /* end of WGS84 stuff */

        $L = deg2rad($lon2-$lon1);
        $U1 = atan((1-$f) * tan(deg2rad($lat1)));
        $U2 = atan((1-$f) * tan(deg2rad($lat2)));
        $sinU1 = sin($U1);
        $cosU1 = cos($U1);
        $sinU2 = sin($U2);
        $cosU2 = cos($U2);

        $lambda = $L;
        $lambdaP = 2*pi();
        $iterLimit = 20;
        while ((abs($lambda-$lambdaP) > pow(10, -12)) && ($iterLimit-- > 0)) {
            $sinLambda = sin($lambda);
            $cosLambda = cos($lambda);
            $sinSigma = sqrt(($cosU2*$sinLambda) * ($cosU2*$sinLambda) + ($cosU1*$sinU2-$sinU1*$cosU2*$cosLambda) * ($cosU1*$sinU2-$sinU1*$cosU2*$cosLambda));

            if ($sinSigma == 0) {
                return 0;
            }

            $cosSigma   = $sinU1*$sinU2 + $cosU1*$cosU2*$cosLambda;
            $sigma      = atan2($sinSigma, $cosSigma);
            $sinAlpha   = $cosU1 * $cosU2 * $sinLambda / $sinSigma;
            $cosSqAlpha = 1 - $sinAlpha*$sinAlpha;
            $cos2SigmaM = $cosSigma - 2*$sinU1*$sinU2/$cosSqAlpha;

            if (is_nan($cos2SigmaM)) {
                $cos2SigmaM = 0;
            }

            $C = $f/16*$cosSqAlpha*(4+$f*(4-3*$cosSqAlpha));
            $lambdaP = $lambda;
            $lambda = $L + (1-$C) * $f * $sinAlpha *($sigma + $C*$sinSigma*($cos2SigmaM+$C*$cosSigma*(-1+2*$cos2SigmaM*$cos2SigmaM)));
        }

        if ($iterLimit == 0) {
            // formula failed to converge
            return NaN;
        }

        $uSq = $cosSqAlpha * ($a*$a - $b*$b) / ($b*$b);
        $A = 1 + $uSq/16384*(4096+$uSq*(-768+$uSq*(320-175*$uSq)));
        $B = $uSq/1024 * (256+$uSq*(-128+$uSq*(74-47*$uSq)));
        $deltaSigma = $B*$sinSigma*($cos2SigmaM+$B/4*($cosSigma*(-1+2*$cos2SigmaM*$cos2SigmaM)- $B/6*$cos2SigmaM*(-3+4*$sinSigma*$sinSigma)*(-3+4*$cos2SigmaM*$cos2SigmaM)));

        return round($b*$A*($sigma-$deltaSigma) / 1000, 2);


        /* sphere way */
        $distance = rad2deg(acos(sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($lon1 - $lon2))));

        $distance *= 111.18957696; // Convert to km

        return $distance;
    }

    private function required_param($value)
    {
        if(empty($value))
        {
            $arr['res_code'] = config('error_code._ER_PARAM_ERROR');
            $arr['res_msg']  = config('error_code._ERM_PARAM_ERROR');
            $this->writeArrayAndExit($arr);
        }
    }
}