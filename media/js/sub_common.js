$(document).ready(function(){

    var screenSize = $(window).width();
    var screenHeight = $(window).height();
    var geturl = window.location.pathname;
    var current_url = geturl.substring(6,11);

    $("#content").css('margin-top',screenHeight);

    if( screenSize > 768){
        $('.videoBox #imgBG').attr('src','images'+current_url+'/back.jpg');
    }
    if(screenSize <= 768){
        $('.videoBox #imgBG').attr('src','images'+current_url+'/back_m.jpg');
    }
    
    $(window).resize(function(){   
    screenSize = $(window).width(); 
    screenHeight = $(window).height();
        
    $("#content").css('margin-top',screenHeight);
        
    if( screenSize > 768){
        $('.videoBox #imgBG').attr('src','images'+current_url+'/back.jpg');
    }
    if(screenSize <= 768){
        $('.videoBox #imgBG').attr('src','images'+current_url+'/back_m.jpg');
    }
    }); 

    $('.down').click(function(){
		screenHeight = $(window).height();
		$('html,body').animate({'scrollTop':screenHeight}, 1000);
	});

});