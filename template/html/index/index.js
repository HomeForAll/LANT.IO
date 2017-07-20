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
    //$.fn.fullpage.silentMoveTo(1);
}

function initUserMenu(user) {
    if (user.status != -1) {
        $('.menu-user .user-menu-reg').remove();
        $('.menu-user .menu-user-name').text(user.name)
        $('.menu-user .user-info img').prop('src', user.photo);


        $('.header-line .menu-user-name').text(user.name)
        $('.header-line .user-info img').prop('src', user.photo);
        $('.menu-user .user-info, .header-line .user-info').click(function(event) {
            window.location = '/profile/';
        });

        $('.userinfo__logout').click(function(){
            window.location = '/logout/';
        });
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
    $(".dialog-registration :input").inputmask(/*{autoUnmask: true}*/);


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

    $("form[name=dialog-registratio]").submit(function(event) {
        event.preventDefault();
    });

    var dialog_registration_config = {
		beforeBackward: function( event, state ) {
    		state.step.find("[name=type]").prop('checked', false);
        	state.step.find("[name=document]").prop('checked', false);
		},
        afterForward: function( event, state, update ) {
            var current_index = state.stepIndex;
            var current_step = dialog_registration.wizard("step", current_index);
            var current_state = current_step.find(".current_state").val();
            if (current_state == 'step_summary') {
                $.getJSON('/api/registration/'+current_state, {}, function(data) {
                    console.log(data);
                });
            }
            //onsole.log(current_state);
        },
		beforeForward: function( event, state, update ) {
            var data =  dialog_registration.wizard("form").serializeObject();
            var current_index = state.stepsActivated.slice(-2, -1).shift();
            var current_step = dialog_registration.wizard("step", current_index);
            var current_state = current_step.find(".current_state").val();
            var error = current_step.find('.error');
            error.html('');
            if (current_state == "step_type_user" || current_state == "step_type_document") {
                update();
            } else {
                $.post('/api/registration/'+current_state, data, function(data) {
                    console.log(data);
                    //data = JSON.parse(data);
                    if (data.response) {
                        update();
                    } else if (data.error) {
                        switch (data.error[0].code) {
                            case 2013: error.html("Пожалуйста, заполните корректно информацию."); break;
                            case 2006: error.html("Неверно указано имя."); break;
                            default: error.html(data.error[0].message);
                        }
                    }
                });
            }
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
        //dialog_registration.wizard("forward");
        dialog_registration.find(".forward").first().trigger('click');
    });
    $('.open-registration').click(function(event) {
        dialog_registration.find("[name=type]").prop('checked', false);
        dialog_registration.find("[name=document]").prop('checked', false);
        dialog_registration.wizard( "destroy" ).wizard(dialog_registration_config);
        $(".dialog-registration").arcticmodal();
        //dialog_registration.wizard("select", 7);
    });


    var dialog_restore_config = {
        beforeForward: function( event, state, update ) {
            var data =  dialog_restore.wizard("form").serializeObject();
            var current_index = state.stepsActivated.slice(-2, -1).shift();
            var current_step = dialog_restore.wizard("step", current_index);
            var current_state = current_step.find(".current_state").val();
            var error = current_step.find('.error');
            error.html('');
            if (current_state != 'step_1') {
                $.post('/api/restore/'+current_state, data, function(data) {
                    console.log(data);
                    try {
                        data = JSON.parse(data);
                        if (data.response) {
                            update();
                        } else if (data.error) {
                            switch (data.error[0].code) {
                                default: error.html(data.error[0].message);
                            }
                        }
                    } catch (e) {
                        error.html(data);
                    }
                });
                return false;
            } else {
                return true;
            }
        },
        transitions: {
            step_1: function( state, action ) {
                var data =  dialog_restore.wizard("form").serializeObject();
                var error = state.step.find('.error');
                error.html('');

                $.post('/api/restore/step_1', data, function(data) {
                    console.log(data);
                    try {
                        //data = JSON.parse(data);
                        if (data.response) {
                            //update();
                            action(data.response.login_type);
                        } else if (data.error) {
                            switch (data.error[0].code) {
                                default: error.html(data.error[0].message);
                            }
                        }
                    } catch (e) {
                        error.html(data);
                    }
                });

                //setTimeout(function() {
                //    action("restore_phone");
                //}, 10);
                //var branch = state.step.find("[name=type]:checked").val();
                //return 'restore_phone';
                //return branch;
            }
        }
    };

    var dialog_restore = $("#dialog-restore").wizard(dialog_restore_config);

    $('.open-restore').click(function(event) {
        dialog_restore.wizard( "destroy" ).wizard(dialog_restore_config);
        var modal = $(".dialog-restore").arcticmodal();
        modal.find('.finish').click(function(event) {
            event.preventDefault();
            console.log(1111111);
            modal.arcticmodal('close');
        });
        //dialog_restore.wizard("select", 7);
    });
    //$('.open-restore').click();









});
