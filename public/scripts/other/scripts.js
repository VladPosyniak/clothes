$(document).ready(function()
{
    window.onscroll = function() {
        var scrolled = window.pageYOffset || document.documentElement.scrollTop;
        if(scrolled > 10){
            $('.wrapper').css('padding',0);
            $('.left-panel').css('border-radius','0')
        }
        else{
            $('.wrapper').css('padding',10);
            $('.left-panel').css('border-radius', '')
        }

        if(scrolled>parseInt($('.right-panel').css('height'))){
            $('.right-panel').hide();
            $('.posts').css('width','80%')
        }

        else{
            $('.right-panel').show();
            $('.posts').css('width','')
        }

    };

    $('.post-likes span').click(function()
    {
        var color = $(this).css('color');
        $('.post-likes span').css('border-bottom','');
        $(this).css('border-bottom', '2px solid '+color);
    })
});