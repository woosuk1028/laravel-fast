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
                                <h4 class="card-title">일자별 통계</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        {{--<li><a data-action="collapse"><i class="ft-minus"></i></a></li>--}}
                                        {{--<li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>--}}
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        {{--<li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                                        {{--<li><a data-action="add">등록</a></li>--}}
                                    </ul>
                                </div>

                            </div>
                            <div class="col-12">
                                <form action="{{$url}}" method="get" id="filter_form">
                                    <div class="card-body">
                                        <fieldset class="form-group d-flex flex-wrap align-items-center">

                                            <div class="custom-select-container flex-grow-1 mb-2 ">
                                                <label class="select-label">시작일</label>
                                                <input type="text" value="{{$filter['start_date']}}" id="start_date" class="form-control filter datepicker" placeholder="날짜" name="start_date" autocomplete="off" style="padding-left:90px;">
                                            </div>

                                            <div class="custom-select-container flex-grow-1 mb-2 ml-md-2 ">
                                                <label class="select-label">마지막일</label>
                                                <input type="text" value="{{$filter['end_date']}}" id="end_date" class="form-control filter datepicker" placeholder="날짜" name="end_date" autocomplete="off" style="padding-left:90px;">
                                            </div>

                                        </fieldset>
                                    </div>
                                </form>

                                <div class="card-content collapse show">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped" style="font-size:12px;">
                                            <thead>
                                            <tr>
                                                <th scope="col">일자별 {!!@$order['active_date'] !!}</th>
                                                <th scope="col">신규 {!!@$order['create_count'] !!}</th>
                                                <th scope="col">실행횟수 {!!@$order['login_count1'] !!}</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($data))
                                                @foreach($data as $key)
                                                    <tr data-idx="{{Crypt::encrypt($key->seq)}}">
                                                        <td>{{$key->active_date}}</td>
                                                        <td>{{number_format($key->create_count)}}</td>
                                                        <td>{{number_format($key->login_count1)}}</td>
                                                 
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>총합계</th>
                                                <th>{{number_format($sum['create_count'])}}</th>
                                                <th>{{number_format($sum['login_count1'])}}</th>
                                             
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

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
