@extends('admx.layout.default')

@section('title', 'main')

@section('contents')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <h3 class="content-header-title">{{$page_name}}</h3>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{$mode}}</h4>
                            </div>
                            <div class="card-block">
                                <div class="card-body">
                                    @if($mode == "수정")
                                        <form class="form" action="/{{config('common_arrays.type_url')[session('admin_type')]}}/{{$active}}/update/{{Crypt::encrypt($data->app_key)}}" method="post" id="main_form" enctype="multipart/form-data">
                                    @else
                                        <form class="form" action="/{{config('common_arrays.type_url')[session('admin_type')]}}/{{$active}}/store" method="post" id="main_form" enctype="multipart/form-data">
                                    @endif
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <x-form.input
                                                            width="6"
                                                            type="text"
                                                            name="app_key"
                                                            placeholder="앱키"
                                                            :value="$data->app_key ?? null"
                                                            :disabled="$mode=='수정'?'disabled':''"
                                                            :errors="$errors"
                                                            oninput="handleOnInput(this, 5)"
                                                    />

                                                    <x-form.input
                                                            width="6"
                                                            type="text"
                                                            name="app_name"
                                                            placeholder="어플명"
                                                            :value="$data->app_name ?? null"
                                                            :errors="$errors"
                                                            oninput="handleOnInput(this, 20)"
                                                    />

                                                    <x-form.select
                                                            width="6"
                                                            name="run_state"
                                                            label="상태"
                                                            :options="$arrays['run_state']"
                                                            :selected="old('run_state', $data->run_state ?? null)"
                                                            :errors="$errors"
                                                    />

                                                    <x-form.input
                                                            width="6"
                                                            type="text"
                                                            name="sort_key"
                                                            placeholder="정렬키"
                                                            :value="$data->sort_key ?? null"
                                                            :errors="$errors"
                                                    />

                                                    <x-form.input
                                                            width="3"
                                                            type="text"
                                                            name="app_ver_code"
                                                            placeholder="버전코드"
                                                            :value="$data->app_ver_code ?? null"
                                                            :errors="$errors"
                                                            numberOnly
                                                    />

                                                    <x-form.input
                                                            width="3"
                                                            type="text"
                                                            name="popup_ver_code"
                                                            placeholder="팝업버전"
                                                            :value="$data->popup_ver_code ?? null"
                                                            :errors="$errors"
                                                            numberOnly
                                                    />

                                                    <x-form.input
                                                            width="3"
                                                            type="text"
                                                            name="min_ver_code"
                                                            placeholder="최소버전"
                                                            :value="$data->min_ver_code ?? null"
                                                            :errors="$errors"
                                                            numberOnly
                                                    />

                                                    <x-form.input
                                                            width="3"
                                                            type="text"
                                                            name="app_ver_name"
                                                            placeholder="버전네임"
                                                            :value="$data->app_ver_name ?? null"
                                                            :errors="$errors"
                                                    />

                                                    <x-form.input
                                                            width="6"
                                                            type="text"
                                                            name="ad_runtime"
                                                            placeholder="광고 스킵(초)"
                                                            :value="$data->ad_runtime ?? null"
                                                            :errors="$errors"
                                                            numberOnly
                                                    />

                                                    <x-form.input
                                                            width="6"
                                                            type="text"
                                                            name="fcm_server_key"
                                                            placeholder="FCM 서버키"
                                                            :value="$data->fcm_server_key ?? null"
                                                            :errors="$errors"
                                                    />

                                                    <x-form.input
                                                            width="6"
                                                            type="text"
                                                            name="fcm_topic"
                                                            placeholder="FCM 토픽"
                                                            :value="$data->fcm_topic ?? null"
                                                            :errors="$errors"
                                                    />

                                                    <x-form.textarea
                                                            width="12"
                                                            name="memo"
                                                            :value="$data->memo ?? null"
                                                            rows="5"
                                                            placeholder="메모"
                                                    />

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-2 imgUp">
                                                        <label for="">이미지</label>

                                                        @if($mode=="수정")
                                                            <div class="imagePreview" style="background-image: url({{$data->img_url}})"></div>
                                                        @else
                                                            <div class="imagePreview"></div>
                                                        @endif
                                                        <label class="btn-sm btn-info btn-custom">
                                                            업로드<input type="file" class="uploadFile img" name="img_url" style="width: 0px;height: 0px;overflow: hidden;">
                                                            <input type="hidden" name="upload_check" value="1">
                                                        </label>
                                                    </div><!-- col-2 -->

                                                    <div class="col-md-10 mt-2">
                                                        <div class="card-text">
                                                            <ul>
                                                                <li>.jpg 및 .png 파일만 가능합니다.</li>
                                                                <li>최대 파일 크기는 500KB입니다.</li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                </div><!-- row -->

                                                <div class="form-actions">
                                                    <button type="button" class="btn btn-danger mr-1" onclick="history.back();">
                                                        <i class="ft-x"></i> 취소
                                                    </button>
                                                    <button type="button" class="btn btn-primary submit-button">
                                                        <i class="la la-check-square-o"></i> {{$mode}}
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).on("click",".submit-button",function(){
            $('#overlay').fadeIn();
            $("#main_form").submit();
        });
    </script>
@endsection
