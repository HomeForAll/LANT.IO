$(function(){
    $.getJSON("/api/user", {}, function(data) {
        if (data.response) {
            if (data.response.status != -1) {
                $("#section-login").remove();
            }
            initUserMenu(data.response);
            initIndexPage();
        }
    });
});
function initIndexPage() {
    $("#page").fadeIn(400);
    $("#hellopreloader").fadeOut(400);
    $('#scene').parallax({
        calibrateX: false,
        calibrateY: true,
        invertX: false,
        invertY: true,
        limitX: false,
        limitY: 10,
        scalarX: 2,
        scalarY: 8,
        frictionX: 0.2,
        frictionY: 0.8,
        originX: 0.0,
        originY: 1.0
    });
    $('#fullpage').fullpage({
        //anchors: ['firstPage', 'secondPage', '3rdPage'],
        lockAnchors: true,
        navigation: true,
        navigationPosition: 'right',
        //navigationTooltips: ['First page', 'Second page', 'Third and last page'],
        normalScrollElements: '.scrollbar-inner, .arcticmodal-container_i',
    });
    // $.fn.fullpage.silentMoveTo(3);

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
    $.fn.fullpage.silentMoveTo(3);
}

function initUserMenu(user) {
    if (user.status != -1) {
        $('.menu-user .user-menu-reg').remove();
        $('.menu-user .menu-user-name').text(user.name)
        $('.menu-user .user-info img').prop('src', user.photo);


        $('.header-line .menu-user-name').text(user.name)
        $('.header-line .user-info img').prop('src', user.photo);
    } else {
        $('.menu-user .user-info').remove();
        $('.header-line .user-info').remove();

        $('.menu-user .user-menu-notice').remove();
        $('.menu-user .user-menu-message').remove();
        $('.menu-user .user-menu-reg').click(function(event) {
            $.fn.fullpage.moveTo('sectionLogin');
        });
        $('.menu-user .user-menu-plus').click(function(event) {
            $.fn.fullpage.moveTo('sectionLogin');
        });

    }
}




$(function(){
    $(".dialog-registration :input").inputmask();


    $("form#form-login").submit(function(event) {
        event.preventDefault();
        $.ajax({
            method: 'post',
            url: '/api/auth',
            data: $(this).serializeObject(),
            dataType: 'Json',
            success: function(data) {
                console.log(data);
                location.reload();
            }
        });
    });

    var dialog_registration_config = {
		beforeBackward: function( event, state ) {
    		state.step.find("[name=type]").prop('checked', false);
        	state.step.find("[name=document]").prop('checked', false);
		},
		beforeForward: function( event, state, update ) {
            var data =  dialog_registration.wizard("form").serializeObject();
            var current_state = dialog_registration.wizard("step", state.stepIndex-1).find(".current_state").val();
            $.post('/api/registration/'+current_state, data, function(data, textStatus, xhr) {
                update();
            });
            setTimeout(function () {
            }, 1000);
            return false;
        },
		transitions: {
			step_type_user: function( state, action ) {
				var branch = state.step.find("[name=type]:checked").val();
				return branch;
			},
			step_type_document: function( state, action ) {
				var branch = state.step.find("[name=document]:checked").val();
				return branch;
			},
		}
    };
    var dialog_registration = $("#dialog-registration").wizard(dialog_registration_config);
    $("#dialog-registration .registration-type-button").change(function(event) {
        dialog_registration.wizard("forward");
    });
    $('.open-registration').click(function(event) {
        dialog_registration.find("[name=type]").prop('checked', false);
        dialog_registration.find("[name=document]").prop('checked', false);
        dialog_registration.wizard( "destroy" ).wizard(dialog_registration_config);
        $(".dialog-registration").arcticmodal();
    });
});
