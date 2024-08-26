<?php

    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "web" middleware group. Make something great!
    |
    */
    $api_controller_path = 'App\Http\Controllers\Api';
    $admin_controller_path = 'App\Http\Controllers\Admin';
    $info_controller_path = 'App\Http\Controllers\Info';
    $location_controller_path = 'App\Http\Controllers\Location';

    //API 테스터
    Route::get('/tester', $api_controller_path . '\TesterController@index');
    Route::post('/tester/api_test', $api_controller_path . '\TesterController@api_test');
    Route::get('/tester/fcm', $api_controller_path . '\TesterController@fcm');

    //관리자 로그인
    Route::get('/admin', $admin_controller_path . '\LoginController@index');
    Route::get('/admin/login', $admin_controller_path . '\LoginController@index');
    Route::post('/admin/login/proc', $admin_controller_path . '\LoginController@proc');

    Route::middleware(['login'])->group(function() {

        Route::prefix('/admin')->group(function () {
            $admin_controller_path = 'App\Http\Controllers\Admin';
            
            Route::get('/login/logout', $admin_controller_path . '\LoginController@logout');
            Route::get('/', $admin_controller_path . '\AppInfoController@index');
            
            //사용자 관리
            Route::get('/user_login', $admin_controller_path . '\UserLoginController@index');
            Route::get('/user_login/create', $admin_controller_path . '\UserLoginController@create');
            Route::post('/user_login/store', $admin_controller_path . '\UserLoginController@store');
            Route::get('/user_login/edit/{id}', $admin_controller_path . '\UserLoginController@edit');
            Route::post('/user_login/update/{id}', $admin_controller_path . '\UserLoginController@update');

            //앱 관리
            Route::get('/app_info', $admin_controller_path . '\AppInfoController@index');
            Route::get('/app_info/create', $admin_controller_path . '\AppInfoController@create');
            Route::post('/app_info/store', $admin_controller_path . '\AppInfoController@store');
            Route::get('/app_info/edit/{id}', $admin_controller_path . '\AppInfoController@edit');
            Route::post('/app_info/update/{id}', $admin_controller_path . '\AppInfoController@update');

            //스테이지 관리
            Route::get('/stage_list', $admin_controller_path . '\StageListController@index');
            Route::get('/stage_list/create', $admin_controller_path . '\StageListController@create');
            Route::post('/stage_list/store', $admin_controller_path . '\StageListController@store');

            //스테이지 히스토리
            Route::get('/stage_history', $admin_controller_path . '\StageHistoryController@index');

            //통계
            Route::get('/stat/user_stat', $admin_controller_path . '\DauController@user_stat');
            Route::get('/stat/user_popup', $admin_controller_path . '\DauController@user_popup');
            Route::get('/stat/daily_stat', $admin_controller_path . '\DauController@daily_stat');
            Route::get('/stat/time_stat', $admin_controller_path . '\DauController@time_stat');
        });
    });