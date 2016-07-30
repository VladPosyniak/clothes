/**
 * Created by Vlad on 11.07.2016.
 */
$(document).ready(function(){
    $('.add_img').click(function(){
        $('.add_img').before('<div class="post-img-create"><img src="http://qnimate.com/wp-content/uploads/2014/03/images2.jpg" alt=""></div>');
    });
    $('.add_p').click(function(){
        $('.add_img').before('<div class="post-p-create"><textarea alt=""></textarea></div>');
    })
});