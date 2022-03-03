
$(document).ready(function () {

    var smh = $('.videoBox').height();  //비주얼 이미지의 높이를 리턴한다   900px
    var on_off = false;  //false(안오버)  true(오버)  
    var op = false
    var current=0; //0이면 소형태블릿 상황 , 1이면 태블릿  이상 



    $(window).on('scroll', function () {//스크롤의 거리가 발생하면
        var scroll = $(window).scrollTop();  //스크롤의 거리를 리턴하는 함수

        if (scroll > smh) {//스크롤300까지 내리면
            $('#headerArea').css('background', 'rgba(0,0,0,.6)');
        } else {//스크롤 내리기 전 디폴트(마우스올리지않음)
                if(on_off==false){
                    $('#headerArea').css('background','none');
                    if(op==true){
                        $('#headerArea').css('background','rgba(0, 0, 0, 0.6)');
                    }
                }

        };

    });

    
    $(".menu_ham").click(function(e) { //메뉴버튼 클릭시
        e.preventDefault()
        var scroll = $(window).scrollTop();
 
       if(op==false){//네비가 닫혀있는상태에서 클릭했냐?
         $("#gnb").animate({right:0,opacity:1}, 'fast');
         $('#headerArea').addClass('mn_open');
         $('#headerArea').css('background','rgba(0, 0, 0, 0.6)');

         op=true;
       }else{ // 네비가 열려있는 상태에서 클릭했냐?
        $('#headerArea').removeClass('mn_open');
         $("#gnb").animate({right:'-100%',opacity:0}, 'fast');

         if (scroll < smh){
            $('#headerArea').css('background','none');
         }

         op=false;
       }
 
    });
    



    $(window).resize(function () {    //웹브라우저 크기 조절시 반응하는 이벤트 메소드()
        var screenSize = $(window).width();
        if (screenSize > 1024) {  // 해상도가 태블릿 이상이면
            current = 1;
            $("#gnb").css({ right: 0, opacity: 1 });
            $('#headerArea').removeClass('mn_open');
            $('#headerArea').css('background','none');
            op=false

        }
        if (current == 1 && screenSize <= 1024) {  // 해상도가 태블릿 이하면
         $("#gnb").css({ right: '-100%', opacity: 0 });
         current = 0;

         if(op=false){
            $('#headerArea').removeClass('mn_open');
            $('#headerArea').css('background','none');
            $("#gnb").animate({right:'-100%',opacity:0}, 'fast');
         }
        }
    }); 


    $('.topMove').click(function (e) {
        e.preventDefault();
        $("html,body").stop().animate({ "scrollTop": 0 }, 1000);
    });

});