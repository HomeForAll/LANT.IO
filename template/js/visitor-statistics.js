(function($, document, Math, undefined) {
    var svgElement = function(tag, attrs) {return $(document.createElementNS("http://www.w3.org/2000/svg", tag)).attr(attrs)};
    var svgSupported = "createElementNS" in document && svgElement("svg", {})[0].createSVGRect;
    $.fn.statChart = function(options) {
        if (svgSupported) {
            this.each(function() {
                var $this = $(this)
                var chart = $this.data("_chart")
                if (chart) {
                    $.extend(chart.opts, options)
                } else {
                    chart = new statChart($this, $.extend({}, {width: "100%", height: "200px"}, $this.data("chart"), options));
                    $this.data("_chart", chart);
                    var resizeTracker;
                    $(window).resize(function () {
                        if (resizeTracker) clearTimeout(resizeTracker);
                        resizeTracker = setTimeout(function () { 
                            chart.draw();
                        }, 100);
                    });
                }
                chart.draw();
            });
        }
        return this;
    };
    $.fn.statChartDraw = function(options) {
        this.each(function() {
            var chart = $(this).data("_chart");
            if (chart) {
                chart.draw();
            }
        });
    };

    var statChart = function($el, opts) {
        this.$el = $el;
        this.opts = opts;
        opts.data.unshift(0);
        opts.data.push(0);
    };
    statChart.prototype.draw = function() {
        var getAnchors = function(p1x,p1y,p2x,p2y,p3x,p3y){var l1=(p2x-p1x)/2,l2=(p3x-p2x)/2,a=Math.atan((p2x-p1x)/Math.abs(p2y-p1y)),b=Math.atan((p3x-p2x)/Math.abs(p2y-p3y));a=p1y<p2y?Math.PI-a:a;b=p3y<p2y?Math.PI-b:b;var alpha=Math.PI/2-((a+b)%(Math.PI*2))/2,dx1=l1*Math.sin(alpha+a),dy1=l1*Math.cos(alpha+a),dx2=l2*Math.sin(alpha+b),dy2=l2*Math.cos(alpha+b);return{x1:p2x-dx1,y1:p2y+dy1,x2:p2x+dx2,y2:p2y+dy2};};
        if (!this.$svg) {
            this.$el.empty().append(
                this.$svg = svgElement("svg", {width: this.opts.width, height: this.opts.height})
            );
        }
        this.$svg.empty().attr({height: this.opts.height, width: this.opts.width});
        
        var values = this.opts.data, width = this.$svg.width(), height = this.$svg.height(), path, 
        max = Math.max.apply(Math, values), X = width / (values.length - 1), Y = (height - 10)/max, left = -(X*.5);

        for (var i = 0; i < values.length; i++) {
            var y = Math.round(height-Y*values[i]), x = Math.round(left+X*(i+.5));
            if (!i) {
                path = ["M",left+X*.5,height,"L",x,y,"C",x,y];
            }
            if (i && i<values.length-1) {
                var Y0=Math.round(height-Y*values[i-1]), X0=Math.round(left+X*(i-.5)),
                    Y2=Math.round(height-Y*values[i+1]),X2=Math.round(left+X*(i+1.5));
                var a = getAnchors(X0,Y0,x,y,X2,Y2);
                path = path.concat([a.x1,a.y1,x,y,a.x2,a.y2]);
            }
        }
        path = path.concat([x,y,x,y,"L",x,height,"z"]);
        this.$svg.append(svgElement("path", {
            fill: this.opts.fill, stroke: "none", d: path.join(',').replace(/,?([achlmqrstvxz]),?/gi,"$1")
        }));
    };
})(jQuery, document, Math);

$(function(){
    $(".chart-line").statChart({width: "100%", height: "204px"});
    var activ = false;
    $(".schedule a").hover(function(){
        var $this = $(this);
        $(".chart-line").removeClass("activ").addClass("no-activ");
        $("#"+$this.data("for")).removeClass("no-activ").addClass("activ");
    }, function() {
        if (activ !== false) {
            $(".chart-line").removeClass("activ").addClass("no-activ");
            $("#"+activ).removeClass("no-activ").addClass("activ");
        } else {
            $(".chart-line").removeClass("no-activ").removeClass("activ");
        }
    }).click(function(){
        var $this = $(this);
        $(".schedule a").removeClass("no-activ").removeClass("activ");
        if (activ == $this.data("for") && activ !== false) {
            activ = false;
        } else {
            $(".schedule a").addClass("no-activ");
            $this.removeClass("no-activ").addClass("activ");
            activ = $this.data("for");
        }
    });
    $(".visitor-statistics li[data-for]").click(function(){
        $(".chart-line").removeClass("no-activ").removeClass("activ");
        $(".schedule a").removeClass("no-activ").removeClass("activ");
        $(".visitor-statistics .schedule").hide();
        $("#"+$(this).data("for")).show();
        $(".chart-line").statChartDraw();
    });
});