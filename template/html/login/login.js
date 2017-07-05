$(function(){
    $(".dialog-registration :input").inputmask();


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
