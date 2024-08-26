
    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="collapse navbar-collapse show" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-block d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav float-right">

                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <span class="avatar avatar-online"><img src="/theme-assets/images/portrait/small/avatar-s-19.png" alt="avatar"><i></i></span></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="arrow_box_right">
                                    <a class="dropdown-item" href="#">
                                        <span class="avatar avatar-online">
                                            <img src="/theme-assets/images/portrait/small/avatar-s-19.png" alt="avatar">
                                            <span class="user-name text-bold-700 ml-1">{{session('user_name')}}</span>
                                        </span>
                                    </a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="/{{config('common_arrays.type_url')[session('admin_type')]}}/login/logout"><i class="ft-power"></i> Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true" data-img="/theme-assets/images/backgrounds/02.jpg">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="/{{config('common_arrays.type_url')[session('admin_type')]}}"><img class="brand-logo" alt="Chameleon admin logo" style="border-radius: 12px;" src="/theme-assets/images/logo/logo.png"/>
                        <h3 class="brand-text">{{config('variables.site_name')}}</h3></a></li>
                <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
            </ul>
        </div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main scrollBar" id="main-menu-navigation" data-menu="menu-navigation">
{{--                <li class=" nat-item {{$active=="dashboard"?"active":""}}">--}}
{{--                    <a href="/admx/"><i class="la la-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>--}}
{{--                </li>--}}
                <li class=" nav-item {{$active=="app_info"?"active":""}}">
                    <a href="/{{config('common_arrays.type_url')[session('admin_type')]}}/app_info"><i class="la la-building-o"></i><span class="menu-title" data-i18n="">어플 관리</span></a>
                </li>
                <li class=" nav-item {{$active=="user_login"?"active":""}}">
                    <a href="/{{config('common_arrays.type_url')[session('admin_type')]}}/user_login"><i class="la la-user"></i><span class="menu-title" data-i18n="">사용자 관리</span></a>
                </li>
                <li class=" nav-item has-sub {{$active=="stage_list"?"open":""}} {{$active=="stage_history"?"open":""}}">
                    <a href="#"><i class="la la-gamepad"></i><span class="menu-title" data-i18n="">스테이지</span></a>
                    <ul class="menu-content">
                        <li class=" {{$active=="stage_list"?"active is-shown":""}}"><a class="menu-item" href="/{{config('common_arrays.type_url')[session('admin_type')]}}/stage_list">스테이지 정보</a></li>
                    </ul>
                    <ul class="menu-content">
                        <li class=" {{$active=="stage_history"?"active is-shown":""}}"><a class="menu-item" href="/{{config('common_arrays.type_url')[session('admin_type')]}}/stage_history">일자별 스테이지 정보</a></li>
                    </ul>
                </li>

                <li class=" nav-item has-sub {{$active=="user_stat"?"open":""}} {{$active=="daily_stat"?"open":""}} {{$active=="time_stat"?"open":""}}">
                    <a href="charts.html"><i class="la la-bar-chart"></i><span class="menu-title" data-i18n="">일반 통계</span></a>
                    <ul class="menu-content">
                        <li class=" {{$active=="user_stat"?"active is-shown":""}}"><a class="menu-item" href="/{{config('common_arrays.type_url')[session('admin_type')]}}/stat/user_stat">가입자 통계</a></li>
                    </ul>
                    <ul class="menu-content">
                        <li class=" {{$active=="daily_stat"?"active is-shown":""}}"><a class="menu-item" href="/{{config('common_arrays.type_url')[session('admin_type')]}}/stat/daily_stat">일자별 통계</a></li>
                    </ul>
                    <ul class="menu-content">
                        <li class=" {{$active=="time_stat"?"active is-shown":""}}"><a class="menu-item" href="/{{config('common_arrays.type_url')[session('admin_type')]}}/stat/time_stat">시간별 통계</a></li>
                    </ul>
                </li>
                
{{--                <li class=" nav-item">--}}
{{--                    <a href="https://themeselection.com/demo/chameleon-admin-template/documentation"><i class="ft-book"></i><span class="menu-title" data-i18n="">Documentation</span></a>--}}
{{--                </li>--}}
            </ul>
        </div>
        <div class="navigation-background"></div>
    </div>