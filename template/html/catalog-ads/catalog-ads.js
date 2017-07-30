$(document).ready(function() {

/*
    var data = {
        id_news: 5097,
        space_type: 1,
        operation_type: 1,
        object_type: 6,
        status: 2,
        user_id: "877",
        title: "mauris ipsum porta elit, a feugiat tellus lorem eu metus.",
        date: "2017-01-21 02:46:57+03",
        content: "ut quam vel sapien imperdiet ornare. In faucibus. Morbi vehicula. Pellentesque tincidunt tempus risus. Donec egestas. Duis ac arcu. Nunc mauris. Morbi non sapien molestie orci tincidunt adipiscing. Mauris molestie pharetra nibh. Aliquam ornare, libero at auctor ullamcorper, nisl arcu iaculis enim, sit amet ornare lectus justo eu arcu. Morbi sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus pede, ultrices a, auctor non, feugiat nec, diam. Duis mi enim, condimentum eget, volutpat ornare, facilisis eget, ipsum.",
        preview_img: "news_07fb5fafa13a8067a8e72cd02c822f1f25.jpg",
        photo_available: true,
        tags: null,
        country: "Argentina",
        area: "Leinster",
        city: "Dublin",
        region: null,
        address: "727-912 Nonummy Rd.",
        non_commission: true,
        gas: false,
        heating: false,
        water_pipes: false,
        bathroom: true,
        dining_room: true,
        study: true,
        playroom: true,
        hallway: false,
        living_room: true,
        kitchen: false,
        bedroom: false,
        signaling: true,
        cctv: false,
        intercom: false,
        concierge: false,
        common: 23,
        bathroom_available: false,
        documents_on_tenure: "288385941-00001",
        alcove: false,
        barn: false,
        bath: true,
        forest_trees: false,
        garden_trees: false,
        guest_house: false,
        lodge: true,
        playground: false,
        river: false,
        spring: true,
        swimming_pool: false,
        waterfront: true,
        wine_vault: true,
        availability_of_garbage_chute: true,
        time_walk: 9,
        time_car: 1,
        rating_views: 2324,
        rating_admin: 4,
        rating_donate: 2,
        balcony: 12,
        bargain: false,
        building_type: 1,
        cadastral_number: "35347806-0",
        ceiling_height: 3,
        clarification_of_the_object_type: 2,
        electricity: true,
        equipment: true,
        fencing: 7,
        floor: 20,
        foundation: 2,
        furnish: 3,
        lavatory: 2,
        lease: 0,
        lease_contract: "lorem. Donec elementum, lorem ut",
        metro_station: 71,
        not_residential: 9,
        number_of_floors: 1,
        number_of_rooms: 27,
        object_located: 1,
        planning_project: "Curabitur vel lectus. Cum sociis",
        price: "7489",
        property_documents: "dolor. Quisque tincidunt pede ac",
        residential: 47,
        roofing: 9,
        sanitation: true,
        security: true,
        space: 17,
        stairwells_status: 0,
        three_d_project: "nisi. Mauris nulla. Integer urna.",
        type_of_construction: 0,
        type_of_house: 2,
        video: "faucibus. Morbi vehicula. Pellentesque tincidunt",
        wall_material: 8,
        year_of_construction: 2008,
        distance_from_metro: 235,
        house: null,
        street: null,
        lift_lifting: false,
        lift_passenger: true,
        lift_none: false,
        parking_multilevel: false,
        parking_underground: true,
        parking_garage_complex: true,
        parking_lot_garage: false,
        parking_none: true,
        plot_smooth: false,
        plot_uneven: false,
        plot_on_the_slope: true,
        plot_of_ravine: false,
        plot_wetland: true
    };



    var dialog = $("<div>").addClass('dialog-ad').prop('title', data.price + " руб./месяц");
    var line = $("<div>").addClass("dialog-ad-line").appendTo(dialog);
    $("<div>").addClass('dialog-ad-photo')
        .css("background-image", "url(/uploads/images/"+data.preview_img+")").appendTo(line);
    var detail = $("<div>").addClass("dialog-ad-detail").appendTo(line);
    var user = $("<div>").addClass('axf').addClass('user-info').appendTo(detail);
    $("<img>").prop("src", "/template/img/user.png").appendTo(user);
    var user = $("<div>").appendTo(user);
    $("<div>").html("Никулин Александр").appendTo(user);
    $("<div>").addClass('user-type').html("частное лицо").appendTo(user);
    $("<button>").addClass('dialog-ad-button-send')
        .html('НАПИСАТЬ').appendTo(detail);
    $("<button>").addClass('dialog-ad-button-call')
        .html('ПОЗВОНИТЬ').appendTo(detail);
    $("<div>").addClass('dialog-ad-price')
        .html(data.price + " руб./месяц").appendTo(detail);
    $("<div>").addClass('dialog-ad-metro')
        .html('<svg width="19" height="13"><use xlink:href="#i-metro" x="0" y="0"></use></svg> Бауманская').appendTo(detail);
    $("<div>").addClass('dialog-ad-afoot')
        .html('<svg width="8" height="12"><use xlink:href="#i-afoot" x="0" y="0"></use></svg> '+data.not_residential+' мин').appendTo(detail);
    $("<div>").addClass("dialog-ad-param").html("2 ком. кв 135 м2").appendTo(dialog);
    $("<div>").html(data.content).appendTo(dialog);
    dialog.dialog({
        resizable: false,
        height: "auto",
        width: 630,
    });
*/





    var renderAd = function(data) {
        if (!data.s_250_140) {
            data.s_250_140 = "/template/img/250x140.jpg";
        }
        var ad = $("<div>").addClass("block").appendTo("#ads-list");
        var ad = $("<div>").addClass("padd").appendTo(ad).click(function(event) {
                var dialog = $("<div>").addClass('dialog-ad').prop('title', data.price + " руб./месяц");
                var line = $("<div>").addClass("dialog-ad-line").appendTo(dialog);
                $("<div>").addClass('dialog-ad-photo')
                    .css("background-image", "url(/uploads/images/"+data.preview_img+")").appendTo(line);
                var detail = $("<div>").addClass("dialog-ad-detail").appendTo(line);
                var user = $("<div>").addClass('axf').addClass('user-info').appendTo(detail);
                $("<img>").prop("src", "/template/img/user.png").appendTo(user);
                var user = $("<div>").appendTo(user);
                $("<div>").html("Никулин Александр").appendTo(user);
                $("<div>").addClass('user-type').html("частное лицо").appendTo(user);
                $("<button>").addClass('dialog-ad-button-send')
                    .html('НАПИСАТЬ').appendTo(detail);
                $("<button>").addClass('dialog-ad-button-call')
                    .html('ПОЗВОНИТЬ').appendTo(detail);
                $("<div>").addClass('dialog-ad-price')
                    .html(data.price + " руб./месяц").appendTo(detail);
                $("<div>").addClass('dialog-ad-metro')
                    .html('<svg width="19" height="13"><use xlink:href="#i-metro" x="0" y="0"></use></svg> Бауманская').appendTo(detail);
                $("<div>").addClass('dialog-ad-afoot')
                    .html('<svg width="8" height="12"><use xlink:href="#i-afoot" x="0" y="0"></use></svg> '+data.not_residential+' мин').appendTo(detail);
                $("<div>").addClass("dialog-ad-param").html("2 ком. кв 135 м2").appendTo(dialog);
                $("<div>").html(data.content).appendTo(dialog);
                dialog.dialog({
                    resizable: false,
                    height: "auto",
                    width: 630,
                });
            });;
        var img = $("<img>").prop("src", data.s_250_140).appendTo(ad);

        // $("<div>").addClass('ads-photo').css("background-image", "url(/uploads/images/"+data.preview_img+")").appendTo(ad);

        $("<div>").addClass("ads-param").addClass("axfs").html(data.number_of_rooms + " ком. кв " + data.space + " м2").appendTo(ad);
        var ad = $("<div>").addClass("ads-detail").appendTo(ad);

        $("<div>").addClass('ads-price').html(data.price + " руб./месяц").appendTo(ad);
        $("<div>").addClass('ads-metro').html('<svg width="19" height="13"><use xlink:href="#i-metro" x="0" y="0"></use></svg> Бауманская').appendTo(ad);
        $("<div>").addClass('ads-afoot').html('<svg width="8" height="12"><use xlink:href="#i-afoot" x="0" y="0"></use></svg> '+data.not_residential+' мин').appendTo(ad);

    };

    // $.ajax({
    //     method: 'POST',
    //     url: 'api/search',
    //     data: {tabs: 1},
    //     dataType: 'Json',
    //     success: function(form_data) {
    //         $.each(form_data, function(i, item) {
    //             renderAd(item)
    //         });
    //     }
    // });

    $('.itemstabs input[name=items_best]').change(function() {
        var period = $(".itemstabs input[name=items_best]:checked").val();
        console.log(period);

        $("#ads-list").children().remove();
        $.getJSON('/api/' + period, {count: 30}, function(json, textStatus) {
            if (json.response && json.response.count_all > 0) {
                $.each(json.response.best_ads, function(i, item) {
                    renderAd(item);
                    //renderFavorite(item);
                });
            }
        });
    });
    $(".itemstabs input[name=items_best]:checked").trigger('change');
    

    $("form#search").on("submit", function( event ) {
        event.preventDefault();
        $.ajax({
            method: 'POST',
            url: 'api/search',
            data: $("form#search").serializeObject(),
            dataType: 'Json',
            success: function(form_data) {
                $("#ads-list").children().remove();
                $.each(form_data, function(i, item) {
                    renderAd(item)
                });
                $("#section-ads h3").html("Результаты поиска");
                //$.fn.fullpage.moveTo(3);
                $.fn.fullpage.moveTo('sectionAds');
            }
        });
    });


});
