$(document).ready(function(){
    var article=$('.content_area .article');
    // article.find('.answer').slideUp(200); 
    var onoff=false; // 모두열기
    
    $('.question a').click(function(){
        var myArticle=$(this).parents('.article');
        
        if(myArticle.hasClass('hide')){
            article.find('.answer').slideUp(200);
            article.removeClass('show').addClass('hide');
            myArticle.removeClass('hide').addClass('show');  
            myArticle.find('.answer').slideDown(200);  
        }else{
            myArticle.removeClass('show').addClass('hide');  
	        myArticle.find('.answer').slideUp(200); 
        }
    });

    $('.all').click(function(){
        if(onoff==false){
            article.find('.answer').slideDown(200);
            article.removeClass('hide').addClass('show');
            $('.all span').html('전체 닫기')
            onoff=true;
        }else{
            article.find('.answer').slideUp(200);
            article.removeClass('show').addClass('hide');
            $('.all span').html('전체 열기')
            onoff=false;
        }
    });
    
});