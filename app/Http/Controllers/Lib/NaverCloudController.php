<?php

namespace App\Http\Controllers\Lib;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NaverCloudController extends Controller
{
    protected $service_id;
    protected $service_key;
    protected $acc_key;
    protected $accsec_key;
    protected $call_num;

    public function __construct($service_id, $service_key, $acc_key, $accsec_key, $call_num)
    {
        $this->service_id = $service_id;
        $this->service_key = $service_key;
        $this->acc_key = $acc_key;
        $this->accsec_key = $accsec_key;
        $this->call_num = $call_num;
    }

    public function Send_SMS($mk_key, $hash_key, $phone_num)
    {
        $sID = $this->service_id; // 서비스 ID

        $smsURL = "https://sens.apigw.ntruss.com/sms/v2/services/" . $sID . "/messages";
        $smsUri = "/sms/v2/services/" . $sID . "/messages";
        $sKey = $this->service_key;

        $accKeyId = $this->acc_key;   //인증키 id
        $accSecKey = $this->accsec_key;  //secret key

        $sTime = floor(microtime(true) * 1000);

        $authNum = $mk_key;

        $postData = array(
            'type' => 'SMS',
            'countryCode' => '82',
            'from' => $this->call_num, // 발신번호 (등록되어있어야함)
            'contentType' => 'COMM',
            'content' => config('variables.site_name')." 인증문자",
            'messages' => array(array('content' => "<#>".config('variables.site_name')." 인증 문자. \n인증번호: [" . $authNum . "]\n" . $hash_key, 'to' => $phone_num))
        );

        $postFields = json_encode($postData);

        $hashString = "POST {$smsUri}\n{$sTime}\n{$accKeyId}";


        $dHash = base64_encode(hash_hmac('sha256', $hashString, $accSecKey, true));

        $header = array(
            'Content-Type: application/json; charset=utf-8',
            'x-ncp-apigw-timestamp: ' . $sTime,
            "x-ncp-iam-access-key: " . $accKeyId,
            "x-ncp-apigw-signature-v2: " . $dHash
        );

        $ch = curl_init($smsURL);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_POSTFIELDS => $postFields
        ));

        $response = curl_exec($ch);//설정된 옵션으로 실행한다

        curl_close($ch);//chrl을 닫아준다

        return $response;
    }

    public function AD_Send_SMS($URL, $phone_num)
    {
        $sID = $this->service_id; // 서비스 ID

        $smsURL = "https://sens.apigw.ntruss.com/sms/v2/services/" . $sID . "/messages";
        $smsUri = "/sms/v2/services/" . $sID . "/messages";
        $sKey = $this->service_key;

        $accKeyId = $this->acc_key;   //인증키 id
        $accSecKey = $this->accsec_key;  //secret key

        $sTime = floor(microtime(true) * 1000);


        $postData = array(
            'type' => 'SMS',
            'countryCode' => '82',
            'from' => $this->call_num, // 발신번호 (등록되어있어야함)
            'contentType' => 'COMM',
            'content' => config('variables.site_name')." 설치링크",
            'messages' => array(array('content' => "$URL", 'to' => $phone_num))
        );

        $postFields = json_encode($postData);

        $hashString = "POST {$smsUri}\n{$sTime}\n{$accKeyId}";


        $dHash = base64_encode(hash_hmac('sha256', $hashString, $accSecKey, true));

        $header = array(
            'Content-Type: application/json; charset=utf-8',
            'x-ncp-apigw-timestamp: ' . $sTime,
            "x-ncp-iam-access-key: " . $accKeyId,
            "x-ncp-apigw-signature-v2: " . $dHash
        );

        $ch = curl_init($smsURL);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_POSTFIELDS => $postFields
        ));

        $response = curl_exec($ch);//설정된 옵션으로 실행한다

        curl_close($ch);//chrl을 닫아준다

        return $response;
    }

    public function Link_Send_SMS($URL, $phone_num)
    {
        $sID = $this->service_id; // 서비스 ID

        $smsURL = "https://sens.apigw.ntruss.com/sms/v2/services/" . $sID . "/messages";
        $smsUri = "/sms/v2/services/" . $sID . "/messages";
        $sKey = $this->service_key;

        $accKeyId = $this->acc_key;   //인증키 id
        $accSecKey = $this->accsec_key;  //secret key

        $sTime = floor(microtime(true) * 1000);


        $postData = array(
            'type' => 'SMS',
            'countryCode' => '82',
            'from' => $this->call_num, // 발신번호 (등록되어있어야함)
            'contentType' => 'COMM',
            'content' => config('variables.site_name')." 설치링크",
            'messages' => array(array('content' => "$URL", 'to' => $phone_num))
        );

        $postFields = json_encode($postData);

        $hashString = "POST {$smsUri}\n{$sTime}\n{$accKeyId}";


        $dHash = base64_encode(hash_hmac('sha256', $hashString, $accSecKey, true));

        $header = array(
            'Content-Type: application/json; charset=utf-8',
            'x-ncp-apigw-timestamp: ' . $sTime,
            "x-ncp-iam-access-key: " . $accKeyId,
            "x-ncp-apigw-signature-v2: " . $dHash
        );

        $ch = curl_init($smsURL);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_POSTFIELDS => $postFields
        ));

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }
}
