(function($){

    $('.toggle-sidebar').click(function(){
        $($(this).attr('data-target')).toggleClass("active");
    });

    //for user panel drop down button
    var isClick = false;
    $(".dropdown").click(function(){
        if(!isClick){
            $(this).addClass("open");
            isClick = true;
        }
        else{
            $(this).removeClass("open");
            isClick = false;
        }
    });

})(jQuery);
