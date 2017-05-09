$(function(){
    
    var footerFix = $('body').height() - screen.height;
    if(screen.width < 960){
       var mobileFix = -170;      
    }else{
        mobileFix = 0;
    }
    
    $(window).scroll(function () {
        var scroll = parseInt($(this).scrollTop());
        var movement = -70 + parseInt(scroll / 2);
        $('.fon-paralax').css({
            backgroundPosition: 'center ' + movement + 'px'
        });

        movement = -450 + parseInt((scroll - footerFix)/2) + mobileFix;
        
        $('.footer').css({
            backgroundPosition: 'center ' + movement + 'px'
        });
    });
    
    $(document).on('click','.navmenu .control-but',function(){
        var check = $(this).hasClass('check');
        if(check){
            $(this).removeClass('check');
            $('.navmenu .contaner-collapse').removeClass('check');
        }else{
            $(this).addClass('check'); 
            $('.navmenu .contaner-collapse').addClass('check');
        }
    })
})
