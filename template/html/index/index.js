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
    // $.fn.fullpage.silentMoveTo(1);

    
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
        if (user.avatar_50)
        $('.menu-user .user-info img').prop('src', user.avatar_50);


        $('.header-line .menu-user-name').text(user.name)
        if (user.avatar_50)
        $('.header-line .user-info img').prop('src', user.avatar_50);
        $('.menu-user .user-info, .header-line .user-info').click(function(event, a) {
            window.location = '/profile/';
        });

        $('.userinfo__logout').click(function(event){
            event.stopPropagation();
            $.getJSON('/api/logout/', {}, function(data) {
                if (data.response) {
                    //window.location = '/';
                    location.reload();
                } else {

                }
            });
            // window.location = '/logout/';
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

var getFirstError = function (errors) {
    var getFirstProperty = function (errors) {
        for (var i in errors) {
            return errors[i];
            break;
        }
        return false;
    };
    errors = getFirstProperty(errors);
    if (errors && errors.length > 0) {
        return errors[0];
    }
    return false;
};


$(function(){
    $(".dialog-registration :input").inputmask(/*{autoUnmask: true}*/);


    $("form#form-login").submit(function(event) {
        event.preventDefault();
        var data_login = $(this).serializeObject();
        $.ajax({
            method: 'post',
            url: '/api/auth',
            data: data_login,
            dataType: 'Json',
            success: function(data) {
                console.log(data_login);
                console.log(data);
                if (data.response.auth_type == 'ga') {
                    // tmp_hash
                    //$(".dialog-2factor").find('.error').html(data.response.tmp_hash);
                    $(".dialog-2factor").find('input[name=login]').val(data_login.login);
                    $(".dialog-2factor").find('input[name=hash]').val(data.response.tmp_hash);
                    $(".dialog-2factor").arcticmodal();
                } else if (data.response.auth_type == 'sms') {
                    // tmp_hash
                } else if (data.response == true) {
                    //location.reload();
                }
            }
        });
    });
    $("form[name=dialog-2factor]").submit(function(event) {
        event.preventDefault();
        var data = $(this).serializeObject();
        var error =  $(this).find('.error').html('');
        var errors = getFirstError(validate(data, {
            code: {
                presence: {message: "^Введите полученный код подтверждения."},
                numericality: {message: "^Введите корректный код подтверждения."},
                length: {is: 6, message: "^Введите корректный код подтверждения."}
            }
        }));
        if (errors) {
            error.html(errors);
        } else {
            $.post('/api/authenticator/verify', data, function(data) {
                console.log(data);
                if (data.response) {
                    //location.reload();
                } else if (data.error) {
                    error.html(data.error.message);
                }
            });

        }
        console.log(errors);
        console.log(data);
    });
   



    $("form[name=dialog-registratio]").submit(function(event) {
        event.preventDefault();
    });

    var constraints = {
        name: {
            presence: {message: "^Пожалуйста, укажите ваше имя."}
        },
        document_inn: {

        },
        document_ogrn: {

        },
        brand: {

        },
        company: {

        },
        phone: {
            presence: {message: "^Введите телефон."}
        },
        code: {
            presence: {message: "^Введите полученный код из смс."},
            numericality: {message: "^Введите корректный код из смс."},
            length: {is: 6, message: "^Введите корректный код из смс."}
        },
        email: {
            presence: {message: "^Укажите вашу электронную почту."},
            email: { message: "^Введите правильную электронную почту." }
        },
        password: {
            presence: {message: "^Придумайте и введите пароль."}
        },
        //code: {},
    };

    $('#tbut').click(function(){
        var input = $('#tteesstt').find('input');
        var errors = validate(input, constraints);// || {};
        console.log(errors)
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
            var inputs = current_step.find('input').serializeObject();
            var _constraints = {};
            $.each(inputs, function(name) {
                if (constraints[name])
                _constraints[name] = constraints[name];
            });

            //console.log('serialize', inputs.serializeObject())

            error.html('');
            
            var errors = validate(inputs, _constraints);
            console.log(errors);
            if (errors) {
                $.each(inputs, function(name) {
                    $.each(errors[name], function(i, _error) {
                        error.html(_error);
                    });
                });
            } else {
                if (current_state == "step_type_user" || current_state == "step_type_document") {
                    update();
                } else {
                    $.post('/api/registration/'+current_state, data, function(data) {
                        console.log(data);
                        if (data.response) {
                            if (current_state == "step_password") {
                                location.reload();
                            } else {
                                update();
                            }
                        } else if (data.error) {
                            error.html(data.error.message);
                        }
                    });
                }
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
                        //data = JSON.parse(data);
                        if (data.response) {
                            update();
                        } else if (data.error) {
                            switch (data.error.code) {
                                default: error.html(data.error.message);
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
                            switch (data.error.code) {
                                default: error.html(data.error.message);
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
