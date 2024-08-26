    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
{{--    <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">--}}
{{--    <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">--}}
{{--    <meta name="author" content="ThemeSelect">--}}
    <link rel="apple-touch-icon" href={{ asset("theme-assets/images/ico/apple-icon-120.png") }}>
    <link rel="shortcut icon" type="image/x-icon" href={{ asset("theme-assets/images/ico/favicon.ico") }}>
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href={{ asset("theme-assets/css/vendors.css") }}>
    <link rel="stylesheet" type="text/css" href={{ asset("theme-assets/vendors/css/charts/chartist.css") }}>
    <!-- END VENDOR CSS-->
    <!-- BEGIN CHAMELEON  CSS-->
    <link rel="stylesheet" type="text/css" href={{ asset("theme-assets/css/app-lite.css") }}>
    <!-- END CHAMELEON  CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href={{ asset("theme-assets/css/core/menu/menu-types/vertical-menu.css") }}>
    <link rel="stylesheet" type="text/css" href={{ asset("theme-assets/css/core/colors/palette-gradient.css") }}>
    <link rel="stylesheet" type="text/css" href={{ asset("theme-assets/css/pages/dashboard-ecommerce.css") }}>
    <link rel="stylesheet" type="text/css" href={{ asset("src/css/jquery-ui.css") }}>
    <!-- END Page Level CSS-->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+KR:wght@300&display=swap" rel="stylesheet">

    <!-- BEGIN VENDOR JS-->
    <script src="/theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="/src/js/core/libraries/jquery-ui.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" type="text/css" href={{ asset("theme-assets/select2/select2.min.css") }}>
    <script src="{{ asset("theme-assets/select2/select2.min.js") }}" type="text/javascript"></script>

    <script>
        $(document).ready(function(){
            $('.select-search').select2();
        })

        function checkInputNum(){
            if ((event.keyCode < 48) || (event.keyCode > 57)){
                event.returnValue = false;
            }
        }

        function handleOnInput(el, maxlength) {
            if(el.value.length > maxlength)  {
                el.value
                    = el.value.substr(0, maxlength);
            }
        }
    </script>

    <style>
        body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown)
        {
            overflow: auto;
        }

        #overlay {
            background: #ffffff;
            color: #666666;
            position: fixed;
            height: 100%;
            width: 100%;
            z-index: 5000;
            top: 0;
            left: 0;
            float: left;
            text-align: center;
            padding-top: 25%;
            opacity: .80;
        }

        .spinner {
            margin: 0 auto;
            height: 64px;
            width: 64px;
            animation: rotate 0.8s infinite linear;
            border: 5px solid firebrick;
            border-right-color: transparent;
            border-radius: 50%;
        }
        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>