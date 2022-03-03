// JavaScript Document

$(document).ready(function(){
    var cnt=4;  //탭메뉴 개수 ***
    
    $('#contnet .contlist:eq(0)').show(); // 첫번째 탭 내용만 열어라
    $('#content .tab1').addClass('current'); //첫번째 탭메뉴 활성화
               //자바스크립트의 상대 경로의 기준은 => 스크립트 파일을 불러들인 html파일이 저장된 경로 기준***
      
    $('#content .tab').click(function(e){
          e.preventDefault();   
          
          var ind = $(this).index('#content .tab');  // 클릭시 해당 index를 뽑아준다
          

          $("#content .contlist").hide(); //모든 탭내용을 안보이게...
          $("#content .contlist:eq("+ind+")").fadeIn('fast');  //클릭한 해당 탭내용만 보여라
          $('.tab').removeClass('current'); // 모든탭 클래스제거
          $(this).addClass('current');  // 누른 탭 클래스 추가 

     });
   

  });

