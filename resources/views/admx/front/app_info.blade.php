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

                <div class="content-header-right col-md-8 col-12 text-right">
                    @if(session('admin_type') == "admin")
                        <button type="button" class="btn btn-primary float-end" onclick="location.href='/admx/{{$active}}/create'">등록</button>
                    @endif
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">어플 내역</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12">
                                <form action="{{$url}}" method="get" id="filter_form">
                                    <div class="card-body">
                                        <fieldset class="form-group d-flex flex-wrap align-items-center">

                                            <div class="custom-select-container flex-grow-1 mb-2 mb-md-0 ">
                                                <label class="select-label">상태</label>
                                                <select class="form-control filter custom-select" id="basicSelect" name="run_state">
                                                    <option value="">전체</option>
                                                    @foreach($arrays['run_state'] as $key => $val)
                                                        <option value="{{$key}}" {{$filter['run_state']==$key?"SELECTED":""}}>{{$val}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="d-flex flex-wrap align-items-center justify-content-between w-100 mt-2">
                                                <div class="flex-grow-1 mb-2 mb-md-0">
                                                    <input type="text" name="search" class="form-control" id="placeholderInput" value="{{$search}}" placeholder="Search">
                                                </div>
                                                <div class="mb-2 mb-md-0 ml-md-2">
                                                    <button type="submit" class="btn btn-secondary">검색</button>
                                                </div>
                                            </div>

                                        </fieldset>
                                    </div>
                                </form>

                                <div class="card-content collapse show">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped" style="font-size:12px;">
                                            <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col" style="width:100px;">런처</th>
                                                <th scope="col">앱키 {!!@$order['app_key'] !!}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($data))
                                                @foreach($data as $key)
                                                    <tr class="data_row" data-idx="{{Crypt::encrypt($key->app_key)}}">
                                                        <td>{{$key->no}}</td>
                                                        <td><img style="height:20px;" src="{{$key->img_url}}"></td>
                                                        <td>{{$key->app_key}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{$data->onEachSide(2)->links('admx.pagination.pagination')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <script>
    </script>

@endsection
