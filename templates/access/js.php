<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
<script src="/templates/main/js/jquery.min.js"></script>
<script src="/templates/main/js/jquery.scrollbar.min.js"></script>
<script>
    $(window).on('load', function () {
        $("#loading-center").fadeOut(800, function () {
            $("#loading").fadeOut(1000);
        });
    });

    setCookie('agree', 'rules');

    function getCookie(name) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    function setCookie(name, value, options) {
        options = options || {};

        var expires = options.expires;

        if (typeof expires == "number" && expires) {
            var d = new Date();
            d.setTime(d.getTime() + expires * 1000);
            expires = options.expires = d;
        }
        if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
        }

        value = encodeURIComponent(value);

        var updatedCookie = name + "=" + value;

        for (var propName in options) {
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
                updatedCookie += "=" + propValue;
            }
        }

        document.cookie = updatedCookie;
    }

    function showRules() {
        $('#rules').css({
            visibility: 'visible'
        }).animate({
            top: '30px',
            opacity: '1'
        }, 400)
    }

    function hideRules() {
        $.when(
            $('#rules').animate({
                top: '20px',
                opacity: '0'
            }, 400)
        ).then(function () {
            $(this).css({
                visibility: 'hidden'
            });
        });
    }

    function query() {
        var emailInput = $('input[name=email]');
        var keyInput = $("input[name=key]");

        var email = emailInput.val();
        var key = keyInput.val();

        var request = "email=" + email + "&key=" + key + "&agree=" + getCookie('agree');

        if (key !== '' && getCookie('agree') == 'rules') {
            setCookie('agree', '');
            showRules();
        } else {
            $.ajax({
                type: "POST",
                url: "/",
                data: "type=emailBetaAccess&" + request,
                success: function (msg) {
                    switch (msg) {
                        case 'accessGranted':
                            location.reload();
                            break;
                        case 'incorrectEmail':
                            emailInput.attr('id', 'emailError');
                            break;
                        case 'keyRequest':
                            $(".keyVisible").animate({
                                margin: '0 auto 25px auto',
                                height: '62px'
                            }, 250, function () {
                                keyInput.animate({
                                    opacity: '1'
                                }, 250);
                            });
                            $("input[type=submit]").val('Активировать доступ');
                            break;
                        case 'incorrectKey':
                            setCookie('agree', 'rules');
                            keyInput.attr('id', 'keyError');
                            break;
                        case 'keyDeleted':
                            location.reload();
                            break;
                    }
                }
            });
        }
    }

    $(document).ready(function () {
        $('.scrollbar-inner').scrollbar();

        $("form").on('submit', function (event) {
            query();
            event.preventDefault();
        });

        $("#agree").on('click', function (event) {
            setCookie('agree', true);
            query();
            hideRules();
            event.preventDefault();
        });

        $("#denial").on('click', function (event) {
            setCookie('agree', '');
            query();
            hideRules();
            event.preventDefault();
        });
    });
</script>