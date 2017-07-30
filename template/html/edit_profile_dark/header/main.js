$(document).ready(function () {

    /** Получаем API для header **/
    $.getJSON("/api/user", {}, function(user) {
        $('.img-user img').attr('src', user.response.avatar_original);
        $('.profile-user a').html(user.response.name);
        $('#user-header').attr('src', user.response.avatar_50);
    });

});