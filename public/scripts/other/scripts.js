$(document).ready(function()
{

    function adaptiveBlocks(){
    if ($(window).width() <= '1200'){
        $('.central-content-top').before($('.right-panel'));
    } else {
        $('.central-content').after($('.right-panel'));


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

        if(scrolled>parseInt($('.right-panel').css('height')) && $(window).width() >= '1200'){
            $('.right-panel').hide();
            $('.central-content').css('width','80%')
        }

        else{
            $('.right-panel').show();
            $('.central-content').css('width','') }
            };
    }
}
$(window).load(function(){
    mobileRightMenu();
    adaptiveBlocks();
}); // при загрузке
$(window).resize(function(){
    mobileRightMenu();
    adaptiveBlocks();
}); // при изменении размеров

    //mobile menu

    function mobileRightMenu(){
        if ($(window).width() <= '860'){
            $('.mobile-menu').append($('.left-panel'))
        }
        else{
            $('.container').before($('.left-panel'))
        }
    }

    function openMenu() {
        $('.mobile-menu').animate({right: '-1px'}, 200);
        $('.mobile-menu-button').animate({marginRight: '250px'}, 200);
    }

    function closeMenu() {
        $('.mobile-menu').animate({right: '-250px'}, 200);
        $('.mobile-menu-button').animate({marginRight: '0'}, 200);
    }

    $('.wrapper').click(function(){
        if($('.mobile-menu').css('right') == '-1px'){
            closeMenu()
        }
    });
    $('.mobile-menu-button').click(function () {
        if ($('.mobile-menu').css('right') == '-250px') {
            openMenu();
        }
        else {
            closeMenu();
        }
    });
    //mobile menu


    //$('.post-likes span').click(function()    likes
    //{
    //    var color = $(this).css('color');
    //    $('.post-likes span').css('border-bottom','');
    //    $(this).css('border-bottom', '2px solid '+color);
    //})
});