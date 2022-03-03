
$(document).ready(function () {

    var smh = $('.visual').height();  //비주얼 이미지의 높이를 리턴한다   900px
    var on_off = false;  //false(안오버)  true(오버)  


    $('#headerArea').mouseenter(function () { // 마우스가 올라가는 순간 색 바꾸기  1depth만!
        // var scroll = $(window).scrollTop();
        $(this).css('background', '#fff');  //헤더에이리어의 백그라운드
        $('.dropdownmenu li a').css('color', '#333');
        $('.top_menu li a').css('color', '#333');
        $('.bottom_menu .logo a').css('background-position', '0 -42px');
        $('.dropdownmenu li ul li a').css('color', '#999');

        on_off = true;
    });

    $('#headerArea').mouseleave(function () {  //마우스가 떠날때
        var scroll = $(window).scrollTop();  //스크롤의 거리

        // 마우스가 떠날때의 스크롤 상태 에 따라서

        if (scroll >= 0 && scroll < smh - 300) {
            $(this).css('background', 'none').css('border-bottom', 'none');
            $('.dropdownmenu li a').css('color', '#fff');
            $('.top_menu li a').css('color', '#fff');
            $('.bottom_menu .logo a').css('background-position', '0 0');
            $('.dropdownmenu li ul li a').css('color', '#999');

        } else if (scroll > smh - 300) {
            $(this).css('background', '#fff');
            $('.dropdownmenu li a').css('color', '#333');
            $('.top_menu li a').css('color', '#333');
            $('.bottom_menu .logo a').css('background-position', '0 -42px');
            $('.dropdownmenu li ul li a').css('color', '#999');

        }
        on_off = false;
    });

    $(window).on('scroll', function () {//스크롤의 거리가 발생하면
        var scroll = $(window).scrollTop();  //스크롤의 거리를 리턴하는 함수
        //console.log(scroll);


        if (scroll > smh - 300) {//스크롤300까지 내리면
            $('#headerArea').css('background', '#fff').css('border-bottom', '1px solid #7ccadd');
            $('.dropdownmenu li a').css('color', '#333');
            $('.top_menu li a').css('color', '#333');
            $('.bottom_menu .logo a').css('background-position', '0 -42px');
            $('.dropdownmenu li ul li a').css('color', '#999');

        } else {//스크롤 내리기 전 디폴트(마우스올리지않음)
            if (on_off == false) {
                $('#headerArea').css('background', 'none').css('border-bottom', 'none');
                $('.dropdownmenu li a').css('color', '#fff');
                $('.top_menu li a').css('color', '#fff');
                $('.bottom_menu .logo a').css('background-position', '0 0');

            }
        };

    });


    //2depth 열기/닫기
    $('ul.dropdownmenu').hover(
        function () {
            $('ul.dropdownmenu li.menu ul').fadeIn('normal', function () { $(this).stop(); }); //모든 서브를 다 열어라
            $('#headerArea').animate({ height: 300 }, 'fast').clearQueue();
        }, function () {
            $('ul.dropdownmenu li.menu ul').hide(); //모든 서브를 다 닫아라
            $('#headerArea').animate({ height: 125 }, 'fast').clearQueue();
        });

    //1depth 효과
    $('ul.dropdownmenu li.menu').hover(
        function () {
            $('.depth1', this).css('color', '#00abcd');
        }, function () {
            $('.depth1', this).css('color', '#333');

        });

    //2depth 효과
    $('ul.dropdownmenu li.menu ul li').hover(
        function () {
            $('a', this).css('color', '#333');
        }, function () {
            $('a', this).css('color', '#999');

        });


    //tab 처리
    $('ul.dropdownmenu li.menu .depth1').on('focus', function () {
        $('ul.dropdownmenu li.menu ul').slideDown('normal');
        $('#headerArea').animate({ height: 300 }, 'fast').clearQueue();
    });

    $('ul.dropdownmenu li.m6 li:last').find('a').on('blur', function () {
        $('ul.dropdownmenu li.menu ul').slideUp('fast');
        $('#headerArea').animate({ height: 125 }, 'normal').clearQueue();
    });


    // 상단으로 이동
    $('.topMove').hide();

    $(window).on('scroll', function () { //스크롤 값의 변화가 생기면
        var scroll = $(window).scrollTop(); //스크롤의 거리

        //console.log(scroll);
        //$('.text').text(scroll);

        if (scroll > 800) { //500이상의 거리가 발생되면
            $('.topMove').fadeIn('slow');  //top보여라~~~~
        } else {
            $('.topMove').fadeOut('fast');//top안보여라~~~~
        }
    });

    $('.topMove').click(function (e) {
        e.preventDefault();
        //상단으로 스르륵 이동합니다.
        $("html,body").stop().animate({ "scrollTop": 0 }, 1000);
    });

    
    //푸터 패밀리사이트
    $('.footer_family .family_btn').toggle(function(){
        $('.footer_family .family_list').fadeIn();
        $('.footer_family .family_btn span').html('<i class="fas fa-chevron-down"></i>')
    }, function(){
        $('.footer_family .family_list').fadeOut();
        $('.footer_family .family_btn span').html('<i class="fas fa-chevron-up"></i>')
    });

    

//tab키 처리
  $('.footer_family .family_btn').on('focus', function () {        
          $('.footer_family .family_list').fadeIn();	
   });
   $('.footer_family .family_list li:last a').on('blur', function () {        
          $('.footer_family .family_list').fadeOut();
   });  




});
