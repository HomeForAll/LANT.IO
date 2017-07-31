$(function () {


    $.getJSON("/api/user", {}, function(user) {
        if (user.response) {
            if (user.response.status == -1) {
                window.location = '/';
            }
            if (user.response.avatar_50)
                $('.user-info img').prop('src', user.response.avatar_50);
            if (user.response.avatar_100)
                $('.profile-userinfo_photo').prop('src', user.response.avatar_100);
            $('.profile-userinfo_welcome').html("Здравствуйте, "+user.response.name+"!");
            $('.user-info .user-info__name').html(user.response.name);
        }
    });

    $(".profile-userinfo_uploadphoto input").change(function(event) {
        $(this).simpleUpload("/api/upload/user/avatar", {
            allowedExts: ["jpg", "jpeg", "jpe", "jif", "jfif", "jfi", "png", "gif"],
            allowedTypes: ["image/pjpeg", "image/jpeg", "image/png", "image/x-png", "image/gif", "image/x-gif"],
            start: function(file) {
                // console.log('Start:', file);
                // this.block = $('<div class="uploadr__block"></div>');
                // this.progressBar = $('<div class="uploadr__progress"></div>');
                // this.cancelButton = $('<div class="uploadr__cancel"></div>');
                // var that = this;
                // this.cancelButton.click(function(){
                //     that.upload.cancel();
                // });
                // this.block.append(this.progressBar).append(this.cancelButton);
                // $('.uploadr__button').before(this.block);
            },
            progress: function(progress) {
                // this.progressBar.width(progress + "%");
            },
            success: function(data) {
                console.log('success', data);
                if (data.response) {
                    location.reload();
                }
                // var that = this;
                // this.progressBar.remove();
                // this.cancelButton.click(function(){ that.block.remove() });
                // if (data.response && data.response['250_140']) {
                //     data.response['250_140'] = data.response['250_140'].replace(/\\/g, '/');
                //     this.block.css('background-image', 'url('+data.response['250_140']+')');
                //     var formatDiv = $('<input type="hidden" name="photos[]" value="">').val(data.response.id);
                //     this.block.append(formatDiv);
                // } else {
                //     //our application returned an error
                //     var error = data.error.message;
                //     var errorDiv = $('<div class="error"></div>').text(error);
                //     this.block.append(errorDiv);
                // }
            },
            error: function(error) {
                console.log('error', error);
                // this.progressBar.remove();
                // // this.cancelButton.click(function(){
                // // 	this.block.fadeOut(400, function(){
                // // 		$(this).remove();
                // // 	});
                // // });
                // //this.cancelButton.remove();
                // var error = error.message;
                // var errorDiv = $('<div class="error"></div>').text(error);
                // this.block.append(errorDiv);
            },
            cancel: function(){
                // //upload cancelled
                // this.block.remove();
                // // this.block.fadeOut(400, function(){
                // // 	$(this).remove();
                // // });
            }
        });

    });

    var renderItems = function(data) {
        if (!data.s_250_140) {
            data.s_250_140 = "/template/img/250x140.jpg";
        }
        var ad = $("<div>").addClass("profile-item").appendTo(".profile-items");
        //var ad = $("<div>").addClass("padd").appendTo(ad);
        //var img = $("<img>").prop("src", "/uploads/images/"+data.preview_img).appendTo(ad);

        $("<div>").addClass('profile-item__photo').css("background-image", "url("+data.s_250_140+")").appendTo(ad);
        $("<div>").addClass("profile-item__param").addClass("axfs").html("2 ком. кв 135 м2").appendTo(ad);

        var detail = $("<div>").addClass("profile-item__detail").appendTo(ad);

        var price = $("<div>").addClass('profile-item__price').html((data.price * 1).toLocaleString('ru-RU')).appendTo(detail);
        $("<span>").addClass('profile-item__price_info').html("руб./месяц").appendTo(price);

        $("<div>").addClass('profile-item__metro').html('<svg width="19" height="13"><use xlink:href="#i-metro" x="0" y="0"></use></svg> Бауманская').appendTo(detail);
        $("<div>").addClass('profile-item__afoot').html('<svg width="8" height="12"><use xlink:href="#i-afoot" x="0" y="0"></use></svg> '+data.not_residential+' мин').appendTo(detail);
        //

        var actions = $("<div>").addClass("profile-item__actions").appendTo(ad);
        $("<img>").addClass('profile-item__action').prop('src', '/template/img/item-icon-edit.svg').appendTo(actions);

        $("<img>").addClass('profile-item__action').prop('src', '/template/img/item-icon-del.svg').appendTo(actions).click(function(){
            if (window.confirm('Действительно хотите удалить?')) {
                $.getJSON("/api/items.delete", {id: data.id_news}, function(user) {
                    if (user.response) {
                        $.getJSON('/api/items/my', {count: 2}, function(json, textStatus) {
                            if (json.response && json.response.count > 0) {
                                $('.profile-items').html('');
                                $.each(json.response.items, function(i, item) {
                                    renderItems(item);
                                });
                                $('.pblock__status_i').html("Смотреть еще "+json.response.count+" объявления");
                            }
                        });
                    }
                });
            }
        });

        $("<img>").addClass('profile-item__action').prop('src', '/template/img/item-icon-activ.svg').appendTo(actions).click(function(){
            if (actions.find('.profile-item__activ').hasClass('profile-item__noactiv')) {
                $.getJSON("/api/items.setActive", {id: data.id_news}, function(user) {
                    if (user.response) 
                        actions.find('.profile-item__activ')
                        .toggleClass('profile-item__noactiv').html('активно');
                });
            } else {
                $.getJSON("/api/items.setUnActive", {id: data.id_news}, function(user) {
                    if (user.response) 
                        actions.find('.profile-item__activ')
                        .toggleClass('profile-item__noactiv').html('не активно');
                });
            }
        });

        if (data.status == 1) {
            $("<span>").addClass('profile-item__activ').html("активно").appendTo(actions);
        } else {
            $("<span>").addClass('profile-item__activ').addClass('profile-item__noactiv').html("не активно").appendTo(actions);
        }


        // $("<div>").addClass('ads-more').addClass("axfc")
        //     .html('<svg width="20" height="12"><use xlink:href="#i-eye" x="0" y="0"></use></svg>')
        //     .appendTo(ad);
    };

    var renderFavorite = function(data) {
        if (!data.s_250_140) {
            data.s_250_140 = "/template/img/250x140.jpg";
        }
        var ad = $("<div>").addClass("profile-item").appendTo(".profile-favorites");
        //var ad = $("<div>").addClass("padd").appendTo(ad);
        //var img = $("<img>").prop("src", "/uploads/images/"+data.preview_img).appendTo(ad);

        $("<div>").addClass('profile-item__photo').css("background-image", "url("+data.s_250_140+")").appendTo(ad);
        $("<div>").addClass("profile-item__param").addClass("axfs").html("2 ком. кв 135 м2").appendTo(ad);

        var ad = $("<div>").addClass("profile-item__detail").appendTo(ad);

        var price = $("<div>").addClass('profile-item__price').html((data.price * 1).toLocaleString('ru-RU')).appendTo(ad);
        $("<span>").addClass('profile-item__price_info').html("руб./месяц").appendTo(price);

        $("<div>").addClass('profile-item__metro').html('<svg width="19" height="13"><use xlink:href="#i-metro" x="0" y="0"></use></svg> Бауманская').appendTo(ad);
        $("<div>").addClass('profile-item__afoot').html('<svg width="8" height="12"><use xlink:href="#i-afoot" x="0" y="0"></use></svg> '+data.not_residential+' мин').appendTo(ad);
        //
        // $("<div>").addClass('ads-more').addClass("axfc")
        //     .html('<svg width="20" height="12"><use xlink:href="#i-eye" x="0" y="0"></use></svg>')
        //     .appendTo(ad);
    };



$.getJSON('/api/items/my', {count: 2}, function(json, textStatus) {
    if (json.response && json.response.count > 0) {
        $.each(json.response.items, function(i, item) {
            renderItems(item);
        });
        $('.pblock__status_i').html("Смотреть еще "+json.response.count+" объявления");
    }
});


$.getJSON('/api/favorite/list', {count: 3}, function(json, textStatus) {
    if (json.response && json.response.count > 0) {
        $.each(json.response.items, function(i, item) {
            renderFavorite(item);
        });
        $('.pblock__status_v').html("Смотреть еще "+json.response.count+" объявления");
    }
});


$('.pheader__logout').click(function(event){
    event.stopPropagation();
    $.getJSON('/api/logout/', {}, function(data) {
        if (data.response) {
            window.location = '/';
            // location.reload();
        } else {

        }
    });
});









$(".additems-cards select.aselect__input").chosen({
    //placeholder_text_multiple: "Выберете параметры...",
    //placeholder_text: "Выберете параметры...",
    disable_search_threshold: 20,
    width: "100%"
})



$(".additems-cards select[name=type].aselect__input").change(function(){

    if (data_all[$(this).val()]) {
        var data = data_all[$(this).val()];
        console.log(data);

        var tabs = $("#additems-cards__tabs");
        tabs.find('.additems-cards__tab:not(.additems-cards__tab_default)').remove();

        var more = $("#additems-cards__cards");
        more.find('.additems-cards__card:not(.additems-cards__card_default)').remove();


        $.each(data, function(i, item) {


            $("<div>").addClass("additems-cards__tab").html(item.title).appendTo(tabs);

            var card = $("<div>").addClass("additems-cards__card").appendTo(more);

            $.each(item.data, function(i, item) {

                var line = $("<div>").addClass("afield").appendTo(card);
                $("<div>").addClass("afield__label").html(item.title).appendTo(line);

                if (item.type == 'checkbox') {
                    var select = $("<select>").addClass("aselect__input")
                        .prop("name", item.name).data("placeholder", "Выберете параметры...")
                        .appendTo(line);
                    if (item.multiple && item.multiple == true) {
                        select.prop("multiple", "multiple");
                    } else {
                        $("<option>").val('').html('').appendTo(select);
                    }
                    $.each(item.value, function(id, item) {
                        $("<option>").val(id).html(item).appendTo(select);
                    });
                    select.chosen({
                        placeholder_text_multiple: "Выберете параметры...",
                        placeholder_text: "Выберете параметры...",
                        disable_search_threshold: 20,
                        width: "100%"
                    }).change(function(evt, params) {
                        //console.log(select.val())
                        if (select.val() !== null) {
                            //$("input[name=" + name + "]").val(select.val().join(','));
                        }
                    });
                }
                if (item.type == 'from-to') {
                    $("<input>").addClass("aselect__input").prop("name", item.name).appendTo(line);
                }
                if (item.cost && item.cost != "") {
                    $("<div>").addClass("afield__right").html(item.cost).appendTo(line);
                }

            });
        });
    }

    $('.additems-cards__tabs').on('click', '.additems-cards__tab:not(.additems-cards__tab_select)', function() {
		$(this).addClass('additems-cards__tab_select')
            .siblings().removeClass('additems-cards__tab_select')
			.closest('.additems-cards').find('.additems-cards__card')
            .removeClass('additems-cards__card_select')
            .eq($(this).index()).addClass('additems-cards__card_select');
        $('.additems-cards select').trigger("chosen:updated");
	});
});

$("#profile-additems").submit(function(event) {
    event.preventDefault();
});
$("#profile-additems button").click(function(event) {
    event.preventDefault();
    var data = $("#profile-additems").serializeObject();
    data.status = $(event.target).val();
    console.log(data);
    $.ajax({
        method: 'post',
        url: '/api/items/add',
        data: data,
        dataType: 'Json',
        success: function(data) {
            console.log(data);
            if (data.response) {
                location = '/profile/items/';
            }
            //location.reload();
        }
    });
});

$("#upload_photos").change(function(event) {
	$(this).simpleUpload("/api/upload/news/images", {
        allowedExts: ["jpg", "jpeg", "jpe", "jif", "jfif", "jfi", "png", "gif"],
		allowedTypes: ["image/pjpeg", "image/jpeg", "image/png", "image/x-png", "image/gif", "image/x-gif"],
    	start: function(file){
            console.log('Start:', file);
			this.block = $('<div class="uploadr__block"></div>');
			this.progressBar = $('<div class="uploadr__progress"></div>');
			this.cancelButton = $('<div class="uploadr__cancel"></div>');
			var that = this;
			this.cancelButton.click(function(){
				that.upload.cancel();
			});
			this.block.append(this.progressBar).append(this.cancelButton);
			$('.uploadr__button').before(this.block);
    	},
    	progress: function(progress) {
			this.progressBar.width(progress + "%");
    	},
    	success: function(data) {
            var that = this;
			this.progressBar.remove();
			this.cancelButton.click(function(){ that.block.remove() });
			if (data.response && data.response['250_140']) {
                data.response['250_140'] = data.response['250_140'].replace(/\\/g, '/');
                this.block.css('background-image', 'url('+data.response['250_140']+')');
				var formatDiv = $('<input type="hidden" name="photos[]" value="">').val(data.response.id);
				this.block.append(formatDiv);
			} else {
				//our application returned an error
				var error = data.error.message;
				var errorDiv = $('<div class="error"></div>').text(error);
				this.block.append(errorDiv);
			}
    	},
    	error: function(error) {
            this.progressBar.remove();
			// this.cancelButton.click(function(){
    		// 	this.block.fadeOut(400, function(){
    		// 		$(this).remove();
    		// 	});
			// });
            //this.cancelButton.remove();
            var error = error.message;
            var errorDiv = $('<div class="error"></div>').text(error);
            this.block.append(errorDiv);
    	},
		cancel: function(){
			//upload cancelled
    		this.block.remove();
			// this.block.fadeOut(400, function(){
			// 	$(this).remove();
			// });
		}
    });
});









/*
Дата рождения

Паспортные данные:
Серия номер
Адрес регистрации:
Индекс
Город
Улица
Дом
Квартира

Контакты:
Номер телефона
Email
*/


    var profile_my = $('#profile_my');
    if (profile_my.length) {
        $.getJSON("/api/user", {extend: 1}, function(user) {
            if (user.response) {
                user.response.middle_name = user.response.patronymic;
                user.response.bdate = user.response.birthday;
                var html = '';

                html += `
                <img src="${user.response.avatar_100}" />
                <div>${user.response.first_name} ${user.response.middle_name} ${user.response.last_name}<div>

                <div>Дата рождения</div><div>${user.response.bdate}</div>


                <div>О себе</div>
                <div>${user.response.about_me}</div>
                `;


                profile_my.html(html);
            }
        });
    }



    // if (user.response.avatar_50)
    //     $('.user-info img').prop('src', user.response.avatar_50);
    // if (user.response.avatar_100)
    //     $('.profile-userinfo_photo').prop('src', user.response.avatar_100);
    // $('.profile-userinfo_welcome').html("Здравствуйте, "+user.response.name+"!");
    // $('.user-info .user-info__name').html(user.response.name);










});