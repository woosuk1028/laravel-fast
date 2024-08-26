<!doctype html>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Api테스터</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.1/socket.io.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <style>
            .hidden
            {
                display: none;
            }
            .api-request
            {
                margin-top: 15px;
                border: 1px solid #ccc;
                border-radius: 4px;
                padding: 10px;
                background-color: #f8f9fa;
            }
            .api-response
            {
                margin-top: 15px;
                border: 1px solid #ccc;
                border-radius: 4px;
                padding: 10px;
                background-color: #f8f9fa;
            }
            .label-color
            {
                color: #7F7F7F;
            }
        </style>
    </head>
    <body>
        <div class="container mt-5">
            <p><h3>{{config('variables.site_name')}} API 테스트</h3></p>

            {{tester_form('POST', '/wapi/login/splash', 'splash', $splash, '스플래쉬')}}

            {{tester_form('POST', '/wapi/cont/stage', 'stage', $stage, '스테이지')}}

            {{tester_form('POST', '/wapi/trans/payment', 'payment', $payment, '구매')}}


{{--            {{tester_socket_form('SOCKET', 'https://nradiosock.xdev.kr:3000/location', 'location', $location, '위치정보 통신')}}--}}

        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        //api ajax
        $(document).on('click','.tester-btn',function(){
            const idx = $(this).index('.tester-btn');

            const setForm = $(".tester-form")[idx];
            const formData = new FormData(setForm);
            formData.append('_token', "{{ csrf_token() }}");
            $.ajax({
                url: "/tester/api_test",
                type: "POST",
                dataType: "JSON",
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    var request = JSON.parse(response.request);
                    var response = JSON.parse(response.response);
                    var formattedRequest = JSON.stringify(request, null, 4);
                    var formattedResponse = JSON.stringify(response, null, 4);

                    $(".request-text").eq(idx).html("<pre>" + formattedRequest + "</pre>");
                    $(".response-text").eq(idx).html("<pre>" + formattedResponse + "</pre>");
                },
                error: function() {
                    console.log("ERR");
                    // SweetAlertMsg('error', '에러', '통신실패');
                }
            });
        });

        //소켓
        $(document).on("click",".socket-btn",function(){
            const idx = $(this).index('.socket-btn');
            let url = $("input[name='socket_url']").eq(idx).val();
            let setForm = $(".socket-form")[idx];
            let formData = new FormData(setForm);
            const obj = {};
            formData.forEach((value, key) => { obj[key] = value; });
            console.log(obj);
            const socket = io(url);

            socket.on('connect', () => {
                var connect = `Connected to the server with id: ${socket.id}`;
                $(".socket-response").eq(idx).append('<pre>'+connect+'</pre>');
                socket.emit('events', obj);
                var request = `${JSON.stringify(obj, null, 4)}`;
                $(".socket-request").eq(idx).append('<pre>'+request+'</pre>');
            });

            socket.on('disconnect', () => {
                var response = 'Disconnected from the server';
                $(".socket-response").eq(idx).append('<pre>'+response+'</pre>');
            });
            // });

            socket.on('events', (message) => {
                var response = `Received message: ${message}`;
                $(".socket-response").eq(idx).append('<pre>'+response+'</pre>');
            });

            socket.on('locationUpdate', (message) => {
                var response = `${JSON.stringify(message, null, 4)}`;
                $(".socket-response").eq(idx).append('<pre>'+response+'</pre>');
            });

            socket.on('result', (message) => {
                var response = `${JSON.stringify(message, null, 4)}`;
                $(".socket-response").eq(idx).append('<pre>'+response+'</pre>');
            });
        });
    </script>
</html>