(function($, document, Math, undefined) {
    var svgElement = function(tag, attrs, append=[]) {
        var elem = $(document.createElementNS("http://www.w3.org/2000/svg", tag)).attr(attrs);
        $.each(append, function(index, el) {
            elem.append(el);
        });
        return elem;
    };
    var svgSupported = "createElementNS" in document && svgElement("svg", {})[0].createSVGRect;
    $.fn.statChart = function(options) {
        if (svgSupported) {
            this.each(function() {
                var $this = $(this)
                var chart = $this.data("_chart")
                if (chart) {
                    $.extend(chart.opts, options)
                } else {
                    var data = $this.data("chart");
                    chart = new statChart($this, $.extend({}, {width: "100%", height: "200px"}, data, options));

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
    $.fn.statChartDraw = function(options = {}) {
        this.each(function() {
            var chart = $(this).data("_chart");
            if (chart) {
                chart.opts = $.extend(chart.opts, options);
                chart.draw();
            }
        });
    };

    var statChart = function($el, opts) {
        this.$el = $el;
        this.opts = opts;
        this.stroke = "#4d89f9";
        //for (var i=0; i < opts.data.length; i++) {
        //    opts.data.splice(i, 1);
        //}
        //opts.data.unshift(0);
        //opts.data.push(0);
    };
    statChart.prototype.draw = function() {
        var getAnchors = function(p1x,p1y,p2x,p2y,p3x,p3y){
            var l1=(p2x-p1x)/2,l2=(p3x-p2x)/2,a=Math.atan((p2x-p1x)/Math.abs(p2y-p1y)),b=Math.atan((p3x-p2x)/Math.abs(p2y-p3y));a=p1y<p2y?Math.PI-a:a;b=p3y<p2y?Math.PI-b:b;var alpha=Math.PI/2-((a+b)%(Math.PI*2))/2,dx1=l1*Math.sin(alpha+a),dy1=l1*Math.cos(alpha+a),dx2=l2*Math.sin(alpha+b),dy2=l2*Math.cos(alpha+b);return{x1:p2x-dx1,y1:p2y+dy1,x2:p2x+dx2,y2:p2y+dy2};
        };
        if (!this.$svg) {
            this.$el.empty().append(
                this.$svg = svgElement("svg", {width: this.opts.width, height: this.opts.height})
            );
        }
        this.$svg.empty().attr({height: this.opts.height, width: this.opts.width});

        if (!this.opts.data || this.opts.data.length == 0) {
            this.opts.data = [1,1,1,1,1,1,1];
        }

        for (var i=0; i < this.opts.data.length; i++) {
            this.opts.data[i]++;
            this.opts.data[i]*=2;
        }

        var strokeWidth = 3;
        var values = this.opts.data, width = this.$svg.width() + (strokeWidth * 2), height = this.$svg.height() + (strokeWidth/2), path,
        max = Math.max.apply(Math, values), X = width / (values.length - 1), Y = (height - 10)/max, left = -(X*.5) - strokeWidth;

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

        var gradient_id = "linear-gradient" + Math.random().toString(36).substr(2, 9);
        this.$svg.append(
            svgElement('linearGradient', {
                id: gradient_id,
                x1: "0", x2: "0", y1: "0", y2: "1",
            }, [
                svgElement('stop', {offset: "0%", "stop-color": this.opts.fill[0]}),
                svgElement('stop', {offset: "100%", "stop-color": this.opts.fill[1]})
            ])
        )
        //this.$svg.append(svgElement("path", {
        //    fill: this.opts.fill, stroke: "none", d: path.join(',').replace(/,?([achlmqrstvxz]),?/gi,"$1")
        //}));

        this.$svg.append(
          svgElement('path', {
            fill: 'none',
            d: path.join(',').replace(/,?([achlmqrstvxz]),?/gi,"$1"),
            //stroke: this.opts.fill,
            stroke: "url(#"+gradient_id+")",
            'stroke-width': strokeWidth,
            'stroke-linecap': 'square'
          })
        )


    };
})(jQuery, document, Math);

$.fn.serializeObject = function() {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

$(function() {
    $(document).ajaxStart(function(event) {
        $('.ax-loading').show();
    });
    $(document).ajaxStop(function(event) {
        $('.ax-loading').hide();
    });
});
