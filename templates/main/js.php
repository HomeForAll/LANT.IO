<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    /*$(window).on('load', function () {
     $("#loading-center").fadeOut(800, function () {
     $("#loading").fadeOut(1000);
     });
     });*/

    function getRegions() {
        $.ajax({
            type: "POST",
            url: "/search",
            data: "type=getRegions",
            success: function (data) {
                var regionsCursor = $("select[name=region]");
                regionsCursor.html("");
                var regions = JSON.parse(data);

                var html = "<option value=\"\" selected>---</option>";
                regions.forEach(function (region, i) {
                    html += "<option value=\"" + region.region_id + "\">" + region.title + "</option>";
                });
                regionsCursor.html(html);
            }
        });
    }

    function getCities(region_id) {
        $.ajax({
            type: "POST",
            url: "/search",
            data: "type=getCities&region_id=" + region_id,
            success: function (data) {
                var citiesCursor = $("select[name=city]");
                citiesCursor.html("");

                var cities = JSON.parse(data);

                var html = "<option value=\"\" selected>---</option>";
                cities.forEach(function (citi, i) {
                    html += "<option value=\"" + citi.id + "\">" + citi.title + "</option>";
                });
                citiesCursor.html(html);
            }
        });
    }

    var timer;
    function getTimeout(delay, callback) {
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback();
        }, delay);
    }

    function getGeoData(address) {
        var divCitiesCursor = $('#cities');

        getTimeout(1000, function () {
            $.ajax({
                type: "POST",
                url: "/search",
                data: "type=getGeoData&address=" + address,
                success: function (data) {
                    divCitiesCursor.html(data);
                }
            });
        });
    }
</script>