    <!doctype html>
    <html lang="ko">
    <head>
        <meta http-equiv="Expires" content="Mon, 06 Jan 1990 00:00:01 GMT">
        <meta http-equiv="Expires" content="-1">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">

        @include('admx.layout.head')
        <title>{{config('variables.site_name')}}</title>
    </head>
    <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">
        @include('admx.layout.header')
        @yield('contents')
        @include('admx.layout.footer')
    </body>
    </html>