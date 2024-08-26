<?php
namespace App\Traits;
use Illuminate\Support\Facades\Validator;
trait DataTraits
{
    //정렬 초기화
    public function initializeSorting($request) {
        $this->order_key = $request->order_key;
        $this->order = $request->order == '' ? 'DESC' : $request->order;
        if ($this->order == "DESC") {
            $this->return_order = 'ASC';
            $this->return_cls = '-desc';
        } else {
            $this->return_order = 'DESC';
            $this->return_cls = '-asc';
        }
    }

    //필터
    private function applyFilters($query, $request, $filters)
    {
        foreach ($filters as $filter) {
            $value = $request->input($filter);
            if ($request->has($filter) && $value != "") {
                $query->where($filter, $value);
            }
            else
            {
//                if($filter == 'run_state')
//                {
//                    $query->where($filter, 1);
//                }
            }
        }
        return $query;
    }

    //검색
    private function applySearch($query, $request, $search_keys)
    {
        if ($request->has('search')) {
            $query->where(function($query) use($search_keys, $request){
                foreach ($search_keys as $key) {
                    $query->orWhere($key, "like", "%" . $request->search . "%");
                }
            });
        }

        return $query;
    }

    //정렬
    private function orderData($query, $request, $defulat_order, $order_type="DESC")
    {
        $order_key  = $request->input('order_key');
        $order      = $request->input('order');

        if($request->has('order_key') && $request->has('order'))
        {
            $query->orderBy($order_key, $order);
        }
        else
        {
            $query->orderBy($defulat_order, $order_type);
        }

        return $query;
    }

    //데이터 추출 준비
    private function prepareData($query, $request)
    {
        $data = $query->paginate(config('variables.pageCnt'))->withQueryString();
        return $data;
    }

    //현재 조회된 열 이름 get
    private function get_row($value)
    {
        $data = array();

        if (!empty($value))
        {
            foreach ($value as $key)
            {
                foreach (json_decode($key) as $key2 => $val2)
                {
                    array_push($data, $key2);
                }
                break;
            }
        }

        return $data;
    }

    //테이블 정렬 생성
    private function order_make($value, $request)
    {
        $data = array();

        $url = $request->fullUrl() . "?";
        if (strpos($request->fullUrl(), '?') !== false)
        {
            $url = $request->fullUrl() . "&";
        }

        foreach($this->get_row($value) as $key => $val)
        {
            $cls = "";
            if ($this->order_key == $val)
            {
                $cls = $this->return_cls;
            }

            $front = "    <a href='" . $url . "order_key=$val&order=$this->return_order'>
                            <i class='la la-sort$cls float-right'></i>
                          </a>";

            $data[$val] = $front;
        }
        return $data;
    }

    //유효성 검사 메서드
    private function validateRequest($request, $rules) {
        return Validator::make($request->all(), $rules)->validate();
    }

    function admin_encodeText($plain_text)
    {
        $aes_key = config('variables.WAES_KEY');
        if(empty($plain_text))
            return "";

        $text = base64_encode(openssl_encrypt($plain_text, "aes-256-cbc", $aes_key, true, str_repeat(chr(0), 16)));

        return $text;
    }

    function admin_decodeText($plain_text)
    {
        $aes_key = config('variables.WAES_KEY');
        if(empty($plain_text))
            return "";

        $text = $plain_text;
        return openssl_decrypt(base64_decode($text), "aes-256-cbc", $aes_key, true, str_repeat(chr(0), 16));
    }

    //curl post
    private function curl_post($url, $field)
    {
        $ch = curl_init();
        $headers  = [
            //            'x-api-key: XXXXXX',
            'Content-Type: application/json'
        ];

        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($field));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result     = curl_exec ($ch);
        //        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        return $result;
    }

}
