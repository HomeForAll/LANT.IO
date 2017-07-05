$(document).ready(function() {

    $('#fullpage').fullpage({
        //anchors: ['firstPage', 'secondPage', '3rdPage'],
        navigation: true,
        navigationPosition: 'right',
        //navigationTooltips: ['First page', 'Second page', 'Third and last page'],
        normalScrollElements: '.scrollbar-inner, .arcticmodal-container_i',
    });
    //$.fn.fullpage.silentMoveTo(3);

    var lastScrollY = 0;
    $('.scrollbar-inner').scrollbar({
        onScroll: function(y, x){
            if(y.scroll == 0 && lastScrollY != 0) {
                //$.fn.fullpage.moveSectionUp();
                //$.fn.fullpage.setMouseWheelScrolling(true);
            }
            if(y.scroll == y.maxScroll){
                //$.fn.fullpage.moveSectionDown();
                //$.fn.fullpage.setMouseWheelScrolling(true);
            }
            lastScrollY = y.scroll;
        }
    });
    $.fn.fullpage.silentMoveTo(2);






});
