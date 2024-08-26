<footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2024  &copy; Copyright Zerosoft</span>
        <ul class="list-inline float-md-right d-block d-md-inline-blockd-none d-lg-block mb-0">
        </ul>
    </div>
</footer>

<div id="overlay" style="display:none;">
    <div class="spinner"></div>
    <br/>
    Loading...
</div>

<!-- BEGIN PAGE VENDOR JS-->
{{--<script src="/theme-assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script>--}}
<!-- END PAGE VENDOR JS-->
<!-- BEGIN CHAMELEON  JS-->
<script src="/theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
<script src="/theme-assets/js/core/app-lite.js" type="text/javascript"></script>
<!-- END CHAMELEON  JS-->
<!-- BEGIN PAGE LEVEL JS-->
{{--<script src="/theme-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>--}}
<!-- END PAGE LEVEL JS-->


<script>
    $(document).on("change", ".uploadFile", function() {
        var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        var file = files[0];

        // Check file type
        var fileType = file.type;
        if (fileType !== 'image/jpeg' && fileType !== 'image/png') {
            alert('만 jpg 및 png 파일을 업로드해주세요.');
            return;
        }

        // Check file size (500KB)
        if (file.size > 500 * 1024) { // 500KB in bytes
            alert('파일 크기는 500KB를 초과할 수 없습니다.');
            return;
        }

        var reader = new FileReader(); // instance of the FileReader
        reader.readAsDataURL(file); // read the local file

        reader.onloadend = function() { // set image data as background of div
            uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
        }

        $("input[name='upload_check']").val(2);
    });

    $(document).on("click",".dynamic-checkbox",function(){
        if($(this).prop("checked") == true)
        {
            $(this).val(1);
        }
        else if($(this).prop("checked") == false)
        {
            $(this).val(2);
        }
    });

    function SweetAlertMsg(icon, title, text)
    {
        //icon => success, error, warning, info, question
        Swal.fire({
            icon: icon,
            title: title,
            text: text,
        }).then(function(){
            if(icon=="success")
            {
                location.reload();
            }
        });
    }

    function AddComma(num)
    {
        var regexp = /\B(?=(\d{3})+(?!\d))/g;
        return num.toString().replace(regexp, ',');
    }

    $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        showMonthAfterYear: true,
        yearSuffix: '년'
    });

    $(document).ready(function() {
        $("input:text[numberOnly]").on("keyup", function() {
            $(this).val($(this).val().replace(/[^0-9]/g,""));
        });

        $(".datepicker").datepicker();

        //select2 드롭다운 크기 조정
        let select2_length = $('.select2-selection').length;
        
        for(let i = 0; i < select2_length; i++)
        {
            let select2_width = $('.select2-selection').eq(i).outerWidth();
            $('.select2-container').css("width", select2_width+"px");
        }
    });

    $(document).on("change",".all-check",function(){
        var chkList = $("input[name=checked_id]");

        if($(".all-check").is(":checked"))
            chkList.prop("checked", true);
        else
            chkList.prop("checked", false);
    });

    $(document).on("click", ".data_row", function(){
        var idx = $(this).attr('data-idx');

        location.href = "/{{config('common_arrays.type_url')[session('admin_type')]}}/{{$active}}/edit/"+idx;
    });

    $(document).on("click",".checkbox_td, .url_td",function(event){
        event.stopImmediatePropagation();
    });

    $(document).on("change", ".filter", function(){
        $("#filter_form").submit();
    });

    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success_store'))
        Swal.fire({
            heightAuto: false,
            title: '등록 완료',
            text: '앱이 성공적으로 등록되었습니다.',
            icon: 'success',
            timer: 1500,
            showConfirmButton: false
        });
        @endif
        @php
            session()->forget('success_store');
        @endphp

        @if(session('success_edit'))
        Swal.fire({
            heightAuto: false,
            title: '수정 완료',
            text: '앱이 성공적으로 수정되었습니다.',
            icon: 'success',
            timer: 1500,
            showConfirmButton: false
        });
        @endif
        @php
            session()->forget('success_edit');
        @endphp

        @if(session('error'))
        Swal.fire({
            heightAuto: false,
            title: 'Error!',
            text: '잠시후 다시 시도해주세요',
            icon: 'error',
            timer: 1000,
            showConfirmButton: false
        });
        @endif
        @php
            session()->forget('error');
        @endphp

        window.history.replaceState(null, null, window.location.href);
    });
</script>
