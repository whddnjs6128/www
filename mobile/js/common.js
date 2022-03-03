//  네비 , top
$(document).ready(function () {

    var smh = $('.visual').height();  //비주얼 이미지의 높이를 리턴한다   900px
    var on_off = false;  //false(안오버)  true(오버)  
    var op = false;  //네비가 열려있으면(true) , 닫혀있으면(false)

    $(".menu_ham").click(function(e) { //메뉴버튼 클릭시
        e.preventDefault()
        // var documentHeight =  $(document).height();
        var scroll = $(window).scrollTop();
        //$("#gnb").css('height',documentHeight); // 전체 body의 높이를 네비의 높이로 반환한다
 
       if(op==false){//네비가 닫혀있는상태에서 클릭했냐?
         $("#gnb").animate({right:0,opacity:1}, 'fast');
         $('#headerArea').addClass('mn_open');
         $('#headerArea').css('background','rgba(255,255,255,1)').css('box-shadow','0 0 10px #999');
         $('#headerArea .logo a').css('background', 'url(./images/nav_logox2.png) no-repeat center').css('background-size','cover');
         op=true;
       }else{ // 네비가 열려있는 상태에서 클릭했냐?
         $("#gnb").animate({right:'-100%',opacity:0}, 'fast');
         $('#headerArea').removeClass('mn_open');
            if(scroll>300){
                $('#headerArea').css('background','rgba(255,255,255,1)').css('box-shadow','0 0 10px #999');
                $('#headerArea .logo a').css('background', 'url(./images/nav_logox2.png) no-repeat center').css('background-size','cover');
            }else{
                if(on_off==false){
                    $('#headerArea').css('background','rgba(255,255,255,0').css('box-shadow','none');
                    $('#headerArea .logo a').css('background', 'url(./images/logox2.png) no-repeat center').css('background-size','cover');
                }
        }; 

         op=false;
       }
 
    });
    
    
     //2depth 메뉴 교대로 열기 처리 
     var onoff=[false,false,false,false,false,false]; // 각각의 메뉴가 닫혀있으면 false / 열려있으면 true
     var arrcount=onoff.length;
     
     
     $('#gnb .depth1 h3 a').click(function(e){  //1depth 메뉴를 각각 클릭하면
        e.preventDefault();
         var ind=$(this).parents('.depth1').index(); //0~5
         
        //  console.log(ind);
         
        if(onoff[ind]==false){
         //$('#gnb .depth1 ul').hide();
         $(this).parents('.depth1').find('ul').slideDown('slow'); //클릭한 해당메뉴의 2dep를 열어라
         $(this).parents('.depth1').siblings('li').find('ul').slideUp('fast');  // 나머지 메뉴의 서브를 다 닫아라
          for(var i=0; i<arrcount; i++) onoff[i]=false; // 모든메뉴의 상태를 false로 바꿔라 
          onoff[ind]=true; // 자기만 트루
            
          $('.depth1 span').html('<i class="fas fa-chevron-down"></i>');   
          $(this).find('span').html('<i class="fas fa-chevron-up"></i>');   
             
        }else{ // 클릭한 메뉴가 열려있느냐?
          $(this).parents('.depth1').find('ul').slideUp('fast');  // 자신의 서브만 닫아라 
          onoff[ind]=false;   
            
          $(this).find('span').html('<i class="fas fa-chevron-down"></i>');     
        }
     });    






// 상단으로 이동
$('.topMove').hide();

$(window).on('scroll', function () { //스크롤 값의 변화가 생기면
    var scroll = $(window).scrollTop(); //스크롤의 거리

    //console.log(scroll);
    //$('.text').text(scroll);

    if (scroll > 450) { //500이상의 거리가 발생되면
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

$(window).on('scroll',function(){
    var scroll = $(window).scrollTop();

    if(scroll>180){
        $('#headerArea').css('background','rgba(255,255,255,1)').css('box-shadow','0 0 10px #999');
        $('#headerArea .logo a').css('background', 'url(./images/nav_logox2.png) no-repeat center').css('background-size','cover');
       
    }else{
        if(on_off==false){
            $('#headerArea').css('background','rgba(255,255,255,0').css('box-shadow','none');
            $('#headerArea .logo a').css('background', 'url(./images/logox2.png) no-repeat center').css('background-size','cover');
            if(op==true){
                $('#headerArea').css('background','rgba(255,255,255,1)').css('box-shadow','0 0 10px #999');
                $('#headerArea .logo a').css('background', 'url(./images/nav_logox2.png) no-repeat center').css('background-size','cover');
            }
        }
    }; 
    
 });

});