

$(document).ready(function(){
    $("#bar-icon").click(function(){
        $(".top-menu").slideToggle();
    });

    $(window).resize(function(){
        var winWidth = $(this).width();
        if(winWidth >= 768) {
            $(".top-menu").removeAttr("style");
        }
    });

    $("#birthCalendar").datepicker();
    $("#date").datepicker();
});