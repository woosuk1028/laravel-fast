<?php
    $aes_key = '';

    function makeIdxKey($len = 10)
    {
        return make36UpperHexKey($len);
    }

    function makeUserKey($len = 10)
    {
        return make36UpperHexKey($len);
    }

    // 최대 11자리의 유일한 키 생성(대문자)
    function make36UpperHexKey($len)
    {
        $str = md5(uniqid(microtime().rand(), true));
        $num = hexdec($str); // 10의 38승 -> 36의 25승?
        $num = (int)($num/pow(10, 20));
        $hex = conv36UpperHex($num);

        if(strlen($hex) <= $len)
            return $hex;

        return substr($hex, 0, $len);
    }

    function conv36UpperHex($val)
    {
        $ar = array(
            "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J",
            "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T",
            "U", "V", "W", "X", "Y", "Z",
        );

        $hex = '';
        while($val >= 36)
        {
            $mod = ($val/36);
            $remain = $val % 36;
            $hex = $ar[$remain].$hex;
            $val = $mod;
        }
        $hex = $ar[$val].$hex;

        return $hex;
    }
    
    function location($url)
    {
        echo "<script>location.href='$url';</script>";
        exit;
    }

    function full_alert_location($uri, $msg)
    {
        echo "<script>alert('$msg'); location.href='$uri';</script>";
        exit;
    }

    function alert_location($uri, $msg)
    {
        echo "<script>alert('$msg'); location.href='/admx/$uri';</script>";
        exit;
    }

    function alert_back($msg)
    {
        echo "<script>alert('$msg'); history.back();</script>";
        exit;
    }

    function date_format_setting($date)
    {
        $result = "";
        if($date != "" || !empty($date)) {
            $result = date("Y-m-d", strtotime($date));
        }

        return $result;
    }

    function tester_form($method, $url, $name, $input=array(), $korean='')
    {
        echo '
        <div class="accordion mb-5" id="accordion'.$name.'">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$name.'" aria-expanded="false" aria-controls="collapse'.$name.'">
                        <span class="badge bg-success">'.$method.'</span> <span style="margin-left:10px; font-weight: bold;">'.$url.'</span> <span style="margin-left:10px;">- '.$korean.'</span>
                    </button>
                </h2>
                <div id="collapse'.$name.'" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordion'.$name.'">
                    <div class="accordion-body">
                        <form class="tester-form" id="'.$name.'Form" method="'.$method.'">
                                <input type="hidden" name="url" value="'.$url.'">
                            ';

                            foreach($input as $key)
                            {
                                input_create($key);
                            }

        echo '                <button type="button" class="btn btn-primary tester-btn">전송</button>
                        </form>
                    </div>

                    <div class="api-request">
                        <p style="font-weight: bold;">REQUEST</p>
                        <p class="request-text">API 요청이 여기에 표시됩니다.</p>
                    </div>

                    <div class="api-response">
                        <p style="font-weight: bold;">RESPONSE</p>
                        <p class="response-text">API 응답이 여기에 표시됩니다.</p>
                    </div>
                </div>
            </div>
        </div>
        ';
    }

    function tester_socket_form($method, $url, $name, $input=array(), $korean='')
    {
        echo '
            <div class="accordion mb-5" id="accordion'.$name.'">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$name.'" aria-expanded="false" aria-controls="collapse'.$name.'">
                            <span class="badge bg-primary">'.$method.'</span> <span style="margin-left:10px; font-weight: bold;">'.$url.'</span> <span style="margin-left:10px;">- '.$korean.'</span>
                        </button>
                    </h2>
                    <div id="collapse'.$name.'" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordion'.$name.'">
                        <div class="accordion-body">
                            <form class="socket-form" id="'.$name.'Form" >
                                    <input type="hidden" name="socket_url" value="'.$url.'">
                                ';

                                    foreach($input as $key)
                                    {
                                        input_create($key);
                                    }

        echo '                <button type="button" class="btn btn-primary socket-btn">전송</button>
                            </form>
                        </div>
    
                        <div class="api-request socket-request">
                            <p style="font-weight: bold;">REQUEST</p>

                        </div>
    
                        <div class="api-response socket-response">
                            <p style="font-weight: bold;">RESPONSE</p>

                        </div>
                    </div>
                </div>
            </div>
            ';
    }

    function input_create($key, $name="")
    {
        echo '<div class="form-floating mb-3">
                <input type="text" class="form-control" id="'.$key.'Input" name="'.$key.'" placeholder="'.$key.'">
                <label for="'.$key.'Input" class="label-color">'.$key.'</label>
              </div>
              ';
    }