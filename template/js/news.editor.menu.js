$(document).ready(function () {
var form_options_menu = {
    1: {
        1: {2: 1, 3: 1, 4: 1, 5: 1, 6: 1, 7: 1, 8: 1, 9: 1, 10: 1},
        2: {2: 1, 3: 1, 4: 1, 5: 1, 6: 1, 7: 1, 8: 1, 9: 1, 10: 1}
    }, 2: {1: {1: 1, 11: 1, 12: 1, 13: 1, 14: 1}, 2: {1: 1, 11: 1, 12: 1, 13: 1, 14: 1}}
};


    $('#add_news').submit(function () {
        var opt1 = $('#space_type').val();
        var opt2 = $('#operation_type').val();
        var opt3 = $('#object_type').val();
        if (typeof form_options_menu[opt1][opt2][opt3] === "undefined") {
            alert('Данной опции не существует!');
            return false;
        }
    });
    // Добавление поля hidden при изменении status
    $("#status_frm .status").change(function () {
        var hidName = ($(this).attr('name'));
        hidName = hidName.substr(7);
        $(this).after('<input type="hidden" name="change_status_' + hidName + '" value="' + hidName + '">');
    });


});

