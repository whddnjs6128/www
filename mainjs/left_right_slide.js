// JavaScript Document
$(document).ready(function() {
    var position=0;  //최초위치
    var movesize=350; //이미지 하나의 너비
   
    $('.product_slide ul').after($('.product_slide ul').clone());

    
    
        //슬라이드 겔러리를 한번 복제
 
  $('.button').click(function(e){
     e.preventDefault();

     //clearInterval(timeonoff);
     
     if($(this).is('.m1')){
          if(position==-2100){
              $('.product_slide').css('left',0);
               position=0;
           }
         
          position-=movesize;  // 150씩 감소
              $('.product_slide').stop().animate({left:position}, 'fast',
                function(){							
                    if(position==-2100){
                        $('.product_slide').css('left',0);
                        position=0;
                    }
                });
                
     }else if($(this).is('.m2')){
           if(position==0){
                $('.product_slide').css('left',-2100);
                position=-2100;
            }
 
            position+=movesize; // 150씩 증가
            $('.product_slide').stop().animate({left:position}, 'fast',
                function(){							
                    if(position==0){
                        $('.product_slide').css('left',-2100);
                        position=-2100;
                    }
                });
      }
   });
});

