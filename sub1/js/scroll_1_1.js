$(document).ready(function () {

    $('.sub_nav li:eq(0)').find('a').addClass('spy');
    var subnav = $('#content .content_area').offset().top - 100;
    var vision1 = $('#content .company_vision').offset().top - 500;
    var ethics1 = $('#content .company_ethics').offset().top - 500;

    //스크롤의 좌표가 변하면.. 스크롤 이벤트
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();

        //sticky menu 처리
        if (scroll > subnav) {
            $('.sub_nav').addClass('navOn');
            //스크롤의 거리가 350px 이상이면 서브메뉴 고정
            $('header').hide();
        } else {
            $('.sub_nav').removeClass('navOn');
            //스크롤의 거리가 350px 보다 작으면 서브메뉴 원래 상태로
            $('header').show();
        }

        $('.sub_nav li').find('a').removeClass('spy');
        //모든 서브메뉴 비활성화~ 불꺼!!!

        //스크롤의 거리의 범위를 처리
        if (scroll >= subnav && scroll < vision1) {
            $('.sub_nav li:eq(0)').find('a').addClass('spy');
        } else if (scroll >= vision1 && scroll < ethics1) {
            $('.sub_nav li:eq(1)').find('a').addClass('spy');
        } else if (scroll >= ethics1) {
            $('.sub_nav li:eq(2)').find('a').addClass('spy');
        }
        

        if (scroll >= (subnav-400) && scroll < vision1) {
            $('#content .company_intro img').addClass('boxUpMove');
            $('#content .company_intro .intro_text dl').addClass('boxLeftMove');
        }
    });
});