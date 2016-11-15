$(document).ready(function(){

    $('.panel_slide').delay(1000).animate({right: "0"}, 500);
    $('.panel_slide').click(function (event) {
        /*event.preventDefault();*/
        $(this).animate({right: "-250px"}, 500);

    })

    /*--------  double  ------*/
    $('.temp_slider').delay(1000).animate({right: "0"}, 500);
    $('.temp_slider').click(function (event) {
        /*event.preventDefault();*/
        $(this).animate({right: "-250px"}, 500);

    })
    
    /*-------------  slider  ---------------*/
    $("#left_arrow").click(function () {
        event.preventDefault();
        var leftPos = $('#gallery_block').scrollLeft();
        $("#gallery_block").animate({scrollLeft: leftPos - 230}, 500);

    });

    $("#right_arrow").click(function (event) {
        event.preventDefault();
        var leftPos = $('#gallery_block').scrollLeft();
        $("#gallery_block").animate({scrollLeft: leftPos + 230}, 500);

    });

    $( function() {
        $( "#gallery_block" ).draggable();
    } );



    
    
});

