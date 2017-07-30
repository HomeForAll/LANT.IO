$(function(){
    $(".chart-line").statChart({width: "100%", height: "110px"});
    setTimeout(function () {
        $(".chart-line").statChartDraw();
    }, 100);


    // $.getJSON("/api/stat/users/online/day", {}, function(data) {
    //     if (data.response) {
    //         $("#section-statistic .block-users .count span").text(data.response.count);
    //         $("#section-statistic .block-users .chart-line").statChartDraw({data: data.response.data});
    //     } else {
    //         $("#section-statistic .block-ads .count span").text(0);
    //         $("#section-statistic .block-ads .chart-line").statChartDraw({data: [0,0,0]});
    //     }
    // });
    // $.getJSON("/api/stat/ads/get/month?city=1", {}, function(data) {
    //     if (data.response) {
    //         $("#section-statistic .block-ads .count span").text(data.response.count);
    //         $("#section-statistic .block-ads .chart-line").statChartDraw({data: data.response.data});
    //     } else {
    //         $("#section-statistic .block-ads .count span").text(0);
    //         $("#section-statistic .block-ads .chart-line").statChartDraw({data: [0,0,0]});
    //     }
    // });
    //
    // $.getJSON("/api/stat/trans/close/get/now/", {}, function(data) {
    //     if (data.response) {
    //         $("#section-statistic .block-dealings .count span").text(data.response.count);
    //         $("#section-statistic .block-dealings .chart-line").statChartDraw({data: data.response.data});
    //     } else {
    //         $("#section-statistic .block-ads .count span").text(0);
    //         $("#section-statistic .block-ads .chart-line").statChartDraw({data: [0,0,0]});
    //     }
    // });

    $("#stat-block-users button").click(function(event) {
        event.preventDefault();
        var api = $(this).data('api');
        $("#stat-block-users").data('api', api);
        var period = $("#stat-block-users [name=period]:checked").val();
        if (api == "api/stat/users/online/" && period == "now") {
            $("#stat-block-users .chart-line").css('height', '0px');
        } else {
            $("#stat-block-users .chart-line").css('height', '110px');
        }
        $.getJSON(api+period, {}, function(data) {
            if (data.response) {
                $("#section-statistic .block-users .count span").text(data.response.count);
                $("#section-statistic .block-users .chart-line").statChartDraw({data: data.response.data});
            } else {
                $("#section-statistic .block-users .count span").text(0);
                $("#section-statistic .block-users .chart-line").statChartDraw({data: [0,0,0]});
            }
        });
    })
    $("#stat-block-users button").first().trigger('click');
    $("#stat-block-users [name=period]").change(function(event) {
        var api = $("#stat-block-users").data('api');
        var period = $("#stat-block-users [name=period]:checked").val();
        if (api == "api/stat/users/online/" && period == "now") {
            $("#stat-block-users .chart-line").css('height', '0px');
        } else {
            $("#stat-block-users .chart-line").css('height', '110px');
        }
        $.getJSON(api+period, {}, function(data) {
            if (data.response) {
                $("#section-statistic .block-users .count span").text(data.response.count);
                $("#section-statistic .block-users .chart-line").statChartDraw({data: data.response.data});
            } else {
                $("#section-statistic .block-users .count span").text(0);
                $("#section-statistic .block-users .chart-line").statChartDraw({data: [0,0,0]});
            }
        });
    })








    $("#stat-block-items button").click(function(event) {
        event.preventDefault();
        var api = $(this).data('api');
        $("#stat-block-items").data('api', api);
        var period = $("#stat-block-items [name=period]:checked").val();
        var city = $("#stat-block-items [name=city]").val();
        if (api == "api/stat/ads/get/all/") {
            period = '';
            $("#stat-block-items .periods").hide();
        } else {
            $("#stat-block-items .periods").show();
        }

        $.getJSON(api+period, {"city": city}, function(data) {
            if (data.response) {
                $("#section-statistic .block-items .count span").text(data.response.count);
                $("#section-statistic .block-items .chart-line").statChartDraw({data: data.response.data});
            } else {
                $("#section-statistic .block-items .count span").text(0);
                $("#section-statistic .block-items .chart-line").statChartDraw({data: [0,0,0]});
            }
        });
    });
    $("#stat-block-items button").first().trigger('click');
    $("#stat-block-items [name=period]").change(function(event) {
        var api = $("#stat-block-items").data('api');
        var period = $("#stat-block-items [name=period]:checked").val();
        var city = $("#stat-block-items [name=city]").val();
        if (api == "api/stat/ads/get/all/") {
            period = '';
            $("#stat-block-items .periods").hide();
        } else {
            $("#stat-block-items .periods").show();
        }
        $.getJSON(api+period, {"city": city}, function(data) {
            if (data.response) {
                $("#section-statistic .block-items .count span").text(data.response.count);
                $("#section-statistic .block-items .chart-line").statChartDraw({data: data.response.data});
            } else {
                $("#section-statistic .block-items .count span").text(0);
                $("#section-statistic .block-items .chart-line").statChartDraw({data: [0,0,0]});
            }
        });

    });
    $("#stat-block-items [name=city]").change(function(event) {
        var api = $("#stat-block-items").data('api');
        var period = $("#stat-block-items [name=period]:checked").val();
        var city = $("#stat-block-items [name=city]").val();
        if (api == "api/stat/ads/get/all/") {
            period = '';
            $("#stat-block-items .periods").hide();
        } else {
            $("#stat-block-items .periods").show();
        }
        $.getJSON(api+period, {"city": city}, function(data) {
            if (data.response) {
                $("#section-statistic .block-items .count span").text(data.response.count);
                $("#section-statistic .block-items .chart-line").statChartDraw({data: data.response.data});
            } else {
                $("#section-statistic .block-items .count span").text(0);
                $("#section-statistic .block-items .chart-line").statChartDraw({data: [0,0,0]});
            }
        });
    });


});
