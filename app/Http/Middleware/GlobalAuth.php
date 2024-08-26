<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GlobalAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // 현재 URL 경로를 확인
        $currentPath = $request->path();

//        if ($request->is('/admin/*')) {
//            config(['session.cookie' => 'admin_session']);
//        } elseif ($request->is('/admx/*')) {
//            config(['session.cookie' => 'admx_session']);
//        }

        // 세션에서 uid 값을 가져옴
        $uid = $request->session()->get('uid');
        $adminType = $request->session()->get('admin_type');

        // 값이 없으면 뭔가 처리 (예: 리다이렉트, 예외 발생 등)
        if (empty($uid) || !isset($uid)) {
            return $this->redirectToLogin($request->path());
        }

        if ($request->is('app/*') && ($adminType !== 'app' || empty($uid))) {
            return redirect('/app/login');  // or show an unauthorized page
        }

        if ($request->is('admin/*') && ($adminType !== 'admin' || empty($uid))) {
            return redirect('/admin/login');  // or show an unauthorized page
        }

        // 아니면 요청을 계속 진행
        return $next($request);
    }

    private function redirectToLogin($currentPath)
    {
        if (str_starts_with($currentPath, 'app')) {
            return redirect('/app/login');
        } else {
            return redirect('/admin/login');
        }
    }
}
