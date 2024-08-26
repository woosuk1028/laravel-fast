<!doctype html>
<html lang="ko">
    <head>
        <meta http-equiv="Expires" content="Mon, 06 Jan 1990 00:00:01 GMT">
        <meta http-equiv="Expires" content="-1">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
        <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
        <meta name="author" content="ThemeSelect">
        <title>Login</title>
        <link rel="apple-touch-icon" href="/theme-assets/images/ico/apple-icon-120.png">
        <link rel="shortcut icon" type="image/x-icon" href="/theme-assets/images/ico/favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="/theme-assets/vendors/css/vendors.min.css">
        <link rel="stylesheet" type="text/css" href="/theme-assets/vendors/css/forms/toggle/switchery.min.css">
        <link rel="stylesheet" type="text/css" href="/theme-assets/css/plugins/forms/switch.min.css">
        <link rel="stylesheet" type="text/css" href="/theme-assets/css/core/colors/palette-switch.min.css">
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="/theme-assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/theme-assets/css/bootstrap-extended.min.css">
        <link rel="stylesheet" type="text/css" href="/theme-assets/css/colors.min.css">
        <link rel="stylesheet" type="text/css" href="/theme-assets/css/components.min.css">
        <!-- END: Theme CSS-->

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="/theme-assets/css/core/menu/menu-types/vertical-menu.min.css">
        <link rel="stylesheet" type="text/css" href="/theme-assets/css/core/colors/palette-gradient.min.css">
        <link rel="stylesheet" type="text/css" href="/theme-assets/css/pages/login-register.min.css">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
        <!-- END: Custom CSS-->

    </head>

    <body class="vertical-layout vertical-menu 1-column  bg-full-screen-image blank-page blank-page  pace-done" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="1-column"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div></div>
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
            </div>
            <div class="content-body"><section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="card-header border-0">
                                    <div class="text-center mb-1">
                                        <img src="/theme-assets/images/logo/logo.png" alt="branding logo" style="width:100px; border-radius: 32px;">
                                    </div>
                                    <div class="font-large-1  text-center">
                                        {{config('variables.site_name')}}
                                    </div>
                                </div>
                                <div class="card-content">

                                    <div class="card-body">
                                        <form method="post" class="form-horizontal" action="/admx/login/proc" novalidate="">
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control round" id="user-name" placeholder="Your Username" name="uid" required="">
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" class="form-control round" id="user-password" placeholder="Enter Password" name="pwd" required="">
                                                <div class="form-control-position">
                                                    <i class="ft-lock"></i>
                                                </div>
                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-12 text-center text-sm-left">

                                                </div>
{{--                                                <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>--}}
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Login</button>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="/theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="/theme-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
    <script src="/theme-assets/js/scripts/forms/switch.min.js" type="text/javascript"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="/theme-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="/theme-assets/js/core/app-menu.min.js" type="text/javascript"></script>
    <script src="/theme-assets/js/core/app.min.js" type="text/javascript"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="/theme-assets/js/scripts/forms/form-login-register.min.js" type="text/javascript"></script>
    <!-- END: Page JS-->

    </body>
</html>