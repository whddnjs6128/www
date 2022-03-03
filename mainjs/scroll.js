$(document).ready(function () {
        
    var smh= $('.visual').height()-300;
    var product1= $('#content .new_product .slide_title').offset().top-700 ;
    var product2= $('#content .new_product .slide_gallery_box').offset().top-400;

    var intro1= $('#content .introduction .slide_title').offset().top-600 ;
    var intro2= $('#content .introduction ul li').eq(0).offset().top-300 ;
    var intro3= $('#content .introduction ul li').eq(1).offset().top-300 ;
    var intro4= $('#content .introduction ul li').eq(2).offset().top-300 ;

    var manage1= $('#content .management .slide_title').offset().top-600 ;
    
  
     //스크롤의 좌표가 변하면.. 스크롤 이벤트
    $(window).on('scroll',function(){
        var scroll = $(window).scrollTop();
 

        
         //스크롤의 거리의 범위를 처리
        if(scroll>=smh && scroll<product1){
            $('#content .new_product .slide_title').addClass('boxUpMove');
        }else if(scroll>=product1 && scroll<product2){
             $('#content .new_product .slide_gallery_box').addClass('boxUpMove');
             $('#content .new_product .product_btn').addClass('boxUpMove');
        }
        else if(scroll>=product2 && scroll<intro1){
            $('#content .introduction .slide_title').addClass('boxUpMove');
        }else if(scroll>=intro1 && scroll<intro2){
            $('#content .introduction ul li:first-of-type').addClass('boxLeftMove');
        }else if(scroll>=intro2 && scroll<intro3){
            $('#content .introduction ul li:nth-of-type(2)').addClass('boxRightMove');
        }else if(scroll>=intro3 && scroll<intro4){
            $('#content .introduction ul li:nth-of-type(3)').addClass('boxLeftMove');
        }
        else if(scroll>=intro4 && scroll<manage1){
            $('#content .management .slide_title').addClass('boxUpMove');
        }else if(scroll>=manage1){
            $('#content .management ul li:first-of-type').addClass('boxDownMove');
            $('#content .management ul li:nth-of-type(2)').addClass('boxDownMove');
            $('#content .management ul li:nth-of-type(3)').addClass('boxDownMove');
        }


    });


});