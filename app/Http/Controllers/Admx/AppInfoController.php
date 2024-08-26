<?php

namespace App\Http\Controllers\Admx;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppInfo;
use App\Traits\DataTraits;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class AppInfoController extends Controller
{
    use DataTraits;

    public function __construct(Request $request)
    {
        $this->initializeSorting($request);

        $this->page_name = "앱정보 관리";
        $this->prev_url  = URL::previous();
    }

    public function index(Request $request)
    {
        $request->session()->put('previous_page', $request->getQueryString());

        $data = array();

        $filters = ['run_state'];
        $search_keys = ['app_key', 'app_name'];
        $defulat_order = 'sort_key';

        $query = $this->applyFilters(AppInfo::query(), $request, $filters);
        $query = $this->applySearch($query, $request, $search_keys);
        $query = $this->orderData($query, $request, $defulat_order);
        $data['data'] = $this->prepareData($query, $request);

        //번호 추가
        $offset = ($data['data']->currentPage() - 1) * $data['data']->perPage() + 1;
        $data['data']->getCollection()->each(function ($item) use (&$offset) {
            $item->no = $offset++;
        });

//        if(!$request->has('run_state'))
//            $run_state = 1;
//        else
            $run_state = $request->run_state;

        $data['filter']['run_state']        = $run_state;
        $data['search']                     = $request->search;
        $data['url']                        = $request->fullUrl();
        $data['prev_url']                   = $this->prev_url;
        $data['arrays']                     = config('common_arrays');
        $data['active']                     = "app_info";
        $data['order']                      = $this->order_make($data['data'], $request);
        $data['page_name']                  = $this->page_name;
        return view('admx.front.app_info', $data);
    }

    //등록 view
    public function create()
    {
        $data['mode']       = "등록";
        $data['arrays']     = config('common_arrays');
        $data['active']     = "app_info";
        $data['page_name']  = $this->page_name;
        $data['prev_url']   = $this->prev_url;
        return view('admx.form.app_info', $data);
    }

    //등록 proc
    public function store(Request $request)
    {
        $date = date("Y-m-d H:i:s");

        $app_key            = $request->input('app_key');
        $app_name           = $request->input('app_name');
        $run_state          = $request->input('run_state', 1);
        //..

        //유효성 검사
        $rules = [
            'app_key' => 'required',
            'app_name' => 'required',
            'run_state' => 'required',
            //..
        ];

        $this->validateRequest($request, $rules);
        //유효성 검사_END

        $appInfo = new AppInfo();
        $appInfo->app_key = $app_key;
        $appInfo->app_name = $app_name;
        $appInfo->run_state = $run_state;
        //..

        if ($request->hasFile('img_url')) {
            if ($request->file('img_url')->isValid()) {
                $rand = rand(000000, 999999);
                $file = $request->file('img_url');
                $filename = $rand . "_" . time() . '.' . $file->getClientOriginalExtension();

                // Save file to public disk
                Storage::disk('public')->put("app_img/{$filename}", file_get_contents($file));

                // If you want to return the URL
                $img_url = Storage::url("app_img/{$filename}");
                $img_url = url($img_url);
                $appInfo->img_url = $img_url;
            }
        }

        $result = $appInfo->save();

        $previous_page = "";
        if(!empty(session('previous_page')))
            $previous_page = "?".session('previous_page');

        if($result)
            return redirect('/'.config('common_arrays.type_url')[session('admin_type')].'/app_info'.$previous_page)->with('success_store', '등록되었습니다.');
        else
            return redirect('/'.config('common_arrays.type_url')[session('admin_type')].'/app_info'.$previous_page)->with('error', '알 수 없는 에러가 발생했습니다.\n관리자에게 문의해주세요');
    }

    //수정 view
    public function edit($id)
    {
        $id = Crypt::decrypt($id);

        $data['mode']       = "수정";
        $data['arrays']     = config('common_arrays');
        $data['active']     = "app_info";
        $data['data']       = AppInfo::where('app_key', $id)->first();
        $data['page_name']  = $this->page_name;
        $data['prev_url']   = $this->prev_url;
        return view('admx.form.app_info', $data);
    }

    //수정 proc
    public function update(Request $request, $id)
    {
        $date = date("Y-m-d H:i:s");

//        $app_key        = $request->input('app_key');
        $app_name       = $request->input('app_name');
        $run_state      = $request->input('run_state', 1);
        //...

        //유효성 검사
        $rules = [
            'app_name' => 'required',
            'run_state' => 'required',
            //...
        ];

        $this->validateRequest($request, $rules);
        //유효성 검사_END

        $id = Crypt::decrypt($id);

        $appInfo = AppInfo::find($id);
//        $appInfo->app_key = $app_key;
        $appInfo->app_name = $app_name;
        $appInfo->run_state = $run_state;
        //...

        if ($request->hasFile('img_url')) {
            if ($request->file('img_url')->isValid()) {
                $rand = rand(000000, 999999);
                $file = $request->file('img_url');
                $filename = $rand . "_" . time() . '.' . $file->getClientOriginalExtension();

                // Save file to public disk
                Storage::disk('public')->put("app_img/{$filename}", file_get_contents($file));

                // If you want to return the URL
                $img_url = Storage::url("app_img/{$filename}");
                $img_url = url($img_url);
                $appInfo->img_url = $img_url;
            }
        }

        $previous_page = "";
        if(!empty(session('previous_page')))
            $previous_page = "?".session('previous_page');

        $result = $appInfo->save();
        if($result)
            return redirect('/'.config('common_arrays.type_url')[session('admin_type')].'/app_info'.$previous_page)->with('success_edit', '수정되었습니다.');
        else
            return redirect('/'.config('common_arrays.type_url')[session('admin_type')].'/app_info'.$previous_page)->with('error', '알 수 없는 에러가 발생했습니다.\n관리자에게 문의해주세요');
    }
}
