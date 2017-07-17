'use strict';

$(document).ready(function () {

    $('.user-all-information').not(':first').hide();

    $('.top-title .hash-tabs').click(function() {

        $('.top-title .hash-tabs').removeClass('active-hash').eq($(this).index()).addClass('active-hash');
        $('.user-all-information').hide().eq($(this).index()).fadeIn()

    }).eq(0).addClass('active-hash');

});