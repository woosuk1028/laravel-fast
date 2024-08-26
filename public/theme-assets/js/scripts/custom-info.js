//특수문자 제거
function check(obj) {
    var regExp = /[ \{\}\[\]\/?.,;:|\)*~`!^\-_+┼<>@\#$%&\'\"\\\(\=]/gi;
    obj.value = obj.value.replace(regExp, "");
}

//이메일 형식 체크
function fn_emailChk(email){
    var regExp = /\w+([-+.]\w+)*@\w+([-.]\w+)*\.[a-zA-Z]{2,4}$/;
    if(!regExp.test(email)){
        return false;
    }
    return true;
}

$(document).on("click","#post_btn",function(){
    var phone_num = $("input[name='phone_num']").val();
    var email = $("input[name='email']").val();
    var required_chk = $("#required_chk").is(":checked");
    if(phone_num == "")
    {
        alert('연락처를 입력해주세요.');
        $("input[name='phone_num']").focus();
        return false;
    }

    if(email == "")
    {
        alert('이메일을 입력해주세요.');
        $("input[name='email']").focus();
        return false;
    }

    if(!fn_emailChk(email))
    {
        alert('이메일 형식을 확인해주세요.');
        return false;
    }

    if(!required_chk)
    {
        alert('개인정보 수집 및 이용 동의에 체크해주세요.');
        return false;
    }

    $("#contact_form").submit();
});

$('.post-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    prevArrow:"<img class='prev slick-prev' src='/theme-assets/images/icons/slick_button_prev.png'>",
    nextArrow:"<img class='next slick-next' src='/theme-assets/images/icons/slick_button_next.png'>"
});

$('.goto-slide').on('click', function() {
    var slideIndex = $(this).attr('data-index'); // data-index 값 가져오기
    $('.post-slider').slick('slickGoTo', slideIndex); // 해당 슬라이더 위치로 이동
});
var modals = document.querySelectorAll(".myModal");
var btns = document.querySelectorAll(".openModalBtn");
var spans = document.querySelectorAll(".close-btn");
var body = document.body;  // body element를 선택합니다.

// Open the modal
btns.forEach(function(btn) {
    btn.onclick = function() {
        modals[0].style.display = "block";

        // Disable main scroll
        body.classList.add("no-scroll");  // no-scroll 클래스를 추가하여 스크롤을 비활성화합니다.
    }
});

// Close the modal
spans.forEach(function(span, index) {
    span.onclick = function() {
        modals[index].style.display = "none";

        // Enable main scroll
        body.classList.remove("no-scroll");  // no-scroll 클래스를 제거하여 스크롤을 활성화합니다.
    }
});

// Close the modal if the user clicks outside of it
window.onclick = function(event) {
    modals.forEach(function(modal) {
        if (event.target == modal) {
            modal.style.display = "none";

            // Enable main scroll
            body.classList.remove("no-scroll");  // no-scroll 클래스를 제거하여 스크롤을 활성화합니다.
        }
    });
}

const hamburger = document.getElementsByClassName('hamberg-box')[0];
const menu = document.getElementsByClassName('mob-btn-box')[0];
const close = document.getElementsByClassName('ham-close-btn')[0];

hamburger.addEventListener('click', () => {
    menu.classList.toggle('active');  /* toggle 메서드를 사용하여 클래스를 추가/제거합니다. */
});

close.addEventListener('click', () => {
    menu.classList.toggle('active');  /* toggle 메서드를 사용하여 클래스를 추가/제거합니다. */
});