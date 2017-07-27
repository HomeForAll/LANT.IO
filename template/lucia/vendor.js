/*! jQuery UI - v1.12.1 - 2016-09-14
* http://jqueryui.com
* Includes: widget.js, position.js, data.js, disable-selection.js, effect.js, effects/effect-blind.js, effects/effect-bounce.js, effects/effect-clip.js, effects/effect-drop.js, effects/effect-explode.js, effects/effect-fade.js, effects/effect-fold.js, effects/effect-highlight.js, effects/effect-puff.js, effects/effect-pulsate.js, effects/effect-scale.js, effects/effect-shake.js, effects/effect-size.js, effects/effect-slide.js, effects/effect-transfer.js, focusable.js, form-reset-mixin.js, jquery-1-7.js, keycode.js, labels.js, scroll-parent.js, tabbable.js, unique-id.js, widgets/accordion.js, widgets/autocomplete.js, widgets/button.js, widgets/checkboxradio.js, widgets/controlgroup.js, widgets/datepicker.js, widgets/dialog.js, widgets/draggable.js, widgets/droppable.js, widgets/menu.js, widgets/mouse.js, widgets/progressbar.js, widgets/resizable.js, widgets/selectable.js, widgets/selectmenu.js, widgets/slider.js, widgets/sortable.js, widgets/spinner.js, widgets/tabs.js, widgets/tooltip.js
* Copyright jQuery Foundation and other contributors; Licensed MIT */

(function(t){"function"==typeof define&&define.amd?define(["jquery"],t):t(jQuery)})(function(t){function e(t){for(var e=t.css("visibility");"inherit"===e;)t=t.parent(),e=t.css("visibility");return"hidden"!==e}function i(t){for(var e,i;t.length&&t[0]!==document;){if(e=t.css("position"),("absolute"===e||"relative"===e||"fixed"===e)&&(i=parseInt(t.css("zIndex"),10),!isNaN(i)&&0!==i))return i;t=t.parent()}return 0}function s(){this._curInst=null,this._keyEvent=!1,this._disabledInputs=[],this._datepickerShowing=!1,this._inDialog=!1,this._mainDivId="ui-datepicker-div",this._inlineClass="ui-datepicker-inline",this._appendClass="ui-datepicker-append",this._triggerClass="ui-datepicker-trigger",this._dialogClass="ui-datepicker-dialog",this._disableClass="ui-datepicker-disabled",this._unselectableClass="ui-datepicker-unselectable",this._currentClass="ui-datepicker-current-day",this._dayOverClass="ui-datepicker-days-cell-over",this.regional=[],this.regional[""]={closeText:"Done",prevText:"Prev",nextText:"Next",currentText:"Today",monthNames:["January","February","March","April","May","June","July","August","September","October","November","December"],monthNamesShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],dayNames:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],dayNamesShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],dayNamesMin:["Su","Mo","Tu","We","Th","Fr","Sa"],weekHeader:"Wk",dateFormat:"mm/dd/yy",firstDay:0,isRTL:!1,showMonthAfterYear:!1,yearSuffix:""},this._defaults={showOn:"focus",showAnim:"fadeIn",showOptions:{},defaultDate:null,appendText:"",buttonText:"...",buttonImage:"",buttonImageOnly:!1,hideIfNoPrevNext:!1,navigationAsDateFormat:!1,gotoCurrent:!1,changeMonth:!1,changeYear:!1,yearRange:"c-10:c+10",showOtherMonths:!1,selectOtherMonths:!1,showWeek:!1,calculateWeek:this.iso8601Week,shortYearCutoff:"+10",minDate:null,maxDate:null,duration:"fast",beforeShowDay:null,beforeShow:null,onSelect:null,onChangeMonthYear:null,onClose:null,numberOfMonths:1,showCurrentAtPos:0,stepMonths:1,stepBigMonths:12,altField:"",altFormat:"",constrainInput:!0,showButtonPanel:!1,autoSize:!1,disabled:!1},t.extend(this._defaults,this.regional[""]),this.regional.en=t.extend(!0,{},this.regional[""]),this.regional["en-US"]=t.extend(!0,{},this.regional.en),this.dpDiv=n(t("<div id='"+this._mainDivId+"' class='ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>"))}function n(e){var i="button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a";return e.on("mouseout",i,function(){t(this).removeClass("ui-state-hover"),-1!==this.className.indexOf("ui-datepicker-prev")&&t(this).removeClass("ui-datepicker-prev-hover"),-1!==this.className.indexOf("ui-datepicker-next")&&t(this).removeClass("ui-datepicker-next-hover")}).on("mouseover",i,o)}function o(){t.datepicker._isDisabledDatepicker(m.inline?m.dpDiv.parent()[0]:m.input[0])||(t(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover"),t(this).addClass("ui-state-hover"),-1!==this.className.indexOf("ui-datepicker-prev")&&t(this).addClass("ui-datepicker-prev-hover"),-1!==this.className.indexOf("ui-datepicker-next")&&t(this).addClass("ui-datepicker-next-hover"))}function a(e,i){t.extend(e,i);for(var s in i)null==i[s]&&(e[s]=i[s]);return e}function r(t){return function(){var e=this.element.val();t.apply(this,arguments),this._refresh(),e!==this.element.val()&&this._trigger("change")}}t.ui=t.ui||{},t.ui.version="1.12.1";var h=0,l=Array.prototype.slice;t.cleanData=function(e){return function(i){var s,n,o;for(o=0;null!=(n=i[o]);o++)try{s=t._data(n,"events"),s&&s.remove&&t(n).triggerHandler("remove")}catch(a){}e(i)}}(t.cleanData),t.widget=function(e,i,s){var n,o,a,r={},h=e.split(".")[0];e=e.split(".")[1];var l=h+"-"+e;return s||(s=i,i=t.Widget),t.isArray(s)&&(s=t.extend.apply(null,[{}].concat(s))),t.expr[":"][l.toLowerCase()]=function(e){return!!t.data(e,l)},t[h]=t[h]||{},n=t[h][e],o=t[h][e]=function(t,e){return this._createWidget?(arguments.length&&this._createWidget(t,e),void 0):new o(t,e)},t.extend(o,n,{version:s.version,_proto:t.extend({},s),_childConstructors:[]}),a=new i,a.options=t.widget.extend({},a.options),t.each(s,function(e,s){return t.isFunction(s)?(r[e]=function(){function t(){return i.prototype[e].apply(this,arguments)}function n(t){return i.prototype[e].apply(this,t)}return function(){var e,i=this._super,o=this._superApply;return this._super=t,this._superApply=n,e=s.apply(this,arguments),this._super=i,this._superApply=o,e}}(),void 0):(r[e]=s,void 0)}),o.prototype=t.widget.extend(a,{widgetEventPrefix:n?a.widgetEventPrefix||e:e},r,{constructor:o,namespace:h,widgetName:e,widgetFullName:l}),n?(t.each(n._childConstructors,function(e,i){var s=i.prototype;t.widget(s.namespace+"."+s.widgetName,o,i._proto)}),delete n._childConstructors):i._childConstructors.push(o),t.widget.bridge(e,o),o},t.widget.extend=function(e){for(var i,s,n=l.call(arguments,1),o=0,a=n.length;a>o;o++)for(i in n[o])s=n[o][i],n[o].hasOwnProperty(i)&&void 0!==s&&(e[i]=t.isPlainObject(s)?t.isPlainObject(e[i])?t.widget.extend({},e[i],s):t.widget.extend({},s):s);return e},t.widget.bridge=function(e,i){var s=i.prototype.widgetFullName||e;t.fn[e]=function(n){var o="string"==typeof n,a=l.call(arguments,1),r=this;return o?this.length||"instance"!==n?this.each(function(){var i,o=t.data(this,s);return"instance"===n?(r=o,!1):o?t.isFunction(o[n])&&"_"!==n.charAt(0)?(i=o[n].apply(o,a),i!==o&&void 0!==i?(r=i&&i.jquery?r.pushStack(i.get()):i,!1):void 0):t.error("no such method '"+n+"' for "+e+" widget instance"):t.error("cannot call methods on "+e+" prior to initialization; "+"attempted to call method '"+n+"'")}):r=void 0:(a.length&&(n=t.widget.extend.apply(null,[n].concat(a))),this.each(function(){var e=t.data(this,s);e?(e.option(n||{}),e._init&&e._init()):t.data(this,s,new i(n,this))})),r}},t.Widget=function(){},t.Widget._childConstructors=[],t.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",defaultElement:"<div>",options:{classes:{},disabled:!1,create:null},_createWidget:function(e,i){i=t(i||this.defaultElement||this)[0],this.element=t(i),this.uuid=h++,this.eventNamespace="."+this.widgetName+this.uuid,this.bindings=t(),this.hoverable=t(),this.focusable=t(),this.classesElementLookup={},i!==this&&(t.data(i,this.widgetFullName,this),this._on(!0,this.element,{remove:function(t){t.target===i&&this.destroy()}}),this.document=t(i.style?i.ownerDocument:i.document||i),this.window=t(this.document[0].defaultView||this.document[0].parentWindow)),this.options=t.widget.extend({},this.options,this._getCreateOptions(),e),this._create(),this.options.disabled&&this._setOptionDisabled(this.options.disabled),this._trigger("create",null,this._getCreateEventData()),this._init()},_getCreateOptions:function(){return{}},_getCreateEventData:t.noop,_create:t.noop,_init:t.noop,destroy:function(){var e=this;this._destroy(),t.each(this.classesElementLookup,function(t,i){e._removeClass(i,t)}),this.element.off(this.eventNamespace).removeData(this.widgetFullName),this.widget().off(this.eventNamespace).removeAttr("aria-disabled"),this.bindings.off(this.eventNamespace)},_destroy:t.noop,widget:function(){return this.element},option:function(e,i){var s,n,o,a=e;if(0===arguments.length)return t.widget.extend({},this.options);if("string"==typeof e)if(a={},s=e.split("."),e=s.shift(),s.length){for(n=a[e]=t.widget.extend({},this.options[e]),o=0;s.length-1>o;o++)n[s[o]]=n[s[o]]||{},n=n[s[o]];if(e=s.pop(),1===arguments.length)return void 0===n[e]?null:n[e];n[e]=i}else{if(1===arguments.length)return void 0===this.options[e]?null:this.options[e];a[e]=i}return this._setOptions(a),this},_setOptions:function(t){var e;for(e in t)this._setOption(e,t[e]);return this},_setOption:function(t,e){return"classes"===t&&this._setOptionClasses(e),this.options[t]=e,"disabled"===t&&this._setOptionDisabled(e),this},_setOptionClasses:function(e){var i,s,n;for(i in e)n=this.classesElementLookup[i],e[i]!==this.options.classes[i]&&n&&n.length&&(s=t(n.get()),this._removeClass(n,i),s.addClass(this._classes({element:s,keys:i,classes:e,add:!0})))},_setOptionDisabled:function(t){this._toggleClass(this.widget(),this.widgetFullName+"-disabled",null,!!t),t&&(this._removeClass(this.hoverable,null,"ui-state-hover"),this._removeClass(this.focusable,null,"ui-state-focus"))},enable:function(){return this._setOptions({disabled:!1})},disable:function(){return this._setOptions({disabled:!0})},_classes:function(e){function i(i,o){var a,r;for(r=0;i.length>r;r++)a=n.classesElementLookup[i[r]]||t(),a=e.add?t(t.unique(a.get().concat(e.element.get()))):t(a.not(e.element).get()),n.classesElementLookup[i[r]]=a,s.push(i[r]),o&&e.classes[i[r]]&&s.push(e.classes[i[r]])}var s=[],n=this;return e=t.extend({element:this.element,classes:this.options.classes||{}},e),this._on(e.element,{remove:"_untrackClassesElement"}),e.keys&&i(e.keys.match(/\S+/g)||[],!0),e.extra&&i(e.extra.match(/\S+/g)||[]),s.join(" ")},_untrackClassesElement:function(e){var i=this;t.each(i.classesElementLookup,function(s,n){-1!==t.inArray(e.target,n)&&(i.classesElementLookup[s]=t(n.not(e.target).get()))})},_removeClass:function(t,e,i){return this._toggleClass(t,e,i,!1)},_addClass:function(t,e,i){return this._toggleClass(t,e,i,!0)},_toggleClass:function(t,e,i,s){s="boolean"==typeof s?s:i;var n="string"==typeof t||null===t,o={extra:n?e:i,keys:n?t:e,element:n?this.element:t,add:s};return o.element.toggleClass(this._classes(o),s),this},_on:function(e,i,s){var n,o=this;"boolean"!=typeof e&&(s=i,i=e,e=!1),s?(i=n=t(i),this.bindings=this.bindings.add(i)):(s=i,i=this.element,n=this.widget()),t.each(s,function(s,a){function r(){return e||o.options.disabled!==!0&&!t(this).hasClass("ui-state-disabled")?("string"==typeof a?o[a]:a).apply(o,arguments):void 0}"string"!=typeof a&&(r.guid=a.guid=a.guid||r.guid||t.guid++);var h=s.match(/^([\w:-]*)\s*(.*)$/),l=h[1]+o.eventNamespace,c=h[2];c?n.on(l,c,r):i.on(l,r)})},_off:function(e,i){i=(i||"").split(" ").join(this.eventNamespace+" ")+this.eventNamespace,e.off(i).off(i),this.bindings=t(this.bindings.not(e).get()),this.focusable=t(this.focusable.not(e).get()),this.hoverable=t(this.hoverable.not(e).get())},_delay:function(t,e){function i(){return("string"==typeof t?s[t]:t).apply(s,arguments)}var s=this;return setTimeout(i,e||0)},_hoverable:function(e){this.hoverable=this.hoverable.add(e),this._on(e,{mouseenter:function(e){this._addClass(t(e.currentTarget),null,"ui-state-hover")},mouseleave:function(e){this._removeClass(t(e.currentTarget),null,"ui-state-hover")}})},_focusable:function(e){this.focusable=this.focusable.add(e),this._on(e,{focusin:function(e){this._addClass(t(e.currentTarget),null,"ui-state-focus")},focusout:function(e){this._removeClass(t(e.currentTarget),null,"ui-state-focus")}})},_trigger:function(e,i,s){var n,o,a=this.options[e];if(s=s||{},i=t.Event(i),i.type=(e===this.widgetEventPrefix?e:this.widgetEventPrefix+e).toLowerCase(),i.target=this.element[0],o=i.originalEvent)for(n in o)n in i||(i[n]=o[n]);return this.element.trigger(i,s),!(t.isFunction(a)&&a.apply(this.element[0],[i].concat(s))===!1||i.isDefaultPrevented())}},t.each({show:"fadeIn",hide:"fadeOut"},function(e,i){t.Widget.prototype["_"+e]=function(s,n,o){"string"==typeof n&&(n={effect:n});var a,r=n?n===!0||"number"==typeof n?i:n.effect||i:e;n=n||{},"number"==typeof n&&(n={duration:n}),a=!t.isEmptyObject(n),n.complete=o,n.delay&&s.delay(n.delay),a&&t.effects&&t.effects.effect[r]?s[e](n):r!==e&&s[r]?s[r](n.duration,n.easing,o):s.queue(function(i){t(this)[e](),o&&o.call(s[0]),i()})}}),t.widget,function(){function e(t,e,i){return[parseFloat(t[0])*(u.test(t[0])?e/100:1),parseFloat(t[1])*(u.test(t[1])?i/100:1)]}function i(e,i){return parseInt(t.css(e,i),10)||0}function s(e){var i=e[0];return 9===i.nodeType?{width:e.width(),height:e.height(),offset:{top:0,left:0}}:t.isWindow(i)?{width:e.width(),height:e.height(),offset:{top:e.scrollTop(),left:e.scrollLeft()}}:i.preventDefault?{width:0,height:0,offset:{top:i.pageY,left:i.pageX}}:{width:e.outerWidth(),height:e.outerHeight(),offset:e.offset()}}var n,o=Math.max,a=Math.abs,r=/left|center|right/,h=/top|center|bottom/,l=/[\+\-]\d+(\.[\d]+)?%?/,c=/^\w+/,u=/%$/,d=t.fn.position;t.position={scrollbarWidth:function(){if(void 0!==n)return n;var e,i,s=t("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"),o=s.children()[0];return t("body").append(s),e=o.offsetWidth,s.css("overflow","scroll"),i=o.offsetWidth,e===i&&(i=s[0].clientWidth),s.remove(),n=e-i},getScrollInfo:function(e){var i=e.isWindow||e.isDocument?"":e.element.css("overflow-x"),s=e.isWindow||e.isDocument?"":e.element.css("overflow-y"),n="scroll"===i||"auto"===i&&e.width<e.element[0].scrollWidth,o="scroll"===s||"auto"===s&&e.height<e.element[0].scrollHeight;return{width:o?t.position.scrollbarWidth():0,height:n?t.position.scrollbarWidth():0}},getWithinInfo:function(e){var i=t(e||window),s=t.isWindow(i[0]),n=!!i[0]&&9===i[0].nodeType,o=!s&&!n;return{element:i,isWindow:s,isDocument:n,offset:o?t(e).offset():{left:0,top:0},scrollLeft:i.scrollLeft(),scrollTop:i.scrollTop(),width:i.outerWidth(),height:i.outerHeight()}}},t.fn.position=function(n){if(!n||!n.of)return d.apply(this,arguments);n=t.extend({},n);var u,p,f,g,m,_,v=t(n.of),b=t.position.getWithinInfo(n.within),y=t.position.getScrollInfo(b),w=(n.collision||"flip").split(" "),k={};return _=s(v),v[0].preventDefault&&(n.at="left top"),p=_.width,f=_.height,g=_.offset,m=t.extend({},g),t.each(["my","at"],function(){var t,e,i=(n[this]||"").split(" ");1===i.length&&(i=r.test(i[0])?i.concat(["center"]):h.test(i[0])?["center"].concat(i):["center","center"]),i[0]=r.test(i[0])?i[0]:"center",i[1]=h.test(i[1])?i[1]:"center",t=l.exec(i[0]),e=l.exec(i[1]),k[this]=[t?t[0]:0,e?e[0]:0],n[this]=[c.exec(i[0])[0],c.exec(i[1])[0]]}),1===w.length&&(w[1]=w[0]),"right"===n.at[0]?m.left+=p:"center"===n.at[0]&&(m.left+=p/2),"bottom"===n.at[1]?m.top+=f:"center"===n.at[1]&&(m.top+=f/2),u=e(k.at,p,f),m.left+=u[0],m.top+=u[1],this.each(function(){var s,r,h=t(this),l=h.outerWidth(),c=h.outerHeight(),d=i(this,"marginLeft"),_=i(this,"marginTop"),x=l+d+i(this,"marginRight")+y.width,C=c+_+i(this,"marginBottom")+y.height,D=t.extend({},m),I=e(k.my,h.outerWidth(),h.outerHeight());"right"===n.my[0]?D.left-=l:"center"===n.my[0]&&(D.left-=l/2),"bottom"===n.my[1]?D.top-=c:"center"===n.my[1]&&(D.top-=c/2),D.left+=I[0],D.top+=I[1],s={marginLeft:d,marginTop:_},t.each(["left","top"],function(e,i){t.ui.position[w[e]]&&t.ui.position[w[e]][i](D,{targetWidth:p,targetHeight:f,elemWidth:l,elemHeight:c,collisionPosition:s,collisionWidth:x,collisionHeight:C,offset:[u[0]+I[0],u[1]+I[1]],my:n.my,at:n.at,within:b,elem:h})}),n.using&&(r=function(t){var e=g.left-D.left,i=e+p-l,s=g.top-D.top,r=s+f-c,u={target:{element:v,left:g.left,top:g.top,width:p,height:f},element:{element:h,left:D.left,top:D.top,width:l,height:c},horizontal:0>i?"left":e>0?"right":"center",vertical:0>r?"top":s>0?"bottom":"middle"};l>p&&p>a(e+i)&&(u.horizontal="center"),c>f&&f>a(s+r)&&(u.vertical="middle"),u.important=o(a(e),a(i))>o(a(s),a(r))?"horizontal":"vertical",n.using.call(this,t,u)}),h.offset(t.extend(D,{using:r}))})},t.ui.position={fit:{left:function(t,e){var i,s=e.within,n=s.isWindow?s.scrollLeft:s.offset.left,a=s.width,r=t.left-e.collisionPosition.marginLeft,h=n-r,l=r+e.collisionWidth-a-n;e.collisionWidth>a?h>0&&0>=l?(i=t.left+h+e.collisionWidth-a-n,t.left+=h-i):t.left=l>0&&0>=h?n:h>l?n+a-e.collisionWidth:n:h>0?t.left+=h:l>0?t.left-=l:t.left=o(t.left-r,t.left)},top:function(t,e){var i,s=e.within,n=s.isWindow?s.scrollTop:s.offset.top,a=e.within.height,r=t.top-e.collisionPosition.marginTop,h=n-r,l=r+e.collisionHeight-a-n;e.collisionHeight>a?h>0&&0>=l?(i=t.top+h+e.collisionHeight-a-n,t.top+=h-i):t.top=l>0&&0>=h?n:h>l?n+a-e.collisionHeight:n:h>0?t.top+=h:l>0?t.top-=l:t.top=o(t.top-r,t.top)}},flip:{left:function(t,e){var i,s,n=e.within,o=n.offset.left+n.scrollLeft,r=n.width,h=n.isWindow?n.scrollLeft:n.offset.left,l=t.left-e.collisionPosition.marginLeft,c=l-h,u=l+e.collisionWidth-r-h,d="left"===e.my[0]?-e.elemWidth:"right"===e.my[0]?e.elemWidth:0,p="left"===e.at[0]?e.targetWidth:"right"===e.at[0]?-e.targetWidth:0,f=-2*e.offset[0];0>c?(i=t.left+d+p+f+e.collisionWidth-r-o,(0>i||a(c)>i)&&(t.left+=d+p+f)):u>0&&(s=t.left-e.collisionPosition.marginLeft+d+p+f-h,(s>0||u>a(s))&&(t.left+=d+p+f))},top:function(t,e){var i,s,n=e.within,o=n.offset.top+n.scrollTop,r=n.height,h=n.isWindow?n.scrollTop:n.offset.top,l=t.top-e.collisionPosition.marginTop,c=l-h,u=l+e.collisionHeight-r-h,d="top"===e.my[1],p=d?-e.elemHeight:"bottom"===e.my[1]?e.elemHeight:0,f="top"===e.at[1]?e.targetHeight:"bottom"===e.at[1]?-e.targetHeight:0,g=-2*e.offset[1];0>c?(s=t.top+p+f+g+e.collisionHeight-r-o,(0>s||a(c)>s)&&(t.top+=p+f+g)):u>0&&(i=t.top-e.collisionPosition.marginTop+p+f+g-h,(i>0||u>a(i))&&(t.top+=p+f+g))}},flipfit:{left:function(){t.ui.position.flip.left.apply(this,arguments),t.ui.position.fit.left.apply(this,arguments)},top:function(){t.ui.position.flip.top.apply(this,arguments),t.ui.position.fit.top.apply(this,arguments)}}}}(),t.ui.position,t.extend(t.expr[":"],{data:t.expr.createPseudo?t.expr.createPseudo(function(e){return function(i){return!!t.data(i,e)}}):function(e,i,s){return!!t.data(e,s[3])}}),t.fn.extend({disableSelection:function(){var t="onselectstart"in document.createElement("div")?"selectstart":"mousedown";return function(){return this.on(t+".ui-disableSelection",function(t){t.preventDefault()})}}(),enableSelection:function(){return this.off(".ui-disableSelection")}});var c="ui-effects-",u="ui-effects-style",d="ui-effects-animated",p=t;t.effects={effect:{}},function(t,e){function i(t,e,i){var s=u[e.type]||{};return null==t?i||!e.def?null:e.def:(t=s.floor?~~t:parseFloat(t),isNaN(t)?e.def:s.mod?(t+s.mod)%s.mod:0>t?0:t>s.max?s.max:t)}function s(i){var s=l(),n=s._rgba=[];return i=i.toLowerCase(),f(h,function(t,o){var a,r=o.re.exec(i),h=r&&o.parse(r),l=o.space||"rgba";return h?(a=s[l](h),s[c[l].cache]=a[c[l].cache],n=s._rgba=a._rgba,!1):e}),n.length?("0,0,0,0"===n.join()&&t.extend(n,o.transparent),s):o[i]}function n(t,e,i){return i=(i+1)%1,1>6*i?t+6*(e-t)*i:1>2*i?e:2>3*i?t+6*(e-t)*(2/3-i):t}var o,a="backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor",r=/^([\-+])=\s*(\d+\.?\d*)/,h=[{re:/rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,parse:function(t){return[t[1],t[2],t[3],t[4]]}},{re:/rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,parse:function(t){return[2.55*t[1],2.55*t[2],2.55*t[3],t[4]]}},{re:/#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,parse:function(t){return[parseInt(t[1],16),parseInt(t[2],16),parseInt(t[3],16)]}},{re:/#([a-f0-9])([a-f0-9])([a-f0-9])/,parse:function(t){return[parseInt(t[1]+t[1],16),parseInt(t[2]+t[2],16),parseInt(t[3]+t[3],16)]}},{re:/hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,space:"hsla",parse:function(t){return[t[1],t[2]/100,t[3]/100,t[4]]}}],l=t.Color=function(e,i,s,n){return new t.Color.fn.parse(e,i,s,n)},c={rgba:{props:{red:{idx:0,type:"byte"},green:{idx:1,type:"byte"},blue:{idx:2,type:"byte"}}},hsla:{props:{hue:{idx:0,type:"degrees"},saturation:{idx:1,type:"percent"},lightness:{idx:2,type:"percent"}}}},u={"byte":{floor:!0,max:255},percent:{max:1},degrees:{mod:360,floor:!0}},d=l.support={},p=t("<p>")[0],f=t.each;p.style.cssText="background-color:rgba(1,1,1,.5)",d.rgba=p.style.backgroundColor.indexOf("rgba")>-1,f(c,function(t,e){e.cache="_"+t,e.props.alpha={idx:3,type:"percent",def:1}}),l.fn=t.extend(l.prototype,{parse:function(n,a,r,h){if(n===e)return this._rgba=[null,null,null,null],this;(n.jquery||n.nodeType)&&(n=t(n).css(a),a=e);var u=this,d=t.type(n),p=this._rgba=[];return a!==e&&(n=[n,a,r,h],d="array"),"string"===d?this.parse(s(n)||o._default):"array"===d?(f(c.rgba.props,function(t,e){p[e.idx]=i(n[e.idx],e)}),this):"object"===d?(n instanceof l?f(c,function(t,e){n[e.cache]&&(u[e.cache]=n[e.cache].slice())}):f(c,function(e,s){var o=s.cache;f(s.props,function(t,e){if(!u[o]&&s.to){if("alpha"===t||null==n[t])return;u[o]=s.to(u._rgba)}u[o][e.idx]=i(n[t],e,!0)}),u[o]&&0>t.inArray(null,u[o].slice(0,3))&&(u[o][3]=1,s.from&&(u._rgba=s.from(u[o])))}),this):e},is:function(t){var i=l(t),s=!0,n=this;return f(c,function(t,o){var a,r=i[o.cache];return r&&(a=n[o.cache]||o.to&&o.to(n._rgba)||[],f(o.props,function(t,i){return null!=r[i.idx]?s=r[i.idx]===a[i.idx]:e})),s}),s},_space:function(){var t=[],e=this;return f(c,function(i,s){e[s.cache]&&t.push(i)}),t.pop()},transition:function(t,e){var s=l(t),n=s._space(),o=c[n],a=0===this.alpha()?l("transparent"):this,r=a[o.cache]||o.to(a._rgba),h=r.slice();return s=s[o.cache],f(o.props,function(t,n){var o=n.idx,a=r[o],l=s[o],c=u[n.type]||{};null!==l&&(null===a?h[o]=l:(c.mod&&(l-a>c.mod/2?a+=c.mod:a-l>c.mod/2&&(a-=c.mod)),h[o]=i((l-a)*e+a,n)))}),this[n](h)},blend:function(e){if(1===this._rgba[3])return this;var i=this._rgba.slice(),s=i.pop(),n=l(e)._rgba;return l(t.map(i,function(t,e){return(1-s)*n[e]+s*t}))},toRgbaString:function(){var e="rgba(",i=t.map(this._rgba,function(t,e){return null==t?e>2?1:0:t});return 1===i[3]&&(i.pop(),e="rgb("),e+i.join()+")"},toHslaString:function(){var e="hsla(",i=t.map(this.hsla(),function(t,e){return null==t&&(t=e>2?1:0),e&&3>e&&(t=Math.round(100*t)+"%"),t});return 1===i[3]&&(i.pop(),e="hsl("),e+i.join()+")"},toHexString:function(e){var i=this._rgba.slice(),s=i.pop();return e&&i.push(~~(255*s)),"#"+t.map(i,function(t){return t=(t||0).toString(16),1===t.length?"0"+t:t}).join("")},toString:function(){return 0===this._rgba[3]?"transparent":this.toRgbaString()}}),l.fn.parse.prototype=l.fn,c.hsla.to=function(t){if(null==t[0]||null==t[1]||null==t[2])return[null,null,null,t[3]];var e,i,s=t[0]/255,n=t[1]/255,o=t[2]/255,a=t[3],r=Math.max(s,n,o),h=Math.min(s,n,o),l=r-h,c=r+h,u=.5*c;return e=h===r?0:s===r?60*(n-o)/l+360:n===r?60*(o-s)/l+120:60*(s-n)/l+240,i=0===l?0:.5>=u?l/c:l/(2-c),[Math.round(e)%360,i,u,null==a?1:a]},c.hsla.from=function(t){if(null==t[0]||null==t[1]||null==t[2])return[null,null,null,t[3]];var e=t[0]/360,i=t[1],s=t[2],o=t[3],a=.5>=s?s*(1+i):s+i-s*i,r=2*s-a;return[Math.round(255*n(r,a,e+1/3)),Math.round(255*n(r,a,e)),Math.round(255*n(r,a,e-1/3)),o]},f(c,function(s,n){var o=n.props,a=n.cache,h=n.to,c=n.from;l.fn[s]=function(s){if(h&&!this[a]&&(this[a]=h(this._rgba)),s===e)return this[a].slice();var n,r=t.type(s),u="array"===r||"object"===r?s:arguments,d=this[a].slice();return f(o,function(t,e){var s=u["object"===r?t:e.idx];null==s&&(s=d[e.idx]),d[e.idx]=i(s,e)}),c?(n=l(c(d)),n[a]=d,n):l(d)},f(o,function(e,i){l.fn[e]||(l.fn[e]=function(n){var o,a=t.type(n),h="alpha"===e?this._hsla?"hsla":"rgba":s,l=this[h](),c=l[i.idx];return"undefined"===a?c:("function"===a&&(n=n.call(this,c),a=t.type(n)),null==n&&i.empty?this:("string"===a&&(o=r.exec(n),o&&(n=c+parseFloat(o[2])*("+"===o[1]?1:-1))),l[i.idx]=n,this[h](l)))})})}),l.hook=function(e){var i=e.split(" ");f(i,function(e,i){t.cssHooks[i]={set:function(e,n){var o,a,r="";if("transparent"!==n&&("string"!==t.type(n)||(o=s(n)))){if(n=l(o||n),!d.rgba&&1!==n._rgba[3]){for(a="backgroundColor"===i?e.parentNode:e;(""===r||"transparent"===r)&&a&&a.style;)try{r=t.css(a,"backgroundColor"),a=a.parentNode}catch(h){}n=n.blend(r&&"transparent"!==r?r:"_default")}n=n.toRgbaString()}try{e.style[i]=n}catch(h){}}},t.fx.step[i]=function(e){e.colorInit||(e.start=l(e.elem,i),e.end=l(e.end),e.colorInit=!0),t.cssHooks[i].set(e.elem,e.start.transition(e.end,e.pos))}})},l.hook(a),t.cssHooks.borderColor={expand:function(t){var e={};return f(["Top","Right","Bottom","Left"],function(i,s){e["border"+s+"Color"]=t}),e}},o=t.Color.names={aqua:"#00ffff",black:"#000000",blue:"#0000ff",fuchsia:"#ff00ff",gray:"#808080",green:"#008000",lime:"#00ff00",maroon:"#800000",navy:"#000080",olive:"#808000",purple:"#800080",red:"#ff0000",silver:"#c0c0c0",teal:"#008080",white:"#ffffff",yellow:"#ffff00",transparent:[null,null,null,0],_default:"#ffffff"}}(p),function(){function e(e){var i,s,n=e.ownerDocument.defaultView?e.ownerDocument.defaultView.getComputedStyle(e,null):e.currentStyle,o={};if(n&&n.length&&n[0]&&n[n[0]])for(s=n.length;s--;)i=n[s],"string"==typeof n[i]&&(o[t.camelCase(i)]=n[i]);else for(i in n)"string"==typeof n[i]&&(o[i]=n[i]);return o}function i(e,i){var s,o,a={};for(s in i)o=i[s],e[s]!==o&&(n[s]||(t.fx.step[s]||!isNaN(parseFloat(o)))&&(a[s]=o));return a}var s=["add","remove","toggle"],n={border:1,borderBottom:1,borderColor:1,borderLeft:1,borderRight:1,borderTop:1,borderWidth:1,margin:1,padding:1};t.each(["borderLeftStyle","borderRightStyle","borderBottomStyle","borderTopStyle"],function(e,i){t.fx.step[i]=function(t){("none"!==t.end&&!t.setAttr||1===t.pos&&!t.setAttr)&&(p.style(t.elem,i,t.end),t.setAttr=!0)}}),t.fn.addBack||(t.fn.addBack=function(t){return this.add(null==t?this.prevObject:this.prevObject.filter(t))}),t.effects.animateClass=function(n,o,a,r){var h=t.speed(o,a,r);return this.queue(function(){var o,a=t(this),r=a.attr("class")||"",l=h.children?a.find("*").addBack():a;l=l.map(function(){var i=t(this);return{el:i,start:e(this)}}),o=function(){t.each(s,function(t,e){n[e]&&a[e+"Class"](n[e])})},o(),l=l.map(function(){return this.end=e(this.el[0]),this.diff=i(this.start,this.end),this}),a.attr("class",r),l=l.map(function(){var e=this,i=t.Deferred(),s=t.extend({},h,{queue:!1,complete:function(){i.resolve(e)}});return this.el.animate(this.diff,s),i.promise()}),t.when.apply(t,l.get()).done(function(){o(),t.each(arguments,function(){var e=this.el;t.each(this.diff,function(t){e.css(t,"")})}),h.complete.call(a[0])})})},t.fn.extend({addClass:function(e){return function(i,s,n,o){return s?t.effects.animateClass.call(this,{add:i},s,n,o):e.apply(this,arguments)}}(t.fn.addClass),removeClass:function(e){return function(i,s,n,o){return arguments.length>1?t.effects.animateClass.call(this,{remove:i},s,n,o):e.apply(this,arguments)}}(t.fn.removeClass),toggleClass:function(e){return function(i,s,n,o,a){return"boolean"==typeof s||void 0===s?n?t.effects.animateClass.call(this,s?{add:i}:{remove:i},n,o,a):e.apply(this,arguments):t.effects.animateClass.call(this,{toggle:i},s,n,o)}}(t.fn.toggleClass),switchClass:function(e,i,s,n,o){return t.effects.animateClass.call(this,{add:i,remove:e},s,n,o)}})}(),function(){function e(e,i,s,n){return t.isPlainObject(e)&&(i=e,e=e.effect),e={effect:e},null==i&&(i={}),t.isFunction(i)&&(n=i,s=null,i={}),("number"==typeof i||t.fx.speeds[i])&&(n=s,s=i,i={}),t.isFunction(s)&&(n=s,s=null),i&&t.extend(e,i),s=s||i.duration,e.duration=t.fx.off?0:"number"==typeof s?s:s in t.fx.speeds?t.fx.speeds[s]:t.fx.speeds._default,e.complete=n||i.complete,e}function i(e){return!e||"number"==typeof e||t.fx.speeds[e]?!0:"string"!=typeof e||t.effects.effect[e]?t.isFunction(e)?!0:"object"!=typeof e||e.effect?!1:!0:!0}function s(t,e){var i=e.outerWidth(),s=e.outerHeight(),n=/^rect\((-?\d*\.?\d*px|-?\d+%|auto),?\s*(-?\d*\.?\d*px|-?\d+%|auto),?\s*(-?\d*\.?\d*px|-?\d+%|auto),?\s*(-?\d*\.?\d*px|-?\d+%|auto)\)$/,o=n.exec(t)||["",0,i,s,0];return{top:parseFloat(o[1])||0,right:"auto"===o[2]?i:parseFloat(o[2]),bottom:"auto"===o[3]?s:parseFloat(o[3]),left:parseFloat(o[4])||0}}t.expr&&t.expr.filters&&t.expr.filters.animated&&(t.expr.filters.animated=function(e){return function(i){return!!t(i).data(d)||e(i)}}(t.expr.filters.animated)),t.uiBackCompat!==!1&&t.extend(t.effects,{save:function(t,e){for(var i=0,s=e.length;s>i;i++)null!==e[i]&&t.data(c+e[i],t[0].style[e[i]])},restore:function(t,e){for(var i,s=0,n=e.length;n>s;s++)null!==e[s]&&(i=t.data(c+e[s]),t.css(e[s],i))},setMode:function(t,e){return"toggle"===e&&(e=t.is(":hidden")?"show":"hide"),e},createWrapper:function(e){if(e.parent().is(".ui-effects-wrapper"))return e.parent();var i={width:e.outerWidth(!0),height:e.outerHeight(!0),"float":e.css("float")},s=t("<div></div>").addClass("ui-effects-wrapper").css({fontSize:"100%",background:"transparent",border:"none",margin:0,padding:0}),n={width:e.width(),height:e.height()},o=document.activeElement;try{o.id}catch(a){o=document.body}return e.wrap(s),(e[0]===o||t.contains(e[0],o))&&t(o).trigger("focus"),s=e.parent(),"static"===e.css("position")?(s.css({position:"relative"}),e.css({position:"relative"})):(t.extend(i,{position:e.css("position"),zIndex:e.css("z-index")}),t.each(["top","left","bottom","right"],function(t,s){i[s]=e.css(s),isNaN(parseInt(i[s],10))&&(i[s]="auto")}),e.css({position:"relative",top:0,left:0,right:"auto",bottom:"auto"})),e.css(n),s.css(i).show()},removeWrapper:function(e){var i=document.activeElement;return e.parent().is(".ui-effects-wrapper")&&(e.parent().replaceWith(e),(e[0]===i||t.contains(e[0],i))&&t(i).trigger("focus")),e}}),t.extend(t.effects,{version:"1.12.1",define:function(e,i,s){return s||(s=i,i="effect"),t.effects.effect[e]=s,t.effects.effect[e].mode=i,s},scaledDimensions:function(t,e,i){if(0===e)return{height:0,width:0,outerHeight:0,outerWidth:0};var s="horizontal"!==i?(e||100)/100:1,n="vertical"!==i?(e||100)/100:1;return{height:t.height()*n,width:t.width()*s,outerHeight:t.outerHeight()*n,outerWidth:t.outerWidth()*s}},clipToBox:function(t){return{width:t.clip.right-t.clip.left,height:t.clip.bottom-t.clip.top,left:t.clip.left,top:t.clip.top}},unshift:function(t,e,i){var s=t.queue();e>1&&s.splice.apply(s,[1,0].concat(s.splice(e,i))),t.dequeue()},saveStyle:function(t){t.data(u,t[0].style.cssText)},restoreStyle:function(t){t[0].style.cssText=t.data(u)||"",t.removeData(u)},mode:function(t,e){var i=t.is(":hidden");return"toggle"===e&&(e=i?"show":"hide"),(i?"hide"===e:"show"===e)&&(e="none"),e},getBaseline:function(t,e){var i,s;switch(t[0]){case"top":i=0;break;case"middle":i=.5;break;case"bottom":i=1;break;default:i=t[0]/e.height}switch(t[1]){case"left":s=0;break;case"center":s=.5;break;case"right":s=1;break;default:s=t[1]/e.width}return{x:s,y:i}},createPlaceholder:function(e){var i,s=e.css("position"),n=e.position();return e.css({marginTop:e.css("marginTop"),marginBottom:e.css("marginBottom"),marginLeft:e.css("marginLeft"),marginRight:e.css("marginRight")}).outerWidth(e.outerWidth()).outerHeight(e.outerHeight()),/^(static|relative)/.test(s)&&(s="absolute",i=t("<"+e[0].nodeName+">").insertAfter(e).css({display:/^(inline|ruby)/.test(e.css("display"))?"inline-block":"block",visibility:"hidden",marginTop:e.css("marginTop"),marginBottom:e.css("marginBottom"),marginLeft:e.css("marginLeft"),marginRight:e.css("marginRight"),"float":e.css("float")}).outerWidth(e.outerWidth()).outerHeight(e.outerHeight()).addClass("ui-effects-placeholder"),e.data(c+"placeholder",i)),e.css({position:s,left:n.left,top:n.top}),i},removePlaceholder:function(t){var e=c+"placeholder",i=t.data(e);i&&(i.remove(),t.removeData(e))},cleanUp:function(e){t.effects.restoreStyle(e),t.effects.removePlaceholder(e)},setTransition:function(e,i,s,n){return n=n||{},t.each(i,function(t,i){var o=e.cssUnit(i);o[0]>0&&(n[i]=o[0]*s+o[1])}),n}}),t.fn.extend({effect:function(){function i(e){function i(){r.removeData(d),t.effects.cleanUp(r),"hide"===s.mode&&r.hide(),a()}function a(){t.isFunction(h)&&h.call(r[0]),t.isFunction(e)&&e()}var r=t(this);s.mode=c.shift(),t.uiBackCompat===!1||o?"none"===s.mode?(r[l](),a()):n.call(r[0],s,i):(r.is(":hidden")?"hide"===l:"show"===l)?(r[l](),a()):n.call(r[0],s,a)}var s=e.apply(this,arguments),n=t.effects.effect[s.effect],o=n.mode,a=s.queue,r=a||"fx",h=s.complete,l=s.mode,c=[],u=function(e){var i=t(this),s=t.effects.mode(i,l)||o;i.data(d,!0),c.push(s),o&&("show"===s||s===o&&"hide"===s)&&i.show(),o&&"none"===s||t.effects.saveStyle(i),t.isFunction(e)&&e()};return t.fx.off||!n?l?this[l](s.duration,h):this.each(function(){h&&h.call(this)}):a===!1?this.each(u).each(i):this.queue(r,u).queue(r,i)},show:function(t){return function(s){if(i(s))return t.apply(this,arguments);var n=e.apply(this,arguments);return n.mode="show",this.effect.call(this,n)
}}(t.fn.show),hide:function(t){return function(s){if(i(s))return t.apply(this,arguments);var n=e.apply(this,arguments);return n.mode="hide",this.effect.call(this,n)}}(t.fn.hide),toggle:function(t){return function(s){if(i(s)||"boolean"==typeof s)return t.apply(this,arguments);var n=e.apply(this,arguments);return n.mode="toggle",this.effect.call(this,n)}}(t.fn.toggle),cssUnit:function(e){var i=this.css(e),s=[];return t.each(["em","px","%","pt"],function(t,e){i.indexOf(e)>0&&(s=[parseFloat(i),e])}),s},cssClip:function(t){return t?this.css("clip","rect("+t.top+"px "+t.right+"px "+t.bottom+"px "+t.left+"px)"):s(this.css("clip"),this)},transfer:function(e,i){var s=t(this),n=t(e.to),o="fixed"===n.css("position"),a=t("body"),r=o?a.scrollTop():0,h=o?a.scrollLeft():0,l=n.offset(),c={top:l.top-r,left:l.left-h,height:n.innerHeight(),width:n.innerWidth()},u=s.offset(),d=t("<div class='ui-effects-transfer'></div>").appendTo("body").addClass(e.className).css({top:u.top-r,left:u.left-h,height:s.innerHeight(),width:s.innerWidth(),position:o?"fixed":"absolute"}).animate(c,e.duration,e.easing,function(){d.remove(),t.isFunction(i)&&i()})}}),t.fx.step.clip=function(e){e.clipInit||(e.start=t(e.elem).cssClip(),"string"==typeof e.end&&(e.end=s(e.end,e.elem)),e.clipInit=!0),t(e.elem).cssClip({top:e.pos*(e.end.top-e.start.top)+e.start.top,right:e.pos*(e.end.right-e.start.right)+e.start.right,bottom:e.pos*(e.end.bottom-e.start.bottom)+e.start.bottom,left:e.pos*(e.end.left-e.start.left)+e.start.left})}}(),function(){var e={};t.each(["Quad","Cubic","Quart","Quint","Expo"],function(t,i){e[i]=function(e){return Math.pow(e,t+2)}}),t.extend(e,{Sine:function(t){return 1-Math.cos(t*Math.PI/2)},Circ:function(t){return 1-Math.sqrt(1-t*t)},Elastic:function(t){return 0===t||1===t?t:-Math.pow(2,8*(t-1))*Math.sin((80*(t-1)-7.5)*Math.PI/15)},Back:function(t){return t*t*(3*t-2)},Bounce:function(t){for(var e,i=4;((e=Math.pow(2,--i))-1)/11>t;);return 1/Math.pow(4,3-i)-7.5625*Math.pow((3*e-2)/22-t,2)}}),t.each(e,function(e,i){t.easing["easeIn"+e]=i,t.easing["easeOut"+e]=function(t){return 1-i(1-t)},t.easing["easeInOut"+e]=function(t){return.5>t?i(2*t)/2:1-i(-2*t+2)/2}})}();var f=t.effects;t.effects.define("blind","hide",function(e,i){var s={up:["bottom","top"],vertical:["bottom","top"],down:["top","bottom"],left:["right","left"],horizontal:["right","left"],right:["left","right"]},n=t(this),o=e.direction||"up",a=n.cssClip(),r={clip:t.extend({},a)},h=t.effects.createPlaceholder(n);r.clip[s[o][0]]=r.clip[s[o][1]],"show"===e.mode&&(n.cssClip(r.clip),h&&h.css(t.effects.clipToBox(r)),r.clip=a),h&&h.animate(t.effects.clipToBox(r),e.duration,e.easing),n.animate(r,{queue:!1,duration:e.duration,easing:e.easing,complete:i})}),t.effects.define("bounce",function(e,i){var s,n,o,a=t(this),r=e.mode,h="hide"===r,l="show"===r,c=e.direction||"up",u=e.distance,d=e.times||5,p=2*d+(l||h?1:0),f=e.duration/p,g=e.easing,m="up"===c||"down"===c?"top":"left",_="up"===c||"left"===c,v=0,b=a.queue().length;for(t.effects.createPlaceholder(a),o=a.css(m),u||(u=a["top"===m?"outerHeight":"outerWidth"]()/3),l&&(n={opacity:1},n[m]=o,a.css("opacity",0).css(m,_?2*-u:2*u).animate(n,f,g)),h&&(u/=Math.pow(2,d-1)),n={},n[m]=o;d>v;v++)s={},s[m]=(_?"-=":"+=")+u,a.animate(s,f,g).animate(n,f,g),u=h?2*u:u/2;h&&(s={opacity:0},s[m]=(_?"-=":"+=")+u,a.animate(s,f,g)),a.queue(i),t.effects.unshift(a,b,p+1)}),t.effects.define("clip","hide",function(e,i){var s,n={},o=t(this),a=e.direction||"vertical",r="both"===a,h=r||"horizontal"===a,l=r||"vertical"===a;s=o.cssClip(),n.clip={top:l?(s.bottom-s.top)/2:s.top,right:h?(s.right-s.left)/2:s.right,bottom:l?(s.bottom-s.top)/2:s.bottom,left:h?(s.right-s.left)/2:s.left},t.effects.createPlaceholder(o),"show"===e.mode&&(o.cssClip(n.clip),n.clip=s),o.animate(n,{queue:!1,duration:e.duration,easing:e.easing,complete:i})}),t.effects.define("drop","hide",function(e,i){var s,n=t(this),o=e.mode,a="show"===o,r=e.direction||"left",h="up"===r||"down"===r?"top":"left",l="up"===r||"left"===r?"-=":"+=",c="+="===l?"-=":"+=",u={opacity:0};t.effects.createPlaceholder(n),s=e.distance||n["top"===h?"outerHeight":"outerWidth"](!0)/2,u[h]=l+s,a&&(n.css(u),u[h]=c+s,u.opacity=1),n.animate(u,{queue:!1,duration:e.duration,easing:e.easing,complete:i})}),t.effects.define("explode","hide",function(e,i){function s(){b.push(this),b.length===u*d&&n()}function n(){p.css({visibility:"visible"}),t(b).remove(),i()}var o,a,r,h,l,c,u=e.pieces?Math.round(Math.sqrt(e.pieces)):3,d=u,p=t(this),f=e.mode,g="show"===f,m=p.show().css("visibility","hidden").offset(),_=Math.ceil(p.outerWidth()/d),v=Math.ceil(p.outerHeight()/u),b=[];for(o=0;u>o;o++)for(h=m.top+o*v,c=o-(u-1)/2,a=0;d>a;a++)r=m.left+a*_,l=a-(d-1)/2,p.clone().appendTo("body").wrap("<div></div>").css({position:"absolute",visibility:"visible",left:-a*_,top:-o*v}).parent().addClass("ui-effects-explode").css({position:"absolute",overflow:"hidden",width:_,height:v,left:r+(g?l*_:0),top:h+(g?c*v:0),opacity:g?0:1}).animate({left:r+(g?0:l*_),top:h+(g?0:c*v),opacity:g?1:0},e.duration||500,e.easing,s)}),t.effects.define("fade","toggle",function(e,i){var s="show"===e.mode;t(this).css("opacity",s?0:1).animate({opacity:s?1:0},{queue:!1,duration:e.duration,easing:e.easing,complete:i})}),t.effects.define("fold","hide",function(e,i){var s=t(this),n=e.mode,o="show"===n,a="hide"===n,r=e.size||15,h=/([0-9]+)%/.exec(r),l=!!e.horizFirst,c=l?["right","bottom"]:["bottom","right"],u=e.duration/2,d=t.effects.createPlaceholder(s),p=s.cssClip(),f={clip:t.extend({},p)},g={clip:t.extend({},p)},m=[p[c[0]],p[c[1]]],_=s.queue().length;h&&(r=parseInt(h[1],10)/100*m[a?0:1]),f.clip[c[0]]=r,g.clip[c[0]]=r,g.clip[c[1]]=0,o&&(s.cssClip(g.clip),d&&d.css(t.effects.clipToBox(g)),g.clip=p),s.queue(function(i){d&&d.animate(t.effects.clipToBox(f),u,e.easing).animate(t.effects.clipToBox(g),u,e.easing),i()}).animate(f,u,e.easing).animate(g,u,e.easing).queue(i),t.effects.unshift(s,_,4)}),t.effects.define("highlight","show",function(e,i){var s=t(this),n={backgroundColor:s.css("backgroundColor")};"hide"===e.mode&&(n.opacity=0),t.effects.saveStyle(s),s.css({backgroundImage:"none",backgroundColor:e.color||"#ffff99"}).animate(n,{queue:!1,duration:e.duration,easing:e.easing,complete:i})}),t.effects.define("size",function(e,i){var s,n,o,a=t(this),r=["fontSize"],h=["borderTopWidth","borderBottomWidth","paddingTop","paddingBottom"],l=["borderLeftWidth","borderRightWidth","paddingLeft","paddingRight"],c=e.mode,u="effect"!==c,d=e.scale||"both",p=e.origin||["middle","center"],f=a.css("position"),g=a.position(),m=t.effects.scaledDimensions(a),_=e.from||m,v=e.to||t.effects.scaledDimensions(a,0);t.effects.createPlaceholder(a),"show"===c&&(o=_,_=v,v=o),n={from:{y:_.height/m.height,x:_.width/m.width},to:{y:v.height/m.height,x:v.width/m.width}},("box"===d||"both"===d)&&(n.from.y!==n.to.y&&(_=t.effects.setTransition(a,h,n.from.y,_),v=t.effects.setTransition(a,h,n.to.y,v)),n.from.x!==n.to.x&&(_=t.effects.setTransition(a,l,n.from.x,_),v=t.effects.setTransition(a,l,n.to.x,v))),("content"===d||"both"===d)&&n.from.y!==n.to.y&&(_=t.effects.setTransition(a,r,n.from.y,_),v=t.effects.setTransition(a,r,n.to.y,v)),p&&(s=t.effects.getBaseline(p,m),_.top=(m.outerHeight-_.outerHeight)*s.y+g.top,_.left=(m.outerWidth-_.outerWidth)*s.x+g.left,v.top=(m.outerHeight-v.outerHeight)*s.y+g.top,v.left=(m.outerWidth-v.outerWidth)*s.x+g.left),a.css(_),("content"===d||"both"===d)&&(h=h.concat(["marginTop","marginBottom"]).concat(r),l=l.concat(["marginLeft","marginRight"]),a.find("*[width]").each(function(){var i=t(this),s=t.effects.scaledDimensions(i),o={height:s.height*n.from.y,width:s.width*n.from.x,outerHeight:s.outerHeight*n.from.y,outerWidth:s.outerWidth*n.from.x},a={height:s.height*n.to.y,width:s.width*n.to.x,outerHeight:s.height*n.to.y,outerWidth:s.width*n.to.x};n.from.y!==n.to.y&&(o=t.effects.setTransition(i,h,n.from.y,o),a=t.effects.setTransition(i,h,n.to.y,a)),n.from.x!==n.to.x&&(o=t.effects.setTransition(i,l,n.from.x,o),a=t.effects.setTransition(i,l,n.to.x,a)),u&&t.effects.saveStyle(i),i.css(o),i.animate(a,e.duration,e.easing,function(){u&&t.effects.restoreStyle(i)})})),a.animate(v,{queue:!1,duration:e.duration,easing:e.easing,complete:function(){var e=a.offset();0===v.opacity&&a.css("opacity",_.opacity),u||(a.css("position","static"===f?"relative":f).offset(e),t.effects.saveStyle(a)),i()}})}),t.effects.define("scale",function(e,i){var s=t(this),n=e.mode,o=parseInt(e.percent,10)||(0===parseInt(e.percent,10)?0:"effect"!==n?0:100),a=t.extend(!0,{from:t.effects.scaledDimensions(s),to:t.effects.scaledDimensions(s,o,e.direction||"both"),origin:e.origin||["middle","center"]},e);e.fade&&(a.from.opacity=1,a.to.opacity=0),t.effects.effect.size.call(this,a,i)}),t.effects.define("puff","hide",function(e,i){var s=t.extend(!0,{},e,{fade:!0,percent:parseInt(e.percent,10)||150});t.effects.effect.scale.call(this,s,i)}),t.effects.define("pulsate","show",function(e,i){var s=t(this),n=e.mode,o="show"===n,a="hide"===n,r=o||a,h=2*(e.times||5)+(r?1:0),l=e.duration/h,c=0,u=1,d=s.queue().length;for((o||!s.is(":visible"))&&(s.css("opacity",0).show(),c=1);h>u;u++)s.animate({opacity:c},l,e.easing),c=1-c;s.animate({opacity:c},l,e.easing),s.queue(i),t.effects.unshift(s,d,h+1)}),t.effects.define("shake",function(e,i){var s=1,n=t(this),o=e.direction||"left",a=e.distance||20,r=e.times||3,h=2*r+1,l=Math.round(e.duration/h),c="up"===o||"down"===o?"top":"left",u="up"===o||"left"===o,d={},p={},f={},g=n.queue().length;for(t.effects.createPlaceholder(n),d[c]=(u?"-=":"+=")+a,p[c]=(u?"+=":"-=")+2*a,f[c]=(u?"-=":"+=")+2*a,n.animate(d,l,e.easing);r>s;s++)n.animate(p,l,e.easing).animate(f,l,e.easing);n.animate(p,l,e.easing).animate(d,l/2,e.easing).queue(i),t.effects.unshift(n,g,h+1)}),t.effects.define("slide","show",function(e,i){var s,n,o=t(this),a={up:["bottom","top"],down:["top","bottom"],left:["right","left"],right:["left","right"]},r=e.mode,h=e.direction||"left",l="up"===h||"down"===h?"top":"left",c="up"===h||"left"===h,u=e.distance||o["top"===l?"outerHeight":"outerWidth"](!0),d={};t.effects.createPlaceholder(o),s=o.cssClip(),n=o.position()[l],d[l]=(c?-1:1)*u+n,d.clip=o.cssClip(),d.clip[a[h][1]]=d.clip[a[h][0]],"show"===r&&(o.cssClip(d.clip),o.css(l,d[l]),d.clip=s,d[l]=n),o.animate(d,{queue:!1,duration:e.duration,easing:e.easing,complete:i})});var f;t.uiBackCompat!==!1&&(f=t.effects.define("transfer",function(e,i){t(this).transfer(e,i)})),t.ui.focusable=function(i,s){var n,o,a,r,h,l=i.nodeName.toLowerCase();return"area"===l?(n=i.parentNode,o=n.name,i.href&&o&&"map"===n.nodeName.toLowerCase()?(a=t("img[usemap='#"+o+"']"),a.length>0&&a.is(":visible")):!1):(/^(input|select|textarea|button|object)$/.test(l)?(r=!i.disabled,r&&(h=t(i).closest("fieldset")[0],h&&(r=!h.disabled))):r="a"===l?i.href||s:s,r&&t(i).is(":visible")&&e(t(i)))},t.extend(t.expr[":"],{focusable:function(e){return t.ui.focusable(e,null!=t.attr(e,"tabindex"))}}),t.ui.focusable,t.fn.form=function(){return"string"==typeof this[0].form?this.closest("form"):t(this[0].form)},t.ui.formResetMixin={_formResetHandler:function(){var e=t(this);setTimeout(function(){var i=e.data("ui-form-reset-instances");t.each(i,function(){this.refresh()})})},_bindFormResetHandler:function(){if(this.form=this.element.form(),this.form.length){var t=this.form.data("ui-form-reset-instances")||[];t.length||this.form.on("reset.ui-form-reset",this._formResetHandler),t.push(this),this.form.data("ui-form-reset-instances",t)}},_unbindFormResetHandler:function(){if(this.form.length){var e=this.form.data("ui-form-reset-instances");e.splice(t.inArray(this,e),1),e.length?this.form.data("ui-form-reset-instances",e):this.form.removeData("ui-form-reset-instances").off("reset.ui-form-reset")}}},"1.7"===t.fn.jquery.substring(0,3)&&(t.each(["Width","Height"],function(e,i){function s(e,i,s,o){return t.each(n,function(){i-=parseFloat(t.css(e,"padding"+this))||0,s&&(i-=parseFloat(t.css(e,"border"+this+"Width"))||0),o&&(i-=parseFloat(t.css(e,"margin"+this))||0)}),i}var n="Width"===i?["Left","Right"]:["Top","Bottom"],o=i.toLowerCase(),a={innerWidth:t.fn.innerWidth,innerHeight:t.fn.innerHeight,outerWidth:t.fn.outerWidth,outerHeight:t.fn.outerHeight};t.fn["inner"+i]=function(e){return void 0===e?a["inner"+i].call(this):this.each(function(){t(this).css(o,s(this,e)+"px")})},t.fn["outer"+i]=function(e,n){return"number"!=typeof e?a["outer"+i].call(this,e):this.each(function(){t(this).css(o,s(this,e,!0,n)+"px")})}}),t.fn.addBack=function(t){return this.add(null==t?this.prevObject:this.prevObject.filter(t))}),t.ui.keyCode={BACKSPACE:8,COMMA:188,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,LEFT:37,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SPACE:32,TAB:9,UP:38},t.ui.escapeSelector=function(){var t=/([!"#$%&'()*+,.\/:;<=>?@[\]^`{|}~])/g;return function(e){return e.replace(t,"\\$1")}}(),t.fn.labels=function(){var e,i,s,n,o;return this[0].labels&&this[0].labels.length?this.pushStack(this[0].labels):(n=this.eq(0).parents("label"),s=this.attr("id"),s&&(e=this.eq(0).parents().last(),o=e.add(e.length?e.siblings():this.siblings()),i="label[for='"+t.ui.escapeSelector(s)+"']",n=n.add(o.find(i).addBack(i))),this.pushStack(n))},t.fn.scrollParent=function(e){var i=this.css("position"),s="absolute"===i,n=e?/(auto|scroll|hidden)/:/(auto|scroll)/,o=this.parents().filter(function(){var e=t(this);return s&&"static"===e.css("position")?!1:n.test(e.css("overflow")+e.css("overflow-y")+e.css("overflow-x"))}).eq(0);return"fixed"!==i&&o.length?o:t(this[0].ownerDocument||document)},t.extend(t.expr[":"],{tabbable:function(e){var i=t.attr(e,"tabindex"),s=null!=i;return(!s||i>=0)&&t.ui.focusable(e,s)}}),t.fn.extend({uniqueId:function(){var t=0;return function(){return this.each(function(){this.id||(this.id="ui-id-"+ ++t)})}}(),removeUniqueId:function(){return this.each(function(){/^ui-id-\d+$/.test(this.id)&&t(this).removeAttr("id")})}}),t.widget("ui.accordion",{version:"1.12.1",options:{active:0,animate:{},classes:{"ui-accordion-header":"ui-corner-top","ui-accordion-header-collapsed":"ui-corner-all","ui-accordion-content":"ui-corner-bottom"},collapsible:!1,event:"click",header:"> li > :first-child, > :not(li):even",heightStyle:"auto",icons:{activeHeader:"ui-icon-triangle-1-s",header:"ui-icon-triangle-1-e"},activate:null,beforeActivate:null},hideProps:{borderTopWidth:"hide",borderBottomWidth:"hide",paddingTop:"hide",paddingBottom:"hide",height:"hide"},showProps:{borderTopWidth:"show",borderBottomWidth:"show",paddingTop:"show",paddingBottom:"show",height:"show"},_create:function(){var e=this.options;this.prevShow=this.prevHide=t(),this._addClass("ui-accordion","ui-widget ui-helper-reset"),this.element.attr("role","tablist"),e.collapsible||e.active!==!1&&null!=e.active||(e.active=0),this._processPanels(),0>e.active&&(e.active+=this.headers.length),this._refresh()},_getCreateEventData:function(){return{header:this.active,panel:this.active.length?this.active.next():t()}},_createIcons:function(){var e,i,s=this.options.icons;s&&(e=t("<span>"),this._addClass(e,"ui-accordion-header-icon","ui-icon "+s.header),e.prependTo(this.headers),i=this.active.children(".ui-accordion-header-icon"),this._removeClass(i,s.header)._addClass(i,null,s.activeHeader)._addClass(this.headers,"ui-accordion-icons"))},_destroyIcons:function(){this._removeClass(this.headers,"ui-accordion-icons"),this.headers.children(".ui-accordion-header-icon").remove()},_destroy:function(){var t;this.element.removeAttr("role"),this.headers.removeAttr("role aria-expanded aria-selected aria-controls tabIndex").removeUniqueId(),this._destroyIcons(),t=this.headers.next().css("display","").removeAttr("role aria-hidden aria-labelledby").removeUniqueId(),"content"!==this.options.heightStyle&&t.css("height","")},_setOption:function(t,e){return"active"===t?(this._activate(e),void 0):("event"===t&&(this.options.event&&this._off(this.headers,this.options.event),this._setupEvents(e)),this._super(t,e),"collapsible"!==t||e||this.options.active!==!1||this._activate(0),"icons"===t&&(this._destroyIcons(),e&&this._createIcons()),void 0)},_setOptionDisabled:function(t){this._super(t),this.element.attr("aria-disabled",t),this._toggleClass(null,"ui-state-disabled",!!t),this._toggleClass(this.headers.add(this.headers.next()),null,"ui-state-disabled",!!t)},_keydown:function(e){if(!e.altKey&&!e.ctrlKey){var i=t.ui.keyCode,s=this.headers.length,n=this.headers.index(e.target),o=!1;switch(e.keyCode){case i.RIGHT:case i.DOWN:o=this.headers[(n+1)%s];break;case i.LEFT:case i.UP:o=this.headers[(n-1+s)%s];break;case i.SPACE:case i.ENTER:this._eventHandler(e);break;case i.HOME:o=this.headers[0];break;case i.END:o=this.headers[s-1]}o&&(t(e.target).attr("tabIndex",-1),t(o).attr("tabIndex",0),t(o).trigger("focus"),e.preventDefault())}},_panelKeyDown:function(e){e.keyCode===t.ui.keyCode.UP&&e.ctrlKey&&t(e.currentTarget).prev().trigger("focus")},refresh:function(){var e=this.options;this._processPanels(),e.active===!1&&e.collapsible===!0||!this.headers.length?(e.active=!1,this.active=t()):e.active===!1?this._activate(0):this.active.length&&!t.contains(this.element[0],this.active[0])?this.headers.length===this.headers.find(".ui-state-disabled").length?(e.active=!1,this.active=t()):this._activate(Math.max(0,e.active-1)):e.active=this.headers.index(this.active),this._destroyIcons(),this._refresh()},_processPanels:function(){var t=this.headers,e=this.panels;this.headers=this.element.find(this.options.header),this._addClass(this.headers,"ui-accordion-header ui-accordion-header-collapsed","ui-state-default"),this.panels=this.headers.next().filter(":not(.ui-accordion-content-active)").hide(),this._addClass(this.panels,"ui-accordion-content","ui-helper-reset ui-widget-content"),e&&(this._off(t.not(this.headers)),this._off(e.not(this.panels)))},_refresh:function(){var e,i=this.options,s=i.heightStyle,n=this.element.parent();this.active=this._findActive(i.active),this._addClass(this.active,"ui-accordion-header-active","ui-state-active")._removeClass(this.active,"ui-accordion-header-collapsed"),this._addClass(this.active.next(),"ui-accordion-content-active"),this.active.next().show(),this.headers.attr("role","tab").each(function(){var e=t(this),i=e.uniqueId().attr("id"),s=e.next(),n=s.uniqueId().attr("id");e.attr("aria-controls",n),s.attr("aria-labelledby",i)}).next().attr("role","tabpanel"),this.headers.not(this.active).attr({"aria-selected":"false","aria-expanded":"false",tabIndex:-1}).next().attr({"aria-hidden":"true"}).hide(),this.active.length?this.active.attr({"aria-selected":"true","aria-expanded":"true",tabIndex:0}).next().attr({"aria-hidden":"false"}):this.headers.eq(0).attr("tabIndex",0),this._createIcons(),this._setupEvents(i.event),"fill"===s?(e=n.height(),this.element.siblings(":visible").each(function(){var i=t(this),s=i.css("position");"absolute"!==s&&"fixed"!==s&&(e-=i.outerHeight(!0))}),this.headers.each(function(){e-=t(this).outerHeight(!0)}),this.headers.next().each(function(){t(this).height(Math.max(0,e-t(this).innerHeight()+t(this).height()))}).css("overflow","auto")):"auto"===s&&(e=0,this.headers.next().each(function(){var i=t(this).is(":visible");i||t(this).show(),e=Math.max(e,t(this).css("height","").height()),i||t(this).hide()}).height(e))},_activate:function(e){var i=this._findActive(e)[0];i!==this.active[0]&&(i=i||this.active[0],this._eventHandler({target:i,currentTarget:i,preventDefault:t.noop}))},_findActive:function(e){return"number"==typeof e?this.headers.eq(e):t()},_setupEvents:function(e){var i={keydown:"_keydown"};e&&t.each(e.split(" "),function(t,e){i[e]="_eventHandler"}),this._off(this.headers.add(this.headers.next())),this._on(this.headers,i),this._on(this.headers.next(),{keydown:"_panelKeyDown"}),this._hoverable(this.headers),this._focusable(this.headers)},_eventHandler:function(e){var i,s,n=this.options,o=this.active,a=t(e.currentTarget),r=a[0]===o[0],h=r&&n.collapsible,l=h?t():a.next(),c=o.next(),u={oldHeader:o,oldPanel:c,newHeader:h?t():a,newPanel:l};e.preventDefault(),r&&!n.collapsible||this._trigger("beforeActivate",e,u)===!1||(n.active=h?!1:this.headers.index(a),this.active=r?t():a,this._toggle(u),this._removeClass(o,"ui-accordion-header-active","ui-state-active"),n.icons&&(i=o.children(".ui-accordion-header-icon"),this._removeClass(i,null,n.icons.activeHeader)._addClass(i,null,n.icons.header)),r||(this._removeClass(a,"ui-accordion-header-collapsed")._addClass(a,"ui-accordion-header-active","ui-state-active"),n.icons&&(s=a.children(".ui-accordion-header-icon"),this._removeClass(s,null,n.icons.header)._addClass(s,null,n.icons.activeHeader)),this._addClass(a.next(),"ui-accordion-content-active")))},_toggle:function(e){var i=e.newPanel,s=this.prevShow.length?this.prevShow:e.oldPanel;this.prevShow.add(this.prevHide).stop(!0,!0),this.prevShow=i,this.prevHide=s,this.options.animate?this._animate(i,s,e):(s.hide(),i.show(),this._toggleComplete(e)),s.attr({"aria-hidden":"true"}),s.prev().attr({"aria-selected":"false","aria-expanded":"false"}),i.length&&s.length?s.prev().attr({tabIndex:-1,"aria-expanded":"false"}):i.length&&this.headers.filter(function(){return 0===parseInt(t(this).attr("tabIndex"),10)}).attr("tabIndex",-1),i.attr("aria-hidden","false").prev().attr({"aria-selected":"true","aria-expanded":"true",tabIndex:0})},_animate:function(t,e,i){var s,n,o,a=this,r=0,h=t.css("box-sizing"),l=t.length&&(!e.length||t.index()<e.index()),c=this.options.animate||{},u=l&&c.down||c,d=function(){a._toggleComplete(i)};return"number"==typeof u&&(o=u),"string"==typeof u&&(n=u),n=n||u.easing||c.easing,o=o||u.duration||c.duration,e.length?t.length?(s=t.show().outerHeight(),e.animate(this.hideProps,{duration:o,easing:n,step:function(t,e){e.now=Math.round(t)}}),t.hide().animate(this.showProps,{duration:o,easing:n,complete:d,step:function(t,i){i.now=Math.round(t),"height"!==i.prop?"content-box"===h&&(r+=i.now):"content"!==a.options.heightStyle&&(i.now=Math.round(s-e.outerHeight()-r),r=0)}}),void 0):e.animate(this.hideProps,o,n,d):t.animate(this.showProps,o,n,d)},_toggleComplete:function(t){var e=t.oldPanel,i=e.prev();this._removeClass(e,"ui-accordion-content-active"),this._removeClass(i,"ui-accordion-header-active")._addClass(i,"ui-accordion-header-collapsed"),e.length&&(e.parent()[0].className=e.parent()[0].className),this._trigger("activate",null,t)}}),t.ui.safeActiveElement=function(t){var e;try{e=t.activeElement}catch(i){e=t.body}return e||(e=t.body),e.nodeName||(e=t.body),e},t.widget("ui.menu",{version:"1.12.1",defaultElement:"<ul>",delay:300,options:{icons:{submenu:"ui-icon-caret-1-e"},items:"> *",menus:"ul",position:{my:"left top",at:"right top"},role:"menu",blur:null,focus:null,select:null},_create:function(){this.activeMenu=this.element,this.mouseHandled=!1,this.element.uniqueId().attr({role:this.options.role,tabIndex:0}),this._addClass("ui-menu","ui-widget ui-widget-content"),this._on({"mousedown .ui-menu-item":function(t){t.preventDefault()},"click .ui-menu-item":function(e){var i=t(e.target),s=t(t.ui.safeActiveElement(this.document[0]));!this.mouseHandled&&i.not(".ui-state-disabled").length&&(this.select(e),e.isPropagationStopped()||(this.mouseHandled=!0),i.has(".ui-menu").length?this.expand(e):!this.element.is(":focus")&&s.closest(".ui-menu").length&&(this.element.trigger("focus",[!0]),this.active&&1===this.active.parents(".ui-menu").length&&clearTimeout(this.timer)))},"mouseenter .ui-menu-item":function(e){if(!this.previousFilter){var i=t(e.target).closest(".ui-menu-item"),s=t(e.currentTarget);i[0]===s[0]&&(this._removeClass(s.siblings().children(".ui-state-active"),null,"ui-state-active"),this.focus(e,s))}},mouseleave:"collapseAll","mouseleave .ui-menu":"collapseAll",focus:function(t,e){var i=this.active||this.element.find(this.options.items).eq(0);e||this.focus(t,i)},blur:function(e){this._delay(function(){var i=!t.contains(this.element[0],t.ui.safeActiveElement(this.document[0]));i&&this.collapseAll(e)})},keydown:"_keydown"}),this.refresh(),this._on(this.document,{click:function(t){this._closeOnDocumentClick(t)&&this.collapseAll(t),this.mouseHandled=!1}})},_destroy:function(){var e=this.element.find(".ui-menu-item").removeAttr("role aria-disabled"),i=e.children(".ui-menu-item-wrapper").removeUniqueId().removeAttr("tabIndex role aria-haspopup");this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeAttr("role aria-labelledby aria-expanded aria-hidden aria-disabled tabIndex").removeUniqueId().show(),i.children().each(function(){var e=t(this);e.data("ui-menu-submenu-caret")&&e.remove()})},_keydown:function(e){var i,s,n,o,a=!0;switch(e.keyCode){case t.ui.keyCode.PAGE_UP:this.previousPage(e);break;case t.ui.keyCode.PAGE_DOWN:this.nextPage(e);break;case t.ui.keyCode.HOME:this._move("first","first",e);break;case t.ui.keyCode.END:this._move("last","last",e);break;case t.ui.keyCode.UP:this.previous(e);break;case t.ui.keyCode.DOWN:this.next(e);break;case t.ui.keyCode.LEFT:this.collapse(e);break;case t.ui.keyCode.RIGHT:this.active&&!this.active.is(".ui-state-disabled")&&this.expand(e);break;case t.ui.keyCode.ENTER:case t.ui.keyCode.SPACE:this._activate(e);break;case t.ui.keyCode.ESCAPE:this.collapse(e);break;default:a=!1,s=this.previousFilter||"",o=!1,n=e.keyCode>=96&&105>=e.keyCode?""+(e.keyCode-96):String.fromCharCode(e.keyCode),clearTimeout(this.filterTimer),n===s?o=!0:n=s+n,i=this._filterMenuItems(n),i=o&&-1!==i.index(this.active.next())?this.active.nextAll(".ui-menu-item"):i,i.length||(n=String.fromCharCode(e.keyCode),i=this._filterMenuItems(n)),i.length?(this.focus(e,i),this.previousFilter=n,this.filterTimer=this._delay(function(){delete this.previousFilter},1e3)):delete this.previousFilter}a&&e.preventDefault()},_activate:function(t){this.active&&!this.active.is(".ui-state-disabled")&&(this.active.children("[aria-haspopup='true']").length?this.expand(t):this.select(t))},refresh:function(){var e,i,s,n,o,a=this,r=this.options.icons.submenu,h=this.element.find(this.options.menus);this._toggleClass("ui-menu-icons",null,!!this.element.find(".ui-icon").length),s=h.filter(":not(.ui-menu)").hide().attr({role:this.options.role,"aria-hidden":"true","aria-expanded":"false"}).each(function(){var e=t(this),i=e.prev(),s=t("<span>").data("ui-menu-submenu-caret",!0);a._addClass(s,"ui-menu-icon","ui-icon "+r),i.attr("aria-haspopup","true").prepend(s),e.attr("aria-labelledby",i.attr("id"))}),this._addClass(s,"ui-menu","ui-widget ui-widget-content ui-front"),e=h.add(this.element),i=e.find(this.options.items),i.not(".ui-menu-item").each(function(){var e=t(this);a._isDivider(e)&&a._addClass(e,"ui-menu-divider","ui-widget-content")}),n=i.not(".ui-menu-item, .ui-menu-divider"),o=n.children().not(".ui-menu").uniqueId().attr({tabIndex:-1,role:this._itemRole()}),this._addClass(n,"ui-menu-item")._addClass(o,"ui-menu-item-wrapper"),i.filter(".ui-state-disabled").attr("aria-disabled","true"),this.active&&!t.contains(this.element[0],this.active[0])&&this.blur()},_itemRole:function(){return{menu:"menuitem",listbox:"option"}[this.options.role]},_setOption:function(t,e){if("icons"===t){var i=this.element.find(".ui-menu-icon");this._removeClass(i,null,this.options.icons.submenu)._addClass(i,null,e.submenu)}this._super(t,e)},_setOptionDisabled:function(t){this._super(t),this.element.attr("aria-disabled",t+""),this._toggleClass(null,"ui-state-disabled",!!t)},focus:function(t,e){var i,s,n;this.blur(t,t&&"focus"===t.type),this._scrollIntoView(e),this.active=e.first(),s=this.active.children(".ui-menu-item-wrapper"),this._addClass(s,null,"ui-state-active"),this.options.role&&this.element.attr("aria-activedescendant",s.attr("id")),n=this.active.parent().closest(".ui-menu-item").children(".ui-menu-item-wrapper"),this._addClass(n,null,"ui-state-active"),t&&"keydown"===t.type?this._close():this.timer=this._delay(function(){this._close()},this.delay),i=e.children(".ui-menu"),i.length&&t&&/^mouse/.test(t.type)&&this._startOpening(i),this.activeMenu=e.parent(),this._trigger("focus",t,{item:e})},_scrollIntoView:function(e){var i,s,n,o,a,r;this._hasScroll()&&(i=parseFloat(t.css(this.activeMenu[0],"borderTopWidth"))||0,s=parseFloat(t.css(this.activeMenu[0],"paddingTop"))||0,n=e.offset().top-this.activeMenu.offset().top-i-s,o=this.activeMenu.scrollTop(),a=this.activeMenu.height(),r=e.outerHeight(),0>n?this.activeMenu.scrollTop(o+n):n+r>a&&this.activeMenu.scrollTop(o+n-a+r))},blur:function(t,e){e||clearTimeout(this.timer),this.active&&(this._removeClass(this.active.children(".ui-menu-item-wrapper"),null,"ui-state-active"),this._trigger("blur",t,{item:this.active}),this.active=null)},_startOpening:function(t){clearTimeout(this.timer),"true"===t.attr("aria-hidden")&&(this.timer=this._delay(function(){this._close(),this._open(t)},this.delay))},_open:function(e){var i=t.extend({of:this.active},this.options.position);clearTimeout(this.timer),this.element.find(".ui-menu").not(e.parents(".ui-menu")).hide().attr("aria-hidden","true"),e.show().removeAttr("aria-hidden").attr("aria-expanded","true").position(i)},collapseAll:function(e,i){clearTimeout(this.timer),this.timer=this._delay(function(){var s=i?this.element:t(e&&e.target).closest(this.element.find(".ui-menu"));s.length||(s=this.element),this._close(s),this.blur(e),this._removeClass(s.find(".ui-state-active"),null,"ui-state-active"),this.activeMenu=s},this.delay)},_close:function(t){t||(t=this.active?this.active.parent():this.element),t.find(".ui-menu").hide().attr("aria-hidden","true").attr("aria-expanded","false")},_closeOnDocumentClick:function(e){return!t(e.target).closest(".ui-menu").length},_isDivider:function(t){return!/[^\-\u2014\u2013\s]/.test(t.text())},collapse:function(t){var e=this.active&&this.active.parent().closest(".ui-menu-item",this.element);e&&e.length&&(this._close(),this.focus(t,e))},expand:function(t){var e=this.active&&this.active.children(".ui-menu ").find(this.options.items).first();e&&e.length&&(this._open(e.parent()),this._delay(function(){this.focus(t,e)}))},next:function(t){this._move("next","first",t)},previous:function(t){this._move("prev","last",t)},isFirstItem:function(){return this.active&&!this.active.prevAll(".ui-menu-item").length},isLastItem:function(){return this.active&&!this.active.nextAll(".ui-menu-item").length},_move:function(t,e,i){var s;this.active&&(s="first"===t||"last"===t?this.active["first"===t?"prevAll":"nextAll"](".ui-menu-item").eq(-1):this.active[t+"All"](".ui-menu-item").eq(0)),s&&s.length&&this.active||(s=this.activeMenu.find(this.options.items)[e]()),this.focus(i,s)},nextPage:function(e){var i,s,n;return this.active?(this.isLastItem()||(this._hasScroll()?(s=this.active.offset().top,n=this.element.height(),this.active.nextAll(".ui-menu-item").each(function(){return i=t(this),0>i.offset().top-s-n}),this.focus(e,i)):this.focus(e,this.activeMenu.find(this.options.items)[this.active?"last":"first"]())),void 0):(this.next(e),void 0)},previousPage:function(e){var i,s,n;return this.active?(this.isFirstItem()||(this._hasScroll()?(s=this.active.offset().top,n=this.element.height(),this.active.prevAll(".ui-menu-item").each(function(){return i=t(this),i.offset().top-s+n>0}),this.focus(e,i)):this.focus(e,this.activeMenu.find(this.options.items).first())),void 0):(this.next(e),void 0)},_hasScroll:function(){return this.element.outerHeight()<this.element.prop("scrollHeight")},select:function(e){this.active=this.active||t(e.target).closest(".ui-menu-item");var i={item:this.active};this.active.has(".ui-menu").length||this.collapseAll(e,!0),this._trigger("select",e,i)},_filterMenuItems:function(e){var i=e.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g,"\\$&"),s=RegExp("^"+i,"i");return this.activeMenu.find(this.options.items).filter(".ui-menu-item").filter(function(){return s.test(t.trim(t(this).children(".ui-menu-item-wrapper").text()))})}}),t.widget("ui.autocomplete",{version:"1.12.1",defaultElement:"<input>",options:{appendTo:null,autoFocus:!1,delay:300,minLength:1,position:{my:"left top",at:"left bottom",collision:"none"},source:null,change:null,close:null,focus:null,open:null,response:null,search:null,select:null},requestIndex:0,pending:0,_create:function(){var e,i,s,n=this.element[0].nodeName.toLowerCase(),o="textarea"===n,a="input"===n;
this.isMultiLine=o||!a&&this._isContentEditable(this.element),this.valueMethod=this.element[o||a?"val":"text"],this.isNewMenu=!0,this._addClass("ui-autocomplete-input"),this.element.attr("autocomplete","off"),this._on(this.element,{keydown:function(n){if(this.element.prop("readOnly"))return e=!0,s=!0,i=!0,void 0;e=!1,s=!1,i=!1;var o=t.ui.keyCode;switch(n.keyCode){case o.PAGE_UP:e=!0,this._move("previousPage",n);break;case o.PAGE_DOWN:e=!0,this._move("nextPage",n);break;case o.UP:e=!0,this._keyEvent("previous",n);break;case o.DOWN:e=!0,this._keyEvent("next",n);break;case o.ENTER:this.menu.active&&(e=!0,n.preventDefault(),this.menu.select(n));break;case o.TAB:this.menu.active&&this.menu.select(n);break;case o.ESCAPE:this.menu.element.is(":visible")&&(this.isMultiLine||this._value(this.term),this.close(n),n.preventDefault());break;default:i=!0,this._searchTimeout(n)}},keypress:function(s){if(e)return e=!1,(!this.isMultiLine||this.menu.element.is(":visible"))&&s.preventDefault(),void 0;if(!i){var n=t.ui.keyCode;switch(s.keyCode){case n.PAGE_UP:this._move("previousPage",s);break;case n.PAGE_DOWN:this._move("nextPage",s);break;case n.UP:this._keyEvent("previous",s);break;case n.DOWN:this._keyEvent("next",s)}}},input:function(t){return s?(s=!1,t.preventDefault(),void 0):(this._searchTimeout(t),void 0)},focus:function(){this.selectedItem=null,this.previous=this._value()},blur:function(t){return this.cancelBlur?(delete this.cancelBlur,void 0):(clearTimeout(this.searching),this.close(t),this._change(t),void 0)}}),this._initSource(),this.menu=t("<ul>").appendTo(this._appendTo()).menu({role:null}).hide().menu("instance"),this._addClass(this.menu.element,"ui-autocomplete","ui-front"),this._on(this.menu.element,{mousedown:function(e){e.preventDefault(),this.cancelBlur=!0,this._delay(function(){delete this.cancelBlur,this.element[0]!==t.ui.safeActiveElement(this.document[0])&&this.element.trigger("focus")})},menufocus:function(e,i){var s,n;return this.isNewMenu&&(this.isNewMenu=!1,e.originalEvent&&/^mouse/.test(e.originalEvent.type))?(this.menu.blur(),this.document.one("mousemove",function(){t(e.target).trigger(e.originalEvent)}),void 0):(n=i.item.data("ui-autocomplete-item"),!1!==this._trigger("focus",e,{item:n})&&e.originalEvent&&/^key/.test(e.originalEvent.type)&&this._value(n.value),s=i.item.attr("aria-label")||n.value,s&&t.trim(s).length&&(this.liveRegion.children().hide(),t("<div>").text(s).appendTo(this.liveRegion)),void 0)},menuselect:function(e,i){var s=i.item.data("ui-autocomplete-item"),n=this.previous;this.element[0]!==t.ui.safeActiveElement(this.document[0])&&(this.element.trigger("focus"),this.previous=n,this._delay(function(){this.previous=n,this.selectedItem=s})),!1!==this._trigger("select",e,{item:s})&&this._value(s.value),this.term=this._value(),this.close(e),this.selectedItem=s}}),this.liveRegion=t("<div>",{role:"status","aria-live":"assertive","aria-relevant":"additions"}).appendTo(this.document[0].body),this._addClass(this.liveRegion,null,"ui-helper-hidden-accessible"),this._on(this.window,{beforeunload:function(){this.element.removeAttr("autocomplete")}})},_destroy:function(){clearTimeout(this.searching),this.element.removeAttr("autocomplete"),this.menu.element.remove(),this.liveRegion.remove()},_setOption:function(t,e){this._super(t,e),"source"===t&&this._initSource(),"appendTo"===t&&this.menu.element.appendTo(this._appendTo()),"disabled"===t&&e&&this.xhr&&this.xhr.abort()},_isEventTargetInWidget:function(e){var i=this.menu.element[0];return e.target===this.element[0]||e.target===i||t.contains(i,e.target)},_closeOnClickOutside:function(t){this._isEventTargetInWidget(t)||this.close()},_appendTo:function(){var e=this.options.appendTo;return e&&(e=e.jquery||e.nodeType?t(e):this.document.find(e).eq(0)),e&&e[0]||(e=this.element.closest(".ui-front, dialog")),e.length||(e=this.document[0].body),e},_initSource:function(){var e,i,s=this;t.isArray(this.options.source)?(e=this.options.source,this.source=function(i,s){s(t.ui.autocomplete.filter(e,i.term))}):"string"==typeof this.options.source?(i=this.options.source,this.source=function(e,n){s.xhr&&s.xhr.abort(),s.xhr=t.ajax({url:i,data:e,dataType:"json",success:function(t){n(t)},error:function(){n([])}})}):this.source=this.options.source},_searchTimeout:function(t){clearTimeout(this.searching),this.searching=this._delay(function(){var e=this.term===this._value(),i=this.menu.element.is(":visible"),s=t.altKey||t.ctrlKey||t.metaKey||t.shiftKey;(!e||e&&!i&&!s)&&(this.selectedItem=null,this.search(null,t))},this.options.delay)},search:function(t,e){return t=null!=t?t:this._value(),this.term=this._value(),t.length<this.options.minLength?this.close(e):this._trigger("search",e)!==!1?this._search(t):void 0},_search:function(t){this.pending++,this._addClass("ui-autocomplete-loading"),this.cancelSearch=!1,this.source({term:t},this._response())},_response:function(){var e=++this.requestIndex;return t.proxy(function(t){e===this.requestIndex&&this.__response(t),this.pending--,this.pending||this._removeClass("ui-autocomplete-loading")},this)},__response:function(t){t&&(t=this._normalize(t)),this._trigger("response",null,{content:t}),!this.options.disabled&&t&&t.length&&!this.cancelSearch?(this._suggest(t),this._trigger("open")):this._close()},close:function(t){this.cancelSearch=!0,this._close(t)},_close:function(t){this._off(this.document,"mousedown"),this.menu.element.is(":visible")&&(this.menu.element.hide(),this.menu.blur(),this.isNewMenu=!0,this._trigger("close",t))},_change:function(t){this.previous!==this._value()&&this._trigger("change",t,{item:this.selectedItem})},_normalize:function(e){return e.length&&e[0].label&&e[0].value?e:t.map(e,function(e){return"string"==typeof e?{label:e,value:e}:t.extend({},e,{label:e.label||e.value,value:e.value||e.label})})},_suggest:function(e){var i=this.menu.element.empty();this._renderMenu(i,e),this.isNewMenu=!0,this.menu.refresh(),i.show(),this._resizeMenu(),i.position(t.extend({of:this.element},this.options.position)),this.options.autoFocus&&this.menu.next(),this._on(this.document,{mousedown:"_closeOnClickOutside"})},_resizeMenu:function(){var t=this.menu.element;t.outerWidth(Math.max(t.width("").outerWidth()+1,this.element.outerWidth()))},_renderMenu:function(e,i){var s=this;t.each(i,function(t,i){s._renderItemData(e,i)})},_renderItemData:function(t,e){return this._renderItem(t,e).data("ui-autocomplete-item",e)},_renderItem:function(e,i){return t("<li>").append(t("<div>").text(i.label)).appendTo(e)},_move:function(t,e){return this.menu.element.is(":visible")?this.menu.isFirstItem()&&/^previous/.test(t)||this.menu.isLastItem()&&/^next/.test(t)?(this.isMultiLine||this._value(this.term),this.menu.blur(),void 0):(this.menu[t](e),void 0):(this.search(null,e),void 0)},widget:function(){return this.menu.element},_value:function(){return this.valueMethod.apply(this.element,arguments)},_keyEvent:function(t,e){(!this.isMultiLine||this.menu.element.is(":visible"))&&(this._move(t,e),e.preventDefault())},_isContentEditable:function(t){if(!t.length)return!1;var e=t.prop("contentEditable");return"inherit"===e?this._isContentEditable(t.parent()):"true"===e}}),t.extend(t.ui.autocomplete,{escapeRegex:function(t){return t.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g,"\\$&")},filter:function(e,i){var s=RegExp(t.ui.autocomplete.escapeRegex(i),"i");return t.grep(e,function(t){return s.test(t.label||t.value||t)})}}),t.widget("ui.autocomplete",t.ui.autocomplete,{options:{messages:{noResults:"No search results.",results:function(t){return t+(t>1?" results are":" result is")+" available, use up and down arrow keys to navigate."}}},__response:function(e){var i;this._superApply(arguments),this.options.disabled||this.cancelSearch||(i=e&&e.length?this.options.messages.results(e.length):this.options.messages.noResults,this.liveRegion.children().hide(),t("<div>").text(i).appendTo(this.liveRegion))}}),t.ui.autocomplete;var g=/ui-corner-([a-z]){2,6}/g;t.widget("ui.controlgroup",{version:"1.12.1",defaultElement:"<div>",options:{direction:"horizontal",disabled:null,onlyVisible:!0,items:{button:"input[type=button], input[type=submit], input[type=reset], button, a",controlgroupLabel:".ui-controlgroup-label",checkboxradio:"input[type='checkbox'], input[type='radio']",selectmenu:"select",spinner:".ui-spinner-input"}},_create:function(){this._enhance()},_enhance:function(){this.element.attr("role","toolbar"),this.refresh()},_destroy:function(){this._callChildMethod("destroy"),this.childWidgets.removeData("ui-controlgroup-data"),this.element.removeAttr("role"),this.options.items.controlgroupLabel&&this.element.find(this.options.items.controlgroupLabel).find(".ui-controlgroup-label-contents").contents().unwrap()},_initWidgets:function(){var e=this,i=[];t.each(this.options.items,function(s,n){var o,a={};return n?"controlgroupLabel"===s?(o=e.element.find(n),o.each(function(){var e=t(this);e.children(".ui-controlgroup-label-contents").length||e.contents().wrapAll("<span class='ui-controlgroup-label-contents'></span>")}),e._addClass(o,null,"ui-widget ui-widget-content ui-state-default"),i=i.concat(o.get()),void 0):(t.fn[s]&&(a=e["_"+s+"Options"]?e["_"+s+"Options"]("middle"):{classes:{}},e.element.find(n).each(function(){var n=t(this),o=n[s]("instance"),r=t.widget.extend({},a);if("button"!==s||!n.parent(".ui-spinner").length){o||(o=n[s]()[s]("instance")),o&&(r.classes=e._resolveClassesValues(r.classes,o)),n[s](r);var h=n[s]("widget");t.data(h[0],"ui-controlgroup-data",o?o:n[s]("instance")),i.push(h[0])}})),void 0):void 0}),this.childWidgets=t(t.unique(i)),this._addClass(this.childWidgets,"ui-controlgroup-item")},_callChildMethod:function(e){this.childWidgets.each(function(){var i=t(this),s=i.data("ui-controlgroup-data");s&&s[e]&&s[e]()})},_updateCornerClass:function(t,e){var i="ui-corner-top ui-corner-bottom ui-corner-left ui-corner-right ui-corner-all",s=this._buildSimpleOptions(e,"label").classes.label;this._removeClass(t,null,i),this._addClass(t,null,s)},_buildSimpleOptions:function(t,e){var i="vertical"===this.options.direction,s={classes:{}};return s.classes[e]={middle:"",first:"ui-corner-"+(i?"top":"left"),last:"ui-corner-"+(i?"bottom":"right"),only:"ui-corner-all"}[t],s},_spinnerOptions:function(t){var e=this._buildSimpleOptions(t,"ui-spinner");return e.classes["ui-spinner-up"]="",e.classes["ui-spinner-down"]="",e},_buttonOptions:function(t){return this._buildSimpleOptions(t,"ui-button")},_checkboxradioOptions:function(t){return this._buildSimpleOptions(t,"ui-checkboxradio-label")},_selectmenuOptions:function(t){var e="vertical"===this.options.direction;return{width:e?"auto":!1,classes:{middle:{"ui-selectmenu-button-open":"","ui-selectmenu-button-closed":""},first:{"ui-selectmenu-button-open":"ui-corner-"+(e?"top":"tl"),"ui-selectmenu-button-closed":"ui-corner-"+(e?"top":"left")},last:{"ui-selectmenu-button-open":e?"":"ui-corner-tr","ui-selectmenu-button-closed":"ui-corner-"+(e?"bottom":"right")},only:{"ui-selectmenu-button-open":"ui-corner-top","ui-selectmenu-button-closed":"ui-corner-all"}}[t]}},_resolveClassesValues:function(e,i){var s={};return t.each(e,function(n){var o=i.options.classes[n]||"";o=t.trim(o.replace(g,"")),s[n]=(o+" "+e[n]).replace(/\s+/g," ")}),s},_setOption:function(t,e){return"direction"===t&&this._removeClass("ui-controlgroup-"+this.options.direction),this._super(t,e),"disabled"===t?(this._callChildMethod(e?"disable":"enable"),void 0):(this.refresh(),void 0)},refresh:function(){var e,i=this;this._addClass("ui-controlgroup ui-controlgroup-"+this.options.direction),"horizontal"===this.options.direction&&this._addClass(null,"ui-helper-clearfix"),this._initWidgets(),e=this.childWidgets,this.options.onlyVisible&&(e=e.filter(":visible")),e.length&&(t.each(["first","last"],function(t,s){var n=e[s]().data("ui-controlgroup-data");if(n&&i["_"+n.widgetName+"Options"]){var o=i["_"+n.widgetName+"Options"](1===e.length?"only":s);o.classes=i._resolveClassesValues(o.classes,n),n.element[n.widgetName](o)}else i._updateCornerClass(e[s](),s)}),this._callChildMethod("refresh"))}}),t.widget("ui.checkboxradio",[t.ui.formResetMixin,{version:"1.12.1",options:{disabled:null,label:null,icon:!0,classes:{"ui-checkboxradio-label":"ui-corner-all","ui-checkboxradio-icon":"ui-corner-all"}},_getCreateOptions:function(){var e,i,s=this,n=this._super()||{};return this._readType(),i=this.element.labels(),this.label=t(i[i.length-1]),this.label.length||t.error("No label found for checkboxradio widget"),this.originalLabel="",this.label.contents().not(this.element[0]).each(function(){s.originalLabel+=3===this.nodeType?t(this).text():this.outerHTML}),this.originalLabel&&(n.label=this.originalLabel),e=this.element[0].disabled,null!=e&&(n.disabled=e),n},_create:function(){var t=this.element[0].checked;this._bindFormResetHandler(),null==this.options.disabled&&(this.options.disabled=this.element[0].disabled),this._setOption("disabled",this.options.disabled),this._addClass("ui-checkboxradio","ui-helper-hidden-accessible"),this._addClass(this.label,"ui-checkboxradio-label","ui-button ui-widget"),"radio"===this.type&&this._addClass(this.label,"ui-checkboxradio-radio-label"),this.options.label&&this.options.label!==this.originalLabel?this._updateLabel():this.originalLabel&&(this.options.label=this.originalLabel),this._enhance(),t&&(this._addClass(this.label,"ui-checkboxradio-checked","ui-state-active"),this.icon&&this._addClass(this.icon,null,"ui-state-hover")),this._on({change:"_toggleClasses",focus:function(){this._addClass(this.label,null,"ui-state-focus ui-visual-focus")},blur:function(){this._removeClass(this.label,null,"ui-state-focus ui-visual-focus")}})},_readType:function(){var e=this.element[0].nodeName.toLowerCase();this.type=this.element[0].type,"input"===e&&/radio|checkbox/.test(this.type)||t.error("Can't create checkboxradio on element.nodeName="+e+" and element.type="+this.type)},_enhance:function(){this._updateIcon(this.element[0].checked)},widget:function(){return this.label},_getRadioGroup:function(){var e,i=this.element[0].name,s="input[name='"+t.ui.escapeSelector(i)+"']";return i?(e=this.form.length?t(this.form[0].elements).filter(s):t(s).filter(function(){return 0===t(this).form().length}),e.not(this.element)):t([])},_toggleClasses:function(){var e=this.element[0].checked;this._toggleClass(this.label,"ui-checkboxradio-checked","ui-state-active",e),this.options.icon&&"checkbox"===this.type&&this._toggleClass(this.icon,null,"ui-icon-check ui-state-checked",e)._toggleClass(this.icon,null,"ui-icon-blank",!e),"radio"===this.type&&this._getRadioGroup().each(function(){var e=t(this).checkboxradio("instance");e&&e._removeClass(e.label,"ui-checkboxradio-checked","ui-state-active")})},_destroy:function(){this._unbindFormResetHandler(),this.icon&&(this.icon.remove(),this.iconSpace.remove())},_setOption:function(t,e){return"label"!==t||e?(this._super(t,e),"disabled"===t?(this._toggleClass(this.label,null,"ui-state-disabled",e),this.element[0].disabled=e,void 0):(this.refresh(),void 0)):void 0},_updateIcon:function(e){var i="ui-icon ui-icon-background ";this.options.icon?(this.icon||(this.icon=t("<span>"),this.iconSpace=t("<span> </span>"),this._addClass(this.iconSpace,"ui-checkboxradio-icon-space")),"checkbox"===this.type?(i+=e?"ui-icon-check ui-state-checked":"ui-icon-blank",this._removeClass(this.icon,null,e?"ui-icon-blank":"ui-icon-check")):i+="ui-icon-blank",this._addClass(this.icon,"ui-checkboxradio-icon",i),e||this._removeClass(this.icon,null,"ui-icon-check ui-state-checked"),this.icon.prependTo(this.label).after(this.iconSpace)):void 0!==this.icon&&(this.icon.remove(),this.iconSpace.remove(),delete this.icon)},_updateLabel:function(){var t=this.label.contents().not(this.element[0]);this.icon&&(t=t.not(this.icon[0])),this.iconSpace&&(t=t.not(this.iconSpace[0])),t.remove(),this.label.append(this.options.label)},refresh:function(){var t=this.element[0].checked,e=this.element[0].disabled;this._updateIcon(t),this._toggleClass(this.label,"ui-checkboxradio-checked","ui-state-active",t),null!==this.options.label&&this._updateLabel(),e!==this.options.disabled&&this._setOptions({disabled:e})}}]),t.ui.checkboxradio,t.widget("ui.button",{version:"1.12.1",defaultElement:"<button>",options:{classes:{"ui-button":"ui-corner-all"},disabled:null,icon:null,iconPosition:"beginning",label:null,showLabel:!0},_getCreateOptions:function(){var t,e=this._super()||{};return this.isInput=this.element.is("input"),t=this.element[0].disabled,null!=t&&(e.disabled=t),this.originalLabel=this.isInput?this.element.val():this.element.html(),this.originalLabel&&(e.label=this.originalLabel),e},_create:function(){!this.option.showLabel&!this.options.icon&&(this.options.showLabel=!0),null==this.options.disabled&&(this.options.disabled=this.element[0].disabled||!1),this.hasTitle=!!this.element.attr("title"),this.options.label&&this.options.label!==this.originalLabel&&(this.isInput?this.element.val(this.options.label):this.element.html(this.options.label)),this._addClass("ui-button","ui-widget"),this._setOption("disabled",this.options.disabled),this._enhance(),this.element.is("a")&&this._on({keyup:function(e){e.keyCode===t.ui.keyCode.SPACE&&(e.preventDefault(),this.element[0].click?this.element[0].click():this.element.trigger("click"))}})},_enhance:function(){this.element.is("button")||this.element.attr("role","button"),this.options.icon&&(this._updateIcon("icon",this.options.icon),this._updateTooltip())},_updateTooltip:function(){this.title=this.element.attr("title"),this.options.showLabel||this.title||this.element.attr("title",this.options.label)},_updateIcon:function(e,i){var s="iconPosition"!==e,n=s?this.options.iconPosition:i,o="top"===n||"bottom"===n;this.icon?s&&this._removeClass(this.icon,null,this.options.icon):(this.icon=t("<span>"),this._addClass(this.icon,"ui-button-icon","ui-icon"),this.options.showLabel||this._addClass("ui-button-icon-only")),s&&this._addClass(this.icon,null,i),this._attachIcon(n),o?(this._addClass(this.icon,null,"ui-widget-icon-block"),this.iconSpace&&this.iconSpace.remove()):(this.iconSpace||(this.iconSpace=t("<span> </span>"),this._addClass(this.iconSpace,"ui-button-icon-space")),this._removeClass(this.icon,null,"ui-wiget-icon-block"),this._attachIconSpace(n))},_destroy:function(){this.element.removeAttr("role"),this.icon&&this.icon.remove(),this.iconSpace&&this.iconSpace.remove(),this.hasTitle||this.element.removeAttr("title")},_attachIconSpace:function(t){this.icon[/^(?:end|bottom)/.test(t)?"before":"after"](this.iconSpace)},_attachIcon:function(t){this.element[/^(?:end|bottom)/.test(t)?"append":"prepend"](this.icon)},_setOptions:function(t){var e=void 0===t.showLabel?this.options.showLabel:t.showLabel,i=void 0===t.icon?this.options.icon:t.icon;e||i||(t.showLabel=!0),this._super(t)},_setOption:function(t,e){"icon"===t&&(e?this._updateIcon(t,e):this.icon&&(this.icon.remove(),this.iconSpace&&this.iconSpace.remove())),"iconPosition"===t&&this._updateIcon(t,e),"showLabel"===t&&(this._toggleClass("ui-button-icon-only",null,!e),this._updateTooltip()),"label"===t&&(this.isInput?this.element.val(e):(this.element.html(e),this.icon&&(this._attachIcon(this.options.iconPosition),this._attachIconSpace(this.options.iconPosition)))),this._super(t,e),"disabled"===t&&(this._toggleClass(null,"ui-state-disabled",e),this.element[0].disabled=e,e&&this.element.blur())},refresh:function(){var t=this.element.is("input, button")?this.element[0].disabled:this.element.hasClass("ui-button-disabled");t!==this.options.disabled&&this._setOptions({disabled:t}),this._updateTooltip()}}),t.uiBackCompat!==!1&&(t.widget("ui.button",t.ui.button,{options:{text:!0,icons:{primary:null,secondary:null}},_create:function(){this.options.showLabel&&!this.options.text&&(this.options.showLabel=this.options.text),!this.options.showLabel&&this.options.text&&(this.options.text=this.options.showLabel),this.options.icon||!this.options.icons.primary&&!this.options.icons.secondary?this.options.icon&&(this.options.icons.primary=this.options.icon):this.options.icons.primary?this.options.icon=this.options.icons.primary:(this.options.icon=this.options.icons.secondary,this.options.iconPosition="end"),this._super()},_setOption:function(t,e){return"text"===t?(this._super("showLabel",e),void 0):("showLabel"===t&&(this.options.text=e),"icon"===t&&(this.options.icons.primary=e),"icons"===t&&(e.primary?(this._super("icon",e.primary),this._super("iconPosition","beginning")):e.secondary&&(this._super("icon",e.secondary),this._super("iconPosition","end"))),this._superApply(arguments),void 0)}}),t.fn.button=function(e){return function(){return!this.length||this.length&&"INPUT"!==this[0].tagName||this.length&&"INPUT"===this[0].tagName&&"checkbox"!==this.attr("type")&&"radio"!==this.attr("type")?e.apply(this,arguments):(t.ui.checkboxradio||t.error("Checkboxradio widget missing"),0===arguments.length?this.checkboxradio({icon:!1}):this.checkboxradio.apply(this,arguments))}}(t.fn.button),t.fn.buttonset=function(){return t.ui.controlgroup||t.error("Controlgroup widget missing"),"option"===arguments[0]&&"items"===arguments[1]&&arguments[2]?this.controlgroup.apply(this,[arguments[0],"items.button",arguments[2]]):"option"===arguments[0]&&"items"===arguments[1]?this.controlgroup.apply(this,[arguments[0],"items.button"]):("object"==typeof arguments[0]&&arguments[0].items&&(arguments[0].items={button:arguments[0].items}),this.controlgroup.apply(this,arguments))}),t.ui.button,t.extend(t.ui,{datepicker:{version:"1.12.1"}});var m;t.extend(s.prototype,{markerClassName:"hasDatepicker",maxRows:4,_widgetDatepicker:function(){return this.dpDiv},setDefaults:function(t){return a(this._defaults,t||{}),this},_attachDatepicker:function(e,i){var s,n,o;s=e.nodeName.toLowerCase(),n="div"===s||"span"===s,e.id||(this.uuid+=1,e.id="dp"+this.uuid),o=this._newInst(t(e),n),o.settings=t.extend({},i||{}),"input"===s?this._connectDatepicker(e,o):n&&this._inlineDatepicker(e,o)},_newInst:function(e,i){var s=e[0].id.replace(/([^A-Za-z0-9_\-])/g,"\\\\$1");return{id:s,input:e,selectedDay:0,selectedMonth:0,selectedYear:0,drawMonth:0,drawYear:0,inline:i,dpDiv:i?n(t("<div class='"+this._inlineClass+" ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>")):this.dpDiv}},_connectDatepicker:function(e,i){var s=t(e);i.append=t([]),i.trigger=t([]),s.hasClass(this.markerClassName)||(this._attachments(s,i),s.addClass(this.markerClassName).on("keydown",this._doKeyDown).on("keypress",this._doKeyPress).on("keyup",this._doKeyUp),this._autoSize(i),t.data(e,"datepicker",i),i.settings.disabled&&this._disableDatepicker(e))},_attachments:function(e,i){var s,n,o,a=this._get(i,"appendText"),r=this._get(i,"isRTL");i.append&&i.append.remove(),a&&(i.append=t("<span class='"+this._appendClass+"'>"+a+"</span>"),e[r?"before":"after"](i.append)),e.off("focus",this._showDatepicker),i.trigger&&i.trigger.remove(),s=this._get(i,"showOn"),("focus"===s||"both"===s)&&e.on("focus",this._showDatepicker),("button"===s||"both"===s)&&(n=this._get(i,"buttonText"),o=this._get(i,"buttonImage"),i.trigger=t(this._get(i,"buttonImageOnly")?t("<img/>").addClass(this._triggerClass).attr({src:o,alt:n,title:n}):t("<button type='button'></button>").addClass(this._triggerClass).html(o?t("<img/>").attr({src:o,alt:n,title:n}):n)),e[r?"before":"after"](i.trigger),i.trigger.on("click",function(){return t.datepicker._datepickerShowing&&t.datepicker._lastInput===e[0]?t.datepicker._hideDatepicker():t.datepicker._datepickerShowing&&t.datepicker._lastInput!==e[0]?(t.datepicker._hideDatepicker(),t.datepicker._showDatepicker(e[0])):t.datepicker._showDatepicker(e[0]),!1}))},_autoSize:function(t){if(this._get(t,"autoSize")&&!t.inline){var e,i,s,n,o=new Date(2009,11,20),a=this._get(t,"dateFormat");a.match(/[DM]/)&&(e=function(t){for(i=0,s=0,n=0;t.length>n;n++)t[n].length>i&&(i=t[n].length,s=n);return s},o.setMonth(e(this._get(t,a.match(/MM/)?"monthNames":"monthNamesShort"))),o.setDate(e(this._get(t,a.match(/DD/)?"dayNames":"dayNamesShort"))+20-o.getDay())),t.input.attr("size",this._formatDate(t,o).length)}},_inlineDatepicker:function(e,i){var s=t(e);s.hasClass(this.markerClassName)||(s.addClass(this.markerClassName).append(i.dpDiv),t.data(e,"datepicker",i),this._setDate(i,this._getDefaultDate(i),!0),this._updateDatepicker(i),this._updateAlternate(i),i.settings.disabled&&this._disableDatepicker(e),i.dpDiv.css("display","block"))},_dialogDatepicker:function(e,i,s,n,o){var r,h,l,c,u,d=this._dialogInst;return d||(this.uuid+=1,r="dp"+this.uuid,this._dialogInput=t("<input type='text' id='"+r+"' style='position: absolute; top: -100px; width: 0px;'/>"),this._dialogInput.on("keydown",this._doKeyDown),t("body").append(this._dialogInput),d=this._dialogInst=this._newInst(this._dialogInput,!1),d.settings={},t.data(this._dialogInput[0],"datepicker",d)),a(d.settings,n||{}),i=i&&i.constructor===Date?this._formatDate(d,i):i,this._dialogInput.val(i),this._pos=o?o.length?o:[o.pageX,o.pageY]:null,this._pos||(h=document.documentElement.clientWidth,l=document.documentElement.clientHeight,c=document.documentElement.scrollLeft||document.body.scrollLeft,u=document.documentElement.scrollTop||document.body.scrollTop,this._pos=[h/2-100+c,l/2-150+u]),this._dialogInput.css("left",this._pos[0]+20+"px").css("top",this._pos[1]+"px"),d.settings.onSelect=s,this._inDialog=!0,this.dpDiv.addClass(this._dialogClass),this._showDatepicker(this._dialogInput[0]),t.blockUI&&t.blockUI(this.dpDiv),t.data(this._dialogInput[0],"datepicker",d),this},_destroyDatepicker:function(e){var i,s=t(e),n=t.data(e,"datepicker");s.hasClass(this.markerClassName)&&(i=e.nodeName.toLowerCase(),t.removeData(e,"datepicker"),"input"===i?(n.append.remove(),n.trigger.remove(),s.removeClass(this.markerClassName).off("focus",this._showDatepicker).off("keydown",this._doKeyDown).off("keypress",this._doKeyPress).off("keyup",this._doKeyUp)):("div"===i||"span"===i)&&s.removeClass(this.markerClassName).empty(),m===n&&(m=null))},_enableDatepicker:function(e){var i,s,n=t(e),o=t.data(e,"datepicker");n.hasClass(this.markerClassName)&&(i=e.nodeName.toLowerCase(),"input"===i?(e.disabled=!1,o.trigger.filter("button").each(function(){this.disabled=!1}).end().filter("img").css({opacity:"1.0",cursor:""})):("div"===i||"span"===i)&&(s=n.children("."+this._inlineClass),s.children().removeClass("ui-state-disabled"),s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled",!1)),this._disabledInputs=t.map(this._disabledInputs,function(t){return t===e?null:t}))},_disableDatepicker:function(e){var i,s,n=t(e),o=t.data(e,"datepicker");n.hasClass(this.markerClassName)&&(i=e.nodeName.toLowerCase(),"input"===i?(e.disabled=!0,o.trigger.filter("button").each(function(){this.disabled=!0}).end().filter("img").css({opacity:"0.5",cursor:"default"})):("div"===i||"span"===i)&&(s=n.children("."+this._inlineClass),s.children().addClass("ui-state-disabled"),s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled",!0)),this._disabledInputs=t.map(this._disabledInputs,function(t){return t===e?null:t}),this._disabledInputs[this._disabledInputs.length]=e)},_isDisabledDatepicker:function(t){if(!t)return!1;for(var e=0;this._disabledInputs.length>e;e++)if(this._disabledInputs[e]===t)return!0;return!1},_getInst:function(e){try{return t.data(e,"datepicker")}catch(i){throw"Missing instance data for this datepicker"}},_optionDatepicker:function(e,i,s){var n,o,r,h,l=this._getInst(e);return 2===arguments.length&&"string"==typeof i?"defaults"===i?t.extend({},t.datepicker._defaults):l?"all"===i?t.extend({},l.settings):this._get(l,i):null:(n=i||{},"string"==typeof i&&(n={},n[i]=s),l&&(this._curInst===l&&this._hideDatepicker(),o=this._getDateDatepicker(e,!0),r=this._getMinMaxDate(l,"min"),h=this._getMinMaxDate(l,"max"),a(l.settings,n),null!==r&&void 0!==n.dateFormat&&void 0===n.minDate&&(l.settings.minDate=this._formatDate(l,r)),null!==h&&void 0!==n.dateFormat&&void 0===n.maxDate&&(l.settings.maxDate=this._formatDate(l,h)),"disabled"in n&&(n.disabled?this._disableDatepicker(e):this._enableDatepicker(e)),this._attachments(t(e),l),this._autoSize(l),this._setDate(l,o),this._updateAlternate(l),this._updateDatepicker(l)),void 0)},_changeDatepicker:function(t,e,i){this._optionDatepicker(t,e,i)},_refreshDatepicker:function(t){var e=this._getInst(t);e&&this._updateDatepicker(e)},_setDateDatepicker:function(t,e){var i=this._getInst(t);i&&(this._setDate(i,e),this._updateDatepicker(i),this._updateAlternate(i))},_getDateDatepicker:function(t,e){var i=this._getInst(t);return i&&!i.inline&&this._setDateFromField(i,e),i?this._getDate(i):null},_doKeyDown:function(e){var i,s,n,o=t.datepicker._getInst(e.target),a=!0,r=o.dpDiv.is(".ui-datepicker-rtl");if(o._keyEvent=!0,t.datepicker._datepickerShowing)switch(e.keyCode){case 9:t.datepicker._hideDatepicker(),a=!1;break;case 13:return n=t("td."+t.datepicker._dayOverClass+":not(."+t.datepicker._currentClass+")",o.dpDiv),n[0]&&t.datepicker._selectDay(e.target,o.selectedMonth,o.selectedYear,n[0]),i=t.datepicker._get(o,"onSelect"),i?(s=t.datepicker._formatDate(o),i.apply(o.input?o.input[0]:null,[s,o])):t.datepicker._hideDatepicker(),!1;case 27:t.datepicker._hideDatepicker();break;case 33:t.datepicker._adjustDate(e.target,e.ctrlKey?-t.datepicker._get(o,"stepBigMonths"):-t.datepicker._get(o,"stepMonths"),"M");break;case 34:t.datepicker._adjustDate(e.target,e.ctrlKey?+t.datepicker._get(o,"stepBigMonths"):+t.datepicker._get(o,"stepMonths"),"M");break;case 35:(e.ctrlKey||e.metaKey)&&t.datepicker._clearDate(e.target),a=e.ctrlKey||e.metaKey;break;case 36:(e.ctrlKey||e.metaKey)&&t.datepicker._gotoToday(e.target),a=e.ctrlKey||e.metaKey;break;case 37:(e.ctrlKey||e.metaKey)&&t.datepicker._adjustDate(e.target,r?1:-1,"D"),a=e.ctrlKey||e.metaKey,e.originalEvent.altKey&&t.datepicker._adjustDate(e.target,e.ctrlKey?-t.datepicker._get(o,"stepBigMonths"):-t.datepicker._get(o,"stepMonths"),"M");break;case 38:(e.ctrlKey||e.metaKey)&&t.datepicker._adjustDate(e.target,-7,"D"),a=e.ctrlKey||e.metaKey;break;case 39:(e.ctrlKey||e.metaKey)&&t.datepicker._adjustDate(e.target,r?-1:1,"D"),a=e.ctrlKey||e.metaKey,e.originalEvent.altKey&&t.datepicker._adjustDate(e.target,e.ctrlKey?+t.datepicker._get(o,"stepBigMonths"):+t.datepicker._get(o,"stepMonths"),"M");break;case 40:(e.ctrlKey||e.metaKey)&&t.datepicker._adjustDate(e.target,7,"D"),a=e.ctrlKey||e.metaKey;break;default:a=!1}else 36===e.keyCode&&e.ctrlKey?t.datepicker._showDatepicker(this):a=!1;a&&(e.preventDefault(),e.stopPropagation())},_doKeyPress:function(e){var i,s,n=t.datepicker._getInst(e.target);return t.datepicker._get(n,"constrainInput")?(i=t.datepicker._possibleChars(t.datepicker._get(n,"dateFormat")),s=String.fromCharCode(null==e.charCode?e.keyCode:e.charCode),e.ctrlKey||e.metaKey||" ">s||!i||i.indexOf(s)>-1):void 0},_doKeyUp:function(e){var i,s=t.datepicker._getInst(e.target);if(s.input.val()!==s.lastVal)try{i=t.datepicker.parseDate(t.datepicker._get(s,"dateFormat"),s.input?s.input.val():null,t.datepicker._getFormatConfig(s)),i&&(t.datepicker._setDateFromField(s),t.datepicker._updateAlternate(s),t.datepicker._updateDatepicker(s))}catch(n){}return!0},_showDatepicker:function(e){if(e=e.target||e,"input"!==e.nodeName.toLowerCase()&&(e=t("input",e.parentNode)[0]),!t.datepicker._isDisabledDatepicker(e)&&t.datepicker._lastInput!==e){var s,n,o,r,h,l,c;s=t.datepicker._getInst(e),t.datepicker._curInst&&t.datepicker._curInst!==s&&(t.datepicker._curInst.dpDiv.stop(!0,!0),s&&t.datepicker._datepickerShowing&&t.datepicker._hideDatepicker(t.datepicker._curInst.input[0])),n=t.datepicker._get(s,"beforeShow"),o=n?n.apply(e,[e,s]):{},o!==!1&&(a(s.settings,o),s.lastVal=null,t.datepicker._lastInput=e,t.datepicker._setDateFromField(s),t.datepicker._inDialog&&(e.value=""),t.datepicker._pos||(t.datepicker._pos=t.datepicker._findPos(e),t.datepicker._pos[1]+=e.offsetHeight),r=!1,t(e).parents().each(function(){return r|="fixed"===t(this).css("position"),!r}),h={left:t.datepicker._pos[0],top:t.datepicker._pos[1]},t.datepicker._pos=null,s.dpDiv.empty(),s.dpDiv.css({position:"absolute",display:"block",top:"-1000px"}),t.datepicker._updateDatepicker(s),h=t.datepicker._checkOffset(s,h,r),s.dpDiv.css({position:t.datepicker._inDialog&&t.blockUI?"static":r?"fixed":"absolute",display:"none",left:h.left+"px",top:h.top+"px"}),s.inline||(l=t.datepicker._get(s,"showAnim"),c=t.datepicker._get(s,"duration"),s.dpDiv.css("z-index",i(t(e))+1),t.datepicker._datepickerShowing=!0,t.effects&&t.effects.effect[l]?s.dpDiv.show(l,t.datepicker._get(s,"showOptions"),c):s.dpDiv[l||"show"](l?c:null),t.datepicker._shouldFocusInput(s)&&s.input.trigger("focus"),t.datepicker._curInst=s))
}},_updateDatepicker:function(e){this.maxRows=4,m=e,e.dpDiv.empty().append(this._generateHTML(e)),this._attachHandlers(e);var i,s=this._getNumberOfMonths(e),n=s[1],a=17,r=e.dpDiv.find("."+this._dayOverClass+" a");r.length>0&&o.apply(r.get(0)),e.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width(""),n>1&&e.dpDiv.addClass("ui-datepicker-multi-"+n).css("width",a*n+"em"),e.dpDiv[(1!==s[0]||1!==s[1]?"add":"remove")+"Class"]("ui-datepicker-multi"),e.dpDiv[(this._get(e,"isRTL")?"add":"remove")+"Class"]("ui-datepicker-rtl"),e===t.datepicker._curInst&&t.datepicker._datepickerShowing&&t.datepicker._shouldFocusInput(e)&&e.input.trigger("focus"),e.yearshtml&&(i=e.yearshtml,setTimeout(function(){i===e.yearshtml&&e.yearshtml&&e.dpDiv.find("select.ui-datepicker-year:first").replaceWith(e.yearshtml),i=e.yearshtml=null},0))},_shouldFocusInput:function(t){return t.input&&t.input.is(":visible")&&!t.input.is(":disabled")&&!t.input.is(":focus")},_checkOffset:function(e,i,s){var n=e.dpDiv.outerWidth(),o=e.dpDiv.outerHeight(),a=e.input?e.input.outerWidth():0,r=e.input?e.input.outerHeight():0,h=document.documentElement.clientWidth+(s?0:t(document).scrollLeft()),l=document.documentElement.clientHeight+(s?0:t(document).scrollTop());return i.left-=this._get(e,"isRTL")?n-a:0,i.left-=s&&i.left===e.input.offset().left?t(document).scrollLeft():0,i.top-=s&&i.top===e.input.offset().top+r?t(document).scrollTop():0,i.left-=Math.min(i.left,i.left+n>h&&h>n?Math.abs(i.left+n-h):0),i.top-=Math.min(i.top,i.top+o>l&&l>o?Math.abs(o+r):0),i},_findPos:function(e){for(var i,s=this._getInst(e),n=this._get(s,"isRTL");e&&("hidden"===e.type||1!==e.nodeType||t.expr.filters.hidden(e));)e=e[n?"previousSibling":"nextSibling"];return i=t(e).offset(),[i.left,i.top]},_hideDatepicker:function(e){var i,s,n,o,a=this._curInst;!a||e&&a!==t.data(e,"datepicker")||this._datepickerShowing&&(i=this._get(a,"showAnim"),s=this._get(a,"duration"),n=function(){t.datepicker._tidyDialog(a)},t.effects&&(t.effects.effect[i]||t.effects[i])?a.dpDiv.hide(i,t.datepicker._get(a,"showOptions"),s,n):a.dpDiv["slideDown"===i?"slideUp":"fadeIn"===i?"fadeOut":"hide"](i?s:null,n),i||n(),this._datepickerShowing=!1,o=this._get(a,"onClose"),o&&o.apply(a.input?a.input[0]:null,[a.input?a.input.val():"",a]),this._lastInput=null,this._inDialog&&(this._dialogInput.css({position:"absolute",left:"0",top:"-100px"}),t.blockUI&&(t.unblockUI(),t("body").append(this.dpDiv))),this._inDialog=!1)},_tidyDialog:function(t){t.dpDiv.removeClass(this._dialogClass).off(".ui-datepicker-calendar")},_checkExternalClick:function(e){if(t.datepicker._curInst){var i=t(e.target),s=t.datepicker._getInst(i[0]);(i[0].id!==t.datepicker._mainDivId&&0===i.parents("#"+t.datepicker._mainDivId).length&&!i.hasClass(t.datepicker.markerClassName)&&!i.closest("."+t.datepicker._triggerClass).length&&t.datepicker._datepickerShowing&&(!t.datepicker._inDialog||!t.blockUI)||i.hasClass(t.datepicker.markerClassName)&&t.datepicker._curInst!==s)&&t.datepicker._hideDatepicker()}},_adjustDate:function(e,i,s){var n=t(e),o=this._getInst(n[0]);this._isDisabledDatepicker(n[0])||(this._adjustInstDate(o,i+("M"===s?this._get(o,"showCurrentAtPos"):0),s),this._updateDatepicker(o))},_gotoToday:function(e){var i,s=t(e),n=this._getInst(s[0]);this._get(n,"gotoCurrent")&&n.currentDay?(n.selectedDay=n.currentDay,n.drawMonth=n.selectedMonth=n.currentMonth,n.drawYear=n.selectedYear=n.currentYear):(i=new Date,n.selectedDay=i.getDate(),n.drawMonth=n.selectedMonth=i.getMonth(),n.drawYear=n.selectedYear=i.getFullYear()),this._notifyChange(n),this._adjustDate(s)},_selectMonthYear:function(e,i,s){var n=t(e),o=this._getInst(n[0]);o["selected"+("M"===s?"Month":"Year")]=o["draw"+("M"===s?"Month":"Year")]=parseInt(i.options[i.selectedIndex].value,10),this._notifyChange(o),this._adjustDate(n)},_selectDay:function(e,i,s,n){var o,a=t(e);t(n).hasClass(this._unselectableClass)||this._isDisabledDatepicker(a[0])||(o=this._getInst(a[0]),o.selectedDay=o.currentDay=t("a",n).html(),o.selectedMonth=o.currentMonth=i,o.selectedYear=o.currentYear=s,this._selectDate(e,this._formatDate(o,o.currentDay,o.currentMonth,o.currentYear)))},_clearDate:function(e){var i=t(e);this._selectDate(i,"")},_selectDate:function(e,i){var s,n=t(e),o=this._getInst(n[0]);i=null!=i?i:this._formatDate(o),o.input&&o.input.val(i),this._updateAlternate(o),s=this._get(o,"onSelect"),s?s.apply(o.input?o.input[0]:null,[i,o]):o.input&&o.input.trigger("change"),o.inline?this._updateDatepicker(o):(this._hideDatepicker(),this._lastInput=o.input[0],"object"!=typeof o.input[0]&&o.input.trigger("focus"),this._lastInput=null)},_updateAlternate:function(e){var i,s,n,o=this._get(e,"altField");o&&(i=this._get(e,"altFormat")||this._get(e,"dateFormat"),s=this._getDate(e),n=this.formatDate(i,s,this._getFormatConfig(e)),t(o).val(n))},noWeekends:function(t){var e=t.getDay();return[e>0&&6>e,""]},iso8601Week:function(t){var e,i=new Date(t.getTime());return i.setDate(i.getDate()+4-(i.getDay()||7)),e=i.getTime(),i.setMonth(0),i.setDate(1),Math.floor(Math.round((e-i)/864e5)/7)+1},parseDate:function(e,i,s){if(null==e||null==i)throw"Invalid arguments";if(i="object"==typeof i?""+i:i+"",""===i)return null;var n,o,a,r,h=0,l=(s?s.shortYearCutoff:null)||this._defaults.shortYearCutoff,c="string"!=typeof l?l:(new Date).getFullYear()%100+parseInt(l,10),u=(s?s.dayNamesShort:null)||this._defaults.dayNamesShort,d=(s?s.dayNames:null)||this._defaults.dayNames,p=(s?s.monthNamesShort:null)||this._defaults.monthNamesShort,f=(s?s.monthNames:null)||this._defaults.monthNames,g=-1,m=-1,_=-1,v=-1,b=!1,y=function(t){var i=e.length>n+1&&e.charAt(n+1)===t;return i&&n++,i},w=function(t){var e=y(t),s="@"===t?14:"!"===t?20:"y"===t&&e?4:"o"===t?3:2,n="y"===t?s:1,o=RegExp("^\\d{"+n+","+s+"}"),a=i.substring(h).match(o);if(!a)throw"Missing number at position "+h;return h+=a[0].length,parseInt(a[0],10)},k=function(e,s,n){var o=-1,a=t.map(y(e)?n:s,function(t,e){return[[e,t]]}).sort(function(t,e){return-(t[1].length-e[1].length)});if(t.each(a,function(t,e){var s=e[1];return i.substr(h,s.length).toLowerCase()===s.toLowerCase()?(o=e[0],h+=s.length,!1):void 0}),-1!==o)return o+1;throw"Unknown name at position "+h},x=function(){if(i.charAt(h)!==e.charAt(n))throw"Unexpected literal at position "+h;h++};for(n=0;e.length>n;n++)if(b)"'"!==e.charAt(n)||y("'")?x():b=!1;else switch(e.charAt(n)){case"d":_=w("d");break;case"D":k("D",u,d);break;case"o":v=w("o");break;case"m":m=w("m");break;case"M":m=k("M",p,f);break;case"y":g=w("y");break;case"@":r=new Date(w("@")),g=r.getFullYear(),m=r.getMonth()+1,_=r.getDate();break;case"!":r=new Date((w("!")-this._ticksTo1970)/1e4),g=r.getFullYear(),m=r.getMonth()+1,_=r.getDate();break;case"'":y("'")?x():b=!0;break;default:x()}if(i.length>h&&(a=i.substr(h),!/^\s+/.test(a)))throw"Extra/unparsed characters found in date: "+a;if(-1===g?g=(new Date).getFullYear():100>g&&(g+=(new Date).getFullYear()-(new Date).getFullYear()%100+(c>=g?0:-100)),v>-1)for(m=1,_=v;;){if(o=this._getDaysInMonth(g,m-1),o>=_)break;m++,_-=o}if(r=this._daylightSavingAdjust(new Date(g,m-1,_)),r.getFullYear()!==g||r.getMonth()+1!==m||r.getDate()!==_)throw"Invalid date";return r},ATOM:"yy-mm-dd",COOKIE:"D, dd M yy",ISO_8601:"yy-mm-dd",RFC_822:"D, d M y",RFC_850:"DD, dd-M-y",RFC_1036:"D, d M y",RFC_1123:"D, d M yy",RFC_2822:"D, d M yy",RSS:"D, d M y",TICKS:"!",TIMESTAMP:"@",W3C:"yy-mm-dd",_ticksTo1970:1e7*60*60*24*(718685+Math.floor(492.5)-Math.floor(19.7)+Math.floor(4.925)),formatDate:function(t,e,i){if(!e)return"";var s,n=(i?i.dayNamesShort:null)||this._defaults.dayNamesShort,o=(i?i.dayNames:null)||this._defaults.dayNames,a=(i?i.monthNamesShort:null)||this._defaults.monthNamesShort,r=(i?i.monthNames:null)||this._defaults.monthNames,h=function(e){var i=t.length>s+1&&t.charAt(s+1)===e;return i&&s++,i},l=function(t,e,i){var s=""+e;if(h(t))for(;i>s.length;)s="0"+s;return s},c=function(t,e,i,s){return h(t)?s[e]:i[e]},u="",d=!1;if(e)for(s=0;t.length>s;s++)if(d)"'"!==t.charAt(s)||h("'")?u+=t.charAt(s):d=!1;else switch(t.charAt(s)){case"d":u+=l("d",e.getDate(),2);break;case"D":u+=c("D",e.getDay(),n,o);break;case"o":u+=l("o",Math.round((new Date(e.getFullYear(),e.getMonth(),e.getDate()).getTime()-new Date(e.getFullYear(),0,0).getTime())/864e5),3);break;case"m":u+=l("m",e.getMonth()+1,2);break;case"M":u+=c("M",e.getMonth(),a,r);break;case"y":u+=h("y")?e.getFullYear():(10>e.getFullYear()%100?"0":"")+e.getFullYear()%100;break;case"@":u+=e.getTime();break;case"!":u+=1e4*e.getTime()+this._ticksTo1970;break;case"'":h("'")?u+="'":d=!0;break;default:u+=t.charAt(s)}return u},_possibleChars:function(t){var e,i="",s=!1,n=function(i){var s=t.length>e+1&&t.charAt(e+1)===i;return s&&e++,s};for(e=0;t.length>e;e++)if(s)"'"!==t.charAt(e)||n("'")?i+=t.charAt(e):s=!1;else switch(t.charAt(e)){case"d":case"m":case"y":case"@":i+="0123456789";break;case"D":case"M":return null;case"'":n("'")?i+="'":s=!0;break;default:i+=t.charAt(e)}return i},_get:function(t,e){return void 0!==t.settings[e]?t.settings[e]:this._defaults[e]},_setDateFromField:function(t,e){if(t.input.val()!==t.lastVal){var i=this._get(t,"dateFormat"),s=t.lastVal=t.input?t.input.val():null,n=this._getDefaultDate(t),o=n,a=this._getFormatConfig(t);try{o=this.parseDate(i,s,a)||n}catch(r){s=e?"":s}t.selectedDay=o.getDate(),t.drawMonth=t.selectedMonth=o.getMonth(),t.drawYear=t.selectedYear=o.getFullYear(),t.currentDay=s?o.getDate():0,t.currentMonth=s?o.getMonth():0,t.currentYear=s?o.getFullYear():0,this._adjustInstDate(t)}},_getDefaultDate:function(t){return this._restrictMinMax(t,this._determineDate(t,this._get(t,"defaultDate"),new Date))},_determineDate:function(e,i,s){var n=function(t){var e=new Date;return e.setDate(e.getDate()+t),e},o=function(i){try{return t.datepicker.parseDate(t.datepicker._get(e,"dateFormat"),i,t.datepicker._getFormatConfig(e))}catch(s){}for(var n=(i.toLowerCase().match(/^c/)?t.datepicker._getDate(e):null)||new Date,o=n.getFullYear(),a=n.getMonth(),r=n.getDate(),h=/([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g,l=h.exec(i);l;){switch(l[2]||"d"){case"d":case"D":r+=parseInt(l[1],10);break;case"w":case"W":r+=7*parseInt(l[1],10);break;case"m":case"M":a+=parseInt(l[1],10),r=Math.min(r,t.datepicker._getDaysInMonth(o,a));break;case"y":case"Y":o+=parseInt(l[1],10),r=Math.min(r,t.datepicker._getDaysInMonth(o,a))}l=h.exec(i)}return new Date(o,a,r)},a=null==i||""===i?s:"string"==typeof i?o(i):"number"==typeof i?isNaN(i)?s:n(i):new Date(i.getTime());return a=a&&"Invalid Date"==""+a?s:a,a&&(a.setHours(0),a.setMinutes(0),a.setSeconds(0),a.setMilliseconds(0)),this._daylightSavingAdjust(a)},_daylightSavingAdjust:function(t){return t?(t.setHours(t.getHours()>12?t.getHours()+2:0),t):null},_setDate:function(t,e,i){var s=!e,n=t.selectedMonth,o=t.selectedYear,a=this._restrictMinMax(t,this._determineDate(t,e,new Date));t.selectedDay=t.currentDay=a.getDate(),t.drawMonth=t.selectedMonth=t.currentMonth=a.getMonth(),t.drawYear=t.selectedYear=t.currentYear=a.getFullYear(),n===t.selectedMonth&&o===t.selectedYear||i||this._notifyChange(t),this._adjustInstDate(t),t.input&&t.input.val(s?"":this._formatDate(t))},_getDate:function(t){var e=!t.currentYear||t.input&&""===t.input.val()?null:this._daylightSavingAdjust(new Date(t.currentYear,t.currentMonth,t.currentDay));return e},_attachHandlers:function(e){var i=this._get(e,"stepMonths"),s="#"+e.id.replace(/\\\\/g,"\\");e.dpDiv.find("[data-handler]").map(function(){var e={prev:function(){t.datepicker._adjustDate(s,-i,"M")},next:function(){t.datepicker._adjustDate(s,+i,"M")},hide:function(){t.datepicker._hideDatepicker()},today:function(){t.datepicker._gotoToday(s)},selectDay:function(){return t.datepicker._selectDay(s,+this.getAttribute("data-month"),+this.getAttribute("data-year"),this),!1},selectMonth:function(){return t.datepicker._selectMonthYear(s,this,"M"),!1},selectYear:function(){return t.datepicker._selectMonthYear(s,this,"Y"),!1}};t(this).on(this.getAttribute("data-event"),e[this.getAttribute("data-handler")])})},_generateHTML:function(t){var e,i,s,n,o,a,r,h,l,c,u,d,p,f,g,m,_,v,b,y,w,k,x,C,D,I,T,P,M,S,H,z,O,A,N,W,E,F,L,R=new Date,B=this._daylightSavingAdjust(new Date(R.getFullYear(),R.getMonth(),R.getDate())),Y=this._get(t,"isRTL"),j=this._get(t,"showButtonPanel"),q=this._get(t,"hideIfNoPrevNext"),K=this._get(t,"navigationAsDateFormat"),U=this._getNumberOfMonths(t),V=this._get(t,"showCurrentAtPos"),$=this._get(t,"stepMonths"),X=1!==U[0]||1!==U[1],G=this._daylightSavingAdjust(t.currentDay?new Date(t.currentYear,t.currentMonth,t.currentDay):new Date(9999,9,9)),Q=this._getMinMaxDate(t,"min"),J=this._getMinMaxDate(t,"max"),Z=t.drawMonth-V,te=t.drawYear;if(0>Z&&(Z+=12,te--),J)for(e=this._daylightSavingAdjust(new Date(J.getFullYear(),J.getMonth()-U[0]*U[1]+1,J.getDate())),e=Q&&Q>e?Q:e;this._daylightSavingAdjust(new Date(te,Z,1))>e;)Z--,0>Z&&(Z=11,te--);for(t.drawMonth=Z,t.drawYear=te,i=this._get(t,"prevText"),i=K?this.formatDate(i,this._daylightSavingAdjust(new Date(te,Z-$,1)),this._getFormatConfig(t)):i,s=this._canAdjustMonth(t,-1,te,Z)?"<a class='ui-datepicker-prev ui-corner-all' data-handler='prev' data-event='click' title='"+i+"'><span class='ui-icon ui-icon-circle-triangle-"+(Y?"e":"w")+"'>"+i+"</span></a>":q?"":"<a class='ui-datepicker-prev ui-corner-all ui-state-disabled' title='"+i+"'><span class='ui-icon ui-icon-circle-triangle-"+(Y?"e":"w")+"'>"+i+"</span></a>",n=this._get(t,"nextText"),n=K?this.formatDate(n,this._daylightSavingAdjust(new Date(te,Z+$,1)),this._getFormatConfig(t)):n,o=this._canAdjustMonth(t,1,te,Z)?"<a class='ui-datepicker-next ui-corner-all' data-handler='next' data-event='click' title='"+n+"'><span class='ui-icon ui-icon-circle-triangle-"+(Y?"w":"e")+"'>"+n+"</span></a>":q?"":"<a class='ui-datepicker-next ui-corner-all ui-state-disabled' title='"+n+"'><span class='ui-icon ui-icon-circle-triangle-"+(Y?"w":"e")+"'>"+n+"</span></a>",a=this._get(t,"currentText"),r=this._get(t,"gotoCurrent")&&t.currentDay?G:B,a=K?this.formatDate(a,r,this._getFormatConfig(t)):a,h=t.inline?"":"<button type='button' class='ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all' data-handler='hide' data-event='click'>"+this._get(t,"closeText")+"</button>",l=j?"<div class='ui-datepicker-buttonpane ui-widget-content'>"+(Y?h:"")+(this._isInRange(t,r)?"<button type='button' class='ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all' data-handler='today' data-event='click'>"+a+"</button>":"")+(Y?"":h)+"</div>":"",c=parseInt(this._get(t,"firstDay"),10),c=isNaN(c)?0:c,u=this._get(t,"showWeek"),d=this._get(t,"dayNames"),p=this._get(t,"dayNamesMin"),f=this._get(t,"monthNames"),g=this._get(t,"monthNamesShort"),m=this._get(t,"beforeShowDay"),_=this._get(t,"showOtherMonths"),v=this._get(t,"selectOtherMonths"),b=this._getDefaultDate(t),y="",k=0;U[0]>k;k++){for(x="",this.maxRows=4,C=0;U[1]>C;C++){if(D=this._daylightSavingAdjust(new Date(te,Z,t.selectedDay)),I=" ui-corner-all",T="",X){if(T+="<div class='ui-datepicker-group",U[1]>1)switch(C){case 0:T+=" ui-datepicker-group-first",I=" ui-corner-"+(Y?"right":"left");break;case U[1]-1:T+=" ui-datepicker-group-last",I=" ui-corner-"+(Y?"left":"right");break;default:T+=" ui-datepicker-group-middle",I=""}T+="'>"}for(T+="<div class='ui-datepicker-header ui-widget-header ui-helper-clearfix"+I+"'>"+(/all|left/.test(I)&&0===k?Y?o:s:"")+(/all|right/.test(I)&&0===k?Y?s:o:"")+this._generateMonthYearHeader(t,Z,te,Q,J,k>0||C>0,f,g)+"</div><table class='ui-datepicker-calendar'><thead>"+"<tr>",P=u?"<th class='ui-datepicker-week-col'>"+this._get(t,"weekHeader")+"</th>":"",w=0;7>w;w++)M=(w+c)%7,P+="<th scope='col'"+((w+c+6)%7>=5?" class='ui-datepicker-week-end'":"")+">"+"<span title='"+d[M]+"'>"+p[M]+"</span></th>";for(T+=P+"</tr></thead><tbody>",S=this._getDaysInMonth(te,Z),te===t.selectedYear&&Z===t.selectedMonth&&(t.selectedDay=Math.min(t.selectedDay,S)),H=(this._getFirstDayOfMonth(te,Z)-c+7)%7,z=Math.ceil((H+S)/7),O=X?this.maxRows>z?this.maxRows:z:z,this.maxRows=O,A=this._daylightSavingAdjust(new Date(te,Z,1-H)),N=0;O>N;N++){for(T+="<tr>",W=u?"<td class='ui-datepicker-week-col'>"+this._get(t,"calculateWeek")(A)+"</td>":"",w=0;7>w;w++)E=m?m.apply(t.input?t.input[0]:null,[A]):[!0,""],F=A.getMonth()!==Z,L=F&&!v||!E[0]||Q&&Q>A||J&&A>J,W+="<td class='"+((w+c+6)%7>=5?" ui-datepicker-week-end":"")+(F?" ui-datepicker-other-month":"")+(A.getTime()===D.getTime()&&Z===t.selectedMonth&&t._keyEvent||b.getTime()===A.getTime()&&b.getTime()===D.getTime()?" "+this._dayOverClass:"")+(L?" "+this._unselectableClass+" ui-state-disabled":"")+(F&&!_?"":" "+E[1]+(A.getTime()===G.getTime()?" "+this._currentClass:"")+(A.getTime()===B.getTime()?" ui-datepicker-today":""))+"'"+(F&&!_||!E[2]?"":" title='"+E[2].replace(/'/g,"&#39;")+"'")+(L?"":" data-handler='selectDay' data-event='click' data-month='"+A.getMonth()+"' data-year='"+A.getFullYear()+"'")+">"+(F&&!_?"&#xa0;":L?"<span class='ui-state-default'>"+A.getDate()+"</span>":"<a class='ui-state-default"+(A.getTime()===B.getTime()?" ui-state-highlight":"")+(A.getTime()===G.getTime()?" ui-state-active":"")+(F?" ui-priority-secondary":"")+"' href='#'>"+A.getDate()+"</a>")+"</td>",A.setDate(A.getDate()+1),A=this._daylightSavingAdjust(A);T+=W+"</tr>"}Z++,Z>11&&(Z=0,te++),T+="</tbody></table>"+(X?"</div>"+(U[0]>0&&C===U[1]-1?"<div class='ui-datepicker-row-break'></div>":""):""),x+=T}y+=x}return y+=l,t._keyEvent=!1,y},_generateMonthYearHeader:function(t,e,i,s,n,o,a,r){var h,l,c,u,d,p,f,g,m=this._get(t,"changeMonth"),_=this._get(t,"changeYear"),v=this._get(t,"showMonthAfterYear"),b="<div class='ui-datepicker-title'>",y="";if(o||!m)y+="<span class='ui-datepicker-month'>"+a[e]+"</span>";else{for(h=s&&s.getFullYear()===i,l=n&&n.getFullYear()===i,y+="<select class='ui-datepicker-month' data-handler='selectMonth' data-event='change'>",c=0;12>c;c++)(!h||c>=s.getMonth())&&(!l||n.getMonth()>=c)&&(y+="<option value='"+c+"'"+(c===e?" selected='selected'":"")+">"+r[c]+"</option>");y+="</select>"}if(v||(b+=y+(!o&&m&&_?"":"&#xa0;")),!t.yearshtml)if(t.yearshtml="",o||!_)b+="<span class='ui-datepicker-year'>"+i+"</span>";else{for(u=this._get(t,"yearRange").split(":"),d=(new Date).getFullYear(),p=function(t){var e=t.match(/c[+\-].*/)?i+parseInt(t.substring(1),10):t.match(/[+\-].*/)?d+parseInt(t,10):parseInt(t,10);return isNaN(e)?d:e},f=p(u[0]),g=Math.max(f,p(u[1]||"")),f=s?Math.max(f,s.getFullYear()):f,g=n?Math.min(g,n.getFullYear()):g,t.yearshtml+="<select class='ui-datepicker-year' data-handler='selectYear' data-event='change'>";g>=f;f++)t.yearshtml+="<option value='"+f+"'"+(f===i?" selected='selected'":"")+">"+f+"</option>";t.yearshtml+="</select>",b+=t.yearshtml,t.yearshtml=null}return b+=this._get(t,"yearSuffix"),v&&(b+=(!o&&m&&_?"":"&#xa0;")+y),b+="</div>"},_adjustInstDate:function(t,e,i){var s=t.selectedYear+("Y"===i?e:0),n=t.selectedMonth+("M"===i?e:0),o=Math.min(t.selectedDay,this._getDaysInMonth(s,n))+("D"===i?e:0),a=this._restrictMinMax(t,this._daylightSavingAdjust(new Date(s,n,o)));t.selectedDay=a.getDate(),t.drawMonth=t.selectedMonth=a.getMonth(),t.drawYear=t.selectedYear=a.getFullYear(),("M"===i||"Y"===i)&&this._notifyChange(t)},_restrictMinMax:function(t,e){var i=this._getMinMaxDate(t,"min"),s=this._getMinMaxDate(t,"max"),n=i&&i>e?i:e;return s&&n>s?s:n},_notifyChange:function(t){var e=this._get(t,"onChangeMonthYear");e&&e.apply(t.input?t.input[0]:null,[t.selectedYear,t.selectedMonth+1,t])},_getNumberOfMonths:function(t){var e=this._get(t,"numberOfMonths");return null==e?[1,1]:"number"==typeof e?[1,e]:e},_getMinMaxDate:function(t,e){return this._determineDate(t,this._get(t,e+"Date"),null)},_getDaysInMonth:function(t,e){return 32-this._daylightSavingAdjust(new Date(t,e,32)).getDate()},_getFirstDayOfMonth:function(t,e){return new Date(t,e,1).getDay()},_canAdjustMonth:function(t,e,i,s){var n=this._getNumberOfMonths(t),o=this._daylightSavingAdjust(new Date(i,s+(0>e?e:n[0]*n[1]),1));return 0>e&&o.setDate(this._getDaysInMonth(o.getFullYear(),o.getMonth())),this._isInRange(t,o)},_isInRange:function(t,e){var i,s,n=this._getMinMaxDate(t,"min"),o=this._getMinMaxDate(t,"max"),a=null,r=null,h=this._get(t,"yearRange");return h&&(i=h.split(":"),s=(new Date).getFullYear(),a=parseInt(i[0],10),r=parseInt(i[1],10),i[0].match(/[+\-].*/)&&(a+=s),i[1].match(/[+\-].*/)&&(r+=s)),(!n||e.getTime()>=n.getTime())&&(!o||e.getTime()<=o.getTime())&&(!a||e.getFullYear()>=a)&&(!r||r>=e.getFullYear())},_getFormatConfig:function(t){var e=this._get(t,"shortYearCutoff");return e="string"!=typeof e?e:(new Date).getFullYear()%100+parseInt(e,10),{shortYearCutoff:e,dayNamesShort:this._get(t,"dayNamesShort"),dayNames:this._get(t,"dayNames"),monthNamesShort:this._get(t,"monthNamesShort"),monthNames:this._get(t,"monthNames")}},_formatDate:function(t,e,i,s){e||(t.currentDay=t.selectedDay,t.currentMonth=t.selectedMonth,t.currentYear=t.selectedYear);var n=e?"object"==typeof e?e:this._daylightSavingAdjust(new Date(s,i,e)):this._daylightSavingAdjust(new Date(t.currentYear,t.currentMonth,t.currentDay));return this.formatDate(this._get(t,"dateFormat"),n,this._getFormatConfig(t))}}),t.fn.datepicker=function(e){if(!this.length)return this;t.datepicker.initialized||(t(document).on("mousedown",t.datepicker._checkExternalClick),t.datepicker.initialized=!0),0===t("#"+t.datepicker._mainDivId).length&&t("body").append(t.datepicker.dpDiv);var i=Array.prototype.slice.call(arguments,1);return"string"!=typeof e||"isDisabled"!==e&&"getDate"!==e&&"widget"!==e?"option"===e&&2===arguments.length&&"string"==typeof arguments[1]?t.datepicker["_"+e+"Datepicker"].apply(t.datepicker,[this[0]].concat(i)):this.each(function(){"string"==typeof e?t.datepicker["_"+e+"Datepicker"].apply(t.datepicker,[this].concat(i)):t.datepicker._attachDatepicker(this,e)}):t.datepicker["_"+e+"Datepicker"].apply(t.datepicker,[this[0]].concat(i))},t.datepicker=new s,t.datepicker.initialized=!1,t.datepicker.uuid=(new Date).getTime(),t.datepicker.version="1.12.1",t.datepicker,t.ui.ie=!!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase());var _=!1;t(document).on("mouseup",function(){_=!1}),t.widget("ui.mouse",{version:"1.12.1",options:{cancel:"input, textarea, button, select, option",distance:1,delay:0},_mouseInit:function(){var e=this;this.element.on("mousedown."+this.widgetName,function(t){return e._mouseDown(t)}).on("click."+this.widgetName,function(i){return!0===t.data(i.target,e.widgetName+".preventClickEvent")?(t.removeData(i.target,e.widgetName+".preventClickEvent"),i.stopImmediatePropagation(),!1):void 0}),this.started=!1},_mouseDestroy:function(){this.element.off("."+this.widgetName),this._mouseMoveDelegate&&this.document.off("mousemove."+this.widgetName,this._mouseMoveDelegate).off("mouseup."+this.widgetName,this._mouseUpDelegate)},_mouseDown:function(e){if(!_){this._mouseMoved=!1,this._mouseStarted&&this._mouseUp(e),this._mouseDownEvent=e;var i=this,s=1===e.which,n="string"==typeof this.options.cancel&&e.target.nodeName?t(e.target).closest(this.options.cancel).length:!1;return s&&!n&&this._mouseCapture(e)?(this.mouseDelayMet=!this.options.delay,this.mouseDelayMet||(this._mouseDelayTimer=setTimeout(function(){i.mouseDelayMet=!0},this.options.delay)),this._mouseDistanceMet(e)&&this._mouseDelayMet(e)&&(this._mouseStarted=this._mouseStart(e)!==!1,!this._mouseStarted)?(e.preventDefault(),!0):(!0===t.data(e.target,this.widgetName+".preventClickEvent")&&t.removeData(e.target,this.widgetName+".preventClickEvent"),this._mouseMoveDelegate=function(t){return i._mouseMove(t)},this._mouseUpDelegate=function(t){return i._mouseUp(t)},this.document.on("mousemove."+this.widgetName,this._mouseMoveDelegate).on("mouseup."+this.widgetName,this._mouseUpDelegate),e.preventDefault(),_=!0,!0)):!0}},_mouseMove:function(e){if(this._mouseMoved){if(t.ui.ie&&(!document.documentMode||9>document.documentMode)&&!e.button)return this._mouseUp(e);if(!e.which)if(e.originalEvent.altKey||e.originalEvent.ctrlKey||e.originalEvent.metaKey||e.originalEvent.shiftKey)this.ignoreMissingWhich=!0;else if(!this.ignoreMissingWhich)return this._mouseUp(e)}return(e.which||e.button)&&(this._mouseMoved=!0),this._mouseStarted?(this._mouseDrag(e),e.preventDefault()):(this._mouseDistanceMet(e)&&this._mouseDelayMet(e)&&(this._mouseStarted=this._mouseStart(this._mouseDownEvent,e)!==!1,this._mouseStarted?this._mouseDrag(e):this._mouseUp(e)),!this._mouseStarted)},_mouseUp:function(e){this.document.off("mousemove."+this.widgetName,this._mouseMoveDelegate).off("mouseup."+this.widgetName,this._mouseUpDelegate),this._mouseStarted&&(this._mouseStarted=!1,e.target===this._mouseDownEvent.target&&t.data(e.target,this.widgetName+".preventClickEvent",!0),this._mouseStop(e)),this._mouseDelayTimer&&(clearTimeout(this._mouseDelayTimer),delete this._mouseDelayTimer),this.ignoreMissingWhich=!1,_=!1,e.preventDefault()},_mouseDistanceMet:function(t){return Math.max(Math.abs(this._mouseDownEvent.pageX-t.pageX),Math.abs(this._mouseDownEvent.pageY-t.pageY))>=this.options.distance},_mouseDelayMet:function(){return this.mouseDelayMet},_mouseStart:function(){},_mouseDrag:function(){},_mouseStop:function(){},_mouseCapture:function(){return!0}}),t.ui.plugin={add:function(e,i,s){var n,o=t.ui[e].prototype;for(n in s)o.plugins[n]=o.plugins[n]||[],o.plugins[n].push([i,s[n]])},call:function(t,e,i,s){var n,o=t.plugins[e];if(o&&(s||t.element[0].parentNode&&11!==t.element[0].parentNode.nodeType))for(n=0;o.length>n;n++)t.options[o[n][0]]&&o[n][1].apply(t.element,i)}},t.ui.safeBlur=function(e){e&&"body"!==e.nodeName.toLowerCase()&&t(e).trigger("blur")},t.widget("ui.draggable",t.ui.mouse,{version:"1.12.1",widgetEventPrefix:"drag",options:{addClasses:!0,appendTo:"parent",axis:!1,connectToSortable:!1,containment:!1,cursor:"auto",cursorAt:!1,grid:!1,handle:!1,helper:"original",iframeFix:!1,opacity:!1,refreshPositions:!1,revert:!1,revertDuration:500,scope:"default",scroll:!0,scrollSensitivity:20,scrollSpeed:20,snap:!1,snapMode:"both",snapTolerance:20,stack:!1,zIndex:!1,drag:null,start:null,stop:null},_create:function(){"original"===this.options.helper&&this._setPositionRelative(),this.options.addClasses&&this._addClass("ui-draggable"),this._setHandleClassName(),this._mouseInit()},_setOption:function(t,e){this._super(t,e),"handle"===t&&(this._removeHandleClassName(),this._setHandleClassName())},_destroy:function(){return(this.helper||this.element).is(".ui-draggable-dragging")?(this.destroyOnClear=!0,void 0):(this._removeHandleClassName(),this._mouseDestroy(),void 0)},_mouseCapture:function(e){var i=this.options;return this.helper||i.disabled||t(e.target).closest(".ui-resizable-handle").length>0?!1:(this.handle=this._getHandle(e),this.handle?(this._blurActiveElement(e),this._blockFrames(i.iframeFix===!0?"iframe":i.iframeFix),!0):!1)},_blockFrames:function(e){this.iframeBlocks=this.document.find(e).map(function(){var e=t(this);return t("<div>").css("position","absolute").appendTo(e.parent()).outerWidth(e.outerWidth()).outerHeight(e.outerHeight()).offset(e.offset())[0]})},_unblockFrames:function(){this.iframeBlocks&&(this.iframeBlocks.remove(),delete this.iframeBlocks)},_blurActiveElement:function(e){var i=t.ui.safeActiveElement(this.document[0]),s=t(e.target);s.closest(i).length||t.ui.safeBlur(i)},_mouseStart:function(e){var i=this.options;return this.helper=this._createHelper(e),this._addClass(this.helper,"ui-draggable-dragging"),this._cacheHelperProportions(),t.ui.ddmanager&&(t.ui.ddmanager.current=this),this._cacheMargins(),this.cssPosition=this.helper.css("position"),this.scrollParent=this.helper.scrollParent(!0),this.offsetParent=this.helper.offsetParent(),this.hasFixedAncestor=this.helper.parents().filter(function(){return"fixed"===t(this).css("position")}).length>0,this.positionAbs=this.element.offset(),this._refreshOffsets(e),this.originalPosition=this.position=this._generatePosition(e,!1),this.originalPageX=e.pageX,this.originalPageY=e.pageY,i.cursorAt&&this._adjustOffsetFromHelper(i.cursorAt),this._setContainment(),this._trigger("start",e)===!1?(this._clear(),!1):(this._cacheHelperProportions(),t.ui.ddmanager&&!i.dropBehaviour&&t.ui.ddmanager.prepareOffsets(this,e),this._mouseDrag(e,!0),t.ui.ddmanager&&t.ui.ddmanager.dragStart(this,e),!0)},_refreshOffsets:function(t){this.offset={top:this.positionAbs.top-this.margins.top,left:this.positionAbs.left-this.margins.left,scroll:!1,parent:this._getParentOffset(),relative:this._getRelativeOffset()},this.offset.click={left:t.pageX-this.offset.left,top:t.pageY-this.offset.top}},_mouseDrag:function(e,i){if(this.hasFixedAncestor&&(this.offset.parent=this._getParentOffset()),this.position=this._generatePosition(e,!0),this.positionAbs=this._convertPositionTo("absolute"),!i){var s=this._uiHash();if(this._trigger("drag",e,s)===!1)return this._mouseUp(new t.Event("mouseup",e)),!1;this.position=s.position}return this.helper[0].style.left=this.position.left+"px",this.helper[0].style.top=this.position.top+"px",t.ui.ddmanager&&t.ui.ddmanager.drag(this,e),!1},_mouseStop:function(e){var i=this,s=!1;return t.ui.ddmanager&&!this.options.dropBehaviour&&(s=t.ui.ddmanager.drop(this,e)),this.dropped&&(s=this.dropped,this.dropped=!1),"invalid"===this.options.revert&&!s||"valid"===this.options.revert&&s||this.options.revert===!0||t.isFunction(this.options.revert)&&this.options.revert.call(this.element,s)?t(this.helper).animate(this.originalPosition,parseInt(this.options.revertDuration,10),function(){i._trigger("stop",e)!==!1&&i._clear()}):this._trigger("stop",e)!==!1&&this._clear(),!1},_mouseUp:function(e){return this._unblockFrames(),t.ui.ddmanager&&t.ui.ddmanager.dragStop(this,e),this.handleElement.is(e.target)&&this.element.trigger("focus"),t.ui.mouse.prototype._mouseUp.call(this,e)},cancel:function(){return this.helper.is(".ui-draggable-dragging")?this._mouseUp(new t.Event("mouseup",{target:this.element[0]})):this._clear(),this},_getHandle:function(e){return this.options.handle?!!t(e.target).closest(this.element.find(this.options.handle)).length:!0},_setHandleClassName:function(){this.handleElement=this.options.handle?this.element.find(this.options.handle):this.element,this._addClass(this.handleElement,"ui-draggable-handle")},_removeHandleClassName:function(){this._removeClass(this.handleElement,"ui-draggable-handle")},_createHelper:function(e){var i=this.options,s=t.isFunction(i.helper),n=s?t(i.helper.apply(this.element[0],[e])):"clone"===i.helper?this.element.clone().removeAttr("id"):this.element;return n.parents("body").length||n.appendTo("parent"===i.appendTo?this.element[0].parentNode:i.appendTo),s&&n[0]===this.element[0]&&this._setPositionRelative(),n[0]===this.element[0]||/(fixed|absolute)/.test(n.css("position"))||n.css("position","absolute"),n},_setPositionRelative:function(){/^(?:r|a|f)/.test(this.element.css("position"))||(this.element[0].style.position="relative")},_adjustOffsetFromHelper:function(e){"string"==typeof e&&(e=e.split(" ")),t.isArray(e)&&(e={left:+e[0],top:+e[1]||0}),"left"in e&&(this.offset.click.left=e.left+this.margins.left),"right"in e&&(this.offset.click.left=this.helperProportions.width-e.right+this.margins.left),"top"in e&&(this.offset.click.top=e.top+this.margins.top),"bottom"in e&&(this.offset.click.top=this.helperProportions.height-e.bottom+this.margins.top)},_isRootNode:function(t){return/(html|body)/i.test(t.tagName)||t===this.document[0]},_getParentOffset:function(){var e=this.offsetParent.offset(),i=this.document[0];return"absolute"===this.cssPosition&&this.scrollParent[0]!==i&&t.contains(this.scrollParent[0],this.offsetParent[0])&&(e.left+=this.scrollParent.scrollLeft(),e.top+=this.scrollParent.scrollTop()),this._isRootNode(this.offsetParent[0])&&(e={top:0,left:0}),{top:e.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),left:e.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)}},_getRelativeOffset:function(){if("relative"!==this.cssPosition)return{top:0,left:0};var t=this.element.position(),e=this._isRootNode(this.scrollParent[0]);return{top:t.top-(parseInt(this.helper.css("top"),10)||0)+(e?0:this.scrollParent.scrollTop()),left:t.left-(parseInt(this.helper.css("left"),10)||0)+(e?0:this.scrollParent.scrollLeft())}
},_cacheMargins:function(){this.margins={left:parseInt(this.element.css("marginLeft"),10)||0,top:parseInt(this.element.css("marginTop"),10)||0,right:parseInt(this.element.css("marginRight"),10)||0,bottom:parseInt(this.element.css("marginBottom"),10)||0}},_cacheHelperProportions:function(){this.helperProportions={width:this.helper.outerWidth(),height:this.helper.outerHeight()}},_setContainment:function(){var e,i,s,n=this.options,o=this.document[0];return this.relativeContainer=null,n.containment?"window"===n.containment?(this.containment=[t(window).scrollLeft()-this.offset.relative.left-this.offset.parent.left,t(window).scrollTop()-this.offset.relative.top-this.offset.parent.top,t(window).scrollLeft()+t(window).width()-this.helperProportions.width-this.margins.left,t(window).scrollTop()+(t(window).height()||o.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top],void 0):"document"===n.containment?(this.containment=[0,0,t(o).width()-this.helperProportions.width-this.margins.left,(t(o).height()||o.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top],void 0):n.containment.constructor===Array?(this.containment=n.containment,void 0):("parent"===n.containment&&(n.containment=this.helper[0].parentNode),i=t(n.containment),s=i[0],s&&(e=/(scroll|auto)/.test(i.css("overflow")),this.containment=[(parseInt(i.css("borderLeftWidth"),10)||0)+(parseInt(i.css("paddingLeft"),10)||0),(parseInt(i.css("borderTopWidth"),10)||0)+(parseInt(i.css("paddingTop"),10)||0),(e?Math.max(s.scrollWidth,s.offsetWidth):s.offsetWidth)-(parseInt(i.css("borderRightWidth"),10)||0)-(parseInt(i.css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left-this.margins.right,(e?Math.max(s.scrollHeight,s.offsetHeight):s.offsetHeight)-(parseInt(i.css("borderBottomWidth"),10)||0)-(parseInt(i.css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top-this.margins.bottom],this.relativeContainer=i),void 0):(this.containment=null,void 0)},_convertPositionTo:function(t,e){e||(e=this.position);var i="absolute"===t?1:-1,s=this._isRootNode(this.scrollParent[0]);return{top:e.top+this.offset.relative.top*i+this.offset.parent.top*i-("fixed"===this.cssPosition?-this.offset.scroll.top:s?0:this.offset.scroll.top)*i,left:e.left+this.offset.relative.left*i+this.offset.parent.left*i-("fixed"===this.cssPosition?-this.offset.scroll.left:s?0:this.offset.scroll.left)*i}},_generatePosition:function(t,e){var i,s,n,o,a=this.options,r=this._isRootNode(this.scrollParent[0]),h=t.pageX,l=t.pageY;return r&&this.offset.scroll||(this.offset.scroll={top:this.scrollParent.scrollTop(),left:this.scrollParent.scrollLeft()}),e&&(this.containment&&(this.relativeContainer?(s=this.relativeContainer.offset(),i=[this.containment[0]+s.left,this.containment[1]+s.top,this.containment[2]+s.left,this.containment[3]+s.top]):i=this.containment,t.pageX-this.offset.click.left<i[0]&&(h=i[0]+this.offset.click.left),t.pageY-this.offset.click.top<i[1]&&(l=i[1]+this.offset.click.top),t.pageX-this.offset.click.left>i[2]&&(h=i[2]+this.offset.click.left),t.pageY-this.offset.click.top>i[3]&&(l=i[3]+this.offset.click.top)),a.grid&&(n=a.grid[1]?this.originalPageY+Math.round((l-this.originalPageY)/a.grid[1])*a.grid[1]:this.originalPageY,l=i?n-this.offset.click.top>=i[1]||n-this.offset.click.top>i[3]?n:n-this.offset.click.top>=i[1]?n-a.grid[1]:n+a.grid[1]:n,o=a.grid[0]?this.originalPageX+Math.round((h-this.originalPageX)/a.grid[0])*a.grid[0]:this.originalPageX,h=i?o-this.offset.click.left>=i[0]||o-this.offset.click.left>i[2]?o:o-this.offset.click.left>=i[0]?o-a.grid[0]:o+a.grid[0]:o),"y"===a.axis&&(h=this.originalPageX),"x"===a.axis&&(l=this.originalPageY)),{top:l-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+("fixed"===this.cssPosition?-this.offset.scroll.top:r?0:this.offset.scroll.top),left:h-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+("fixed"===this.cssPosition?-this.offset.scroll.left:r?0:this.offset.scroll.left)}},_clear:function(){this._removeClass(this.helper,"ui-draggable-dragging"),this.helper[0]===this.element[0]||this.cancelHelperRemoval||this.helper.remove(),this.helper=null,this.cancelHelperRemoval=!1,this.destroyOnClear&&this.destroy()},_trigger:function(e,i,s){return s=s||this._uiHash(),t.ui.plugin.call(this,e,[i,s,this],!0),/^(drag|start|stop)/.test(e)&&(this.positionAbs=this._convertPositionTo("absolute"),s.offset=this.positionAbs),t.Widget.prototype._trigger.call(this,e,i,s)},plugins:{},_uiHash:function(){return{helper:this.helper,position:this.position,originalPosition:this.originalPosition,offset:this.positionAbs}}}),t.ui.plugin.add("draggable","connectToSortable",{start:function(e,i,s){var n=t.extend({},i,{item:s.element});s.sortables=[],t(s.options.connectToSortable).each(function(){var i=t(this).sortable("instance");i&&!i.options.disabled&&(s.sortables.push(i),i.refreshPositions(),i._trigger("activate",e,n))})},stop:function(e,i,s){var n=t.extend({},i,{item:s.element});s.cancelHelperRemoval=!1,t.each(s.sortables,function(){var t=this;t.isOver?(t.isOver=0,s.cancelHelperRemoval=!0,t.cancelHelperRemoval=!1,t._storedCSS={position:t.placeholder.css("position"),top:t.placeholder.css("top"),left:t.placeholder.css("left")},t._mouseStop(e),t.options.helper=t.options._helper):(t.cancelHelperRemoval=!0,t._trigger("deactivate",e,n))})},drag:function(e,i,s){t.each(s.sortables,function(){var n=!1,o=this;o.positionAbs=s.positionAbs,o.helperProportions=s.helperProportions,o.offset.click=s.offset.click,o._intersectsWith(o.containerCache)&&(n=!0,t.each(s.sortables,function(){return this.positionAbs=s.positionAbs,this.helperProportions=s.helperProportions,this.offset.click=s.offset.click,this!==o&&this._intersectsWith(this.containerCache)&&t.contains(o.element[0],this.element[0])&&(n=!1),n})),n?(o.isOver||(o.isOver=1,s._parent=i.helper.parent(),o.currentItem=i.helper.appendTo(o.element).data("ui-sortable-item",!0),o.options._helper=o.options.helper,o.options.helper=function(){return i.helper[0]},e.target=o.currentItem[0],o._mouseCapture(e,!0),o._mouseStart(e,!0,!0),o.offset.click.top=s.offset.click.top,o.offset.click.left=s.offset.click.left,o.offset.parent.left-=s.offset.parent.left-o.offset.parent.left,o.offset.parent.top-=s.offset.parent.top-o.offset.parent.top,s._trigger("toSortable",e),s.dropped=o.element,t.each(s.sortables,function(){this.refreshPositions()}),s.currentItem=s.element,o.fromOutside=s),o.currentItem&&(o._mouseDrag(e),i.position=o.position)):o.isOver&&(o.isOver=0,o.cancelHelperRemoval=!0,o.options._revert=o.options.revert,o.options.revert=!1,o._trigger("out",e,o._uiHash(o)),o._mouseStop(e,!0),o.options.revert=o.options._revert,o.options.helper=o.options._helper,o.placeholder&&o.placeholder.remove(),i.helper.appendTo(s._parent),s._refreshOffsets(e),i.position=s._generatePosition(e,!0),s._trigger("fromSortable",e),s.dropped=!1,t.each(s.sortables,function(){this.refreshPositions()}))})}}),t.ui.plugin.add("draggable","cursor",{start:function(e,i,s){var n=t("body"),o=s.options;n.css("cursor")&&(o._cursor=n.css("cursor")),n.css("cursor",o.cursor)},stop:function(e,i,s){var n=s.options;n._cursor&&t("body").css("cursor",n._cursor)}}),t.ui.plugin.add("draggable","opacity",{start:function(e,i,s){var n=t(i.helper),o=s.options;n.css("opacity")&&(o._opacity=n.css("opacity")),n.css("opacity",o.opacity)},stop:function(e,i,s){var n=s.options;n._opacity&&t(i.helper).css("opacity",n._opacity)}}),t.ui.plugin.add("draggable","scroll",{start:function(t,e,i){i.scrollParentNotHidden||(i.scrollParentNotHidden=i.helper.scrollParent(!1)),i.scrollParentNotHidden[0]!==i.document[0]&&"HTML"!==i.scrollParentNotHidden[0].tagName&&(i.overflowOffset=i.scrollParentNotHidden.offset())},drag:function(e,i,s){var n=s.options,o=!1,a=s.scrollParentNotHidden[0],r=s.document[0];a!==r&&"HTML"!==a.tagName?(n.axis&&"x"===n.axis||(s.overflowOffset.top+a.offsetHeight-e.pageY<n.scrollSensitivity?a.scrollTop=o=a.scrollTop+n.scrollSpeed:e.pageY-s.overflowOffset.top<n.scrollSensitivity&&(a.scrollTop=o=a.scrollTop-n.scrollSpeed)),n.axis&&"y"===n.axis||(s.overflowOffset.left+a.offsetWidth-e.pageX<n.scrollSensitivity?a.scrollLeft=o=a.scrollLeft+n.scrollSpeed:e.pageX-s.overflowOffset.left<n.scrollSensitivity&&(a.scrollLeft=o=a.scrollLeft-n.scrollSpeed))):(n.axis&&"x"===n.axis||(e.pageY-t(r).scrollTop()<n.scrollSensitivity?o=t(r).scrollTop(t(r).scrollTop()-n.scrollSpeed):t(window).height()-(e.pageY-t(r).scrollTop())<n.scrollSensitivity&&(o=t(r).scrollTop(t(r).scrollTop()+n.scrollSpeed))),n.axis&&"y"===n.axis||(e.pageX-t(r).scrollLeft()<n.scrollSensitivity?o=t(r).scrollLeft(t(r).scrollLeft()-n.scrollSpeed):t(window).width()-(e.pageX-t(r).scrollLeft())<n.scrollSensitivity&&(o=t(r).scrollLeft(t(r).scrollLeft()+n.scrollSpeed)))),o!==!1&&t.ui.ddmanager&&!n.dropBehaviour&&t.ui.ddmanager.prepareOffsets(s,e)}}),t.ui.plugin.add("draggable","snap",{start:function(e,i,s){var n=s.options;s.snapElements=[],t(n.snap.constructor!==String?n.snap.items||":data(ui-draggable)":n.snap).each(function(){var e=t(this),i=e.offset();this!==s.element[0]&&s.snapElements.push({item:this,width:e.outerWidth(),height:e.outerHeight(),top:i.top,left:i.left})})},drag:function(e,i,s){var n,o,a,r,h,l,c,u,d,p,f=s.options,g=f.snapTolerance,m=i.offset.left,_=m+s.helperProportions.width,v=i.offset.top,b=v+s.helperProportions.height;for(d=s.snapElements.length-1;d>=0;d--)h=s.snapElements[d].left-s.margins.left,l=h+s.snapElements[d].width,c=s.snapElements[d].top-s.margins.top,u=c+s.snapElements[d].height,h-g>_||m>l+g||c-g>b||v>u+g||!t.contains(s.snapElements[d].item.ownerDocument,s.snapElements[d].item)?(s.snapElements[d].snapping&&s.options.snap.release&&s.options.snap.release.call(s.element,e,t.extend(s._uiHash(),{snapItem:s.snapElements[d].item})),s.snapElements[d].snapping=!1):("inner"!==f.snapMode&&(n=g>=Math.abs(c-b),o=g>=Math.abs(u-v),a=g>=Math.abs(h-_),r=g>=Math.abs(l-m),n&&(i.position.top=s._convertPositionTo("relative",{top:c-s.helperProportions.height,left:0}).top),o&&(i.position.top=s._convertPositionTo("relative",{top:u,left:0}).top),a&&(i.position.left=s._convertPositionTo("relative",{top:0,left:h-s.helperProportions.width}).left),r&&(i.position.left=s._convertPositionTo("relative",{top:0,left:l}).left)),p=n||o||a||r,"outer"!==f.snapMode&&(n=g>=Math.abs(c-v),o=g>=Math.abs(u-b),a=g>=Math.abs(h-m),r=g>=Math.abs(l-_),n&&(i.position.top=s._convertPositionTo("relative",{top:c,left:0}).top),o&&(i.position.top=s._convertPositionTo("relative",{top:u-s.helperProportions.height,left:0}).top),a&&(i.position.left=s._convertPositionTo("relative",{top:0,left:h}).left),r&&(i.position.left=s._convertPositionTo("relative",{top:0,left:l-s.helperProportions.width}).left)),!s.snapElements[d].snapping&&(n||o||a||r||p)&&s.options.snap.snap&&s.options.snap.snap.call(s.element,e,t.extend(s._uiHash(),{snapItem:s.snapElements[d].item})),s.snapElements[d].snapping=n||o||a||r||p)}}),t.ui.plugin.add("draggable","stack",{start:function(e,i,s){var n,o=s.options,a=t.makeArray(t(o.stack)).sort(function(e,i){return(parseInt(t(e).css("zIndex"),10)||0)-(parseInt(t(i).css("zIndex"),10)||0)});a.length&&(n=parseInt(t(a[0]).css("zIndex"),10)||0,t(a).each(function(e){t(this).css("zIndex",n+e)}),this.css("zIndex",n+a.length))}}),t.ui.plugin.add("draggable","zIndex",{start:function(e,i,s){var n=t(i.helper),o=s.options;n.css("zIndex")&&(o._zIndex=n.css("zIndex")),n.css("zIndex",o.zIndex)},stop:function(e,i,s){var n=s.options;n._zIndex&&t(i.helper).css("zIndex",n._zIndex)}}),t.ui.draggable,t.widget("ui.resizable",t.ui.mouse,{version:"1.12.1",widgetEventPrefix:"resize",options:{alsoResize:!1,animate:!1,animateDuration:"slow",animateEasing:"swing",aspectRatio:!1,autoHide:!1,classes:{"ui-resizable-se":"ui-icon ui-icon-gripsmall-diagonal-se"},containment:!1,ghost:!1,grid:!1,handles:"e,s,se",helper:!1,maxHeight:null,maxWidth:null,minHeight:10,minWidth:10,zIndex:90,resize:null,start:null,stop:null},_num:function(t){return parseFloat(t)||0},_isNumber:function(t){return!isNaN(parseFloat(t))},_hasScroll:function(e,i){if("hidden"===t(e).css("overflow"))return!1;var s=i&&"left"===i?"scrollLeft":"scrollTop",n=!1;return e[s]>0?!0:(e[s]=1,n=e[s]>0,e[s]=0,n)},_create:function(){var e,i=this.options,s=this;this._addClass("ui-resizable"),t.extend(this,{_aspectRatio:!!i.aspectRatio,aspectRatio:i.aspectRatio,originalElement:this.element,_proportionallyResizeElements:[],_helper:i.helper||i.ghost||i.animate?i.helper||"ui-resizable-helper":null}),this.element[0].nodeName.match(/^(canvas|textarea|input|select|button|img)$/i)&&(this.element.wrap(t("<div class='ui-wrapper' style='overflow: hidden;'></div>").css({position:this.element.css("position"),width:this.element.outerWidth(),height:this.element.outerHeight(),top:this.element.css("top"),left:this.element.css("left")})),this.element=this.element.parent().data("ui-resizable",this.element.resizable("instance")),this.elementIsWrapper=!0,e={marginTop:this.originalElement.css("marginTop"),marginRight:this.originalElement.css("marginRight"),marginBottom:this.originalElement.css("marginBottom"),marginLeft:this.originalElement.css("marginLeft")},this.element.css(e),this.originalElement.css("margin",0),this.originalResizeStyle=this.originalElement.css("resize"),this.originalElement.css("resize","none"),this._proportionallyResizeElements.push(this.originalElement.css({position:"static",zoom:1,display:"block"})),this.originalElement.css(e),this._proportionallyResize()),this._setupHandles(),i.autoHide&&t(this.element).on("mouseenter",function(){i.disabled||(s._removeClass("ui-resizable-autohide"),s._handles.show())}).on("mouseleave",function(){i.disabled||s.resizing||(s._addClass("ui-resizable-autohide"),s._handles.hide())}),this._mouseInit()},_destroy:function(){this._mouseDestroy();var e,i=function(e){t(e).removeData("resizable").removeData("ui-resizable").off(".resizable").find(".ui-resizable-handle").remove()};return this.elementIsWrapper&&(i(this.element),e=this.element,this.originalElement.css({position:e.css("position"),width:e.outerWidth(),height:e.outerHeight(),top:e.css("top"),left:e.css("left")}).insertAfter(e),e.remove()),this.originalElement.css("resize",this.originalResizeStyle),i(this.originalElement),this},_setOption:function(t,e){switch(this._super(t,e),t){case"handles":this._removeHandles(),this._setupHandles();break;default:}},_setupHandles:function(){var e,i,s,n,o,a=this.options,r=this;if(this.handles=a.handles||(t(".ui-resizable-handle",this.element).length?{n:".ui-resizable-n",e:".ui-resizable-e",s:".ui-resizable-s",w:".ui-resizable-w",se:".ui-resizable-se",sw:".ui-resizable-sw",ne:".ui-resizable-ne",nw:".ui-resizable-nw"}:"e,s,se"),this._handles=t(),this.handles.constructor===String)for("all"===this.handles&&(this.handles="n,e,s,w,se,sw,ne,nw"),s=this.handles.split(","),this.handles={},i=0;s.length>i;i++)e=t.trim(s[i]),n="ui-resizable-"+e,o=t("<div>"),this._addClass(o,"ui-resizable-handle "+n),o.css({zIndex:a.zIndex}),this.handles[e]=".ui-resizable-"+e,this.element.append(o);this._renderAxis=function(e){var i,s,n,o;e=e||this.element;for(i in this.handles)this.handles[i].constructor===String?this.handles[i]=this.element.children(this.handles[i]).first().show():(this.handles[i].jquery||this.handles[i].nodeType)&&(this.handles[i]=t(this.handles[i]),this._on(this.handles[i],{mousedown:r._mouseDown})),this.elementIsWrapper&&this.originalElement[0].nodeName.match(/^(textarea|input|select|button)$/i)&&(s=t(this.handles[i],this.element),o=/sw|ne|nw|se|n|s/.test(i)?s.outerHeight():s.outerWidth(),n=["padding",/ne|nw|n/.test(i)?"Top":/se|sw|s/.test(i)?"Bottom":/^e$/.test(i)?"Right":"Left"].join(""),e.css(n,o),this._proportionallyResize()),this._handles=this._handles.add(this.handles[i])},this._renderAxis(this.element),this._handles=this._handles.add(this.element.find(".ui-resizable-handle")),this._handles.disableSelection(),this._handles.on("mouseover",function(){r.resizing||(this.className&&(o=this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i)),r.axis=o&&o[1]?o[1]:"se")}),a.autoHide&&(this._handles.hide(),this._addClass("ui-resizable-autohide"))},_removeHandles:function(){this._handles.remove()},_mouseCapture:function(e){var i,s,n=!1;for(i in this.handles)s=t(this.handles[i])[0],(s===e.target||t.contains(s,e.target))&&(n=!0);return!this.options.disabled&&n},_mouseStart:function(e){var i,s,n,o=this.options,a=this.element;return this.resizing=!0,this._renderProxy(),i=this._num(this.helper.css("left")),s=this._num(this.helper.css("top")),o.containment&&(i+=t(o.containment).scrollLeft()||0,s+=t(o.containment).scrollTop()||0),this.offset=this.helper.offset(),this.position={left:i,top:s},this.size=this._helper?{width:this.helper.width(),height:this.helper.height()}:{width:a.width(),height:a.height()},this.originalSize=this._helper?{width:a.outerWidth(),height:a.outerHeight()}:{width:a.width(),height:a.height()},this.sizeDiff={width:a.outerWidth()-a.width(),height:a.outerHeight()-a.height()},this.originalPosition={left:i,top:s},this.originalMousePosition={left:e.pageX,top:e.pageY},this.aspectRatio="number"==typeof o.aspectRatio?o.aspectRatio:this.originalSize.width/this.originalSize.height||1,n=t(".ui-resizable-"+this.axis).css("cursor"),t("body").css("cursor","auto"===n?this.axis+"-resize":n),this._addClass("ui-resizable-resizing"),this._propagate("start",e),!0},_mouseDrag:function(e){var i,s,n=this.originalMousePosition,o=this.axis,a=e.pageX-n.left||0,r=e.pageY-n.top||0,h=this._change[o];return this._updatePrevProperties(),h?(i=h.apply(this,[e,a,r]),this._updateVirtualBoundaries(e.shiftKey),(this._aspectRatio||e.shiftKey)&&(i=this._updateRatio(i,e)),i=this._respectSize(i,e),this._updateCache(i),this._propagate("resize",e),s=this._applyChanges(),!this._helper&&this._proportionallyResizeElements.length&&this._proportionallyResize(),t.isEmptyObject(s)||(this._updatePrevProperties(),this._trigger("resize",e,this.ui()),this._applyChanges()),!1):!1},_mouseStop:function(e){this.resizing=!1;var i,s,n,o,a,r,h,l=this.options,c=this;return this._helper&&(i=this._proportionallyResizeElements,s=i.length&&/textarea/i.test(i[0].nodeName),n=s&&this._hasScroll(i[0],"left")?0:c.sizeDiff.height,o=s?0:c.sizeDiff.width,a={width:c.helper.width()-o,height:c.helper.height()-n},r=parseFloat(c.element.css("left"))+(c.position.left-c.originalPosition.left)||null,h=parseFloat(c.element.css("top"))+(c.position.top-c.originalPosition.top)||null,l.animate||this.element.css(t.extend(a,{top:h,left:r})),c.helper.height(c.size.height),c.helper.width(c.size.width),this._helper&&!l.animate&&this._proportionallyResize()),t("body").css("cursor","auto"),this._removeClass("ui-resizable-resizing"),this._propagate("stop",e),this._helper&&this.helper.remove(),!1},_updatePrevProperties:function(){this.prevPosition={top:this.position.top,left:this.position.left},this.prevSize={width:this.size.width,height:this.size.height}},_applyChanges:function(){var t={};return this.position.top!==this.prevPosition.top&&(t.top=this.position.top+"px"),this.position.left!==this.prevPosition.left&&(t.left=this.position.left+"px"),this.size.width!==this.prevSize.width&&(t.width=this.size.width+"px"),this.size.height!==this.prevSize.height&&(t.height=this.size.height+"px"),this.helper.css(t),t},_updateVirtualBoundaries:function(t){var e,i,s,n,o,a=this.options;o={minWidth:this._isNumber(a.minWidth)?a.minWidth:0,maxWidth:this._isNumber(a.maxWidth)?a.maxWidth:1/0,minHeight:this._isNumber(a.minHeight)?a.minHeight:0,maxHeight:this._isNumber(a.maxHeight)?a.maxHeight:1/0},(this._aspectRatio||t)&&(e=o.minHeight*this.aspectRatio,s=o.minWidth/this.aspectRatio,i=o.maxHeight*this.aspectRatio,n=o.maxWidth/this.aspectRatio,e>o.minWidth&&(o.minWidth=e),s>o.minHeight&&(o.minHeight=s),o.maxWidth>i&&(o.maxWidth=i),o.maxHeight>n&&(o.maxHeight=n)),this._vBoundaries=o},_updateCache:function(t){this.offset=this.helper.offset(),this._isNumber(t.left)&&(this.position.left=t.left),this._isNumber(t.top)&&(this.position.top=t.top),this._isNumber(t.height)&&(this.size.height=t.height),this._isNumber(t.width)&&(this.size.width=t.width)},_updateRatio:function(t){var e=this.position,i=this.size,s=this.axis;return this._isNumber(t.height)?t.width=t.height*this.aspectRatio:this._isNumber(t.width)&&(t.height=t.width/this.aspectRatio),"sw"===s&&(t.left=e.left+(i.width-t.width),t.top=null),"nw"===s&&(t.top=e.top+(i.height-t.height),t.left=e.left+(i.width-t.width)),t},_respectSize:function(t){var e=this._vBoundaries,i=this.axis,s=this._isNumber(t.width)&&e.maxWidth&&e.maxWidth<t.width,n=this._isNumber(t.height)&&e.maxHeight&&e.maxHeight<t.height,o=this._isNumber(t.width)&&e.minWidth&&e.minWidth>t.width,a=this._isNumber(t.height)&&e.minHeight&&e.minHeight>t.height,r=this.originalPosition.left+this.originalSize.width,h=this.originalPosition.top+this.originalSize.height,l=/sw|nw|w/.test(i),c=/nw|ne|n/.test(i);return o&&(t.width=e.minWidth),a&&(t.height=e.minHeight),s&&(t.width=e.maxWidth),n&&(t.height=e.maxHeight),o&&l&&(t.left=r-e.minWidth),s&&l&&(t.left=r-e.maxWidth),a&&c&&(t.top=h-e.minHeight),n&&c&&(t.top=h-e.maxHeight),t.width||t.height||t.left||!t.top?t.width||t.height||t.top||!t.left||(t.left=null):t.top=null,t},_getPaddingPlusBorderDimensions:function(t){for(var e=0,i=[],s=[t.css("borderTopWidth"),t.css("borderRightWidth"),t.css("borderBottomWidth"),t.css("borderLeftWidth")],n=[t.css("paddingTop"),t.css("paddingRight"),t.css("paddingBottom"),t.css("paddingLeft")];4>e;e++)i[e]=parseFloat(s[e])||0,i[e]+=parseFloat(n[e])||0;return{height:i[0]+i[2],width:i[1]+i[3]}},_proportionallyResize:function(){if(this._proportionallyResizeElements.length)for(var t,e=0,i=this.helper||this.element;this._proportionallyResizeElements.length>e;e++)t=this._proportionallyResizeElements[e],this.outerDimensions||(this.outerDimensions=this._getPaddingPlusBorderDimensions(t)),t.css({height:i.height()-this.outerDimensions.height||0,width:i.width()-this.outerDimensions.width||0})},_renderProxy:function(){var e=this.element,i=this.options;this.elementOffset=e.offset(),this._helper?(this.helper=this.helper||t("<div style='overflow:hidden;'></div>"),this._addClass(this.helper,this._helper),this.helper.css({width:this.element.outerWidth(),height:this.element.outerHeight(),position:"absolute",left:this.elementOffset.left+"px",top:this.elementOffset.top+"px",zIndex:++i.zIndex}),this.helper.appendTo("body").disableSelection()):this.helper=this.element},_change:{e:function(t,e){return{width:this.originalSize.width+e}},w:function(t,e){var i=this.originalSize,s=this.originalPosition;return{left:s.left+e,width:i.width-e}},n:function(t,e,i){var s=this.originalSize,n=this.originalPosition;return{top:n.top+i,height:s.height-i}},s:function(t,e,i){return{height:this.originalSize.height+i}},se:function(e,i,s){return t.extend(this._change.s.apply(this,arguments),this._change.e.apply(this,[e,i,s]))},sw:function(e,i,s){return t.extend(this._change.s.apply(this,arguments),this._change.w.apply(this,[e,i,s]))},ne:function(e,i,s){return t.extend(this._change.n.apply(this,arguments),this._change.e.apply(this,[e,i,s]))},nw:function(e,i,s){return t.extend(this._change.n.apply(this,arguments),this._change.w.apply(this,[e,i,s]))}},_propagate:function(e,i){t.ui.plugin.call(this,e,[i,this.ui()]),"resize"!==e&&this._trigger(e,i,this.ui())},plugins:{},ui:function(){return{originalElement:this.originalElement,element:this.element,helper:this.helper,position:this.position,size:this.size,originalSize:this.originalSize,originalPosition:this.originalPosition}}}),t.ui.plugin.add("resizable","animate",{stop:function(e){var i=t(this).resizable("instance"),s=i.options,n=i._proportionallyResizeElements,o=n.length&&/textarea/i.test(n[0].nodeName),a=o&&i._hasScroll(n[0],"left")?0:i.sizeDiff.height,r=o?0:i.sizeDiff.width,h={width:i.size.width-r,height:i.size.height-a},l=parseFloat(i.element.css("left"))+(i.position.left-i.originalPosition.left)||null,c=parseFloat(i.element.css("top"))+(i.position.top-i.originalPosition.top)||null;i.element.animate(t.extend(h,c&&l?{top:c,left:l}:{}),{duration:s.animateDuration,easing:s.animateEasing,step:function(){var s={width:parseFloat(i.element.css("width")),height:parseFloat(i.element.css("height")),top:parseFloat(i.element.css("top")),left:parseFloat(i.element.css("left"))};n&&n.length&&t(n[0]).css({width:s.width,height:s.height}),i._updateCache(s),i._propagate("resize",e)}})}}),t.ui.plugin.add("resizable","containment",{start:function(){var e,i,s,n,o,a,r,h=t(this).resizable("instance"),l=h.options,c=h.element,u=l.containment,d=u instanceof t?u.get(0):/parent/.test(u)?c.parent().get(0):u;d&&(h.containerElement=t(d),/document/.test(u)||u===document?(h.containerOffset={left:0,top:0},h.containerPosition={left:0,top:0},h.parentData={element:t(document),left:0,top:0,width:t(document).width(),height:t(document).height()||document.body.parentNode.scrollHeight}):(e=t(d),i=[],t(["Top","Right","Left","Bottom"]).each(function(t,s){i[t]=h._num(e.css("padding"+s))}),h.containerOffset=e.offset(),h.containerPosition=e.position(),h.containerSize={height:e.innerHeight()-i[3],width:e.innerWidth()-i[1]},s=h.containerOffset,n=h.containerSize.height,o=h.containerSize.width,a=h._hasScroll(d,"left")?d.scrollWidth:o,r=h._hasScroll(d)?d.scrollHeight:n,h.parentData={element:d,left:s.left,top:s.top,width:a,height:r}))},resize:function(e){var i,s,n,o,a=t(this).resizable("instance"),r=a.options,h=a.containerOffset,l=a.position,c=a._aspectRatio||e.shiftKey,u={top:0,left:0},d=a.containerElement,p=!0;d[0]!==document&&/static/.test(d.css("position"))&&(u=h),l.left<(a._helper?h.left:0)&&(a.size.width=a.size.width+(a._helper?a.position.left-h.left:a.position.left-u.left),c&&(a.size.height=a.size.width/a.aspectRatio,p=!1),a.position.left=r.helper?h.left:0),l.top<(a._helper?h.top:0)&&(a.size.height=a.size.height+(a._helper?a.position.top-h.top:a.position.top),c&&(a.size.width=a.size.height*a.aspectRatio,p=!1),a.position.top=a._helper?h.top:0),n=a.containerElement.get(0)===a.element.parent().get(0),o=/relative|absolute/.test(a.containerElement.css("position")),n&&o?(a.offset.left=a.parentData.left+a.position.left,a.offset.top=a.parentData.top+a.position.top):(a.offset.left=a.element.offset().left,a.offset.top=a.element.offset().top),i=Math.abs(a.sizeDiff.width+(a._helper?a.offset.left-u.left:a.offset.left-h.left)),s=Math.abs(a.sizeDiff.height+(a._helper?a.offset.top-u.top:a.offset.top-h.top)),i+a.size.width>=a.parentData.width&&(a.size.width=a.parentData.width-i,c&&(a.size.height=a.size.width/a.aspectRatio,p=!1)),s+a.size.height>=a.parentData.height&&(a.size.height=a.parentData.height-s,c&&(a.size.width=a.size.height*a.aspectRatio,p=!1)),p||(a.position.left=a.prevPosition.left,a.position.top=a.prevPosition.top,a.size.width=a.prevSize.width,a.size.height=a.prevSize.height)},stop:function(){var e=t(this).resizable("instance"),i=e.options,s=e.containerOffset,n=e.containerPosition,o=e.containerElement,a=t(e.helper),r=a.offset(),h=a.outerWidth()-e.sizeDiff.width,l=a.outerHeight()-e.sizeDiff.height;e._helper&&!i.animate&&/relative/.test(o.css("position"))&&t(this).css({left:r.left-n.left-s.left,width:h,height:l}),e._helper&&!i.animate&&/static/.test(o.css("position"))&&t(this).css({left:r.left-n.left-s.left,width:h,height:l})}}),t.ui.plugin.add("resizable","alsoResize",{start:function(){var e=t(this).resizable("instance"),i=e.options;t(i.alsoResize).each(function(){var e=t(this);e.data("ui-resizable-alsoresize",{width:parseFloat(e.width()),height:parseFloat(e.height()),left:parseFloat(e.css("left")),top:parseFloat(e.css("top"))})})},resize:function(e,i){var s=t(this).resizable("instance"),n=s.options,o=s.originalSize,a=s.originalPosition,r={height:s.size.height-o.height||0,width:s.size.width-o.width||0,top:s.position.top-a.top||0,left:s.position.left-a.left||0};t(n.alsoResize).each(function(){var e=t(this),s=t(this).data("ui-resizable-alsoresize"),n={},o=e.parents(i.originalElement[0]).length?["width","height"]:["width","height","top","left"];t.each(o,function(t,e){var i=(s[e]||0)+(r[e]||0);i&&i>=0&&(n[e]=i||null)}),e.css(n)})},stop:function(){t(this).removeData("ui-resizable-alsoresize")}}),t.ui.plugin.add("resizable","ghost",{start:function(){var e=t(this).resizable("instance"),i=e.size;e.ghost=e.originalElement.clone(),e.ghost.css({opacity:.25,display:"block",position:"relative",height:i.height,width:i.width,margin:0,left:0,top:0}),e._addClass(e.ghost,"ui-resizable-ghost"),t.uiBackCompat!==!1&&"string"==typeof e.options.ghost&&e.ghost.addClass(this.options.ghost),e.ghost.appendTo(e.helper)},resize:function(){var e=t(this).resizable("instance");e.ghost&&e.ghost.css({position:"relative",height:e.size.height,width:e.size.width})},stop:function(){var e=t(this).resizable("instance");e.ghost&&e.helper&&e.helper.get(0).removeChild(e.ghost.get(0))}}),t.ui.plugin.add("resizable","grid",{resize:function(){var e,i=t(this).resizable("instance"),s=i.options,n=i.size,o=i.originalSize,a=i.originalPosition,r=i.axis,h="number"==typeof s.grid?[s.grid,s.grid]:s.grid,l=h[0]||1,c=h[1]||1,u=Math.round((n.width-o.width)/l)*l,d=Math.round((n.height-o.height)/c)*c,p=o.width+u,f=o.height+d,g=s.maxWidth&&p>s.maxWidth,m=s.maxHeight&&f>s.maxHeight,_=s.minWidth&&s.minWidth>p,v=s.minHeight&&s.minHeight>f;s.grid=h,_&&(p+=l),v&&(f+=c),g&&(p-=l),m&&(f-=c),/^(se|s|e)$/.test(r)?(i.size.width=p,i.size.height=f):/^(ne)$/.test(r)?(i.size.width=p,i.size.height=f,i.position.top=a.top-d):/^(sw)$/.test(r)?(i.size.width=p,i.size.height=f,i.position.left=a.left-u):((0>=f-c||0>=p-l)&&(e=i._getPaddingPlusBorderDimensions(this)),f-c>0?(i.size.height=f,i.position.top=a.top-d):(f=c-e.height,i.size.height=f,i.position.top=a.top+o.height-f),p-l>0?(i.size.width=p,i.position.left=a.left-u):(p=l-e.width,i.size.width=p,i.position.left=a.left+o.width-p))}}),t.ui.resizable,t.widget("ui.dialog",{version:"1.12.1",options:{appendTo:"body",autoOpen:!0,buttons:[],classes:{"ui-dialog":"ui-corner-all","ui-dialog-titlebar":"ui-corner-all"},closeOnEscape:!0,closeText:"Close",draggable:!0,hide:null,height:"auto",maxHeight:null,maxWidth:null,minHeight:150,minWidth:150,modal:!1,position:{my:"center",at:"center",of:window,collision:"fit",using:function(e){var i=t(this).css(e).offset().top;0>i&&t(this).css("top",e.top-i)}},resizable:!0,show:null,title:null,width:300,beforeClose:null,close:null,drag:null,dragStart:null,dragStop:null,focus:null,open:null,resize:null,resizeStart:null,resizeStop:null},sizeRelatedOptions:{buttons:!0,height:!0,maxHeight:!0,maxWidth:!0,minHeight:!0,minWidth:!0,width:!0},resizableRelatedOptions:{maxHeight:!0,maxWidth:!0,minHeight:!0,minWidth:!0},_create:function(){this.originalCss={display:this.element[0].style.display,width:this.element[0].style.width,minHeight:this.element[0].style.minHeight,maxHeight:this.element[0].style.maxHeight,height:this.element[0].style.height},this.originalPosition={parent:this.element.parent(),index:this.element.parent().children().index(this.element)},this.originalTitle=this.element.attr("title"),null==this.options.title&&null!=this.originalTitle&&(this.options.title=this.originalTitle),this.options.disabled&&(this.options.disabled=!1),this._createWrapper(),this.element.show().removeAttr("title").appendTo(this.uiDialog),this._addClass("ui-dialog-content","ui-widget-content"),this._createTitlebar(),this._createButtonPane(),this.options.draggable&&t.fn.draggable&&this._makeDraggable(),this.options.resizable&&t.fn.resizable&&this._makeResizable(),this._isOpen=!1,this._trackFocus()},_init:function(){this.options.autoOpen&&this.open()},_appendTo:function(){var e=this.options.appendTo;return e&&(e.jquery||e.nodeType)?t(e):this.document.find(e||"body").eq(0)},_destroy:function(){var t,e=this.originalPosition;this._untrackInstance(),this._destroyOverlay(),this.element.removeUniqueId().css(this.originalCss).detach(),this.uiDialog.remove(),this.originalTitle&&this.element.attr("title",this.originalTitle),t=e.parent.children().eq(e.index),t.length&&t[0]!==this.element[0]?t.before(this.element):e.parent.append(this.element)},widget:function(){return this.uiDialog
},disable:t.noop,enable:t.noop,close:function(e){var i=this;this._isOpen&&this._trigger("beforeClose",e)!==!1&&(this._isOpen=!1,this._focusedElement=null,this._destroyOverlay(),this._untrackInstance(),this.opener.filter(":focusable").trigger("focus").length||t.ui.safeBlur(t.ui.safeActiveElement(this.document[0])),this._hide(this.uiDialog,this.options.hide,function(){i._trigger("close",e)}))},isOpen:function(){return this._isOpen},moveToTop:function(){this._moveToTop()},_moveToTop:function(e,i){var s=!1,n=this.uiDialog.siblings(".ui-front:visible").map(function(){return+t(this).css("z-index")}).get(),o=Math.max.apply(null,n);return o>=+this.uiDialog.css("z-index")&&(this.uiDialog.css("z-index",o+1),s=!0),s&&!i&&this._trigger("focus",e),s},open:function(){var e=this;return this._isOpen?(this._moveToTop()&&this._focusTabbable(),void 0):(this._isOpen=!0,this.opener=t(t.ui.safeActiveElement(this.document[0])),this._size(),this._position(),this._createOverlay(),this._moveToTop(null,!0),this.overlay&&this.overlay.css("z-index",this.uiDialog.css("z-index")-1),this._show(this.uiDialog,this.options.show,function(){e._focusTabbable(),e._trigger("focus")}),this._makeFocusTarget(),this._trigger("open"),void 0)},_focusTabbable:function(){var t=this._focusedElement;t||(t=this.element.find("[autofocus]")),t.length||(t=this.element.find(":tabbable")),t.length||(t=this.uiDialogButtonPane.find(":tabbable")),t.length||(t=this.uiDialogTitlebarClose.filter(":tabbable")),t.length||(t=this.uiDialog),t.eq(0).trigger("focus")},_keepFocus:function(e){function i(){var e=t.ui.safeActiveElement(this.document[0]),i=this.uiDialog[0]===e||t.contains(this.uiDialog[0],e);i||this._focusTabbable()}e.preventDefault(),i.call(this),this._delay(i)},_createWrapper:function(){this.uiDialog=t("<div>").hide().attr({tabIndex:-1,role:"dialog"}).appendTo(this._appendTo()),this._addClass(this.uiDialog,"ui-dialog","ui-widget ui-widget-content ui-front"),this._on(this.uiDialog,{keydown:function(e){if(this.options.closeOnEscape&&!e.isDefaultPrevented()&&e.keyCode&&e.keyCode===t.ui.keyCode.ESCAPE)return e.preventDefault(),this.close(e),void 0;if(e.keyCode===t.ui.keyCode.TAB&&!e.isDefaultPrevented()){var i=this.uiDialog.find(":tabbable"),s=i.filter(":first"),n=i.filter(":last");e.target!==n[0]&&e.target!==this.uiDialog[0]||e.shiftKey?e.target!==s[0]&&e.target!==this.uiDialog[0]||!e.shiftKey||(this._delay(function(){n.trigger("focus")}),e.preventDefault()):(this._delay(function(){s.trigger("focus")}),e.preventDefault())}},mousedown:function(t){this._moveToTop(t)&&this._focusTabbable()}}),this.element.find("[aria-describedby]").length||this.uiDialog.attr({"aria-describedby":this.element.uniqueId().attr("id")})},_createTitlebar:function(){var e;this.uiDialogTitlebar=t("<div>"),this._addClass(this.uiDialogTitlebar,"ui-dialog-titlebar","ui-widget-header ui-helper-clearfix"),this._on(this.uiDialogTitlebar,{mousedown:function(e){t(e.target).closest(".ui-dialog-titlebar-close")||this.uiDialog.trigger("focus")}}),this.uiDialogTitlebarClose=t("<button type='button'></button>").button({label:t("<a>").text(this.options.closeText).html(),icon:"ui-icon-closethick",showLabel:!1}).appendTo(this.uiDialogTitlebar),this._addClass(this.uiDialogTitlebarClose,"ui-dialog-titlebar-close"),this._on(this.uiDialogTitlebarClose,{click:function(t){t.preventDefault(),this.close(t)}}),e=t("<span>").uniqueId().prependTo(this.uiDialogTitlebar),this._addClass(e,"ui-dialog-title"),this._title(e),this.uiDialogTitlebar.prependTo(this.uiDialog),this.uiDialog.attr({"aria-labelledby":e.attr("id")})},_title:function(t){this.options.title?t.text(this.options.title):t.html("&#160;")},_createButtonPane:function(){this.uiDialogButtonPane=t("<div>"),this._addClass(this.uiDialogButtonPane,"ui-dialog-buttonpane","ui-widget-content ui-helper-clearfix"),this.uiButtonSet=t("<div>").appendTo(this.uiDialogButtonPane),this._addClass(this.uiButtonSet,"ui-dialog-buttonset"),this._createButtons()},_createButtons:function(){var e=this,i=this.options.buttons;return this.uiDialogButtonPane.remove(),this.uiButtonSet.empty(),t.isEmptyObject(i)||t.isArray(i)&&!i.length?(this._removeClass(this.uiDialog,"ui-dialog-buttons"),void 0):(t.each(i,function(i,s){var n,o;s=t.isFunction(s)?{click:s,text:i}:s,s=t.extend({type:"button"},s),n=s.click,o={icon:s.icon,iconPosition:s.iconPosition,showLabel:s.showLabel,icons:s.icons,text:s.text},delete s.click,delete s.icon,delete s.iconPosition,delete s.showLabel,delete s.icons,"boolean"==typeof s.text&&delete s.text,t("<button></button>",s).button(o).appendTo(e.uiButtonSet).on("click",function(){n.apply(e.element[0],arguments)})}),this._addClass(this.uiDialog,"ui-dialog-buttons"),this.uiDialogButtonPane.appendTo(this.uiDialog),void 0)},_makeDraggable:function(){function e(t){return{position:t.position,offset:t.offset}}var i=this,s=this.options;this.uiDialog.draggable({cancel:".ui-dialog-content, .ui-dialog-titlebar-close",handle:".ui-dialog-titlebar",containment:"document",start:function(s,n){i._addClass(t(this),"ui-dialog-dragging"),i._blockFrames(),i._trigger("dragStart",s,e(n))},drag:function(t,s){i._trigger("drag",t,e(s))},stop:function(n,o){var a=o.offset.left-i.document.scrollLeft(),r=o.offset.top-i.document.scrollTop();s.position={my:"left top",at:"left"+(a>=0?"+":"")+a+" "+"top"+(r>=0?"+":"")+r,of:i.window},i._removeClass(t(this),"ui-dialog-dragging"),i._unblockFrames(),i._trigger("dragStop",n,e(o))}})},_makeResizable:function(){function e(t){return{originalPosition:t.originalPosition,originalSize:t.originalSize,position:t.position,size:t.size}}var i=this,s=this.options,n=s.resizable,o=this.uiDialog.css("position"),a="string"==typeof n?n:"n,e,s,w,se,sw,ne,nw";this.uiDialog.resizable({cancel:".ui-dialog-content",containment:"document",alsoResize:this.element,maxWidth:s.maxWidth,maxHeight:s.maxHeight,minWidth:s.minWidth,minHeight:this._minHeight(),handles:a,start:function(s,n){i._addClass(t(this),"ui-dialog-resizing"),i._blockFrames(),i._trigger("resizeStart",s,e(n))},resize:function(t,s){i._trigger("resize",t,e(s))},stop:function(n,o){var a=i.uiDialog.offset(),r=a.left-i.document.scrollLeft(),h=a.top-i.document.scrollTop();s.height=i.uiDialog.height(),s.width=i.uiDialog.width(),s.position={my:"left top",at:"left"+(r>=0?"+":"")+r+" "+"top"+(h>=0?"+":"")+h,of:i.window},i._removeClass(t(this),"ui-dialog-resizing"),i._unblockFrames(),i._trigger("resizeStop",n,e(o))}}).css("position",o)},_trackFocus:function(){this._on(this.widget(),{focusin:function(e){this._makeFocusTarget(),this._focusedElement=t(e.target)}})},_makeFocusTarget:function(){this._untrackInstance(),this._trackingInstances().unshift(this)},_untrackInstance:function(){var e=this._trackingInstances(),i=t.inArray(this,e);-1!==i&&e.splice(i,1)},_trackingInstances:function(){var t=this.document.data("ui-dialog-instances");return t||(t=[],this.document.data("ui-dialog-instances",t)),t},_minHeight:function(){var t=this.options;return"auto"===t.height?t.minHeight:Math.min(t.minHeight,t.height)},_position:function(){var t=this.uiDialog.is(":visible");t||this.uiDialog.show(),this.uiDialog.position(this.options.position),t||this.uiDialog.hide()},_setOptions:function(e){var i=this,s=!1,n={};t.each(e,function(t,e){i._setOption(t,e),t in i.sizeRelatedOptions&&(s=!0),t in i.resizableRelatedOptions&&(n[t]=e)}),s&&(this._size(),this._position()),this.uiDialog.is(":data(ui-resizable)")&&this.uiDialog.resizable("option",n)},_setOption:function(e,i){var s,n,o=this.uiDialog;"disabled"!==e&&(this._super(e,i),"appendTo"===e&&this.uiDialog.appendTo(this._appendTo()),"buttons"===e&&this._createButtons(),"closeText"===e&&this.uiDialogTitlebarClose.button({label:t("<a>").text(""+this.options.closeText).html()}),"draggable"===e&&(s=o.is(":data(ui-draggable)"),s&&!i&&o.draggable("destroy"),!s&&i&&this._makeDraggable()),"position"===e&&this._position(),"resizable"===e&&(n=o.is(":data(ui-resizable)"),n&&!i&&o.resizable("destroy"),n&&"string"==typeof i&&o.resizable("option","handles",i),n||i===!1||this._makeResizable()),"title"===e&&this._title(this.uiDialogTitlebar.find(".ui-dialog-title")))},_size:function(){var t,e,i,s=this.options;this.element.show().css({width:"auto",minHeight:0,maxHeight:"none",height:0}),s.minWidth>s.width&&(s.width=s.minWidth),t=this.uiDialog.css({height:"auto",width:s.width}).outerHeight(),e=Math.max(0,s.minHeight-t),i="number"==typeof s.maxHeight?Math.max(0,s.maxHeight-t):"none","auto"===s.height?this.element.css({minHeight:e,maxHeight:i,height:"auto"}):this.element.height(Math.max(0,s.height-t)),this.uiDialog.is(":data(ui-resizable)")&&this.uiDialog.resizable("option","minHeight",this._minHeight())},_blockFrames:function(){this.iframeBlocks=this.document.find("iframe").map(function(){var e=t(this);return t("<div>").css({position:"absolute",width:e.outerWidth(),height:e.outerHeight()}).appendTo(e.parent()).offset(e.offset())[0]})},_unblockFrames:function(){this.iframeBlocks&&(this.iframeBlocks.remove(),delete this.iframeBlocks)},_allowInteraction:function(e){return t(e.target).closest(".ui-dialog").length?!0:!!t(e.target).closest(".ui-datepicker").length},_createOverlay:function(){if(this.options.modal){var e=!0;this._delay(function(){e=!1}),this.document.data("ui-dialog-overlays")||this._on(this.document,{focusin:function(t){e||this._allowInteraction(t)||(t.preventDefault(),this._trackingInstances()[0]._focusTabbable())}}),this.overlay=t("<div>").appendTo(this._appendTo()),this._addClass(this.overlay,null,"ui-widget-overlay ui-front"),this._on(this.overlay,{mousedown:"_keepFocus"}),this.document.data("ui-dialog-overlays",(this.document.data("ui-dialog-overlays")||0)+1)}},_destroyOverlay:function(){if(this.options.modal&&this.overlay){var t=this.document.data("ui-dialog-overlays")-1;t?this.document.data("ui-dialog-overlays",t):(this._off(this.document,"focusin"),this.document.removeData("ui-dialog-overlays")),this.overlay.remove(),this.overlay=null}}}),t.uiBackCompat!==!1&&t.widget("ui.dialog",t.ui.dialog,{options:{dialogClass:""},_createWrapper:function(){this._super(),this.uiDialog.addClass(this.options.dialogClass)},_setOption:function(t,e){"dialogClass"===t&&this.uiDialog.removeClass(this.options.dialogClass).addClass(e),this._superApply(arguments)}}),t.ui.dialog,t.widget("ui.droppable",{version:"1.12.1",widgetEventPrefix:"drop",options:{accept:"*",addClasses:!0,greedy:!1,scope:"default",tolerance:"intersect",activate:null,deactivate:null,drop:null,out:null,over:null},_create:function(){var e,i=this.options,s=i.accept;this.isover=!1,this.isout=!0,this.accept=t.isFunction(s)?s:function(t){return t.is(s)},this.proportions=function(){return arguments.length?(e=arguments[0],void 0):e?e:e={width:this.element[0].offsetWidth,height:this.element[0].offsetHeight}},this._addToManager(i.scope),i.addClasses&&this._addClass("ui-droppable")},_addToManager:function(e){t.ui.ddmanager.droppables[e]=t.ui.ddmanager.droppables[e]||[],t.ui.ddmanager.droppables[e].push(this)},_splice:function(t){for(var e=0;t.length>e;e++)t[e]===this&&t.splice(e,1)},_destroy:function(){var e=t.ui.ddmanager.droppables[this.options.scope];this._splice(e)},_setOption:function(e,i){if("accept"===e)this.accept=t.isFunction(i)?i:function(t){return t.is(i)};else if("scope"===e){var s=t.ui.ddmanager.droppables[this.options.scope];this._splice(s),this._addToManager(i)}this._super(e,i)},_activate:function(e){var i=t.ui.ddmanager.current;this._addActiveClass(),i&&this._trigger("activate",e,this.ui(i))},_deactivate:function(e){var i=t.ui.ddmanager.current;this._removeActiveClass(),i&&this._trigger("deactivate",e,this.ui(i))},_over:function(e){var i=t.ui.ddmanager.current;i&&(i.currentItem||i.element)[0]!==this.element[0]&&this.accept.call(this.element[0],i.currentItem||i.element)&&(this._addHoverClass(),this._trigger("over",e,this.ui(i)))},_out:function(e){var i=t.ui.ddmanager.current;i&&(i.currentItem||i.element)[0]!==this.element[0]&&this.accept.call(this.element[0],i.currentItem||i.element)&&(this._removeHoverClass(),this._trigger("out",e,this.ui(i)))},_drop:function(e,i){var s=i||t.ui.ddmanager.current,n=!1;return s&&(s.currentItem||s.element)[0]!==this.element[0]?(this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function(){var i=t(this).droppable("instance");return i.options.greedy&&!i.options.disabled&&i.options.scope===s.options.scope&&i.accept.call(i.element[0],s.currentItem||s.element)&&v(s,t.extend(i,{offset:i.element.offset()}),i.options.tolerance,e)?(n=!0,!1):void 0}),n?!1:this.accept.call(this.element[0],s.currentItem||s.element)?(this._removeActiveClass(),this._removeHoverClass(),this._trigger("drop",e,this.ui(s)),this.element):!1):!1},ui:function(t){return{draggable:t.currentItem||t.element,helper:t.helper,position:t.position,offset:t.positionAbs}},_addHoverClass:function(){this._addClass("ui-droppable-hover")},_removeHoverClass:function(){this._removeClass("ui-droppable-hover")},_addActiveClass:function(){this._addClass("ui-droppable-active")},_removeActiveClass:function(){this._removeClass("ui-droppable-active")}});var v=t.ui.intersect=function(){function t(t,e,i){return t>=e&&e+i>t}return function(e,i,s,n){if(!i.offset)return!1;var o=(e.positionAbs||e.position.absolute).left+e.margins.left,a=(e.positionAbs||e.position.absolute).top+e.margins.top,r=o+e.helperProportions.width,h=a+e.helperProportions.height,l=i.offset.left,c=i.offset.top,u=l+i.proportions().width,d=c+i.proportions().height;switch(s){case"fit":return o>=l&&u>=r&&a>=c&&d>=h;case"intersect":return o+e.helperProportions.width/2>l&&u>r-e.helperProportions.width/2&&a+e.helperProportions.height/2>c&&d>h-e.helperProportions.height/2;case"pointer":return t(n.pageY,c,i.proportions().height)&&t(n.pageX,l,i.proportions().width);case"touch":return(a>=c&&d>=a||h>=c&&d>=h||c>a&&h>d)&&(o>=l&&u>=o||r>=l&&u>=r||l>o&&r>u);default:return!1}}}();t.ui.ddmanager={current:null,droppables:{"default":[]},prepareOffsets:function(e,i){var s,n,o=t.ui.ddmanager.droppables[e.options.scope]||[],a=i?i.type:null,r=(e.currentItem||e.element).find(":data(ui-droppable)").addBack();t:for(s=0;o.length>s;s++)if(!(o[s].options.disabled||e&&!o[s].accept.call(o[s].element[0],e.currentItem||e.element))){for(n=0;r.length>n;n++)if(r[n]===o[s].element[0]){o[s].proportions().height=0;continue t}o[s].visible="none"!==o[s].element.css("display"),o[s].visible&&("mousedown"===a&&o[s]._activate.call(o[s],i),o[s].offset=o[s].element.offset(),o[s].proportions({width:o[s].element[0].offsetWidth,height:o[s].element[0].offsetHeight}))}},drop:function(e,i){var s=!1;return t.each((t.ui.ddmanager.droppables[e.options.scope]||[]).slice(),function(){this.options&&(!this.options.disabled&&this.visible&&v(e,this,this.options.tolerance,i)&&(s=this._drop.call(this,i)||s),!this.options.disabled&&this.visible&&this.accept.call(this.element[0],e.currentItem||e.element)&&(this.isout=!0,this.isover=!1,this._deactivate.call(this,i)))}),s},dragStart:function(e,i){e.element.parentsUntil("body").on("scroll.droppable",function(){e.options.refreshPositions||t.ui.ddmanager.prepareOffsets(e,i)})},drag:function(e,i){e.options.refreshPositions&&t.ui.ddmanager.prepareOffsets(e,i),t.each(t.ui.ddmanager.droppables[e.options.scope]||[],function(){if(!this.options.disabled&&!this.greedyChild&&this.visible){var s,n,o,a=v(e,this,this.options.tolerance,i),r=!a&&this.isover?"isout":a&&!this.isover?"isover":null;r&&(this.options.greedy&&(n=this.options.scope,o=this.element.parents(":data(ui-droppable)").filter(function(){return t(this).droppable("instance").options.scope===n}),o.length&&(s=t(o[0]).droppable("instance"),s.greedyChild="isover"===r)),s&&"isover"===r&&(s.isover=!1,s.isout=!0,s._out.call(s,i)),this[r]=!0,this["isout"===r?"isover":"isout"]=!1,this["isover"===r?"_over":"_out"].call(this,i),s&&"isout"===r&&(s.isout=!1,s.isover=!0,s._over.call(s,i)))}})},dragStop:function(e,i){e.element.parentsUntil("body").off("scroll.droppable"),e.options.refreshPositions||t.ui.ddmanager.prepareOffsets(e,i)}},t.uiBackCompat!==!1&&t.widget("ui.droppable",t.ui.droppable,{options:{hoverClass:!1,activeClass:!1},_addActiveClass:function(){this._super(),this.options.activeClass&&this.element.addClass(this.options.activeClass)},_removeActiveClass:function(){this._super(),this.options.activeClass&&this.element.removeClass(this.options.activeClass)},_addHoverClass:function(){this._super(),this.options.hoverClass&&this.element.addClass(this.options.hoverClass)},_removeHoverClass:function(){this._super(),this.options.hoverClass&&this.element.removeClass(this.options.hoverClass)}}),t.ui.droppable,t.widget("ui.progressbar",{version:"1.12.1",options:{classes:{"ui-progressbar":"ui-corner-all","ui-progressbar-value":"ui-corner-left","ui-progressbar-complete":"ui-corner-right"},max:100,value:0,change:null,complete:null},min:0,_create:function(){this.oldValue=this.options.value=this._constrainedValue(),this.element.attr({role:"progressbar","aria-valuemin":this.min}),this._addClass("ui-progressbar","ui-widget ui-widget-content"),this.valueDiv=t("<div>").appendTo(this.element),this._addClass(this.valueDiv,"ui-progressbar-value","ui-widget-header"),this._refreshValue()},_destroy:function(){this.element.removeAttr("role aria-valuemin aria-valuemax aria-valuenow"),this.valueDiv.remove()},value:function(t){return void 0===t?this.options.value:(this.options.value=this._constrainedValue(t),this._refreshValue(),void 0)},_constrainedValue:function(t){return void 0===t&&(t=this.options.value),this.indeterminate=t===!1,"number"!=typeof t&&(t=0),this.indeterminate?!1:Math.min(this.options.max,Math.max(this.min,t))},_setOptions:function(t){var e=t.value;delete t.value,this._super(t),this.options.value=this._constrainedValue(e),this._refreshValue()},_setOption:function(t,e){"max"===t&&(e=Math.max(this.min,e)),this._super(t,e)},_setOptionDisabled:function(t){this._super(t),this.element.attr("aria-disabled",t),this._toggleClass(null,"ui-state-disabled",!!t)},_percentage:function(){return this.indeterminate?100:100*(this.options.value-this.min)/(this.options.max-this.min)},_refreshValue:function(){var e=this.options.value,i=this._percentage();this.valueDiv.toggle(this.indeterminate||e>this.min).width(i.toFixed(0)+"%"),this._toggleClass(this.valueDiv,"ui-progressbar-complete",null,e===this.options.max)._toggleClass("ui-progressbar-indeterminate",null,this.indeterminate),this.indeterminate?(this.element.removeAttr("aria-valuenow"),this.overlayDiv||(this.overlayDiv=t("<div>").appendTo(this.valueDiv),this._addClass(this.overlayDiv,"ui-progressbar-overlay"))):(this.element.attr({"aria-valuemax":this.options.max,"aria-valuenow":e}),this.overlayDiv&&(this.overlayDiv.remove(),this.overlayDiv=null)),this.oldValue!==e&&(this.oldValue=e,this._trigger("change")),e===this.options.max&&this._trigger("complete")}}),t.widget("ui.selectable",t.ui.mouse,{version:"1.12.1",options:{appendTo:"body",autoRefresh:!0,distance:0,filter:"*",tolerance:"touch",selected:null,selecting:null,start:null,stop:null,unselected:null,unselecting:null},_create:function(){var e=this;this._addClass("ui-selectable"),this.dragged=!1,this.refresh=function(){e.elementPos=t(e.element[0]).offset(),e.selectees=t(e.options.filter,e.element[0]),e._addClass(e.selectees,"ui-selectee"),e.selectees.each(function(){var i=t(this),s=i.offset(),n={left:s.left-e.elementPos.left,top:s.top-e.elementPos.top};t.data(this,"selectable-item",{element:this,$element:i,left:n.left,top:n.top,right:n.left+i.outerWidth(),bottom:n.top+i.outerHeight(),startselected:!1,selected:i.hasClass("ui-selected"),selecting:i.hasClass("ui-selecting"),unselecting:i.hasClass("ui-unselecting")})})},this.refresh(),this._mouseInit(),this.helper=t("<div>"),this._addClass(this.helper,"ui-selectable-helper")},_destroy:function(){this.selectees.removeData("selectable-item"),this._mouseDestroy()},_mouseStart:function(e){var i=this,s=this.options;this.opos=[e.pageX,e.pageY],this.elementPos=t(this.element[0]).offset(),this.options.disabled||(this.selectees=t(s.filter,this.element[0]),this._trigger("start",e),t(s.appendTo).append(this.helper),this.helper.css({left:e.pageX,top:e.pageY,width:0,height:0}),s.autoRefresh&&this.refresh(),this.selectees.filter(".ui-selected").each(function(){var s=t.data(this,"selectable-item");s.startselected=!0,e.metaKey||e.ctrlKey||(i._removeClass(s.$element,"ui-selected"),s.selected=!1,i._addClass(s.$element,"ui-unselecting"),s.unselecting=!0,i._trigger("unselecting",e,{unselecting:s.element}))}),t(e.target).parents().addBack().each(function(){var s,n=t.data(this,"selectable-item");return n?(s=!e.metaKey&&!e.ctrlKey||!n.$element.hasClass("ui-selected"),i._removeClass(n.$element,s?"ui-unselecting":"ui-selected")._addClass(n.$element,s?"ui-selecting":"ui-unselecting"),n.unselecting=!s,n.selecting=s,n.selected=s,s?i._trigger("selecting",e,{selecting:n.element}):i._trigger("unselecting",e,{unselecting:n.element}),!1):void 0}))},_mouseDrag:function(e){if(this.dragged=!0,!this.options.disabled){var i,s=this,n=this.options,o=this.opos[0],a=this.opos[1],r=e.pageX,h=e.pageY;return o>r&&(i=r,r=o,o=i),a>h&&(i=h,h=a,a=i),this.helper.css({left:o,top:a,width:r-o,height:h-a}),this.selectees.each(function(){var i=t.data(this,"selectable-item"),l=!1,c={};i&&i.element!==s.element[0]&&(c.left=i.left+s.elementPos.left,c.right=i.right+s.elementPos.left,c.top=i.top+s.elementPos.top,c.bottom=i.bottom+s.elementPos.top,"touch"===n.tolerance?l=!(c.left>r||o>c.right||c.top>h||a>c.bottom):"fit"===n.tolerance&&(l=c.left>o&&r>c.right&&c.top>a&&h>c.bottom),l?(i.selected&&(s._removeClass(i.$element,"ui-selected"),i.selected=!1),i.unselecting&&(s._removeClass(i.$element,"ui-unselecting"),i.unselecting=!1),i.selecting||(s._addClass(i.$element,"ui-selecting"),i.selecting=!0,s._trigger("selecting",e,{selecting:i.element}))):(i.selecting&&((e.metaKey||e.ctrlKey)&&i.startselected?(s._removeClass(i.$element,"ui-selecting"),i.selecting=!1,s._addClass(i.$element,"ui-selected"),i.selected=!0):(s._removeClass(i.$element,"ui-selecting"),i.selecting=!1,i.startselected&&(s._addClass(i.$element,"ui-unselecting"),i.unselecting=!0),s._trigger("unselecting",e,{unselecting:i.element}))),i.selected&&(e.metaKey||e.ctrlKey||i.startselected||(s._removeClass(i.$element,"ui-selected"),i.selected=!1,s._addClass(i.$element,"ui-unselecting"),i.unselecting=!0,s._trigger("unselecting",e,{unselecting:i.element})))))}),!1}},_mouseStop:function(e){var i=this;return this.dragged=!1,t(".ui-unselecting",this.element[0]).each(function(){var s=t.data(this,"selectable-item");i._removeClass(s.$element,"ui-unselecting"),s.unselecting=!1,s.startselected=!1,i._trigger("unselected",e,{unselected:s.element})}),t(".ui-selecting",this.element[0]).each(function(){var s=t.data(this,"selectable-item");i._removeClass(s.$element,"ui-selecting")._addClass(s.$element,"ui-selected"),s.selecting=!1,s.selected=!0,s.startselected=!0,i._trigger("selected",e,{selected:s.element})}),this._trigger("stop",e),this.helper.remove(),!1}}),t.widget("ui.selectmenu",[t.ui.formResetMixin,{version:"1.12.1",defaultElement:"<select>",options:{appendTo:null,classes:{"ui-selectmenu-button-open":"ui-corner-top","ui-selectmenu-button-closed":"ui-corner-all"},disabled:null,icons:{button:"ui-icon-triangle-1-s"},position:{my:"left top",at:"left bottom",collision:"none"},width:!1,change:null,close:null,focus:null,open:null,select:null},_create:function(){var e=this.element.uniqueId().attr("id");this.ids={element:e,button:e+"-button",menu:e+"-menu"},this._drawButton(),this._drawMenu(),this._bindFormResetHandler(),this._rendered=!1,this.menuItems=t()},_drawButton:function(){var e,i=this,s=this._parseOption(this.element.find("option:selected"),this.element[0].selectedIndex);this.labels=this.element.labels().attr("for",this.ids.button),this._on(this.labels,{click:function(t){this.button.focus(),t.preventDefault()}}),this.element.hide(),this.button=t("<span>",{tabindex:this.options.disabled?-1:0,id:this.ids.button,role:"combobox","aria-expanded":"false","aria-autocomplete":"list","aria-owns":this.ids.menu,"aria-haspopup":"true",title:this.element.attr("title")}).insertAfter(this.element),this._addClass(this.button,"ui-selectmenu-button ui-selectmenu-button-closed","ui-button ui-widget"),e=t("<span>").appendTo(this.button),this._addClass(e,"ui-selectmenu-icon","ui-icon "+this.options.icons.button),this.buttonItem=this._renderButtonItem(s).appendTo(this.button),this.options.width!==!1&&this._resizeButton(),this._on(this.button,this._buttonEvents),this.button.one("focusin",function(){i._rendered||i._refreshMenu()})},_drawMenu:function(){var e=this;this.menu=t("<ul>",{"aria-hidden":"true","aria-labelledby":this.ids.button,id:this.ids.menu}),this.menuWrap=t("<div>").append(this.menu),this._addClass(this.menuWrap,"ui-selectmenu-menu","ui-front"),this.menuWrap.appendTo(this._appendTo()),this.menuInstance=this.menu.menu({classes:{"ui-menu":"ui-corner-bottom"},role:"listbox",select:function(t,i){t.preventDefault(),e._setSelection(),e._select(i.item.data("ui-selectmenu-item"),t)},focus:function(t,i){var s=i.item.data("ui-selectmenu-item");null!=e.focusIndex&&s.index!==e.focusIndex&&(e._trigger("focus",t,{item:s}),e.isOpen||e._select(s,t)),e.focusIndex=s.index,e.button.attr("aria-activedescendant",e.menuItems.eq(s.index).attr("id"))}}).menu("instance"),this.menuInstance._off(this.menu,"mouseleave"),this.menuInstance._closeOnDocumentClick=function(){return!1},this.menuInstance._isDivider=function(){return!1}},refresh:function(){this._refreshMenu(),this.buttonItem.replaceWith(this.buttonItem=this._renderButtonItem(this._getSelectedItem().data("ui-selectmenu-item")||{})),null===this.options.width&&this._resizeButton()},_refreshMenu:function(){var t,e=this.element.find("option");this.menu.empty(),this._parseOptions(e),this._renderMenu(this.menu,this.items),this.menuInstance.refresh(),this.menuItems=this.menu.find("li").not(".ui-selectmenu-optgroup").find(".ui-menu-item-wrapper"),this._rendered=!0,e.length&&(t=this._getSelectedItem(),this.menuInstance.focus(null,t),this._setAria(t.data("ui-selectmenu-item")),this._setOption("disabled",this.element.prop("disabled")))},open:function(t){this.options.disabled||(this._rendered?(this._removeClass(this.menu.find(".ui-state-active"),null,"ui-state-active"),this.menuInstance.focus(null,this._getSelectedItem())):this._refreshMenu(),this.menuItems.length&&(this.isOpen=!0,this._toggleAttr(),this._resizeMenu(),this._position(),this._on(this.document,this._documentClick),this._trigger("open",t)))},_position:function(){this.menuWrap.position(t.extend({of:this.button},this.options.position))},close:function(t){this.isOpen&&(this.isOpen=!1,this._toggleAttr(),this.range=null,this._off(this.document),this._trigger("close",t))},widget:function(){return this.button},menuWidget:function(){return this.menu},_renderButtonItem:function(e){var i=t("<span>");return this._setText(i,e.label),this._addClass(i,"ui-selectmenu-text"),i},_renderMenu:function(e,i){var s=this,n="";t.each(i,function(i,o){var a;o.optgroup!==n&&(a=t("<li>",{text:o.optgroup}),s._addClass(a,"ui-selectmenu-optgroup","ui-menu-divider"+(o.element.parent("optgroup").prop("disabled")?" ui-state-disabled":"")),a.appendTo(e),n=o.optgroup),s._renderItemData(e,o)})},_renderItemData:function(t,e){return this._renderItem(t,e).data("ui-selectmenu-item",e)},_renderItem:function(e,i){var s=t("<li>"),n=t("<div>",{title:i.element.attr("title")});return i.disabled&&this._addClass(s,null,"ui-state-disabled"),this._setText(n,i.label),s.append(n).appendTo(e)},_setText:function(t,e){e?t.text(e):t.html("&#160;")},_move:function(t,e){var i,s,n=".ui-menu-item";this.isOpen?i=this.menuItems.eq(this.focusIndex).parent("li"):(i=this.menuItems.eq(this.element[0].selectedIndex).parent("li"),n+=":not(.ui-state-disabled)"),s="first"===t||"last"===t?i["first"===t?"prevAll":"nextAll"](n).eq(-1):i[t+"All"](n).eq(0),s.length&&this.menuInstance.focus(e,s)},_getSelectedItem:function(){return this.menuItems.eq(this.element[0].selectedIndex).parent("li")},_toggle:function(t){this[this.isOpen?"close":"open"](t)},_setSelection:function(){var t;this.range&&(window.getSelection?(t=window.getSelection(),t.removeAllRanges(),t.addRange(this.range)):this.range.select(),this.button.focus())},_documentClick:{mousedown:function(e){this.isOpen&&(t(e.target).closest(".ui-selectmenu-menu, #"+t.ui.escapeSelector(this.ids.button)).length||this.close(e))}},_buttonEvents:{mousedown:function(){var t;window.getSelection?(t=window.getSelection(),t.rangeCount&&(this.range=t.getRangeAt(0))):this.range=document.selection.createRange()},click:function(t){this._setSelection(),this._toggle(t)},keydown:function(e){var i=!0;switch(e.keyCode){case t.ui.keyCode.TAB:case t.ui.keyCode.ESCAPE:this.close(e),i=!1;break;case t.ui.keyCode.ENTER:this.isOpen&&this._selectFocusedItem(e);break;case t.ui.keyCode.UP:e.altKey?this._toggle(e):this._move("prev",e);break;case t.ui.keyCode.DOWN:e.altKey?this._toggle(e):this._move("next",e);break;case t.ui.keyCode.SPACE:this.isOpen?this._selectFocusedItem(e):this._toggle(e);break;case t.ui.keyCode.LEFT:this._move("prev",e);break;case t.ui.keyCode.RIGHT:this._move("next",e);break;case t.ui.keyCode.HOME:case t.ui.keyCode.PAGE_UP:this._move("first",e);break;case t.ui.keyCode.END:case t.ui.keyCode.PAGE_DOWN:this._move("last",e);break;default:this.menu.trigger(e),i=!1}i&&e.preventDefault()}},_selectFocusedItem:function(t){var e=this.menuItems.eq(this.focusIndex).parent("li");e.hasClass("ui-state-disabled")||this._select(e.data("ui-selectmenu-item"),t)},_select:function(t,e){var i=this.element[0].selectedIndex;this.element[0].selectedIndex=t.index,this.buttonItem.replaceWith(this.buttonItem=this._renderButtonItem(t)),this._setAria(t),this._trigger("select",e,{item:t}),t.index!==i&&this._trigger("change",e,{item:t}),this.close(e)},_setAria:function(t){var e=this.menuItems.eq(t.index).attr("id");this.button.attr({"aria-labelledby":e,"aria-activedescendant":e}),this.menu.attr("aria-activedescendant",e)},_setOption:function(t,e){if("icons"===t){var i=this.button.find("span.ui-icon");this._removeClass(i,null,this.options.icons.button)._addClass(i,null,e.button)}this._super(t,e),"appendTo"===t&&this.menuWrap.appendTo(this._appendTo()),"width"===t&&this._resizeButton()},_setOptionDisabled:function(t){this._super(t),this.menuInstance.option("disabled",t),this.button.attr("aria-disabled",t),this._toggleClass(this.button,null,"ui-state-disabled",t),this.element.prop("disabled",t),t?(this.button.attr("tabindex",-1),this.close()):this.button.attr("tabindex",0)},_appendTo:function(){var e=this.options.appendTo;return e&&(e=e.jquery||e.nodeType?t(e):this.document.find(e).eq(0)),e&&e[0]||(e=this.element.closest(".ui-front, dialog")),e.length||(e=this.document[0].body),e},_toggleAttr:function(){this.button.attr("aria-expanded",this.isOpen),this._removeClass(this.button,"ui-selectmenu-button-"+(this.isOpen?"closed":"open"))._addClass(this.button,"ui-selectmenu-button-"+(this.isOpen?"open":"closed"))._toggleClass(this.menuWrap,"ui-selectmenu-open",null,this.isOpen),this.menu.attr("aria-hidden",!this.isOpen)},_resizeButton:function(){var t=this.options.width;return t===!1?(this.button.css("width",""),void 0):(null===t&&(t=this.element.show().outerWidth(),this.element.hide()),this.button.outerWidth(t),void 0)},_resizeMenu:function(){this.menu.outerWidth(Math.max(this.button.outerWidth(),this.menu.width("").outerWidth()+1))},_getCreateOptions:function(){var t=this._super();return t.disabled=this.element.prop("disabled"),t},_parseOptions:function(e){var i=this,s=[];e.each(function(e,n){s.push(i._parseOption(t(n),e))}),this.items=s},_parseOption:function(t,e){var i=t.parent("optgroup");return{element:t,index:e,value:t.val(),label:t.text(),optgroup:i.attr("label")||"",disabled:i.prop("disabled")||t.prop("disabled")}},_destroy:function(){this._unbindFormResetHandler(),this.menuWrap.remove(),this.button.remove(),this.element.show(),this.element.removeUniqueId(),this.labels.attr("for",this.ids.element)}}]),t.widget("ui.slider",t.ui.mouse,{version:"1.12.1",widgetEventPrefix:"slide",options:{animate:!1,classes:{"ui-slider":"ui-corner-all","ui-slider-handle":"ui-corner-all","ui-slider-range":"ui-corner-all ui-widget-header"},distance:0,max:100,min:0,orientation:"horizontal",range:!1,step:1,value:0,values:null,change:null,slide:null,start:null,stop:null},numPages:5,_create:function(){this._keySliding=!1,this._mouseSliding=!1,this._animateOff=!0,this._handleIndex=null,this._detectOrientation(),this._mouseInit(),this._calculateNewMax(),this._addClass("ui-slider ui-slider-"+this.orientation,"ui-widget ui-widget-content"),this._refresh(),this._animateOff=!1
},_refresh:function(){this._createRange(),this._createHandles(),this._setupEvents(),this._refreshValue()},_createHandles:function(){var e,i,s=this.options,n=this.element.find(".ui-slider-handle"),o="<span tabindex='0'></span>",a=[];for(i=s.values&&s.values.length||1,n.length>i&&(n.slice(i).remove(),n=n.slice(0,i)),e=n.length;i>e;e++)a.push(o);this.handles=n.add(t(a.join("")).appendTo(this.element)),this._addClass(this.handles,"ui-slider-handle","ui-state-default"),this.handle=this.handles.eq(0),this.handles.each(function(e){t(this).data("ui-slider-handle-index",e).attr("tabIndex",0)})},_createRange:function(){var e=this.options;e.range?(e.range===!0&&(e.values?e.values.length&&2!==e.values.length?e.values=[e.values[0],e.values[0]]:t.isArray(e.values)&&(e.values=e.values.slice(0)):e.values=[this._valueMin(),this._valueMin()]),this.range&&this.range.length?(this._removeClass(this.range,"ui-slider-range-min ui-slider-range-max"),this.range.css({left:"",bottom:""})):(this.range=t("<div>").appendTo(this.element),this._addClass(this.range,"ui-slider-range")),("min"===e.range||"max"===e.range)&&this._addClass(this.range,"ui-slider-range-"+e.range)):(this.range&&this.range.remove(),this.range=null)},_setupEvents:function(){this._off(this.handles),this._on(this.handles,this._handleEvents),this._hoverable(this.handles),this._focusable(this.handles)},_destroy:function(){this.handles.remove(),this.range&&this.range.remove(),this._mouseDestroy()},_mouseCapture:function(e){var i,s,n,o,a,r,h,l,c=this,u=this.options;return u.disabled?!1:(this.elementSize={width:this.element.outerWidth(),height:this.element.outerHeight()},this.elementOffset=this.element.offset(),i={x:e.pageX,y:e.pageY},s=this._normValueFromMouse(i),n=this._valueMax()-this._valueMin()+1,this.handles.each(function(e){var i=Math.abs(s-c.values(e));(n>i||n===i&&(e===c._lastChangedValue||c.values(e)===u.min))&&(n=i,o=t(this),a=e)}),r=this._start(e,a),r===!1?!1:(this._mouseSliding=!0,this._handleIndex=a,this._addClass(o,null,"ui-state-active"),o.trigger("focus"),h=o.offset(),l=!t(e.target).parents().addBack().is(".ui-slider-handle"),this._clickOffset=l?{left:0,top:0}:{left:e.pageX-h.left-o.width()/2,top:e.pageY-h.top-o.height()/2-(parseInt(o.css("borderTopWidth"),10)||0)-(parseInt(o.css("borderBottomWidth"),10)||0)+(parseInt(o.css("marginTop"),10)||0)},this.handles.hasClass("ui-state-hover")||this._slide(e,a,s),this._animateOff=!0,!0))},_mouseStart:function(){return!0},_mouseDrag:function(t){var e={x:t.pageX,y:t.pageY},i=this._normValueFromMouse(e);return this._slide(t,this._handleIndex,i),!1},_mouseStop:function(t){return this._removeClass(this.handles,null,"ui-state-active"),this._mouseSliding=!1,this._stop(t,this._handleIndex),this._change(t,this._handleIndex),this._handleIndex=null,this._clickOffset=null,this._animateOff=!1,!1},_detectOrientation:function(){this.orientation="vertical"===this.options.orientation?"vertical":"horizontal"},_normValueFromMouse:function(t){var e,i,s,n,o;return"horizontal"===this.orientation?(e=this.elementSize.width,i=t.x-this.elementOffset.left-(this._clickOffset?this._clickOffset.left:0)):(e=this.elementSize.height,i=t.y-this.elementOffset.top-(this._clickOffset?this._clickOffset.top:0)),s=i/e,s>1&&(s=1),0>s&&(s=0),"vertical"===this.orientation&&(s=1-s),n=this._valueMax()-this._valueMin(),o=this._valueMin()+s*n,this._trimAlignValue(o)},_uiHash:function(t,e,i){var s={handle:this.handles[t],handleIndex:t,value:void 0!==e?e:this.value()};return this._hasMultipleValues()&&(s.value=void 0!==e?e:this.values(t),s.values=i||this.values()),s},_hasMultipleValues:function(){return this.options.values&&this.options.values.length},_start:function(t,e){return this._trigger("start",t,this._uiHash(e))},_slide:function(t,e,i){var s,n,o=this.value(),a=this.values();this._hasMultipleValues()&&(n=this.values(e?0:1),o=this.values(e),2===this.options.values.length&&this.options.range===!0&&(i=0===e?Math.min(n,i):Math.max(n,i)),a[e]=i),i!==o&&(s=this._trigger("slide",t,this._uiHash(e,i,a)),s!==!1&&(this._hasMultipleValues()?this.values(e,i):this.value(i)))},_stop:function(t,e){this._trigger("stop",t,this._uiHash(e))},_change:function(t,e){this._keySliding||this._mouseSliding||(this._lastChangedValue=e,this._trigger("change",t,this._uiHash(e)))},value:function(t){return arguments.length?(this.options.value=this._trimAlignValue(t),this._refreshValue(),this._change(null,0),void 0):this._value()},values:function(e,i){var s,n,o;if(arguments.length>1)return this.options.values[e]=this._trimAlignValue(i),this._refreshValue(),this._change(null,e),void 0;if(!arguments.length)return this._values();if(!t.isArray(arguments[0]))return this._hasMultipleValues()?this._values(e):this.value();for(s=this.options.values,n=arguments[0],o=0;s.length>o;o+=1)s[o]=this._trimAlignValue(n[o]),this._change(null,o);this._refreshValue()},_setOption:function(e,i){var s,n=0;switch("range"===e&&this.options.range===!0&&("min"===i?(this.options.value=this._values(0),this.options.values=null):"max"===i&&(this.options.value=this._values(this.options.values.length-1),this.options.values=null)),t.isArray(this.options.values)&&(n=this.options.values.length),this._super(e,i),e){case"orientation":this._detectOrientation(),this._removeClass("ui-slider-horizontal ui-slider-vertical")._addClass("ui-slider-"+this.orientation),this._refreshValue(),this.options.range&&this._refreshRange(i),this.handles.css("horizontal"===i?"bottom":"left","");break;case"value":this._animateOff=!0,this._refreshValue(),this._change(null,0),this._animateOff=!1;break;case"values":for(this._animateOff=!0,this._refreshValue(),s=n-1;s>=0;s--)this._change(null,s);this._animateOff=!1;break;case"step":case"min":case"max":this._animateOff=!0,this._calculateNewMax(),this._refreshValue(),this._animateOff=!1;break;case"range":this._animateOff=!0,this._refresh(),this._animateOff=!1}},_setOptionDisabled:function(t){this._super(t),this._toggleClass(null,"ui-state-disabled",!!t)},_value:function(){var t=this.options.value;return t=this._trimAlignValue(t)},_values:function(t){var e,i,s;if(arguments.length)return e=this.options.values[t],e=this._trimAlignValue(e);if(this._hasMultipleValues()){for(i=this.options.values.slice(),s=0;i.length>s;s+=1)i[s]=this._trimAlignValue(i[s]);return i}return[]},_trimAlignValue:function(t){if(this._valueMin()>=t)return this._valueMin();if(t>=this._valueMax())return this._valueMax();var e=this.options.step>0?this.options.step:1,i=(t-this._valueMin())%e,s=t-i;return 2*Math.abs(i)>=e&&(s+=i>0?e:-e),parseFloat(s.toFixed(5))},_calculateNewMax:function(){var t=this.options.max,e=this._valueMin(),i=this.options.step,s=Math.round((t-e)/i)*i;t=s+e,t>this.options.max&&(t-=i),this.max=parseFloat(t.toFixed(this._precision()))},_precision:function(){var t=this._precisionOf(this.options.step);return null!==this.options.min&&(t=Math.max(t,this._precisionOf(this.options.min))),t},_precisionOf:function(t){var e=""+t,i=e.indexOf(".");return-1===i?0:e.length-i-1},_valueMin:function(){return this.options.min},_valueMax:function(){return this.max},_refreshRange:function(t){"vertical"===t&&this.range.css({width:"",left:""}),"horizontal"===t&&this.range.css({height:"",bottom:""})},_refreshValue:function(){var e,i,s,n,o,a=this.options.range,r=this.options,h=this,l=this._animateOff?!1:r.animate,c={};this._hasMultipleValues()?this.handles.each(function(s){i=100*((h.values(s)-h._valueMin())/(h._valueMax()-h._valueMin())),c["horizontal"===h.orientation?"left":"bottom"]=i+"%",t(this).stop(1,1)[l?"animate":"css"](c,r.animate),h.options.range===!0&&("horizontal"===h.orientation?(0===s&&h.range.stop(1,1)[l?"animate":"css"]({left:i+"%"},r.animate),1===s&&h.range[l?"animate":"css"]({width:i-e+"%"},{queue:!1,duration:r.animate})):(0===s&&h.range.stop(1,1)[l?"animate":"css"]({bottom:i+"%"},r.animate),1===s&&h.range[l?"animate":"css"]({height:i-e+"%"},{queue:!1,duration:r.animate}))),e=i}):(s=this.value(),n=this._valueMin(),o=this._valueMax(),i=o!==n?100*((s-n)/(o-n)):0,c["horizontal"===this.orientation?"left":"bottom"]=i+"%",this.handle.stop(1,1)[l?"animate":"css"](c,r.animate),"min"===a&&"horizontal"===this.orientation&&this.range.stop(1,1)[l?"animate":"css"]({width:i+"%"},r.animate),"max"===a&&"horizontal"===this.orientation&&this.range.stop(1,1)[l?"animate":"css"]({width:100-i+"%"},r.animate),"min"===a&&"vertical"===this.orientation&&this.range.stop(1,1)[l?"animate":"css"]({height:i+"%"},r.animate),"max"===a&&"vertical"===this.orientation&&this.range.stop(1,1)[l?"animate":"css"]({height:100-i+"%"},r.animate))},_handleEvents:{keydown:function(e){var i,s,n,o,a=t(e.target).data("ui-slider-handle-index");switch(e.keyCode){case t.ui.keyCode.HOME:case t.ui.keyCode.END:case t.ui.keyCode.PAGE_UP:case t.ui.keyCode.PAGE_DOWN:case t.ui.keyCode.UP:case t.ui.keyCode.RIGHT:case t.ui.keyCode.DOWN:case t.ui.keyCode.LEFT:if(e.preventDefault(),!this._keySliding&&(this._keySliding=!0,this._addClass(t(e.target),null,"ui-state-active"),i=this._start(e,a),i===!1))return}switch(o=this.options.step,s=n=this._hasMultipleValues()?this.values(a):this.value(),e.keyCode){case t.ui.keyCode.HOME:n=this._valueMin();break;case t.ui.keyCode.END:n=this._valueMax();break;case t.ui.keyCode.PAGE_UP:n=this._trimAlignValue(s+(this._valueMax()-this._valueMin())/this.numPages);break;case t.ui.keyCode.PAGE_DOWN:n=this._trimAlignValue(s-(this._valueMax()-this._valueMin())/this.numPages);break;case t.ui.keyCode.UP:case t.ui.keyCode.RIGHT:if(s===this._valueMax())return;n=this._trimAlignValue(s+o);break;case t.ui.keyCode.DOWN:case t.ui.keyCode.LEFT:if(s===this._valueMin())return;n=this._trimAlignValue(s-o)}this._slide(e,a,n)},keyup:function(e){var i=t(e.target).data("ui-slider-handle-index");this._keySliding&&(this._keySliding=!1,this._stop(e,i),this._change(e,i),this._removeClass(t(e.target),null,"ui-state-active"))}}}),t.widget("ui.sortable",t.ui.mouse,{version:"1.12.1",widgetEventPrefix:"sort",ready:!1,options:{appendTo:"parent",axis:!1,connectWith:!1,containment:!1,cursor:"auto",cursorAt:!1,dropOnEmpty:!0,forcePlaceholderSize:!1,forceHelperSize:!1,grid:!1,handle:!1,helper:"original",items:"> *",opacity:!1,placeholder:!1,revert:!1,scroll:!0,scrollSensitivity:20,scrollSpeed:20,scope:"default",tolerance:"intersect",zIndex:1e3,activate:null,beforeStop:null,change:null,deactivate:null,out:null,over:null,receive:null,remove:null,sort:null,start:null,stop:null,update:null},_isOverAxis:function(t,e,i){return t>=e&&e+i>t},_isFloating:function(t){return/left|right/.test(t.css("float"))||/inline|table-cell/.test(t.css("display"))},_create:function(){this.containerCache={},this._addClass("ui-sortable"),this.refresh(),this.offset=this.element.offset(),this._mouseInit(),this._setHandleClassName(),this.ready=!0},_setOption:function(t,e){this._super(t,e),"handle"===t&&this._setHandleClassName()},_setHandleClassName:function(){var e=this;this._removeClass(this.element.find(".ui-sortable-handle"),"ui-sortable-handle"),t.each(this.items,function(){e._addClass(this.instance.options.handle?this.item.find(this.instance.options.handle):this.item,"ui-sortable-handle")})},_destroy:function(){this._mouseDestroy();for(var t=this.items.length-1;t>=0;t--)this.items[t].item.removeData(this.widgetName+"-item");return this},_mouseCapture:function(e,i){var s=null,n=!1,o=this;return this.reverting?!1:this.options.disabled||"static"===this.options.type?!1:(this._refreshItems(e),t(e.target).parents().each(function(){return t.data(this,o.widgetName+"-item")===o?(s=t(this),!1):void 0}),t.data(e.target,o.widgetName+"-item")===o&&(s=t(e.target)),s?!this.options.handle||i||(t(this.options.handle,s).find("*").addBack().each(function(){this===e.target&&(n=!0)}),n)?(this.currentItem=s,this._removeCurrentsFromItems(),!0):!1:!1)},_mouseStart:function(e,i,s){var n,o,a=this.options;if(this.currentContainer=this,this.refreshPositions(),this.helper=this._createHelper(e),this._cacheHelperProportions(),this._cacheMargins(),this.scrollParent=this.helper.scrollParent(),this.offset=this.currentItem.offset(),this.offset={top:this.offset.top-this.margins.top,left:this.offset.left-this.margins.left},t.extend(this.offset,{click:{left:e.pageX-this.offset.left,top:e.pageY-this.offset.top},parent:this._getParentOffset(),relative:this._getRelativeOffset()}),this.helper.css("position","absolute"),this.cssPosition=this.helper.css("position"),this.originalPosition=this._generatePosition(e),this.originalPageX=e.pageX,this.originalPageY=e.pageY,a.cursorAt&&this._adjustOffsetFromHelper(a.cursorAt),this.domPosition={prev:this.currentItem.prev()[0],parent:this.currentItem.parent()[0]},this.helper[0]!==this.currentItem[0]&&this.currentItem.hide(),this._createPlaceholder(),a.containment&&this._setContainment(),a.cursor&&"auto"!==a.cursor&&(o=this.document.find("body"),this.storedCursor=o.css("cursor"),o.css("cursor",a.cursor),this.storedStylesheet=t("<style>*{ cursor: "+a.cursor+" !important; }</style>").appendTo(o)),a.opacity&&(this.helper.css("opacity")&&(this._storedOpacity=this.helper.css("opacity")),this.helper.css("opacity",a.opacity)),a.zIndex&&(this.helper.css("zIndex")&&(this._storedZIndex=this.helper.css("zIndex")),this.helper.css("zIndex",a.zIndex)),this.scrollParent[0]!==this.document[0]&&"HTML"!==this.scrollParent[0].tagName&&(this.overflowOffset=this.scrollParent.offset()),this._trigger("start",e,this._uiHash()),this._preserveHelperProportions||this._cacheHelperProportions(),!s)for(n=this.containers.length-1;n>=0;n--)this.containers[n]._trigger("activate",e,this._uiHash(this));return t.ui.ddmanager&&(t.ui.ddmanager.current=this),t.ui.ddmanager&&!a.dropBehaviour&&t.ui.ddmanager.prepareOffsets(this,e),this.dragging=!0,this._addClass(this.helper,"ui-sortable-helper"),this._mouseDrag(e),!0},_mouseDrag:function(e){var i,s,n,o,a=this.options,r=!1;for(this.position=this._generatePosition(e),this.positionAbs=this._convertPositionTo("absolute"),this.lastPositionAbs||(this.lastPositionAbs=this.positionAbs),this.options.scroll&&(this.scrollParent[0]!==this.document[0]&&"HTML"!==this.scrollParent[0].tagName?(this.overflowOffset.top+this.scrollParent[0].offsetHeight-e.pageY<a.scrollSensitivity?this.scrollParent[0].scrollTop=r=this.scrollParent[0].scrollTop+a.scrollSpeed:e.pageY-this.overflowOffset.top<a.scrollSensitivity&&(this.scrollParent[0].scrollTop=r=this.scrollParent[0].scrollTop-a.scrollSpeed),this.overflowOffset.left+this.scrollParent[0].offsetWidth-e.pageX<a.scrollSensitivity?this.scrollParent[0].scrollLeft=r=this.scrollParent[0].scrollLeft+a.scrollSpeed:e.pageX-this.overflowOffset.left<a.scrollSensitivity&&(this.scrollParent[0].scrollLeft=r=this.scrollParent[0].scrollLeft-a.scrollSpeed)):(e.pageY-this.document.scrollTop()<a.scrollSensitivity?r=this.document.scrollTop(this.document.scrollTop()-a.scrollSpeed):this.window.height()-(e.pageY-this.document.scrollTop())<a.scrollSensitivity&&(r=this.document.scrollTop(this.document.scrollTop()+a.scrollSpeed)),e.pageX-this.document.scrollLeft()<a.scrollSensitivity?r=this.document.scrollLeft(this.document.scrollLeft()-a.scrollSpeed):this.window.width()-(e.pageX-this.document.scrollLeft())<a.scrollSensitivity&&(r=this.document.scrollLeft(this.document.scrollLeft()+a.scrollSpeed))),r!==!1&&t.ui.ddmanager&&!a.dropBehaviour&&t.ui.ddmanager.prepareOffsets(this,e)),this.positionAbs=this._convertPositionTo("absolute"),this.options.axis&&"y"===this.options.axis||(this.helper[0].style.left=this.position.left+"px"),this.options.axis&&"x"===this.options.axis||(this.helper[0].style.top=this.position.top+"px"),i=this.items.length-1;i>=0;i--)if(s=this.items[i],n=s.item[0],o=this._intersectsWithPointer(s),o&&s.instance===this.currentContainer&&n!==this.currentItem[0]&&this.placeholder[1===o?"next":"prev"]()[0]!==n&&!t.contains(this.placeholder[0],n)&&("semi-dynamic"===this.options.type?!t.contains(this.element[0],n):!0)){if(this.direction=1===o?"down":"up","pointer"!==this.options.tolerance&&!this._intersectsWithSides(s))break;this._rearrange(e,s),this._trigger("change",e,this._uiHash());break}return this._contactContainers(e),t.ui.ddmanager&&t.ui.ddmanager.drag(this,e),this._trigger("sort",e,this._uiHash()),this.lastPositionAbs=this.positionAbs,!1},_mouseStop:function(e,i){if(e){if(t.ui.ddmanager&&!this.options.dropBehaviour&&t.ui.ddmanager.drop(this,e),this.options.revert){var s=this,n=this.placeholder.offset(),o=this.options.axis,a={};o&&"x"!==o||(a.left=n.left-this.offset.parent.left-this.margins.left+(this.offsetParent[0]===this.document[0].body?0:this.offsetParent[0].scrollLeft)),o&&"y"!==o||(a.top=n.top-this.offset.parent.top-this.margins.top+(this.offsetParent[0]===this.document[0].body?0:this.offsetParent[0].scrollTop)),this.reverting=!0,t(this.helper).animate(a,parseInt(this.options.revert,10)||500,function(){s._clear(e)})}else this._clear(e,i);return!1}},cancel:function(){if(this.dragging){this._mouseUp(new t.Event("mouseup",{target:null})),"original"===this.options.helper?(this.currentItem.css(this._storedCSS),this._removeClass(this.currentItem,"ui-sortable-helper")):this.currentItem.show();for(var e=this.containers.length-1;e>=0;e--)this.containers[e]._trigger("deactivate",null,this._uiHash(this)),this.containers[e].containerCache.over&&(this.containers[e]._trigger("out",null,this._uiHash(this)),this.containers[e].containerCache.over=0)}return this.placeholder&&(this.placeholder[0].parentNode&&this.placeholder[0].parentNode.removeChild(this.placeholder[0]),"original"!==this.options.helper&&this.helper&&this.helper[0].parentNode&&this.helper.remove(),t.extend(this,{helper:null,dragging:!1,reverting:!1,_noFinalSort:null}),this.domPosition.prev?t(this.domPosition.prev).after(this.currentItem):t(this.domPosition.parent).prepend(this.currentItem)),this},serialize:function(e){var i=this._getItemsAsjQuery(e&&e.connected),s=[];return e=e||{},t(i).each(function(){var i=(t(e.item||this).attr(e.attribute||"id")||"").match(e.expression||/(.+)[\-=_](.+)/);i&&s.push((e.key||i[1]+"[]")+"="+(e.key&&e.expression?i[1]:i[2]))}),!s.length&&e.key&&s.push(e.key+"="),s.join("&")},toArray:function(e){var i=this._getItemsAsjQuery(e&&e.connected),s=[];return e=e||{},i.each(function(){s.push(t(e.item||this).attr(e.attribute||"id")||"")}),s},_intersectsWith:function(t){var e=this.positionAbs.left,i=e+this.helperProportions.width,s=this.positionAbs.top,n=s+this.helperProportions.height,o=t.left,a=o+t.width,r=t.top,h=r+t.height,l=this.offset.click.top,c=this.offset.click.left,u="x"===this.options.axis||s+l>r&&h>s+l,d="y"===this.options.axis||e+c>o&&a>e+c,p=u&&d;return"pointer"===this.options.tolerance||this.options.forcePointerForContainers||"pointer"!==this.options.tolerance&&this.helperProportions[this.floating?"width":"height"]>t[this.floating?"width":"height"]?p:e+this.helperProportions.width/2>o&&a>i-this.helperProportions.width/2&&s+this.helperProportions.height/2>r&&h>n-this.helperProportions.height/2},_intersectsWithPointer:function(t){var e,i,s="x"===this.options.axis||this._isOverAxis(this.positionAbs.top+this.offset.click.top,t.top,t.height),n="y"===this.options.axis||this._isOverAxis(this.positionAbs.left+this.offset.click.left,t.left,t.width),o=s&&n;return o?(e=this._getDragVerticalDirection(),i=this._getDragHorizontalDirection(),this.floating?"right"===i||"down"===e?2:1:e&&("down"===e?2:1)):!1},_intersectsWithSides:function(t){var e=this._isOverAxis(this.positionAbs.top+this.offset.click.top,t.top+t.height/2,t.height),i=this._isOverAxis(this.positionAbs.left+this.offset.click.left,t.left+t.width/2,t.width),s=this._getDragVerticalDirection(),n=this._getDragHorizontalDirection();return this.floating&&n?"right"===n&&i||"left"===n&&!i:s&&("down"===s&&e||"up"===s&&!e)},_getDragVerticalDirection:function(){var t=this.positionAbs.top-this.lastPositionAbs.top;return 0!==t&&(t>0?"down":"up")},_getDragHorizontalDirection:function(){var t=this.positionAbs.left-this.lastPositionAbs.left;return 0!==t&&(t>0?"right":"left")},refresh:function(t){return this._refreshItems(t),this._setHandleClassName(),this.refreshPositions(),this},_connectWith:function(){var t=this.options;return t.connectWith.constructor===String?[t.connectWith]:t.connectWith},_getItemsAsjQuery:function(e){function i(){r.push(this)}var s,n,o,a,r=[],h=[],l=this._connectWith();if(l&&e)for(s=l.length-1;s>=0;s--)for(o=t(l[s],this.document[0]),n=o.length-1;n>=0;n--)a=t.data(o[n],this.widgetFullName),a&&a!==this&&!a.options.disabled&&h.push([t.isFunction(a.options.items)?a.options.items.call(a.element):t(a.options.items,a.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"),a]);for(h.push([t.isFunction(this.options.items)?this.options.items.call(this.element,null,{options:this.options,item:this.currentItem}):t(this.options.items,this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"),this]),s=h.length-1;s>=0;s--)h[s][0].each(i);return t(r)},_removeCurrentsFromItems:function(){var e=this.currentItem.find(":data("+this.widgetName+"-item)");this.items=t.grep(this.items,function(t){for(var i=0;e.length>i;i++)if(e[i]===t.item[0])return!1;return!0})},_refreshItems:function(e){this.items=[],this.containers=[this];var i,s,n,o,a,r,h,l,c=this.items,u=[[t.isFunction(this.options.items)?this.options.items.call(this.element[0],e,{item:this.currentItem}):t(this.options.items,this.element),this]],d=this._connectWith();if(d&&this.ready)for(i=d.length-1;i>=0;i--)for(n=t(d[i],this.document[0]),s=n.length-1;s>=0;s--)o=t.data(n[s],this.widgetFullName),o&&o!==this&&!o.options.disabled&&(u.push([t.isFunction(o.options.items)?o.options.items.call(o.element[0],e,{item:this.currentItem}):t(o.options.items,o.element),o]),this.containers.push(o));for(i=u.length-1;i>=0;i--)for(a=u[i][1],r=u[i][0],s=0,l=r.length;l>s;s++)h=t(r[s]),h.data(this.widgetName+"-item",a),c.push({item:h,instance:a,width:0,height:0,left:0,top:0})},refreshPositions:function(e){this.floating=this.items.length?"x"===this.options.axis||this._isFloating(this.items[0].item):!1,this.offsetParent&&this.helper&&(this.offset.parent=this._getParentOffset());var i,s,n,o;for(i=this.items.length-1;i>=0;i--)s=this.items[i],s.instance!==this.currentContainer&&this.currentContainer&&s.item[0]!==this.currentItem[0]||(n=this.options.toleranceElement?t(this.options.toleranceElement,s.item):s.item,e||(s.width=n.outerWidth(),s.height=n.outerHeight()),o=n.offset(),s.left=o.left,s.top=o.top);if(this.options.custom&&this.options.custom.refreshContainers)this.options.custom.refreshContainers.call(this);else for(i=this.containers.length-1;i>=0;i--)o=this.containers[i].element.offset(),this.containers[i].containerCache.left=o.left,this.containers[i].containerCache.top=o.top,this.containers[i].containerCache.width=this.containers[i].element.outerWidth(),this.containers[i].containerCache.height=this.containers[i].element.outerHeight();return this},_createPlaceholder:function(e){e=e||this;var i,s=e.options;s.placeholder&&s.placeholder.constructor!==String||(i=s.placeholder,s.placeholder={element:function(){var s=e.currentItem[0].nodeName.toLowerCase(),n=t("<"+s+">",e.document[0]);return e._addClass(n,"ui-sortable-placeholder",i||e.currentItem[0].className)._removeClass(n,"ui-sortable-helper"),"tbody"===s?e._createTrPlaceholder(e.currentItem.find("tr").eq(0),t("<tr>",e.document[0]).appendTo(n)):"tr"===s?e._createTrPlaceholder(e.currentItem,n):"img"===s&&n.attr("src",e.currentItem.attr("src")),i||n.css("visibility","hidden"),n},update:function(t,n){(!i||s.forcePlaceholderSize)&&(n.height()||n.height(e.currentItem.innerHeight()-parseInt(e.currentItem.css("paddingTop")||0,10)-parseInt(e.currentItem.css("paddingBottom")||0,10)),n.width()||n.width(e.currentItem.innerWidth()-parseInt(e.currentItem.css("paddingLeft")||0,10)-parseInt(e.currentItem.css("paddingRight")||0,10)))}}),e.placeholder=t(s.placeholder.element.call(e.element,e.currentItem)),e.currentItem.after(e.placeholder),s.placeholder.update(e,e.placeholder)},_createTrPlaceholder:function(e,i){var s=this;e.children().each(function(){t("<td>&#160;</td>",s.document[0]).attr("colspan",t(this).attr("colspan")||1).appendTo(i)})},_contactContainers:function(e){var i,s,n,o,a,r,h,l,c,u,d=null,p=null;for(i=this.containers.length-1;i>=0;i--)if(!t.contains(this.currentItem[0],this.containers[i].element[0]))if(this._intersectsWith(this.containers[i].containerCache)){if(d&&t.contains(this.containers[i].element[0],d.element[0]))continue;d=this.containers[i],p=i}else this.containers[i].containerCache.over&&(this.containers[i]._trigger("out",e,this._uiHash(this)),this.containers[i].containerCache.over=0);if(d)if(1===this.containers.length)this.containers[p].containerCache.over||(this.containers[p]._trigger("over",e,this._uiHash(this)),this.containers[p].containerCache.over=1);else{for(n=1e4,o=null,c=d.floating||this._isFloating(this.currentItem),a=c?"left":"top",r=c?"width":"height",u=c?"pageX":"pageY",s=this.items.length-1;s>=0;s--)t.contains(this.containers[p].element[0],this.items[s].item[0])&&this.items[s].item[0]!==this.currentItem[0]&&(h=this.items[s].item.offset()[a],l=!1,e[u]-h>this.items[s][r]/2&&(l=!0),n>Math.abs(e[u]-h)&&(n=Math.abs(e[u]-h),o=this.items[s],this.direction=l?"up":"down"));if(!o&&!this.options.dropOnEmpty)return;if(this.currentContainer===this.containers[p])return this.currentContainer.containerCache.over||(this.containers[p]._trigger("over",e,this._uiHash()),this.currentContainer.containerCache.over=1),void 0;o?this._rearrange(e,o,null,!0):this._rearrange(e,null,this.containers[p].element,!0),this._trigger("change",e,this._uiHash()),this.containers[p]._trigger("change",e,this._uiHash(this)),this.currentContainer=this.containers[p],this.options.placeholder.update(this.currentContainer,this.placeholder),this.containers[p]._trigger("over",e,this._uiHash(this)),this.containers[p].containerCache.over=1}},_createHelper:function(e){var i=this.options,s=t.isFunction(i.helper)?t(i.helper.apply(this.element[0],[e,this.currentItem])):"clone"===i.helper?this.currentItem.clone():this.currentItem;return s.parents("body").length||t("parent"!==i.appendTo?i.appendTo:this.currentItem[0].parentNode)[0].appendChild(s[0]),s[0]===this.currentItem[0]&&(this._storedCSS={width:this.currentItem[0].style.width,height:this.currentItem[0].style.height,position:this.currentItem.css("position"),top:this.currentItem.css("top"),left:this.currentItem.css("left")}),(!s[0].style.width||i.forceHelperSize)&&s.width(this.currentItem.width()),(!s[0].style.height||i.forceHelperSize)&&s.height(this.currentItem.height()),s},_adjustOffsetFromHelper:function(e){"string"==typeof e&&(e=e.split(" ")),t.isArray(e)&&(e={left:+e[0],top:+e[1]||0}),"left"in e&&(this.offset.click.left=e.left+this.margins.left),"right"in e&&(this.offset.click.left=this.helperProportions.width-e.right+this.margins.left),"top"in e&&(this.offset.click.top=e.top+this.margins.top),"bottom"in e&&(this.offset.click.top=this.helperProportions.height-e.bottom+this.margins.top)},_getParentOffset:function(){this.offsetParent=this.helper.offsetParent();var e=this.offsetParent.offset();return"absolute"===this.cssPosition&&this.scrollParent[0]!==this.document[0]&&t.contains(this.scrollParent[0],this.offsetParent[0])&&(e.left+=this.scrollParent.scrollLeft(),e.top+=this.scrollParent.scrollTop()),(this.offsetParent[0]===this.document[0].body||this.offsetParent[0].tagName&&"html"===this.offsetParent[0].tagName.toLowerCase()&&t.ui.ie)&&(e={top:0,left:0}),{top:e.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),left:e.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)}},_getRelativeOffset:function(){if("relative"===this.cssPosition){var t=this.currentItem.position();return{top:t.top-(parseInt(this.helper.css("top"),10)||0)+this.scrollParent.scrollTop(),left:t.left-(parseInt(this.helper.css("left"),10)||0)+this.scrollParent.scrollLeft()}}return{top:0,left:0}},_cacheMargins:function(){this.margins={left:parseInt(this.currentItem.css("marginLeft"),10)||0,top:parseInt(this.currentItem.css("marginTop"),10)||0}},_cacheHelperProportions:function(){this.helperProportions={width:this.helper.outerWidth(),height:this.helper.outerHeight()}},_setContainment:function(){var e,i,s,n=this.options;"parent"===n.containment&&(n.containment=this.helper[0].parentNode),("document"===n.containment||"window"===n.containment)&&(this.containment=[0-this.offset.relative.left-this.offset.parent.left,0-this.offset.relative.top-this.offset.parent.top,"document"===n.containment?this.document.width():this.window.width()-this.helperProportions.width-this.margins.left,("document"===n.containment?this.document.height()||document.body.parentNode.scrollHeight:this.window.height()||this.document[0].body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top]),/^(document|window|parent)$/.test(n.containment)||(e=t(n.containment)[0],i=t(n.containment).offset(),s="hidden"!==t(e).css("overflow"),this.containment=[i.left+(parseInt(t(e).css("borderLeftWidth"),10)||0)+(parseInt(t(e).css("paddingLeft"),10)||0)-this.margins.left,i.top+(parseInt(t(e).css("borderTopWidth"),10)||0)+(parseInt(t(e).css("paddingTop"),10)||0)-this.margins.top,i.left+(s?Math.max(e.scrollWidth,e.offsetWidth):e.offsetWidth)-(parseInt(t(e).css("borderLeftWidth"),10)||0)-(parseInt(t(e).css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left,i.top+(s?Math.max(e.scrollHeight,e.offsetHeight):e.offsetHeight)-(parseInt(t(e).css("borderTopWidth"),10)||0)-(parseInt(t(e).css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top])},_convertPositionTo:function(e,i){i||(i=this.position);var s="absolute"===e?1:-1,n="absolute"!==this.cssPosition||this.scrollParent[0]!==this.document[0]&&t.contains(this.scrollParent[0],this.offsetParent[0])?this.scrollParent:this.offsetParent,o=/(html|body)/i.test(n[0].tagName);return{top:i.top+this.offset.relative.top*s+this.offset.parent.top*s-("fixed"===this.cssPosition?-this.scrollParent.scrollTop():o?0:n.scrollTop())*s,left:i.left+this.offset.relative.left*s+this.offset.parent.left*s-("fixed"===this.cssPosition?-this.scrollParent.scrollLeft():o?0:n.scrollLeft())*s}},_generatePosition:function(e){var i,s,n=this.options,o=e.pageX,a=e.pageY,r="absolute"!==this.cssPosition||this.scrollParent[0]!==this.document[0]&&t.contains(this.scrollParent[0],this.offsetParent[0])?this.scrollParent:this.offsetParent,h=/(html|body)/i.test(r[0].tagName);return"relative"!==this.cssPosition||this.scrollParent[0]!==this.document[0]&&this.scrollParent[0]!==this.offsetParent[0]||(this.offset.relative=this._getRelativeOffset()),this.originalPosition&&(this.containment&&(e.pageX-this.offset.click.left<this.containment[0]&&(o=this.containment[0]+this.offset.click.left),e.pageY-this.offset.click.top<this.containment[1]&&(a=this.containment[1]+this.offset.click.top),e.pageX-this.offset.click.left>this.containment[2]&&(o=this.containment[2]+this.offset.click.left),e.pageY-this.offset.click.top>this.containment[3]&&(a=this.containment[3]+this.offset.click.top)),n.grid&&(i=this.originalPageY+Math.round((a-this.originalPageY)/n.grid[1])*n.grid[1],a=this.containment?i-this.offset.click.top>=this.containment[1]&&i-this.offset.click.top<=this.containment[3]?i:i-this.offset.click.top>=this.containment[1]?i-n.grid[1]:i+n.grid[1]:i,s=this.originalPageX+Math.round((o-this.originalPageX)/n.grid[0])*n.grid[0],o=this.containment?s-this.offset.click.left>=this.containment[0]&&s-this.offset.click.left<=this.containment[2]?s:s-this.offset.click.left>=this.containment[0]?s-n.grid[0]:s+n.grid[0]:s)),{top:a-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+("fixed"===this.cssPosition?-this.scrollParent.scrollTop():h?0:r.scrollTop()),left:o-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+("fixed"===this.cssPosition?-this.scrollParent.scrollLeft():h?0:r.scrollLeft())}},_rearrange:function(t,e,i,s){i?i[0].appendChild(this.placeholder[0]):e.item[0].parentNode.insertBefore(this.placeholder[0],"down"===this.direction?e.item[0]:e.item[0].nextSibling),this.counter=this.counter?++this.counter:1;var n=this.counter;
this._delay(function(){n===this.counter&&this.refreshPositions(!s)})},_clear:function(t,e){function i(t,e,i){return function(s){i._trigger(t,s,e._uiHash(e))}}this.reverting=!1;var s,n=[];if(!this._noFinalSort&&this.currentItem.parent().length&&this.placeholder.before(this.currentItem),this._noFinalSort=null,this.helper[0]===this.currentItem[0]){for(s in this._storedCSS)("auto"===this._storedCSS[s]||"static"===this._storedCSS[s])&&(this._storedCSS[s]="");this.currentItem.css(this._storedCSS),this._removeClass(this.currentItem,"ui-sortable-helper")}else this.currentItem.show();for(this.fromOutside&&!e&&n.push(function(t){this._trigger("receive",t,this._uiHash(this.fromOutside))}),!this.fromOutside&&this.domPosition.prev===this.currentItem.prev().not(".ui-sortable-helper")[0]&&this.domPosition.parent===this.currentItem.parent()[0]||e||n.push(function(t){this._trigger("update",t,this._uiHash())}),this!==this.currentContainer&&(e||(n.push(function(t){this._trigger("remove",t,this._uiHash())}),n.push(function(t){return function(e){t._trigger("receive",e,this._uiHash(this))}}.call(this,this.currentContainer)),n.push(function(t){return function(e){t._trigger("update",e,this._uiHash(this))}}.call(this,this.currentContainer)))),s=this.containers.length-1;s>=0;s--)e||n.push(i("deactivate",this,this.containers[s])),this.containers[s].containerCache.over&&(n.push(i("out",this,this.containers[s])),this.containers[s].containerCache.over=0);if(this.storedCursor&&(this.document.find("body").css("cursor",this.storedCursor),this.storedStylesheet.remove()),this._storedOpacity&&this.helper.css("opacity",this._storedOpacity),this._storedZIndex&&this.helper.css("zIndex","auto"===this._storedZIndex?"":this._storedZIndex),this.dragging=!1,e||this._trigger("beforeStop",t,this._uiHash()),this.placeholder[0].parentNode.removeChild(this.placeholder[0]),this.cancelHelperRemoval||(this.helper[0]!==this.currentItem[0]&&this.helper.remove(),this.helper=null),!e){for(s=0;n.length>s;s++)n[s].call(this,t);this._trigger("stop",t,this._uiHash())}return this.fromOutside=!1,!this.cancelHelperRemoval},_trigger:function(){t.Widget.prototype._trigger.apply(this,arguments)===!1&&this.cancel()},_uiHash:function(e){var i=e||this;return{helper:i.helper,placeholder:i.placeholder||t([]),position:i.position,originalPosition:i.originalPosition,offset:i.positionAbs,item:i.currentItem,sender:e?e.element:null}}}),t.widget("ui.spinner",{version:"1.12.1",defaultElement:"<input>",widgetEventPrefix:"spin",options:{classes:{"ui-spinner":"ui-corner-all","ui-spinner-down":"ui-corner-br","ui-spinner-up":"ui-corner-tr"},culture:null,icons:{down:"ui-icon-triangle-1-s",up:"ui-icon-triangle-1-n"},incremental:!0,max:null,min:null,numberFormat:null,page:10,step:1,change:null,spin:null,start:null,stop:null},_create:function(){this._setOption("max",this.options.max),this._setOption("min",this.options.min),this._setOption("step",this.options.step),""!==this.value()&&this._value(this.element.val(),!0),this._draw(),this._on(this._events),this._refresh(),this._on(this.window,{beforeunload:function(){this.element.removeAttr("autocomplete")}})},_getCreateOptions:function(){var e=this._super(),i=this.element;return t.each(["min","max","step"],function(t,s){var n=i.attr(s);null!=n&&n.length&&(e[s]=n)}),e},_events:{keydown:function(t){this._start(t)&&this._keydown(t)&&t.preventDefault()},keyup:"_stop",focus:function(){this.previous=this.element.val()},blur:function(t){return this.cancelBlur?(delete this.cancelBlur,void 0):(this._stop(),this._refresh(),this.previous!==this.element.val()&&this._trigger("change",t),void 0)},mousewheel:function(t,e){if(e){if(!this.spinning&&!this._start(t))return!1;this._spin((e>0?1:-1)*this.options.step,t),clearTimeout(this.mousewheelTimer),this.mousewheelTimer=this._delay(function(){this.spinning&&this._stop(t)},100),t.preventDefault()}},"mousedown .ui-spinner-button":function(e){function i(){var e=this.element[0]===t.ui.safeActiveElement(this.document[0]);e||(this.element.trigger("focus"),this.previous=s,this._delay(function(){this.previous=s}))}var s;s=this.element[0]===t.ui.safeActiveElement(this.document[0])?this.previous:this.element.val(),e.preventDefault(),i.call(this),this.cancelBlur=!0,this._delay(function(){delete this.cancelBlur,i.call(this)}),this._start(e)!==!1&&this._repeat(null,t(e.currentTarget).hasClass("ui-spinner-up")?1:-1,e)},"mouseup .ui-spinner-button":"_stop","mouseenter .ui-spinner-button":function(e){return t(e.currentTarget).hasClass("ui-state-active")?this._start(e)===!1?!1:(this._repeat(null,t(e.currentTarget).hasClass("ui-spinner-up")?1:-1,e),void 0):void 0},"mouseleave .ui-spinner-button":"_stop"},_enhance:function(){this.uiSpinner=this.element.attr("autocomplete","off").wrap("<span>").parent().append("<a></a><a></a>")},_draw:function(){this._enhance(),this._addClass(this.uiSpinner,"ui-spinner","ui-widget ui-widget-content"),this._addClass("ui-spinner-input"),this.element.attr("role","spinbutton"),this.buttons=this.uiSpinner.children("a").attr("tabIndex",-1).attr("aria-hidden",!0).button({classes:{"ui-button":""}}),this._removeClass(this.buttons,"ui-corner-all"),this._addClass(this.buttons.first(),"ui-spinner-button ui-spinner-up"),this._addClass(this.buttons.last(),"ui-spinner-button ui-spinner-down"),this.buttons.first().button({icon:this.options.icons.up,showLabel:!1}),this.buttons.last().button({icon:this.options.icons.down,showLabel:!1}),this.buttons.height()>Math.ceil(.5*this.uiSpinner.height())&&this.uiSpinner.height()>0&&this.uiSpinner.height(this.uiSpinner.height())},_keydown:function(e){var i=this.options,s=t.ui.keyCode;switch(e.keyCode){case s.UP:return this._repeat(null,1,e),!0;case s.DOWN:return this._repeat(null,-1,e),!0;case s.PAGE_UP:return this._repeat(null,i.page,e),!0;case s.PAGE_DOWN:return this._repeat(null,-i.page,e),!0}return!1},_start:function(t){return this.spinning||this._trigger("start",t)!==!1?(this.counter||(this.counter=1),this.spinning=!0,!0):!1},_repeat:function(t,e,i){t=t||500,clearTimeout(this.timer),this.timer=this._delay(function(){this._repeat(40,e,i)},t),this._spin(e*this.options.step,i)},_spin:function(t,e){var i=this.value()||0;this.counter||(this.counter=1),i=this._adjustValue(i+t*this._increment(this.counter)),this.spinning&&this._trigger("spin",e,{value:i})===!1||(this._value(i),this.counter++)},_increment:function(e){var i=this.options.incremental;return i?t.isFunction(i)?i(e):Math.floor(e*e*e/5e4-e*e/500+17*e/200+1):1},_precision:function(){var t=this._precisionOf(this.options.step);return null!==this.options.min&&(t=Math.max(t,this._precisionOf(this.options.min))),t},_precisionOf:function(t){var e=""+t,i=e.indexOf(".");return-1===i?0:e.length-i-1},_adjustValue:function(t){var e,i,s=this.options;return e=null!==s.min?s.min:0,i=t-e,i=Math.round(i/s.step)*s.step,t=e+i,t=parseFloat(t.toFixed(this._precision())),null!==s.max&&t>s.max?s.max:null!==s.min&&s.min>t?s.min:t},_stop:function(t){this.spinning&&(clearTimeout(this.timer),clearTimeout(this.mousewheelTimer),this.counter=0,this.spinning=!1,this._trigger("stop",t))},_setOption:function(t,e){var i,s,n;return"culture"===t||"numberFormat"===t?(i=this._parse(this.element.val()),this.options[t]=e,this.element.val(this._format(i)),void 0):(("max"===t||"min"===t||"step"===t)&&"string"==typeof e&&(e=this._parse(e)),"icons"===t&&(s=this.buttons.first().find(".ui-icon"),this._removeClass(s,null,this.options.icons.up),this._addClass(s,null,e.up),n=this.buttons.last().find(".ui-icon"),this._removeClass(n,null,this.options.icons.down),this._addClass(n,null,e.down)),this._super(t,e),void 0)},_setOptionDisabled:function(t){this._super(t),this._toggleClass(this.uiSpinner,null,"ui-state-disabled",!!t),this.element.prop("disabled",!!t),this.buttons.button(t?"disable":"enable")},_setOptions:r(function(t){this._super(t)}),_parse:function(t){return"string"==typeof t&&""!==t&&(t=window.Globalize&&this.options.numberFormat?Globalize.parseFloat(t,10,this.options.culture):+t),""===t||isNaN(t)?null:t},_format:function(t){return""===t?"":window.Globalize&&this.options.numberFormat?Globalize.format(t,this.options.numberFormat,this.options.culture):t},_refresh:function(){this.element.attr({"aria-valuemin":this.options.min,"aria-valuemax":this.options.max,"aria-valuenow":this._parse(this.element.val())})},isValid:function(){var t=this.value();return null===t?!1:t===this._adjustValue(t)},_value:function(t,e){var i;""!==t&&(i=this._parse(t),null!==i&&(e||(i=this._adjustValue(i)),t=this._format(i))),this.element.val(t),this._refresh()},_destroy:function(){this.element.prop("disabled",!1).removeAttr("autocomplete role aria-valuemin aria-valuemax aria-valuenow"),this.uiSpinner.replaceWith(this.element)},stepUp:r(function(t){this._stepUp(t)}),_stepUp:function(t){this._start()&&(this._spin((t||1)*this.options.step),this._stop())},stepDown:r(function(t){this._stepDown(t)}),_stepDown:function(t){this._start()&&(this._spin((t||1)*-this.options.step),this._stop())},pageUp:r(function(t){this._stepUp((t||1)*this.options.page)}),pageDown:r(function(t){this._stepDown((t||1)*this.options.page)}),value:function(t){return arguments.length?(r(this._value).call(this,t),void 0):this._parse(this.element.val())},widget:function(){return this.uiSpinner}}),t.uiBackCompat!==!1&&t.widget("ui.spinner",t.ui.spinner,{_enhance:function(){this.uiSpinner=this.element.attr("autocomplete","off").wrap(this._uiSpinnerHtml()).parent().append(this._buttonHtml())},_uiSpinnerHtml:function(){return"<span>"},_buttonHtml:function(){return"<a></a><a></a>"}}),t.ui.spinner,t.widget("ui.tabs",{version:"1.12.1",delay:300,options:{active:null,classes:{"ui-tabs":"ui-corner-all","ui-tabs-nav":"ui-corner-all","ui-tabs-panel":"ui-corner-bottom","ui-tabs-tab":"ui-corner-top"},collapsible:!1,event:"click",heightStyle:"content",hide:null,show:null,activate:null,beforeActivate:null,beforeLoad:null,load:null},_isLocal:function(){var t=/#.*$/;return function(e){var i,s;i=e.href.replace(t,""),s=location.href.replace(t,"");try{i=decodeURIComponent(i)}catch(n){}try{s=decodeURIComponent(s)}catch(n){}return e.hash.length>1&&i===s}}(),_create:function(){var e=this,i=this.options;this.running=!1,this._addClass("ui-tabs","ui-widget ui-widget-content"),this._toggleClass("ui-tabs-collapsible",null,i.collapsible),this._processTabs(),i.active=this._initialActive(),t.isArray(i.disabled)&&(i.disabled=t.unique(i.disabled.concat(t.map(this.tabs.filter(".ui-state-disabled"),function(t){return e.tabs.index(t)}))).sort()),this.active=this.options.active!==!1&&this.anchors.length?this._findActive(i.active):t(),this._refresh(),this.active.length&&this.load(i.active)},_initialActive:function(){var e=this.options.active,i=this.options.collapsible,s=location.hash.substring(1);return null===e&&(s&&this.tabs.each(function(i,n){return t(n).attr("aria-controls")===s?(e=i,!1):void 0}),null===e&&(e=this.tabs.index(this.tabs.filter(".ui-tabs-active"))),(null===e||-1===e)&&(e=this.tabs.length?0:!1)),e!==!1&&(e=this.tabs.index(this.tabs.eq(e)),-1===e&&(e=i?!1:0)),!i&&e===!1&&this.anchors.length&&(e=0),e},_getCreateEventData:function(){return{tab:this.active,panel:this.active.length?this._getPanelForTab(this.active):t()}},_tabKeydown:function(e){var i=t(t.ui.safeActiveElement(this.document[0])).closest("li"),s=this.tabs.index(i),n=!0;if(!this._handlePageNav(e)){switch(e.keyCode){case t.ui.keyCode.RIGHT:case t.ui.keyCode.DOWN:s++;break;case t.ui.keyCode.UP:case t.ui.keyCode.LEFT:n=!1,s--;break;case t.ui.keyCode.END:s=this.anchors.length-1;break;case t.ui.keyCode.HOME:s=0;break;case t.ui.keyCode.SPACE:return e.preventDefault(),clearTimeout(this.activating),this._activate(s),void 0;case t.ui.keyCode.ENTER:return e.preventDefault(),clearTimeout(this.activating),this._activate(s===this.options.active?!1:s),void 0;default:return}e.preventDefault(),clearTimeout(this.activating),s=this._focusNextTab(s,n),e.ctrlKey||e.metaKey||(i.attr("aria-selected","false"),this.tabs.eq(s).attr("aria-selected","true"),this.activating=this._delay(function(){this.option("active",s)},this.delay))}},_panelKeydown:function(e){this._handlePageNav(e)||e.ctrlKey&&e.keyCode===t.ui.keyCode.UP&&(e.preventDefault(),this.active.trigger("focus"))},_handlePageNav:function(e){return e.altKey&&e.keyCode===t.ui.keyCode.PAGE_UP?(this._activate(this._focusNextTab(this.options.active-1,!1)),!0):e.altKey&&e.keyCode===t.ui.keyCode.PAGE_DOWN?(this._activate(this._focusNextTab(this.options.active+1,!0)),!0):void 0},_findNextTab:function(e,i){function s(){return e>n&&(e=0),0>e&&(e=n),e}for(var n=this.tabs.length-1;-1!==t.inArray(s(),this.options.disabled);)e=i?e+1:e-1;return e},_focusNextTab:function(t,e){return t=this._findNextTab(t,e),this.tabs.eq(t).trigger("focus"),t},_setOption:function(t,e){return"active"===t?(this._activate(e),void 0):(this._super(t,e),"collapsible"===t&&(this._toggleClass("ui-tabs-collapsible",null,e),e||this.options.active!==!1||this._activate(0)),"event"===t&&this._setupEvents(e),"heightStyle"===t&&this._setupHeightStyle(e),void 0)},_sanitizeSelector:function(t){return t?t.replace(/[!"$%&'()*+,.\/:;<=>?@\[\]\^`{|}~]/g,"\\$&"):""},refresh:function(){var e=this.options,i=this.tablist.children(":has(a[href])");e.disabled=t.map(i.filter(".ui-state-disabled"),function(t){return i.index(t)}),this._processTabs(),e.active!==!1&&this.anchors.length?this.active.length&&!t.contains(this.tablist[0],this.active[0])?this.tabs.length===e.disabled.length?(e.active=!1,this.active=t()):this._activate(this._findNextTab(Math.max(0,e.active-1),!1)):e.active=this.tabs.index(this.active):(e.active=!1,this.active=t()),this._refresh()},_refresh:function(){this._setOptionDisabled(this.options.disabled),this._setupEvents(this.options.event),this._setupHeightStyle(this.options.heightStyle),this.tabs.not(this.active).attr({"aria-selected":"false","aria-expanded":"false",tabIndex:-1}),this.panels.not(this._getPanelForTab(this.active)).hide().attr({"aria-hidden":"true"}),this.active.length?(this.active.attr({"aria-selected":"true","aria-expanded":"true",tabIndex:0}),this._addClass(this.active,"ui-tabs-active","ui-state-active"),this._getPanelForTab(this.active).show().attr({"aria-hidden":"false"})):this.tabs.eq(0).attr("tabIndex",0)},_processTabs:function(){var e=this,i=this.tabs,s=this.anchors,n=this.panels;this.tablist=this._getList().attr("role","tablist"),this._addClass(this.tablist,"ui-tabs-nav","ui-helper-reset ui-helper-clearfix ui-widget-header"),this.tablist.on("mousedown"+this.eventNamespace,"> li",function(e){t(this).is(".ui-state-disabled")&&e.preventDefault()}).on("focus"+this.eventNamespace,".ui-tabs-anchor",function(){t(this).closest("li").is(".ui-state-disabled")&&this.blur()}),this.tabs=this.tablist.find("> li:has(a[href])").attr({role:"tab",tabIndex:-1}),this._addClass(this.tabs,"ui-tabs-tab","ui-state-default"),this.anchors=this.tabs.map(function(){return t("a",this)[0]}).attr({role:"presentation",tabIndex:-1}),this._addClass(this.anchors,"ui-tabs-anchor"),this.panels=t(),this.anchors.each(function(i,s){var n,o,a,r=t(s).uniqueId().attr("id"),h=t(s).closest("li"),l=h.attr("aria-controls");e._isLocal(s)?(n=s.hash,a=n.substring(1),o=e.element.find(e._sanitizeSelector(n))):(a=h.attr("aria-controls")||t({}).uniqueId()[0].id,n="#"+a,o=e.element.find(n),o.length||(o=e._createPanel(a),o.insertAfter(e.panels[i-1]||e.tablist)),o.attr("aria-live","polite")),o.length&&(e.panels=e.panels.add(o)),l&&h.data("ui-tabs-aria-controls",l),h.attr({"aria-controls":a,"aria-labelledby":r}),o.attr("aria-labelledby",r)}),this.panels.attr("role","tabpanel"),this._addClass(this.panels,"ui-tabs-panel","ui-widget-content"),i&&(this._off(i.not(this.tabs)),this._off(s.not(this.anchors)),this._off(n.not(this.panels)))},_getList:function(){return this.tablist||this.element.find("ol, ul").eq(0)},_createPanel:function(e){return t("<div>").attr("id",e).data("ui-tabs-destroy",!0)},_setOptionDisabled:function(e){var i,s,n;for(t.isArray(e)&&(e.length?e.length===this.anchors.length&&(e=!0):e=!1),n=0;s=this.tabs[n];n++)i=t(s),e===!0||-1!==t.inArray(n,e)?(i.attr("aria-disabled","true"),this._addClass(i,null,"ui-state-disabled")):(i.removeAttr("aria-disabled"),this._removeClass(i,null,"ui-state-disabled"));this.options.disabled=e,this._toggleClass(this.widget(),this.widgetFullName+"-disabled",null,e===!0)},_setupEvents:function(e){var i={};e&&t.each(e.split(" "),function(t,e){i[e]="_eventHandler"}),this._off(this.anchors.add(this.tabs).add(this.panels)),this._on(!0,this.anchors,{click:function(t){t.preventDefault()}}),this._on(this.anchors,i),this._on(this.tabs,{keydown:"_tabKeydown"}),this._on(this.panels,{keydown:"_panelKeydown"}),this._focusable(this.tabs),this._hoverable(this.tabs)},_setupHeightStyle:function(e){var i,s=this.element.parent();"fill"===e?(i=s.height(),i-=this.element.outerHeight()-this.element.height(),this.element.siblings(":visible").each(function(){var e=t(this),s=e.css("position");"absolute"!==s&&"fixed"!==s&&(i-=e.outerHeight(!0))}),this.element.children().not(this.panels).each(function(){i-=t(this).outerHeight(!0)}),this.panels.each(function(){t(this).height(Math.max(0,i-t(this).innerHeight()+t(this).height()))}).css("overflow","auto")):"auto"===e&&(i=0,this.panels.each(function(){i=Math.max(i,t(this).height("").height())}).height(i))},_eventHandler:function(e){var i=this.options,s=this.active,n=t(e.currentTarget),o=n.closest("li"),a=o[0]===s[0],r=a&&i.collapsible,h=r?t():this._getPanelForTab(o),l=s.length?this._getPanelForTab(s):t(),c={oldTab:s,oldPanel:l,newTab:r?t():o,newPanel:h};e.preventDefault(),o.hasClass("ui-state-disabled")||o.hasClass("ui-tabs-loading")||this.running||a&&!i.collapsible||this._trigger("beforeActivate",e,c)===!1||(i.active=r?!1:this.tabs.index(o),this.active=a?t():o,this.xhr&&this.xhr.abort(),l.length||h.length||t.error("jQuery UI Tabs: Mismatching fragment identifier."),h.length&&this.load(this.tabs.index(o),e),this._toggle(e,c))},_toggle:function(e,i){function s(){o.running=!1,o._trigger("activate",e,i)}function n(){o._addClass(i.newTab.closest("li"),"ui-tabs-active","ui-state-active"),a.length&&o.options.show?o._show(a,o.options.show,s):(a.show(),s())}var o=this,a=i.newPanel,r=i.oldPanel;this.running=!0,r.length&&this.options.hide?this._hide(r,this.options.hide,function(){o._removeClass(i.oldTab.closest("li"),"ui-tabs-active","ui-state-active"),n()}):(this._removeClass(i.oldTab.closest("li"),"ui-tabs-active","ui-state-active"),r.hide(),n()),r.attr("aria-hidden","true"),i.oldTab.attr({"aria-selected":"false","aria-expanded":"false"}),a.length&&r.length?i.oldTab.attr("tabIndex",-1):a.length&&this.tabs.filter(function(){return 0===t(this).attr("tabIndex")}).attr("tabIndex",-1),a.attr("aria-hidden","false"),i.newTab.attr({"aria-selected":"true","aria-expanded":"true",tabIndex:0})},_activate:function(e){var i,s=this._findActive(e);s[0]!==this.active[0]&&(s.length||(s=this.active),i=s.find(".ui-tabs-anchor")[0],this._eventHandler({target:i,currentTarget:i,preventDefault:t.noop}))},_findActive:function(e){return e===!1?t():this.tabs.eq(e)},_getIndex:function(e){return"string"==typeof e&&(e=this.anchors.index(this.anchors.filter("[href$='"+t.ui.escapeSelector(e)+"']"))),e},_destroy:function(){this.xhr&&this.xhr.abort(),this.tablist.removeAttr("role").off(this.eventNamespace),this.anchors.removeAttr("role tabIndex").removeUniqueId(),this.tabs.add(this.panels).each(function(){t.data(this,"ui-tabs-destroy")?t(this).remove():t(this).removeAttr("role tabIndex aria-live aria-busy aria-selected aria-labelledby aria-hidden aria-expanded")}),this.tabs.each(function(){var e=t(this),i=e.data("ui-tabs-aria-controls");i?e.attr("aria-controls",i).removeData("ui-tabs-aria-controls"):e.removeAttr("aria-controls")}),this.panels.show(),"content"!==this.options.heightStyle&&this.panels.css("height","")},enable:function(e){var i=this.options.disabled;i!==!1&&(void 0===e?i=!1:(e=this._getIndex(e),i=t.isArray(i)?t.map(i,function(t){return t!==e?t:null}):t.map(this.tabs,function(t,i){return i!==e?i:null})),this._setOptionDisabled(i))},disable:function(e){var i=this.options.disabled;if(i!==!0){if(void 0===e)i=!0;else{if(e=this._getIndex(e),-1!==t.inArray(e,i))return;i=t.isArray(i)?t.merge([e],i).sort():[e]}this._setOptionDisabled(i)}},load:function(e,i){e=this._getIndex(e);var s=this,n=this.tabs.eq(e),o=n.find(".ui-tabs-anchor"),a=this._getPanelForTab(n),r={tab:n,panel:a},h=function(t,e){"abort"===e&&s.panels.stop(!1,!0),s._removeClass(n,"ui-tabs-loading"),a.removeAttr("aria-busy"),t===s.xhr&&delete s.xhr};this._isLocal(o[0])||(this.xhr=t.ajax(this._ajaxSettings(o,i,r)),this.xhr&&"canceled"!==this.xhr.statusText&&(this._addClass(n,"ui-tabs-loading"),a.attr("aria-busy","true"),this.xhr.done(function(t,e,n){setTimeout(function(){a.html(t),s._trigger("load",i,r),h(n,e)},1)}).fail(function(t,e){setTimeout(function(){h(t,e)},1)})))},_ajaxSettings:function(e,i,s){var n=this;return{url:e.attr("href").replace(/#.*$/,""),beforeSend:function(e,o){return n._trigger("beforeLoad",i,t.extend({jqXHR:e,ajaxSettings:o},s))}}},_getPanelForTab:function(e){var i=t(e).attr("aria-controls");return this.element.find(this._sanitizeSelector("#"+i))}}),t.uiBackCompat!==!1&&t.widget("ui.tabs",t.ui.tabs,{_processTabs:function(){this._superApply(arguments),this._addClass(this.tabs,"ui-tab")}}),t.ui.tabs,t.widget("ui.tooltip",{version:"1.12.1",options:{classes:{"ui-tooltip":"ui-corner-all ui-widget-shadow"},content:function(){var e=t(this).attr("title")||"";return t("<a>").text(e).html()},hide:!0,items:"[title]:not([disabled])",position:{my:"left top+15",at:"left bottom",collision:"flipfit flip"},show:!0,track:!1,close:null,open:null},_addDescribedBy:function(e,i){var s=(e.attr("aria-describedby")||"").split(/\s+/);s.push(i),e.data("ui-tooltip-id",i).attr("aria-describedby",t.trim(s.join(" ")))},_removeDescribedBy:function(e){var i=e.data("ui-tooltip-id"),s=(e.attr("aria-describedby")||"").split(/\s+/),n=t.inArray(i,s);-1!==n&&s.splice(n,1),e.removeData("ui-tooltip-id"),s=t.trim(s.join(" ")),s?e.attr("aria-describedby",s):e.removeAttr("aria-describedby")},_create:function(){this._on({mouseover:"open",focusin:"open"}),this.tooltips={},this.parents={},this.liveRegion=t("<div>").attr({role:"log","aria-live":"assertive","aria-relevant":"additions"}).appendTo(this.document[0].body),this._addClass(this.liveRegion,null,"ui-helper-hidden-accessible"),this.disabledTitles=t([])},_setOption:function(e,i){var s=this;this._super(e,i),"content"===e&&t.each(this.tooltips,function(t,e){s._updateContent(e.element)})},_setOptionDisabled:function(t){this[t?"_disable":"_enable"]()},_disable:function(){var e=this;t.each(this.tooltips,function(i,s){var n=t.Event("blur");n.target=n.currentTarget=s.element[0],e.close(n,!0)}),this.disabledTitles=this.disabledTitles.add(this.element.find(this.options.items).addBack().filter(function(){var e=t(this);return e.is("[title]")?e.data("ui-tooltip-title",e.attr("title")).removeAttr("title"):void 0}))},_enable:function(){this.disabledTitles.each(function(){var e=t(this);e.data("ui-tooltip-title")&&e.attr("title",e.data("ui-tooltip-title"))}),this.disabledTitles=t([])},open:function(e){var i=this,s=t(e?e.target:this.element).closest(this.options.items);s.length&&!s.data("ui-tooltip-id")&&(s.attr("title")&&s.data("ui-tooltip-title",s.attr("title")),s.data("ui-tooltip-open",!0),e&&"mouseover"===e.type&&s.parents().each(function(){var e,s=t(this);s.data("ui-tooltip-open")&&(e=t.Event("blur"),e.target=e.currentTarget=this,i.close(e,!0)),s.attr("title")&&(s.uniqueId(),i.parents[this.id]={element:this,title:s.attr("title")},s.attr("title",""))}),this._registerCloseHandlers(e,s),this._updateContent(s,e))},_updateContent:function(t,e){var i,s=this.options.content,n=this,o=e?e.type:null;return"string"==typeof s||s.nodeType||s.jquery?this._open(e,t,s):(i=s.call(t[0],function(i){n._delay(function(){t.data("ui-tooltip-open")&&(e&&(e.type=o),this._open(e,t,i))})}),i&&this._open(e,t,i),void 0)},_open:function(e,i,s){function n(t){l.of=t,a.is(":hidden")||a.position(l)}var o,a,r,h,l=t.extend({},this.options.position);if(s){if(o=this._find(i))return o.tooltip.find(".ui-tooltip-content").html(s),void 0;i.is("[title]")&&(e&&"mouseover"===e.type?i.attr("title",""):i.removeAttr("title")),o=this._tooltip(i),a=o.tooltip,this._addDescribedBy(i,a.attr("id")),a.find(".ui-tooltip-content").html(s),this.liveRegion.children().hide(),h=t("<div>").html(a.find(".ui-tooltip-content").html()),h.removeAttr("name").find("[name]").removeAttr("name"),h.removeAttr("id").find("[id]").removeAttr("id"),h.appendTo(this.liveRegion),this.options.track&&e&&/^mouse/.test(e.type)?(this._on(this.document,{mousemove:n}),n(e)):a.position(t.extend({of:i},this.options.position)),a.hide(),this._show(a,this.options.show),this.options.track&&this.options.show&&this.options.show.delay&&(r=this.delayedShow=setInterval(function(){a.is(":visible")&&(n(l.of),clearInterval(r))},t.fx.interval)),this._trigger("open",e,{tooltip:a})}},_registerCloseHandlers:function(e,i){var s={keyup:function(e){if(e.keyCode===t.ui.keyCode.ESCAPE){var s=t.Event(e);s.currentTarget=i[0],this.close(s,!0)}}};i[0]!==this.element[0]&&(s.remove=function(){this._removeTooltip(this._find(i).tooltip)}),e&&"mouseover"!==e.type||(s.mouseleave="close"),e&&"focusin"!==e.type||(s.focusout="close"),this._on(!0,i,s)},close:function(e){var i,s=this,n=t(e?e.currentTarget:this.element),o=this._find(n);return o?(i=o.tooltip,o.closing||(clearInterval(this.delayedShow),n.data("ui-tooltip-title")&&!n.attr("title")&&n.attr("title",n.data("ui-tooltip-title")),this._removeDescribedBy(n),o.hiding=!0,i.stop(!0),this._hide(i,this.options.hide,function(){s._removeTooltip(t(this))}),n.removeData("ui-tooltip-open"),this._off(n,"mouseleave focusout keyup"),n[0]!==this.element[0]&&this._off(n,"remove"),this._off(this.document,"mousemove"),e&&"mouseleave"===e.type&&t.each(this.parents,function(e,i){t(i.element).attr("title",i.title),delete s.parents[e]}),o.closing=!0,this._trigger("close",e,{tooltip:i}),o.hiding||(o.closing=!1)),void 0):(n.removeData("ui-tooltip-open"),void 0)},_tooltip:function(e){var i=t("<div>").attr("role","tooltip"),s=t("<div>").appendTo(i),n=i.uniqueId().attr("id");return this._addClass(s,"ui-tooltip-content"),this._addClass(i,"ui-tooltip","ui-widget ui-widget-content"),i.appendTo(this._appendTo(e)),this.tooltips[n]={element:e,tooltip:i}},_find:function(t){var e=t.data("ui-tooltip-id");return e?this.tooltips[e]:null},_removeTooltip:function(t){t.remove(),delete this.tooltips[t.attr("id")]},_appendTo:function(t){var e=t.closest(".ui-front, dialog");return e.length||(e=this.document[0].body),e},_destroy:function(){var e=this;t.each(this.tooltips,function(i,s){var n=t.Event("blur"),o=s.element;n.target=n.currentTarget=o[0],e.close(n,!0),t("#"+i).remove(),o.data("ui-tooltip-title")&&(o.attr("title")||o.attr("title",o.data("ui-tooltip-title")),o.removeData("ui-tooltip-title"))}),this.liveRegion.remove()}}),t.uiBackCompat!==!1&&t.widget("ui.tooltip",t.ui.tooltip,{options:{tooltipClass:null},_tooltip:function(){var t=this._superApply(arguments);return this.options.tooltipClass&&t.tooltip.addClass(this.options.tooltipClass),t}}),t.ui.tooltip});!function(t,i,e,s){"use strict";function n(i,e){this.element=i,this.$context=t(i).data("api",this),this.$layers=this.$context.find(".layer");var s={calibrateX:this.$context.data("calibrate-x")||null,calibrateY:this.$context.data("calibrate-y")||null,invertX:this.$context.data("invert-x")||null,invertY:this.$context.data("invert-y")||null,limitX:parseFloat(this.$context.data("limit-x"))||null,limitY:parseFloat(this.$context.data("limit-y"))||null,scalarX:parseFloat(this.$context.data("scalar-x"))||null,scalarY:parseFloat(this.$context.data("scalar-y"))||null,frictionX:parseFloat(this.$context.data("friction-x"))||null,frictionY:parseFloat(this.$context.data("friction-y"))||null,originX:parseFloat(this.$context.data("origin-x"))||null,originY:parseFloat(this.$context.data("origin-y"))||null,pointerEvents:this.$context.data("pointer-events")||!0,precision:parseFloat(this.$context.data("precision"))||1};for(var n in s)null===s[n]&&delete s[n];t.extend(this,a,e,s),this.calibrationTimer=null,this.calibrationFlag=!0,this.enabled=!1,this.depthsX=[],this.depthsY=[],this.raf=null,this.bounds=null,this.ex=0,this.ey=0,this.ew=0,this.eh=0,this.ecx=0,this.ecy=0,this.erx=0,this.ery=0,this.cx=0,this.cy=0,this.ix=0,this.iy=0,this.mx=0,this.my=0,this.vx=0,this.vy=0,this.onMouseMove=this.onMouseMove.bind(this),this.onDeviceOrientation=this.onDeviceOrientation.bind(this),this.onOrientationTimer=this.onOrientationTimer.bind(this),this.onCalibrationTimer=this.onCalibrationTimer.bind(this),this.onAnimationFrame=this.onAnimationFrame.bind(this),this.onWindowResize=this.onWindowResize.bind(this),this.initialise()}var o="parallax",r=30,a={relativeInput:!1,clipRelativeInput:!1,calibrationThreshold:100,calibrationDelay:500,supportDelay:500,calibrateX:!1,calibrateY:!0,invertX:!0,invertY:!0,limitX:!1,limitY:!1,scalarX:10,scalarY:10,frictionX:.1,frictionY:.1,originX:.5,originY:.5,pointerEvents:!0,precision:1};n.prototype.transformSupport=function(t){for(var n=e.createElement("div"),o=!1,r=null,a=!1,h=null,l=null,p=0,c=this.vendors.length;c>p;p++)if(null!==this.vendors[p]?(h=this.vendors[p][0]+"transform",l=this.vendors[p][1]+"Transform"):(h="transform",l="transform"),n.style[l]!==s){o=!0;break}switch(t){case"2D":a=o;break;case"3D":if(o){var m=e.body||e.createElement("body"),u=e.documentElement,y=u.style.overflow,d=!1;e.body||(d=!0,u.style.overflow="hidden",u.appendChild(m),m.style.overflow="hidden",m.style.background=""),m.appendChild(n),n.style[l]="translate3d(1px,1px,1px)",r=i.getComputedStyle(n).getPropertyValue(h),a=r!==s&&r.length>0&&"none"!==r,u.style.overflow=y,m.removeChild(n),d&&(m.removeAttribute("style"),m.parentNode.removeChild(m))}}return a},n.prototype.ww=null,n.prototype.wh=null,n.prototype.wcx=null,n.prototype.wcy=null,n.prototype.wrx=null,n.prototype.wry=null,n.prototype.portrait=null,n.prototype.desktop=!navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry|BB10|mobi|tablet|opera mini|nexus 7)/i),n.prototype.vendors=[null,["-webkit-","webkit"],["-moz-","Moz"],["-o-","O"],["-ms-","ms"]],n.prototype.motionSupport=!!i.DeviceMotionEvent,n.prototype.orientationSupport=!!i.DeviceOrientationEvent,n.prototype.orientationStatus=0,n.prototype.transform2DSupport=n.prototype.transformSupport("2D"),n.prototype.transform3DSupport=n.prototype.transformSupport("3D"),n.prototype.propertyCache={},n.prototype.initialise=function(){"static"===this.$context.css("position")&&this.$context.css({position:"relative"}),this.pointerEvents||this.$context.css({pointerEvents:"none"}),this.accelerate(this.$context),this.updateLayers(),this.updateDimensions(),this.enable(),this.queueCalibration(this.calibrationDelay)},n.prototype.updateLayers=function(){this.$layers=this.$context.find(".layer"),this.depthsX=[],this.depthsY=[],this.$layers.css({position:"absolute",display:"block",left:0,top:0}),this.$layers.first().css({position:"relative"}),this.accelerate(this.$layers),this.$layers.each(t.proxy(function(i,e){var s=t(e).data("depth")||0;this.depthsX.push(t(e).data("depth-x")||s),this.depthsY.push(t(e).data("depth-y")||s)},this))},n.prototype.updateDimensions=function(){this.ww=i.innerWidth,this.wh=i.innerHeight,this.wcx=this.ww*this.originX,this.wcy=this.wh*this.originY,this.wrx=Math.max(this.wcx,this.ww-this.wcx),this.wry=Math.max(this.wcy,this.wh-this.wcy)},n.prototype.updateBounds=function(){this.bounds=this.element.getBoundingClientRect(),this.ex=this.bounds.left,this.ey=this.bounds.top,this.ew=this.bounds.width,this.eh=this.bounds.height,this.ecx=this.ew*this.originX,this.ecy=this.eh*this.originY,this.erx=Math.max(this.ecx,this.ew-this.ecx),this.ery=Math.max(this.ecy,this.eh-this.ecy)},n.prototype.queueCalibration=function(t){clearTimeout(this.calibrationTimer),this.calibrationTimer=setTimeout(this.onCalibrationTimer,t)},n.prototype.enable=function(){this.enabled||(this.enabled=!0,this.orientationSupport?(this.portrait=null,i.addEventListener("deviceorientation",this.onDeviceOrientation),setTimeout(this.onOrientationTimer,this.supportDelay)):(this.cx=0,this.cy=0,this.portrait=!1,i.addEventListener("mousemove",this.onMouseMove)),i.addEventListener("resize",this.onWindowResize),this.raf=requestAnimationFrame(this.onAnimationFrame))},n.prototype.disable=function(){this.enabled&&(this.enabled=!1,this.orientationSupport?i.removeEventListener("deviceorientation",this.onDeviceOrientation):i.removeEventListener("mousemove",this.onMouseMove),i.removeEventListener("resize",this.onWindowResize),cancelAnimationFrame(this.raf))},n.prototype.calibrate=function(t,i){this.calibrateX=t===s?this.calibrateX:t,this.calibrateY=i===s?this.calibrateY:i},n.prototype.invert=function(t,i){this.invertX=t===s?this.invertX:t,this.invertY=i===s?this.invertY:i},n.prototype.friction=function(t,i){this.frictionX=t===s?this.frictionX:t,this.frictionY=i===s?this.frictionY:i},n.prototype.scalar=function(t,i){this.scalarX=t===s?this.scalarX:t,this.scalarY=i===s?this.scalarY:i},n.prototype.limit=function(t,i){this.limitX=t===s?this.limitX:t,this.limitY=i===s?this.limitY:i},n.prototype.origin=function(t,i){this.originX=t===s?this.originX:t,this.originY=i===s?this.originY:i},n.prototype.clamp=function(t,i,e){return t=Math.max(t,i),t=Math.min(t,e)},n.prototype.css=function(i,e,n){var o=this.propertyCache[e];if(!o)for(var r=0,a=this.vendors.length;a>r;r++)if(o=null!==this.vendors[r]?t.camelCase(this.vendors[r][1]+"-"+e):e,i.style[o]!==s){this.propertyCache[e]=o;break}i.style[o]=n},n.prototype.accelerate=function(t){for(var i=0,e=t.length;e>i;i++){var s=t[i];this.css(s,"transform","translate3d(0,0,0)"),this.css(s,"transform-style","preserve-3d"),this.css(s,"backface-visibility","hidden")}},n.prototype.setPosition=function(t,i,e){i+="px",e+="px",this.transform3DSupport?this.css(t,"transform","translate3d("+i+","+e+",0)"):this.transform2DSupport?this.css(t,"transform","translate("+i+","+e+")"):(t.style.left=i,t.style.top=e)},n.prototype.onOrientationTimer=function(t){this.orientationSupport&&0===this.orientationStatus&&(this.disable(),this.orientationSupport=!1,this.enable())},n.prototype.onCalibrationTimer=function(t){this.calibrationFlag=!0},n.prototype.onWindowResize=function(t){this.updateDimensions()},n.prototype.onAnimationFrame=function(){this.updateBounds();var t=this.ix-this.cx,i=this.iy-this.cy;(Math.abs(t)>this.calibrationThreshold||Math.abs(i)>this.calibrationThreshold)&&this.queueCalibration(0),this.portrait?(this.mx=this.calibrateX?i:this.iy,this.my=this.calibrateY?t:this.ix):(this.mx=this.calibrateX?t:this.ix,this.my=this.calibrateY?i:this.iy),this.mx*=this.ew*(this.scalarX/100),this.my*=this.eh*(this.scalarY/100),isNaN(parseFloat(this.limitX))||(this.mx=this.clamp(this.mx,-this.limitX,this.limitX)),isNaN(parseFloat(this.limitY))||(this.my=this.clamp(this.my,-this.limitY,this.limitY)),this.vx+=(this.mx-this.vx)*this.frictionX,this.vy+=(this.my-this.vy)*this.frictionY;for(var e=0,s=this.$layers.length;s>e;e++){var n=this.depthsX[e],o=this.depthsY[e],r=this.$layers[e],a=this.vx*(n*(this.invertX?-1:1)),h=this.vy*(o*(this.invertY?-1:1));this.setPosition(r,a,h)}this.raf=requestAnimationFrame(this.onAnimationFrame)},n.prototype.onDeviceOrientation=function(t){if(!this.desktop&&null!==t.beta&&null!==t.gamma){this.orientationStatus=1;var e=(t.beta||0)/r,s=(t.gamma||0)/r,n=i.innerHeight>i.innerWidth;this.portrait!==n&&(this.portrait=n,this.calibrationFlag=!0),this.calibrationFlag&&(this.calibrationFlag=!1,this.cx=e,this.cy=s),this.ix=e,this.iy=s}},n.prototype.onMouseMove=function(t){var i=t.clientX,e=t.clientY;!this.orientationSupport&&this.relativeInput?(this.clipRelativeInput&&(i=Math.max(i,this.ex),i=Math.min(i,this.ex+this.ew),e=Math.max(e,this.ey),e=Math.min(e,this.ey+this.eh)),this.ix=(i-this.ex-this.ecx)/this.erx,this.iy=(e-this.ey-this.ecy)/this.ery):(this.ix=(i-this.wcx)/this.wrx,this.iy=(e-this.wcy)/this.wry)};var h={enable:n.prototype.enable,disable:n.prototype.disable,updateLayers:n.prototype.updateLayers,calibrate:n.prototype.calibrate,friction:n.prototype.friction,invert:n.prototype.invert,scalar:n.prototype.scalar,limit:n.prototype.limit,origin:n.prototype.origin};t.fn[o]=function(i){var e=arguments;return this.each(function(){var s=t(this),r=s.data(o);r||(r=new n(this,i),s.data(o,r)),h[i]&&r[i].apply(r,Array.prototype.slice.call(e,1))})}}(window.jQuery||window.Zepto,window,document),function(){for(var t=0,i=["ms","moz","webkit","o"],e=0;e<i.length&&!window.requestAnimationFrame;++e)window.requestAnimationFrame=window[i[e]+"RequestAnimationFrame"],window.cancelAnimationFrame=window[i[e]+"CancelAnimationFrame"]||window[i[e]+"CancelRequestAnimationFrame"];window.requestAnimationFrame||(window.requestAnimationFrame=function(i,e){var s=(new Date).getTime(),n=Math.max(0,16-(s-t)),o=window.setTimeout(function(){i(s+n)},n);return t=s+n,o}),window.cancelAnimationFrame||(window.cancelAnimationFrame=function(t){clearTimeout(t)})}();/*!
* jquery.inputmask.bundle.js
* https://github.com/RobinHerbots/Inputmask
* Copyright (c) 2010 - 2017 Robin Herbots
* Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php)
* Version: 3.3.7
*/

!function(a){function b(d){if(c[d])return c[d].exports;var e=c[d]={i:d,l:!1,exports:{}};return a[d].call(e.exports,e,e.exports,b),e.l=!0,e.exports}var c={};b.m=a,b.c=c,b.i=function(a){return a},b.d=function(a,c,d){b.o(a,c)||Object.defineProperty(a,c,{configurable:!1,enumerable:!0,get:d})},b.n=function(a){var c=a&&a.__esModule?function(){return a.default}:function(){return a};return b.d(c,"a",c),c},b.o=function(a,b){return Object.prototype.hasOwnProperty.call(a,b)},b.p="",b(b.s=10)}([function(a,b,c){"use strict";var d,e,f;"function"==typeof Symbol&&Symbol.iterator;!function(g){e=[c(2)],d=g,void 0!==(f="function"==typeof d?d.apply(b,e):d)&&(a.exports=f)}(function(a){return a})},function(a,b,c){"use strict";var d,e,f,g="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(a){return typeof a}:function(a){return a&&"function"==typeof Symbol&&a.constructor===Symbol&&a!==Symbol.prototype?"symbol":typeof a};!function(g){e=[c(0),c(12),c(11)],d=g,void 0!==(f="function"==typeof d?d.apply(b,e):d)&&(a.exports=f)}(function(a,b,c,d){function e(b,c,g){if(!(this instanceof e))return new e(b,c,g);this.el=d,this.events={},this.maskset=d,this.refreshValue=!1,!0!==g&&(a.isPlainObject(b)?c=b:(c=c||{},c.alias=b),this.opts=a.extend(!0,{},this.defaults,c),this.noMasksCache=c&&c.definitions!==d,this.userOptions=c||{},this.isRTL=this.opts.numericInput,f(this.opts.alias,c,this.opts))}function f(b,c,g){var h=e.prototype.aliases[b];return h?(h.alias&&f(h.alias,d,g),a.extend(!0,g,h),a.extend(!0,g,c),!0):(null===g.mask&&(g.mask=b),!1)}function h(b,c){function f(b,f,g){var h=!1;if(null!==b&&""!==b||(h=null!==g.regex,h?(b=g.regex,b=b.replace(/^(\^)(.*)(\$)$/,"$2")):(h=!0,b=".*")),1===b.length&&!1===g.greedy&&0!==g.repeat&&(g.placeholder=""),g.repeat>0||"*"===g.repeat||"+"===g.repeat){var i="*"===g.repeat?0:"+"===g.repeat?1:g.repeat;b=g.groupmarker.start+b+g.groupmarker.end+g.quantifiermarker.start+i+","+g.repeat+g.quantifiermarker.end}var j,k=h?"regex_"+g.regex:g.numericInput?b.split("").reverse().join(""):b;return e.prototype.masksCache[k]===d||!0===c?(j={mask:b,maskToken:e.prototype.analyseMask(b,h,g),validPositions:{},_buffer:d,buffer:d,tests:{},metadata:f,maskLength:d},!0!==c&&(e.prototype.masksCache[k]=j,j=a.extend(!0,{},e.prototype.masksCache[k]))):j=a.extend(!0,{},e.prototype.masksCache[k]),j}if(a.isFunction(b.mask)&&(b.mask=b.mask(b)),a.isArray(b.mask)){if(b.mask.length>1){b.keepStatic=null===b.keepStatic||b.keepStatic;var g=b.groupmarker.start;return a.each(b.numericInput?b.mask.reverse():b.mask,function(c,e){g.length>1&&(g+=b.groupmarker.end+b.alternatormarker+b.groupmarker.start),e.mask===d||a.isFunction(e.mask)?g+=e:g+=e.mask}),g+=b.groupmarker.end,f(g,b.mask,b)}b.mask=b.mask.pop()}return b.mask&&b.mask.mask!==d&&!a.isFunction(b.mask.mask)?f(b.mask.mask,b.mask,b):f(b.mask,b.mask,b)}function i(f,h,j){function o(a,b,c){b=b||0;var e,f,g,h=[],i=0,k=r();-1===(V=Y!==d?Y.maxLength:d)&&(V=d);do{!0===a&&p().validPositions[i]?(g=p().validPositions[i],f=g.match,e=g.locator.slice(),h.push(!0===c?g.input:!1===c?f.nativeDef:J(i,f))):(g=u(i,e,i-1),f=g.match,e=g.locator.slice(),(!1===j.jitMasking||i<k||"number"==typeof j.jitMasking&&isFinite(j.jitMasking)&&j.jitMasking>i)&&h.push(!1===c?f.nativeDef:J(i,f))),i++}while((V===d||i<V)&&(null!==f.fn||""!==f.def)||b>i);return""===h[h.length-1]&&h.pop(),p().maskLength=i+1,h}function p(){return h}function q(a){var b=p();b.buffer=d,!0!==a&&(b.validPositions={},b.p=0)}function r(a,b,c){var e=-1,f=-1,g=c||p().validPositions;a===d&&(a=-1);for(var h in g){var i=parseInt(h);g[i]&&(b||!0!==g[i].generatedInput)&&(i<=a&&(e=i),i>=a&&(f=i))}return-1!==e&&a-e>1||f<a?e:f}function s(b,c,e,f){var g,h=b,i=a.extend(!0,{},p().validPositions),k=!1;for(p().p=b,g=c-1;g>=h;g--)p().validPositions[g]!==d&&(!0!==e&&(!p().validPositions[g].match.optionality&&function(a){var b=p().validPositions[a];if(b!==d&&null===b.match.fn){var c=p().validPositions[a-1],e=p().validPositions[a+1];return c!==d&&e!==d}return!1}(g)||!1===j.canClearPosition(p(),g,r(),f,j))||delete p().validPositions[g]);for(q(!0),g=h+1;g<=r();){for(;p().validPositions[h]!==d;)h++;if(g<h&&(g=h+1),p().validPositions[g]===d&&E(g))g++;else{var l=u(g);!1===k&&i[h]&&i[h].match.def===l.match.def?(p().validPositions[h]=a.extend(!0,{},i[h]),p().validPositions[h].input=l.input,delete p().validPositions[g],g++):w(h,l.match.def)?!1!==D(h,l.input||J(g),!0)&&(delete p().validPositions[g],g++,k=!0):E(g)||(g++,h--),h++}}q(!0)}function t(a,b){for(var c,e=a,f=r(),g=p().validPositions[f]||x(0)[0],h=g.alternation!==d?g.locator[g.alternation].toString().split(","):[],i=0;i<e.length&&(c=e[i],!(c.match&&(j.greedy&&!0!==c.match.optionalQuantifier||(!1===c.match.optionality||!1===c.match.newBlockMarker)&&!0!==c.match.optionalQuantifier)&&(g.alternation===d||g.alternation!==c.alternation||c.locator[g.alternation]!==d&&C(c.locator[g.alternation].toString().split(","),h)))||!0===b&&(null!==c.match.fn||/[0-9a-bA-Z]/.test(c.match.def)));i++);return c}function u(a,b,c){return p().validPositions[a]||t(x(a,b?b.slice():b,c))}function v(a){return p().validPositions[a]?p().validPositions[a]:x(a)[0]}function w(a,b){for(var c=!1,d=x(a),e=0;e<d.length;e++)if(d[e].match&&d[e].match.def===b){c=!0;break}return c}function x(b,c,e){function f(c,e,g,i){function l(g,i,q){function r(b,c){var d=0===a.inArray(b,c.matches);return d||a.each(c.matches,function(a,e){if(!0===e.isQuantifier&&(d=r(b,c.matches[a-1])))return!1}),d}function s(b,c,e){var f,g;if(p().validPositions[b-1]&&e&&p().tests[b])for(var h=p().validPositions[b-1].locator,i=p().tests[b][0].locator,j=0;j<e;j++)if(h[j]!==i[j])return h.slice(e+1);return(p().tests[b]||p().validPositions[b])&&a.each(p().tests[b]||[p().validPositions[b]],function(a,b){var h=e!==d?e:b.alternation,i=b.locator[h]!==d?b.locator[h].toString().indexOf(c):-1;(g===d||i<g)&&-1!==i&&(f=b,g=i)}),f?f.locator.slice((e!==d?e:f.alternation)+1):e!==d?s(b,c):d}if(k>1e4)throw"Inputmask: There is probably an error in your mask definition or in the code. Create an issue on github with an example of the mask you are using. "+p().mask;if(k===b&&g.matches===d)return m.push({match:g,locator:i.reverse(),cd:o}),!0;if(g.matches!==d){if(g.isGroup&&q!==g){if(g=l(c.matches[a.inArray(g,c.matches)+1],i))return!0}else if(g.isOptional){var t=g;if(g=f(g,e,i,q)){if(h=m[m.length-1].match,!r(h,t))return!0;n=!0,k=b}}else if(g.isAlternator){var u,v=g,w=[],x=m.slice(),y=i.length,z=e.length>0?e.shift():-1;if(-1===z||"string"==typeof z){var A,B=k,C=e.slice(),D=[];if("string"==typeof z)D=z.split(",");else for(A=0;A<v.matches.length;A++)D.push(A);for(var E=0;E<D.length;E++){if(A=parseInt(D[E]),m=[],e=s(k,A,y)||C.slice(),!0!==(g=l(v.matches[A]||c.matches[A],[A].concat(i),q)||g)&&g!==d&&D[D.length-1]<v.matches.length){var F=a.inArray(g,c.matches)+1;c.matches.length>F&&(g=l(c.matches[F],[F].concat(i.slice(1,i.length)),q))&&(D.push(F.toString()),a.each(m,function(a,b){b.alternation=i.length-1}))}u=m.slice(),k=B,m=[];for(var G=0;G<u.length;G++){var H=u[G],I=!1;H.alternation=H.alternation||y;for(var J=0;J<w.length;J++){var K=w[J];if("string"!=typeof z||-1!==a.inArray(H.locator[H.alternation].toString(),D)){if(function(a,b){return a.match.nativeDef===b.match.nativeDef||a.match.def===b.match.nativeDef||a.match.nativeDef===b.match.def}(H,K)){I=!0,H.alternation===K.alternation&&-1===K.locator[K.alternation].toString().indexOf(H.locator[H.alternation])&&(K.locator[K.alternation]=K.locator[K.alternation]+","+H.locator[H.alternation],K.alternation=H.alternation),H.match.nativeDef===K.match.def&&(H.locator[H.alternation]=K.locator[K.alternation],w.splice(w.indexOf(K),1,H));break}if(H.match.def===K.match.def){I=!1;break}if(function(a,c){return null===a.match.fn&&null!==c.match.fn&&c.match.fn.test(a.match.def,p(),b,!1,j,!1)}(H,K)||function(a,c){return null!==a.match.fn&&null!==c.match.fn&&c.match.fn.test(a.match.def.replace(/[\[\]]/g,""),p(),b,!1,j,!1)}(H,K)){H.alternation==K.alternation&&-1===H.locator[H.alternation].toString().indexOf(K.locator[K.alternation].toString().split("")[0])&&(H.na=H.na||H.locator[H.alternation].toString(),-1===H.na.indexOf(H.locator[H.alternation].toString().split("")[0])&&(H.na=H.na+","+H.locator[K.alternation].toString().split("")[0]),I=!0,H.locator[H.alternation]=K.locator[K.alternation].toString().split("")[0]+","+H.locator[H.alternation],w.splice(w.indexOf(K),0,H));break}}}I||w.push(H)}}"string"==typeof z&&(w=a.map(w,function(b,c){if(isFinite(c)){var e=b.alternation,f=b.locator[e].toString().split(",");b.locator[e]=d,b.alternation=d;for(var g=0;g<f.length;g++)-1!==a.inArray(f[g],D)&&(b.locator[e]!==d?(b.locator[e]+=",",b.locator[e]+=f[g]):b.locator[e]=parseInt(f[g]),b.alternation=e);if(b.locator[e]!==d)return b}})),m=x.concat(w),k=b,n=m.length>0,g=w.length>0,e=C.slice()}else g=l(v.matches[z]||c.matches[z],[z].concat(i),q);if(g)return!0}else if(g.isQuantifier&&q!==c.matches[a.inArray(g,c.matches)-1])for(var L=g,M=e.length>0?e.shift():0;M<(isNaN(L.quantifier.max)?M+1:L.quantifier.max)&&k<=b;M++){var N=c.matches[a.inArray(L,c.matches)-1];if(g=l(N,[M].concat(i),N)){if(h=m[m.length-1].match,h.optionalQuantifier=M>L.quantifier.min-1,r(h,N)){if(M>L.quantifier.min-1){n=!0,k=b;break}return!0}return!0}}else if(g=f(g,e,i,q))return!0}else k++}for(var q=e.length>0?e.shift():0;q<c.matches.length;q++)if(!0!==c.matches[q].isQuantifier){var r=l(c.matches[q],[q].concat(g),i);if(r&&k===b)return r;if(k>b)break}}function g(a){if(j.keepStatic&&b>0&&a.length>1+(""===a[a.length-1].match.def?1:0)&&!0!==a[0].match.optionality&&!0!==a[0].match.optionalQuantifier&&null===a[0].match.fn&&!/[0-9a-bA-Z]/.test(a[0].match.def)){if(p().validPositions[b-1]===d)return[t(a)];if(p().validPositions[b-1].alternation===a[0].alternation)return[t(a)];if(p().validPositions[b-1])return[t(a)]}return a}var h,i=p().maskToken,k=c?e:0,l=c?c.slice():[0],m=[],n=!1,o=c?c.join(""):"";if(b>-1){if(c===d){for(var q,r=b-1;(q=p().validPositions[r]||p().tests[r])===d&&r>-1;)r--;q!==d&&r>-1&&(l=function(b){var c=[];return a.isArray(b)||(b=[b]),b.length>0&&(b[0].alternation===d?(c=t(b.slice()).locator.slice(),0===c.length&&(c=b[0].locator.slice())):a.each(b,function(a,b){if(""!==b.def)if(0===c.length)c=b.locator.slice();else for(var d=0;d<c.length;d++)b.locator[d]&&-1===c[d].toString().indexOf(b.locator[d])&&(c[d]+=","+b.locator[d])})),c}(q),o=l.join(""),k=r)}if(p().tests[b]&&p().tests[b][0].cd===o)return g(p().tests[b]);for(var s=l.shift();s<i.length;s++){if(f(i[s],l,[s])&&k===b||k>b)break}}return(0===m.length||n)&&m.push({match:{fn:null,cardinality:0,optionality:!0,casing:null,def:"",placeholder:""},locator:[],cd:o}),c!==d&&p().tests[b]?g(a.extend(!0,[],m)):(p().tests[b]=a.extend(!0,[],m),g(p().tests[b]))}function y(){return p()._buffer===d&&(p()._buffer=o(!1,1),p().buffer===d&&(p().buffer=p()._buffer.slice())),p()._buffer}function z(a){return p().buffer!==d&&!0!==a||(p().buffer=o(!0,r(),!0)),p().buffer}function A(a,b,c){var e,f;if(!0===a)q(),a=0,b=c.length;else for(e=a;e<b;e++)delete p().validPositions[e];for(f=a,e=a;e<b;e++)if(q(!0),c[e]!==j.skipOptionalPartCharacter){var g=D(f,c[e],!0,!0);!1!==g&&(q(!0),f=g.caret!==d?g.caret:g.pos+1)}}function B(b,c,d){switch(j.casing||c.casing){case"upper":b=b.toUpperCase();break;case"lower":b=b.toLowerCase();break;case"title":var f=p().validPositions[d-1];b=0===d||f&&f.input===String.fromCharCode(e.keyCode.SPACE)?b.toUpperCase():b.toLowerCase();break;default:if(a.isFunction(j.casing)){var g=Array.prototype.slice.call(arguments);g.push(p().validPositions),b=j.casing.apply(this,g)}}return b}function C(b,c,e){for(var f,g=j.greedy?c:c.slice(0,1),h=!1,i=e!==d?e.split(","):[],k=0;k<i.length;k++)-1!==(f=b.indexOf(i[k]))&&b.splice(f,1);for(var l=0;l<b.length;l++)if(-1!==a.inArray(b[l],g)){h=!0;break}return h}function D(b,c,f,g,h){function i(a){var b=Z?a.begin-a.end>1||a.begin-a.end==1:a.end-a.begin>1||a.end-a.begin==1;return b&&0===a.begin&&a.end===p().maskLength?"full":b}function k(c,e,f){var h=!1;return a.each(x(c),function(k,m){for(var n=m.match,o=e?1:0,t="",u=n.cardinality;u>o;u--)t+=H(c-(u-1));if(e&&(t+=e),z(!0),!1!==(h=null!=n.fn?n.fn.test(t,p(),c,f,j,i(b)):(e===n.def||e===j.skipOptionalPartCharacter)&&""!==n.def&&{c:J(c,n,!0)||n.def,pos:c})){var v=h.c!==d?h.c:e;v=v===j.skipOptionalPartCharacter&&null===n.fn?J(c,n,!0)||n.def:v;var w=c,x=z();if(h.remove!==d&&(a.isArray(h.remove)||(h.remove=[h.remove]),a.each(h.remove.sort(function(a,b){return b-a}),function(a,b){s(b,b+1,!0)})),h.insert!==d&&(a.isArray(h.insert)||(h.insert=[h.insert]),a.each(h.insert.sort(function(a,b){return a-b}),function(a,b){D(b.pos,b.c,!0,g)})),h.refreshFromBuffer){var y=h.refreshFromBuffer;if(A(!0===y?y:y.start,y.end,x),h.pos===d&&h.c===d)return h.pos=r(),!1;if((w=h.pos!==d?h.pos:c)!==c)return h=a.extend(h,D(w,v,!0,g)),!1}else if(!0!==h&&h.pos!==d&&h.pos!==c&&(w=h.pos,A(c,w,z().slice()),w!==c))return h=a.extend(h,D(w,v,!0)),!1;return(!0===h||h.pos!==d||h.c!==d)&&(k>0&&q(!0),l(w,a.extend({},m,{input:B(v,n,w)}),g,i(b))||(h=!1),!1)}}),h}function l(b,c,e,f){if(f||j.insertMode&&p().validPositions[b]!==d&&e===d){var g,h=a.extend(!0,{},p().validPositions),i=r(d,!0);for(g=b;g<=i;g++)delete p().validPositions[g];p().validPositions[b]=a.extend(!0,{},c);var k,l=!0,n=p().validPositions,o=!1,s=p().maskLength;for(g=k=b;g<=i;g++){var t=h[g];if(t!==d)for(var u=k;u<p().maskLength&&(null===t.match.fn&&n[g]&&(!0===n[g].match.optionalQuantifier||!0===n[g].match.optionality)||null!=t.match.fn);){if(u++,!1===o&&h[u]&&h[u].match.def===t.match.def)p().validPositions[u]=a.extend(!0,{},h[u]),p().validPositions[u].input=t.input,m(u),k=u,l=!0;else if(w(u,t.match.def)){var v=D(u,t.input,!0,!0);l=!1!==v,k=v.caret||v.insert?r():u,o=!0}else if(!(l=!0===t.generatedInput)&&u>=p().maskLength-1)break;if(p().maskLength<s&&(p().maskLength=s),l)break}if(!l)break}if(!l)return p().validPositions=a.extend(!0,{},h),q(!0),!1}else p().validPositions[b]=a.extend(!0,{},c);return q(!0),!0}function m(b){for(var c=b-1;c>-1&&!p().validPositions[c];c--);var e,f;for(c++;c<b;c++)p().validPositions[c]===d&&(!1===j.jitMasking||j.jitMasking>c)&&(f=x(c,u(c-1).locator,c-1).slice(),""===f[f.length-1].match.def&&f.pop(),(e=t(f))&&(e.match.def===j.radixPointDefinitionSymbol||!E(c,!0)||a.inArray(j.radixPoint,z())<c&&e.match.fn&&e.match.fn.test(J(c),p(),c,!1,j))&&!1!==(o=k(c,J(c,e.match,!0)||(null==e.match.fn?e.match.def:""!==J(c)?J(c):z()[c]),!0))&&(p().validPositions[o.pos||c].generatedInput=!0))}f=!0===f;var n=b;b.begin!==d&&(n=Z&&!i(b)?b.end:b.begin);var o=!0,v=a.extend(!0,{},p().validPositions);if(a.isFunction(j.preValidation)&&!f&&!0!==g&&(o=j.preValidation(z(),n,c,i(b),j)),!0===o){if(m(n),i(b)&&(Q(d,e.keyCode.DELETE,b,!0),n=p().p),n<p().maskLength&&(V===d||n<V)&&(o=k(n,c,f),(!f||!0===g)&&!1===o)){var y=p().validPositions[n];if(!y||null!==y.match.fn||y.match.def!==c&&c!==j.skipOptionalPartCharacter){if((j.insertMode||p().validPositions[F(n)]===d)&&!E(n,!0))for(var G=n+1,I=F(n);G<=I;G++)if(!1!==(o=k(G,c,f))){!function(b,c){var e=p().validPositions[c];if(e)for(var f=e.locator,g=f.length,h=b;h<c;h++)if(p().validPositions[h]===d&&!E(h,!0)){var i=x(h).slice(),j=t(i,!0),m=-1;""===i[i.length-1].match.def&&i.pop(),a.each(i,function(a,b){for(var c=0;c<g;c++){if(b.locator[c]===d||!C(b.locator[c].toString().split(","),f[c].toString().split(","),b.na)){var e=f[c],h=j.locator[c],i=b.locator[c];e-h>Math.abs(e-i)&&(j=b);break}m<c&&(m=c,j=b)}}),j=a.extend({},j,{input:J(h,j.match,!0)||j.match.def}),j.generatedInput=!0,l(h,j,!0),p().validPositions[c]=d,k(c,e.input,!0)}}(n,o.pos!==d?o.pos:G),n=G;break}}else o={caret:F(n)}}!1===o&&j.keepStatic&&!f&&!0!==h&&(o=function(b,c,e){var f,h,i,k,l,m,n,o,s=a.extend(!0,{},p().validPositions),t=!1,u=r();for(k=p().validPositions[u];u>=0;u--)if((i=p().validPositions[u])&&i.alternation!==d){if(f=u,h=p().validPositions[f].alternation,k.locator[i.alternation]!==i.locator[i.alternation])break;k=i}if(h!==d){o=parseInt(f);var v=k.locator[k.alternation||h]!==d?k.locator[k.alternation||h]:n[0];v.length>0&&(v=v.split(",")[0]);var w=p().validPositions[o],y=p().validPositions[o-1];a.each(x(o,y?y.locator:d,o-1),function(f,i){n=i.locator[h]?i.locator[h].toString().split(","):[];for(var k=0;k<n.length;k++){var u=[],x=0,y=0,z=!1;if(v<n[k]&&(i.na===d||-1===a.inArray(n[k],i.na.split(","))||-1===a.inArray(v.toString(),n))){p().validPositions[o]=a.extend(!0,{},i);var A=p().validPositions[o].locator;for(p().validPositions[o].locator[h]=parseInt(n[k]),null==i.match.fn?(w.input!==i.match.def&&(z=!0,!0!==w.generatedInput&&u.push(w.input)),y++,p().validPositions[o].generatedInput=!/[0-9a-bA-Z]/.test(i.match.def),p().validPositions[o].input=i.match.def):p().validPositions[o].input=w.input,l=o+1;l<r(d,!0)+1;l++)m=p().validPositions[l],m&&!0!==m.generatedInput&&/[0-9a-bA-Z]/.test(m.input)?u.push(m.input):l<b&&x++,delete p().validPositions[l];for(z&&u[0]===i.match.def&&u.shift(),q(!0),t=!0;u.length>0;){var B=u.shift();if(B!==j.skipOptionalPartCharacter&&!(t=D(r(d,!0)+1,B,!1,g,!0)))break}if(t){p().validPositions[o].locator=A;var C=r(b)+1;for(l=o+1;l<r()+1;l++)((m=p().validPositions[l])===d||null==m.match.fn)&&l<b+(y-x)&&y++;b+=y-x,t=D(b>C?C:b,c,e,g,!0)}if(t)return!1;q(),p().validPositions=a.extend(!0,{},s)}}})}return t}(n,c,f)),!0===o&&(o={pos:n})}if(a.isFunction(j.postValidation)&&!1!==o&&!f&&!0!==g){var K=j.postValidation(z(!0),o,j);if(K.refreshFromBuffer&&K.buffer){var L=K.refreshFromBuffer;A(!0===L?L:L.start,L.end,K.buffer)}o=!0===K?o:K}return o&&o.pos===d&&(o.pos=n),!1===o&&(q(!0),p().validPositions=a.extend(!0,{},v)),o}function E(a,b){var c=u(a).match;if(""===c.def&&(c=v(a).match),null!=c.fn)return c.fn;if(!0!==b&&a>-1){var d=x(a);return d.length>1+(""===d[d.length-1].match.def?1:0)}return!1}function F(a,b){var c=p().maskLength;if(a>=c)return c;var d=a;for(x(c+1).length>1&&(o(!0,c+1,!0),c=p().maskLength);++d<c&&(!0===b&&(!0!==v(d).match.newBlockMarker||!E(d))||!0!==b&&!E(d)););return d}function G(a,b){var c,d=a;if(d<=0)return 0;for(;--d>0&&(!0===b&&!0!==v(d).match.newBlockMarker||!0!==b&&!E(d)&&(c=x(d),c.length<2||2===c.length&&""===c[1].match.def)););return d}function H(a){return p().validPositions[a]===d?J(a):p().validPositions[a].input}function I(b,c,e,f,g){if(f&&a.isFunction(j.onBeforeWrite)){var h=j.onBeforeWrite(f,c,e,j);if(h){if(h.refreshFromBuffer){var i=h.refreshFromBuffer;A(!0===i?i:i.start,i.end,h.buffer||c),c=z(!0)}e!==d&&(e=h.caret!==d?h.caret:e)}}b!==d&&(b.inputmask._valueSet(c.join("")),e===d||f!==d&&"blur"===f.type?S(b,c,e):n&&"input"===f.type?setTimeout(function(){M(b,e)},0):M(b,e),!0===g&&(_=!0,a(b).trigger("input")))}function J(b,c,e){if(c=c||v(b).match,c.placeholder!==d||!0===e)return a.isFunction(c.placeholder)?c.placeholder(j):c.placeholder;if(null===c.fn){if(b>-1&&p().validPositions[b]===d){var f,g=x(b),h=[];if(g.length>1+(""===g[g.length-1].match.def?1:0))for(var i=0;i<g.length;i++)if(!0!==g[i].match.optionality&&!0!==g[i].match.optionalQuantifier&&(null===g[i].match.fn||f===d||!1!==g[i].match.fn.test(f.match.def,p(),b,!0,j))&&(h.push(g[i]),null===g[i].match.fn&&(f=g[i]),h.length>1&&/[0-9a-bA-Z]/.test(h[0].match.def)))return j.placeholder.charAt(b%j.placeholder.length)}return c.def}return j.placeholder.charAt(b%j.placeholder.length)}function K(b,f,g,h,i){function k(a,b){return-1!==y().slice(a,F(a)).join("").indexOf(b)&&!E(a)&&v(a).match.nativeDef===b.charAt(b.length-1)}var l=h.slice(),m="",n=0,o=d;if(q(),p().p=F(-1),!g)if(!0!==j.autoUnmask){var s=y().slice(0,F(-1)).join(""),t=l.join("").match(new RegExp("^"+e.escapeRegex(s),"g"));t&&t.length>0&&(l.splice(0,t.length*s.length),n=F(n))}else n=F(n);if(a.each(l,function(c,e){if(e!==d){var f=new a.Event("_checkval");f.which=e.charCodeAt(0),m+=e;var h=r(d,!0),i=p().validPositions[h],l=u(h+1,i?i.locator.slice():d,h);if(!k(n,m)||g||j.autoUnmask){var s=g?c:null==l.match.fn&&l.match.optionality&&h+1<p().p?h+1:p().p;o=da.keypressEvent.call(b,f,!0,!1,g,s),n=s+1,m=""}else o=da.keypressEvent.call(b,f,!0,!1,!0,h+1);if(!1!==o&&!g&&a.isFunction(j.onBeforeWrite)){var t=o.forwardPosition;if(o=j.onBeforeWrite(f,z(),o.forwardPosition,j),o.forwardPosition=t,o&&o.refreshFromBuffer){var v=o.refreshFromBuffer;A(!0===v?v:v.start,v.end,o.buffer),q(!0),o.caret&&(p().p=o.caret,o.forwardPosition=o.caret)}}}}),f){var w=d;c.activeElement===b&&o&&(w=j.numericInput?G(o.forwardPosition):o.forwardPosition),I(b,z(),w,i||new a.Event("checkval"),i&&"input"===i.type)}}function L(b){if(b){if(b.inputmask===d)return b.value;b.inputmask&&b.inputmask.refreshValue&&da.setValueEvent.call(b)}var c=[],e=p().validPositions;for(var f in e)e[f].match&&null!=e[f].match.fn&&c.push(e[f].input);var g=0===c.length?"":(Z?c.reverse():c).join("");if(a.isFunction(j.onUnMask)){var h=(Z?z().slice().reverse():z()).join("");g=j.onUnMask(h,g,j)}return g}function M(a,e,f,g){function h(a){if(!0!==g&&Z&&"number"==typeof a&&(!j.greedy||""!==j.placeholder)){a=z().join("").length-a}return a}var i;if(e===d)return a.setSelectionRange?(e=a.selectionStart,f=a.selectionEnd):b.getSelection?(i=b.getSelection().getRangeAt(0),i.commonAncestorContainer.parentNode!==a&&i.commonAncestorContainer!==a||(e=i.startOffset,f=i.endOffset)):c.selection&&c.selection.createRange&&(i=c.selection.createRange(),e=0-i.duplicate().moveStart("character",-a.inputmask._valueGet().length),f=e+i.text.length),{begin:h(e),end:h(f)};if(e.begin!==d&&(f=e.end,e=e.begin),"number"==typeof e){e=h(e),f=h(f),f="number"==typeof f?f:e;var l=parseInt(((a.ownerDocument.defaultView||b).getComputedStyle?(a.ownerDocument.defaultView||b).getComputedStyle(a,null):a.currentStyle).fontSize)*f;if(a.scrollLeft=l>a.scrollWidth?l:0,k||!1!==j.insertMode||e!==f||f++,a.setSelectionRange)a.selectionStart=e,a.selectionEnd=f;else if(b.getSelection){if(i=c.createRange(),a.firstChild===d||null===a.firstChild){var m=c.createTextNode("");a.appendChild(m)}i.setStart(a.firstChild,e<a.inputmask._valueGet().length?e:a.inputmask._valueGet().length),i.setEnd(a.firstChild,f<a.inputmask._valueGet().length?f:a.inputmask._valueGet().length),i.collapse(!0);var n=b.getSelection();n.removeAllRanges(),n.addRange(i)}else a.createTextRange&&(i=a.createTextRange(),i.collapse(!0),i.moveEnd("character",f),i.moveStart("character",e),i.select());S(a,d,{begin:e,end:f})}}function N(b){var c,e,f=z(),g=f.length,h=r(),i={},j=p().validPositions[h],k=j!==d?j.locator.slice():d;for(c=h+1;c<f.length;c++)e=u(c,k,c-1),k=e.locator.slice(),i[c]=a.extend(!0,{},e);var l=j&&j.alternation!==d?j.locator[j.alternation]:d;for(c=g-1;c>h&&(e=i[c],(e.match.optionality||e.match.optionalQuantifier&&e.match.newBlockMarker||l&&(l!==i[c].locator[j.alternation]&&null!=e.match.fn||null===e.match.fn&&e.locator[j.alternation]&&C(e.locator[j.alternation].toString().split(","),l.toString().split(","))&&""!==x(c)[0].def))&&f[c]===J(c,e.match));c--)g--;return b?{l:g,def:i[g]?i[g].match:d}:g}function O(a){for(var b,c=N(),e=a.length,f=p().validPositions[r()];c<e&&!E(c,!0)&&(b=f!==d?u(c,f.locator.slice(""),f):v(c))&&!0!==b.match.optionality&&(!0!==b.match.optionalQuantifier&&!0!==b.match.newBlockMarker||c+1===e&&""===(f!==d?u(c+1,f.locator.slice(""),f):v(c+1)).match.def);)c++;for(;(b=p().validPositions[c-1])&&b&&b.match.optionality&&b.input===j.skipOptionalPartCharacter;)c--;return a.splice(c),a}function P(b){if(a.isFunction(j.isComplete))return j.isComplete(b,j);if("*"===j.repeat)return d;var c=!1,e=N(!0),f=G(e.l);if(e.def===d||e.def.newBlockMarker||e.def.optionality||e.def.optionalQuantifier){c=!0;for(var g=0;g<=f;g++){var h=u(g).match;if(null!==h.fn&&p().validPositions[g]===d&&!0!==h.optionality&&!0!==h.optionalQuantifier||null===h.fn&&b[g]!==J(g,h)){c=!1;break}}}return c}function Q(b,c,f,g,h){if((j.numericInput||Z)&&(c===e.keyCode.BACKSPACE?c=e.keyCode.DELETE:c===e.keyCode.DELETE&&(c=e.keyCode.BACKSPACE),Z)){var i=f.end;f.end=f.begin,f.begin=i}c===e.keyCode.BACKSPACE&&(f.end-f.begin<1||!1===j.insertMode)?(f.begin=G(f.begin),p().validPositions[f.begin]!==d&&p().validPositions[f.begin].input===j.groupSeparator&&f.begin--):c===e.keyCode.DELETE&&f.begin===f.end&&(f.end=E(f.end,!0)&&p().validPositions[f.end]&&p().validPositions[f.end].input!==j.radixPoint?f.end+1:F(f.end)+1,p().validPositions[f.begin]!==d&&p().validPositions[f.begin].input===j.groupSeparator&&f.end++),s(f.begin,f.end,!1,g),!0!==g&&function(){if(j.keepStatic){for(var c=[],e=r(-1,!0),f=a.extend(!0,{},p().validPositions),g=p().validPositions[e];e>=0;e--){var h=p().validPositions[e];if(h){if(!0!==h.generatedInput&&/[0-9a-bA-Z]/.test(h.input)&&c.push(h.input),delete p().validPositions[e],h.alternation!==d&&h.locator[h.alternation]!==g.locator[h.alternation])break;g=h}}if(e>-1)for(p().p=F(r(-1,!0));c.length>0;){var i=new a.Event("keypress");i.which=c.pop().charCodeAt(0),da.keypressEvent.call(b,i,!0,!1,!1,p().p)}else p().validPositions=a.extend(!0,{},f)}}();var k=r(f.begin,!0);if(k<f.begin)p().p=F(k);else if(!0!==g&&(p().p=f.begin,!0!==h))for(;p().p<k&&p().validPositions[p().p]===d;)p().p++}function R(d){function e(a){var b,e=c.createElement("span");for(var f in h)isNaN(f)&&-1!==f.indexOf("font")&&(e.style[f]=h[f]);e.style.textTransform=h.textTransform,e.style.letterSpacing=h.letterSpacing,e.style.position="absolute",e.style.height="auto",e.style.width="auto",e.style.visibility="hidden",e.style.whiteSpace="nowrap",c.body.appendChild(e);var g,i=d.inputmask._valueGet(),j=0;for(b=0,g=i.length;b<=g;b++){if(e.innerHTML+=i.charAt(b)||"_",e.offsetWidth>=a){var k=a-j,l=e.offsetWidth-a;e.innerHTML=i.charAt(b),k-=e.offsetWidth/3,b=k<l?b-1:b;break}j=e.offsetWidth}return c.body.removeChild(e),b}function f(){W.style.position="absolute",W.style.top=g.top+"px",W.style.left=g.left+"px",W.style.width=parseInt(d.offsetWidth)-parseInt(h.paddingLeft)-parseInt(h.paddingRight)-parseInt(h.borderLeftWidth)-parseInt(h.borderRightWidth)+"px",W.style.height=parseInt(d.offsetHeight)-parseInt(h.paddingTop)-parseInt(h.paddingBottom)-parseInt(h.borderTopWidth)-parseInt(h.borderBottomWidth)+"px",W.style.lineHeight=W.style.height,W.style.zIndex=isNaN(h.zIndex)?-1:h.zIndex-1,W.style.webkitAppearance="textfield",W.style.mozAppearance="textfield",W.style.Appearance="textfield"}var g=a(d).position(),h=(d.ownerDocument.defaultView||b).getComputedStyle(d,null);W=c.createElement("div"),c.body.appendChild(W);for(var i in h)h.hasOwnProperty(i)&&isNaN(i)&&"cssText"!==i&&-1==i.indexOf("webkit")&&(W.style[i]=h[i]);d.style.backgroundColor="transparent",d.style.color="transparent",d.style.webkitAppearance="caret",d.style.mozAppearance="caret",d.style.Appearance="caret",f(),a(b).on("resize",function(c){g=a(d).position(),h=(d.ownerDocument.defaultView||b).getComputedStyle(d,null),f()}),a(d).on("click",function(a){return M(d,e(a.clientX)),da.clickEvent.call(this,[a])}),a(d).on("keydown",function(a){a.shiftKey||!1===j.insertMode||setTimeout(function(){S(d)},0)})}function S(a,b,e){function f(){h||null!==k.fn&&l.input!==d?h&&null!==k.fn&&l.input!==d&&(h=!1,g+="</span>"):(h=!0,g+="<span class='im-static''>")}if(W!==d){b=b||z(),e===d?e=M(a):e.begin===d&&(e={begin:e,end:e});var g="",h=!1;if(""!=b){var i,k,l,m=0,n=r();do{m===e.begin&&c.activeElement===a&&(g+="<span class='im-caret' style='border-right-width: 1px;border-right-style: solid;'></span>"),p().validPositions[m]?(l=p().validPositions[m],k=l.match,i=l.locator.slice(),f(),g+=l.input):(l=u(m,i,m-1),k=l.match,i=l.locator.slice(),(!1===j.jitMasking||m<n||"number"==typeof j.jitMasking&&isFinite(j.jitMasking)&&j.jitMasking>m)&&(f(),g+=J(m,k))),m++}while((V===d||m<V)&&(null!==k.fn||""!==k.def)||n>m)}W.innerHTML=g}}h=h||this.maskset,j=j||this.opts;var T,U,V,W,X,Y=this.el,Z=this.isRTL,$=!1,_=!1,aa=!1,ba=!1,ca={on:function(b,c,f){var g=function(b){if(this.inputmask===d&&"FORM"!==this.nodeName){var c=a.data(this,"_inputmask_opts");c?new e(c).mask(this):ca.off(this)}else{if("setvalue"===b.type||"FORM"===this.nodeName||!(this.disabled||this.readOnly&&!("keydown"===b.type&&b.ctrlKey&&67===b.keyCode||!1===j.tabThrough&&b.keyCode===e.keyCode.TAB))){switch(b.type){case"input":if(!0===_)return _=!1,b.preventDefault();break;case"keydown":$=!1,_=!1;break;case"keypress":if(!0===$)return b.preventDefault();$=!0;break;case"click":if(l||m){var g=this,h=arguments;return setTimeout(function(){f.apply(g,h)},0),!1}}var i=f.apply(this,arguments);return!1===i&&(b.preventDefault(),b.stopPropagation()),i}b.preventDefault()}};b.inputmask.events[c]=b.inputmask.events[c]||[],b.inputmask.events[c].push(g),-1!==a.inArray(c,["submit","reset"])?null!=b.form&&a(b.form).on(c,g):a(b).on(c,g)},off:function(b,c){if(b.inputmask&&b.inputmask.events){var d;c?(d=[],d[c]=b.inputmask.events[c]):d=b.inputmask.events,a.each(d,function(c,d){for(;d.length>0;){var e=d.pop();-1!==a.inArray(c,["submit","reset"])?null!=b.form&&a(b.form).off(c,e):a(b).off(c,e)}delete b.inputmask.events[c]})}}},da={keydownEvent:function(b){var d=this,f=a(d),g=b.keyCode,h=M(d);if(g===e.keyCode.BACKSPACE||g===e.keyCode.DELETE||m&&g===e.keyCode.BACKSPACE_SAFARI||b.ctrlKey&&g===e.keyCode.X&&!function(a){var b=c.createElement("input"),d="on"+a,e=d in b;return e||(b.setAttribute(d,"return;"),e="function"==typeof b[d]),b=null,e}("cut"))b.preventDefault(),Q(d,g,h),I(d,z(!0),p().p,b,d.inputmask._valueGet()!==z().join("")),d.inputmask._valueGet()===y().join("")?f.trigger("cleared"):!0===P(z())&&f.trigger("complete");else if(g===e.keyCode.END||g===e.keyCode.PAGE_DOWN){b.preventDefault();var i=F(r());j.insertMode||i!==p().maskLength||b.shiftKey||i--,M(d,b.shiftKey?h.begin:i,i,!0)}else g===e.keyCode.HOME&&!b.shiftKey||g===e.keyCode.PAGE_UP?(b.preventDefault(),M(d,0,b.shiftKey?h.begin:0,!0)):(j.undoOnEscape&&g===e.keyCode.ESCAPE||90===g&&b.ctrlKey)&&!0!==b.altKey?(K(d,!0,!1,T.split("")),f.trigger("click")):g!==e.keyCode.INSERT||b.shiftKey||b.ctrlKey?!0===j.tabThrough&&g===e.keyCode.TAB?(!0===b.shiftKey?(null===v(h.begin).match.fn&&(h.begin=F(h.begin)),h.end=G(h.begin,!0),h.begin=G(h.end,!0)):(h.begin=F(h.begin,!0),h.end=F(h.begin,!0),h.end<p().maskLength&&h.end--),h.begin<p().maskLength&&(b.preventDefault(),M(d,h.begin,h.end))):b.shiftKey||!1===j.insertMode&&(g===e.keyCode.RIGHT?setTimeout(function(){var a=M(d);M(d,a.begin)},0):g===e.keyCode.LEFT&&setTimeout(function(){var a=M(d);M(d,Z?a.begin+1:a.begin-1)},0)):(j.insertMode=!j.insertMode,M(d,j.insertMode||h.begin!==p().maskLength?h.begin:h.begin-1));j.onKeyDown.call(this,b,z(),M(d).begin,j),aa=-1!==a.inArray(g,j.ignorables)},keypressEvent:function(b,c,f,g,h){var i=this,k=a(i),l=b.which||b.charCode||b.keyCode;if(!(!0===c||b.ctrlKey&&b.altKey)&&(b.ctrlKey||b.metaKey||aa))return l===e.keyCode.ENTER&&T!==z().join("")&&(T=z().join(""),setTimeout(function(){k.trigger("change")},0)),!0;if(l){46===l&&!1===b.shiftKey&&""!==j.radixPoint&&(l=j.radixPoint.charCodeAt(0));var m,n=c?{begin:h,end:h}:M(i),o=String.fromCharCode(l);p().writeOutBuffer=!0;var r=D(n,o,g);if(!1!==r&&(q(!0),m=r.caret!==d?r.caret:c?r.pos+1:F(r.pos),p().p=m),!1!==f&&(setTimeout(function(){j.onKeyValidation.call(i,l,r,j)},0),p().writeOutBuffer&&!1!==r)){var s=z();I(i,s,j.numericInput&&r.caret===d?G(m):m,b,!0!==c),!0!==c&&setTimeout(function(){!0===P(s)&&k.trigger("complete")},0)}if(b.preventDefault(),c)return!1!==r&&(r.forwardPosition=m),r}},pasteEvent:function(c){var d,e=this,f=c.originalEvent||c,g=a(e),h=e.inputmask._valueGet(!0),i=M(e);Z&&(d=i.end,i.end=i.begin,i.begin=d);var k=h.substr(0,i.begin),l=h.substr(i.end,h.length);if(k===(Z?y().reverse():y()).slice(0,i.begin).join("")&&(k=""),l===(Z?y().reverse():y()).slice(i.end).join("")&&(l=""),Z&&(d=k,k=l,l=d),b.clipboardData&&b.clipboardData.getData)h=k+b.clipboardData.getData("Text")+l;else{if(!f.clipboardData||!f.clipboardData.getData)return!0;h=k+f.clipboardData.getData("text/plain")+l}var m=h;if(a.isFunction(j.onBeforePaste)){if(!1===(m=j.onBeforePaste(h,j)))return c.preventDefault();m||(m=h)}return K(e,!1,!1,Z?m.split("").reverse():m.toString().split("")),I(e,z(),F(r()),c,T!==z().join("")),!0===P(z())&&g.trigger("complete"),c.preventDefault()},inputFallBackEvent:function(b){var c=this,d=c.inputmask._valueGet();if(z().join("")!==d){var f=M(c);if("."===d.charAt(f.begin-1)&&""!==j.radixPoint&&(d=d.split(""),d[f.begin-1]=j.radixPoint.charAt(0),d=d.join("")),
d.charAt(f.begin-1)===j.radixPoint&&d.length>z().length){var g=new a.Event("keypress");return g.which=j.radixPoint.charCodeAt(0),da.keypressEvent.call(c,g,!0,!0,!1,f.begin),!1}if(d=d.replace(new RegExp("("+e.escapeRegex(y().join(""))+")*"),""),l){var h=d.replace(z().join(""),"");if(1===h.length){var g=new a.Event("keypress");return g.which=h.charCodeAt(0),da.keypressEvent.call(c,g,!0,!0,!1,p().validPositions[f.begin-1]?f.begin:f.begin-1),!1}}if(f.begin>d.length&&(M(c,d.length),f=M(c)),z().length-d.length!=1||d.charAt(f.begin)===z()[f.begin]||d.charAt(f.begin+1)===z()[f.begin]||E(f.begin)){var i=[],k=y().join("");for(i.push(d.substr(0,f.begin)),i.push(d.substr(f.begin));null===d.match(e.escapeRegex(k)+"$");)k=k.slice(1);d=d.replace(k,""),a.isFunction(j.onBeforeMask)&&(d=j.onBeforeMask(d,j)||d),K(c,!0,!1,d.split(""),b),function(a,b,c){var d=M(a).begin,f=a.inputmask._valueGet(),g=f.indexOf(b),h=d;if(0===g&&d!==b.length)d=b.length;else{for(;null===f.match(e.escapeRegex(c)+"$");)c=c.substr(1);var i=f.indexOf(c);-1!==i&&""!==c&&d>i&&i>g&&(d=i)}E(d)||(d=F(d)),h!==d&&(M(a,d),n&&setTimeout(function(){M(a,d)},0))}(c,i[0],i[1]),!0===P(z())&&a(c).trigger("complete")}else b.keyCode=e.keyCode.BACKSPACE,da.keydownEvent.call(c,b);b.preventDefault()}},setValueEvent:function(b){this.inputmask.refreshValue=!1;var c=this,d=c.inputmask._valueGet(!0);a.isFunction(j.onBeforeMask)&&(d=j.onBeforeMask(d,j)||d),d=d.split(""),K(c,!0,!1,Z?d.reverse():d),T=z().join(""),(j.clearMaskOnLostFocus||j.clearIncomplete)&&c.inputmask._valueGet()===y().join("")&&c.inputmask._valueSet("")},focusEvent:function(a){var b=this,c=b.inputmask._valueGet();j.showMaskOnFocus&&(!j.showMaskOnHover||j.showMaskOnHover&&""===c)&&(b.inputmask._valueGet()!==z().join("")?I(b,z(),F(r())):!1===ba&&M(b,F(r()))),!0===j.positionCaretOnTab&&!1===ba&&(I(b,z(),M(b)),da.clickEvent.apply(b,[a,!0])),T=z().join("")},mouseleaveEvent:function(a){var b=this;if(ba=!1,j.clearMaskOnLostFocus&&c.activeElement!==b){var d=z().slice(),e=b.inputmask._valueGet();e!==b.getAttribute("placeholder")&&""!==e&&(-1===r()&&e===y().join("")?d=[]:O(d),I(b,d))}},clickEvent:function(b,e){function f(b){if(""!==j.radixPoint){var c=p().validPositions;if(c[b]===d||c[b].input===J(b)){if(b<F(-1))return!0;var e=a.inArray(j.radixPoint,z());if(-1!==e){for(var f in c)if(e<f&&c[f].input!==J(f))return!1;return!0}}}return!1}var g=this;setTimeout(function(){if(c.activeElement===g){var a=M(g);if(e&&(Z?a.end=a.begin:a.begin=a.end),a.begin===a.end)switch(j.positionCaretOnClick){case"none":break;case"radixFocus":if(f(a.begin)){var b=z().join("").indexOf(j.radixPoint);M(g,j.numericInput?F(b):b);break}default:var h=a.begin,i=r(h,!0),k=F(i);if(h<k)M(g,E(h)||E(h-1)?h:F(h));else{var l=J(k),m=p().validPositions[i],n=u(k,m?m.match.locator:d,m);if(""!==l&&z()[k]!==l&&!0!==n.match.optionalQuantifier||!E(k)&&n.match.def===l){var o=F(k);h>=o&&(k=o)}M(g,k)}}}},0)},dblclickEvent:function(a){var b=this;setTimeout(function(){M(b,0,F(r()))},0)},cutEvent:function(d){var f=this,g=a(f),h=M(f),i=d.originalEvent||d,j=b.clipboardData||i.clipboardData,k=Z?z().slice(h.end,h.begin):z().slice(h.begin,h.end);j.setData("text",Z?k.reverse().join(""):k.join("")),c.execCommand&&c.execCommand("copy"),Q(f,e.keyCode.DELETE,h),I(f,z(),p().p,d,T!==z().join("")),f.inputmask._valueGet()===y().join("")&&g.trigger("cleared")},blurEvent:function(b){var c=a(this),e=this;if(e.inputmask){var f=e.inputmask._valueGet(),g=z().slice();""!==f&&(j.clearMaskOnLostFocus&&(-1===r()&&f===y().join("")?g=[]:O(g)),!1===P(g)&&(setTimeout(function(){c.trigger("incomplete")},0),j.clearIncomplete&&(q(),g=j.clearMaskOnLostFocus?[]:y().slice())),I(e,g,d,b)),T!==z().join("")&&(T=g.join(""),c.trigger("change"))}},mouseenterEvent:function(a){var b=this;ba=!0,c.activeElement!==b&&j.showMaskOnHover&&b.inputmask._valueGet()!==z().join("")&&I(b,z())},submitEvent:function(a){T!==z().join("")&&U.trigger("change"),j.clearMaskOnLostFocus&&-1===r()&&Y.inputmask._valueGet&&Y.inputmask._valueGet()===y().join("")&&Y.inputmask._valueSet(""),j.removeMaskOnSubmit&&(Y.inputmask._valueSet(Y.inputmask.unmaskedvalue(),!0),setTimeout(function(){I(Y,z())},0))},resetEvent:function(a){Y.inputmask.refreshValue=!0,setTimeout(function(){U.trigger("setvalue")},0)}};if(f!==d)switch(f.action){case"isComplete":return Y=f.el,P(z());case"unmaskedvalue":return Y!==d&&f.value===d||(X=f.value,X=(a.isFunction(j.onBeforeMask)?j.onBeforeMask(X,j)||X:X).split(""),K(d,!1,!1,Z?X.reverse():X),a.isFunction(j.onBeforeWrite)&&j.onBeforeWrite(d,z(),0,j)),L(Y);case"mask":!function(b){ca.off(b);var e=function(b,e){var f=b.getAttribute("type"),h="INPUT"===b.tagName&&-1!==a.inArray(f,e.supportsInputType)||b.isContentEditable||"TEXTAREA"===b.tagName;if(!h)if("INPUT"===b.tagName){var i=c.createElement("input");i.setAttribute("type",f),h="text"===i.type,i=null}else h="partial";return!1!==h&&function(b){function f(){return this.inputmask?this.inputmask.opts.autoUnmask?this.inputmask.unmaskedvalue():-1!==r()||!0!==e.nullable?c.activeElement===this&&e.clearMaskOnLostFocus?(Z?O(z().slice()).reverse():O(z().slice())).join(""):i.call(this):"":i.call(this)}function h(b){j.call(this,b),this.inputmask&&a(this).trigger("setvalue")}var i,j;if(!b.inputmask.__valueGet){if(!0!==e.noValuePatching){if(Object.getOwnPropertyDescriptor){"function"!=typeof Object.getPrototypeOf&&(Object.getPrototypeOf="object"===g("test".__proto__)?function(a){return a.__proto__}:function(a){return a.constructor.prototype});var k=Object.getPrototypeOf?Object.getOwnPropertyDescriptor(Object.getPrototypeOf(b),"value"):d;k&&k.get&&k.set?(i=k.get,j=k.set,Object.defineProperty(b,"value",{get:f,set:h,configurable:!0})):"INPUT"!==b.tagName&&(i=function(){return this.textContent},j=function(a){this.textContent=a},Object.defineProperty(b,"value",{get:f,set:h,configurable:!0}))}else c.__lookupGetter__&&b.__lookupGetter__("value")&&(i=b.__lookupGetter__("value"),j=b.__lookupSetter__("value"),b.__defineGetter__("value",f),b.__defineSetter__("value",h));b.inputmask.__valueGet=i,b.inputmask.__valueSet=j}b.inputmask._valueGet=function(a){return Z&&!0!==a?i.call(this.el).split("").reverse().join(""):i.call(this.el)},b.inputmask._valueSet=function(a,b){j.call(this.el,null===a||a===d?"":!0!==b&&Z?a.split("").reverse().join(""):a)},i===d&&(i=function(){return this.value},j=function(a){this.value=a},function(b){if(a.valHooks&&(a.valHooks[b]===d||!0!==a.valHooks[b].inputmaskpatch)){var c=a.valHooks[b]&&a.valHooks[b].get?a.valHooks[b].get:function(a){return a.value},f=a.valHooks[b]&&a.valHooks[b].set?a.valHooks[b].set:function(a,b){return a.value=b,a};a.valHooks[b]={get:function(a){if(a.inputmask){if(a.inputmask.opts.autoUnmask)return a.inputmask.unmaskedvalue();var b=c(a);return-1!==r(d,d,a.inputmask.maskset.validPositions)||!0!==e.nullable?b:""}return c(a)},set:function(b,c){var d,e=a(b);return d=f(b,c),b.inputmask&&e.trigger("setvalue"),d},inputmaskpatch:!0}}}(b.type),function(b){ca.on(b,"mouseenter",function(b){var c=a(this);this.inputmask._valueGet()!==z().join("")&&c.trigger("setvalue")})}(b))}}(b),h}(b,j);if(!1!==e&&(Y=b,U=a(Y),!0===j.colorMask&&R(Y),n&&(Y.hasOwnProperty("inputmode")&&(Y.inputmode=j.inputmode,Y.setAttribute("inputmode",j.inputmode)),"rtfm"===j.androidHack&&(!0!==j.colorMask&&R(Y),Y.type="password")),!0===e&&(ca.on(Y,"submit",da.submitEvent),ca.on(Y,"reset",da.resetEvent),ca.on(Y,"mouseenter",da.mouseenterEvent),ca.on(Y,"blur",da.blurEvent),ca.on(Y,"focus",da.focusEvent),ca.on(Y,"mouseleave",da.mouseleaveEvent),!0!==j.colorMask&&ca.on(Y,"click",da.clickEvent),ca.on(Y,"dblclick",da.dblclickEvent),ca.on(Y,"paste",da.pasteEvent),ca.on(Y,"dragdrop",da.pasteEvent),ca.on(Y,"drop",da.pasteEvent),ca.on(Y,"cut",da.cutEvent),ca.on(Y,"complete",j.oncomplete),ca.on(Y,"incomplete",j.onincomplete),ca.on(Y,"cleared",j.oncleared),n||!0===j.inputEventOnly||(ca.on(Y,"keydown",da.keydownEvent),ca.on(Y,"keypress",da.keypressEvent)),ca.on(Y,"compositionstart",a.noop),ca.on(Y,"compositionupdate",a.noop),ca.on(Y,"compositionend",a.noop),ca.on(Y,"keyup",a.noop),ca.on(Y,"input",da.inputFallBackEvent),ca.on(Y,"beforeinput",a.noop)),ca.on(Y,"setvalue",da.setValueEvent),T=y().join(""),""!==Y.inputmask._valueGet(!0)||!1===j.clearMaskOnLostFocus||c.activeElement===Y)){var f=a.isFunction(j.onBeforeMask)?j.onBeforeMask(Y.inputmask._valueGet(!0),j)||Y.inputmask._valueGet(!0):Y.inputmask._valueGet(!0);""!==f&&K(Y,!0,!1,Z?f.split("").reverse():f.split(""));var h=z().slice();T=h.join(""),!1===P(h)&&j.clearIncomplete&&q(),j.clearMaskOnLostFocus&&c.activeElement!==Y&&(-1===r()?h=[]:O(h)),I(Y,h),c.activeElement===Y&&M(Y,F(r()))}}(Y);break;case"format":return X=(a.isFunction(j.onBeforeMask)?j.onBeforeMask(f.value,j)||f.value:f.value).split(""),K(d,!0,!1,Z?X.reverse():X),f.metadata?{value:Z?z().slice().reverse().join(""):z().join(""),metadata:i.call(this,{action:"getmetadata"},h,j)}:Z?z().slice().reverse().join(""):z().join("");case"isValid":f.value?(X=f.value.split(""),K(d,!0,!0,Z?X.reverse():X)):f.value=z().join("");for(var ea=z(),fa=N(),ga=ea.length-1;ga>fa&&!E(ga);ga--);return ea.splice(fa,ga+1-fa),P(ea)&&f.value===z().join("");case"getemptymask":return y().join("");case"remove":if(Y&&Y.inputmask){U=a(Y),Y.inputmask._valueSet(j.autoUnmask?L(Y):Y.inputmask._valueGet(!0)),ca.off(Y);Object.getOwnPropertyDescriptor&&Object.getPrototypeOf?Object.getOwnPropertyDescriptor(Object.getPrototypeOf(Y),"value")&&Y.inputmask.__valueGet&&Object.defineProperty(Y,"value",{get:Y.inputmask.__valueGet,set:Y.inputmask.__valueSet,configurable:!0}):c.__lookupGetter__&&Y.__lookupGetter__("value")&&Y.inputmask.__valueGet&&(Y.__defineGetter__("value",Y.inputmask.__valueGet),Y.__defineSetter__("value",Y.inputmask.__valueSet)),Y.inputmask=d}return Y;case"getmetadata":if(a.isArray(h.metadata)){var ha=o(!0,0,!1).join("");return a.each(h.metadata,function(a,b){if(b.mask===ha)return ha=b,!1}),ha}return h.metadata}}var j=navigator.userAgent,k=/mobile/i.test(j),l=/iemobile/i.test(j),m=/iphone/i.test(j)&&!l,n=/android/i.test(j)&&!l;return e.prototype={dataAttribute:"data-inputmask",defaults:{placeholder:"_",optionalmarker:{start:"[",end:"]"},quantifiermarker:{start:"{",end:"}"},groupmarker:{start:"(",end:")"},alternatormarker:"|",escapeChar:"\\",mask:null,regex:null,oncomplete:a.noop,onincomplete:a.noop,oncleared:a.noop,repeat:0,greedy:!0,autoUnmask:!1,removeMaskOnSubmit:!1,clearMaskOnLostFocus:!0,insertMode:!0,clearIncomplete:!1,alias:null,onKeyDown:a.noop,onBeforeMask:null,onBeforePaste:function(b,c){return a.isFunction(c.onBeforeMask)?c.onBeforeMask(b,c):b},onBeforeWrite:null,onUnMask:null,showMaskOnFocus:!0,showMaskOnHover:!0,onKeyValidation:a.noop,skipOptionalPartCharacter:" ",numericInput:!1,rightAlign:!1,undoOnEscape:!0,radixPoint:"",radixPointDefinitionSymbol:d,groupSeparator:"",keepStatic:null,positionCaretOnTab:!0,tabThrough:!1,supportsInputType:["text","tel","password"],ignorables:[8,9,13,19,27,33,34,35,36,37,38,39,40,45,46,93,112,113,114,115,116,117,118,119,120,121,122,123,0,229],isComplete:null,canClearPosition:a.noop,preValidation:null,postValidation:null,staticDefinitionSymbol:d,jitMasking:!1,nullable:!0,inputEventOnly:!1,noValuePatching:!1,positionCaretOnClick:"lvp",casing:null,inputmode:"verbatim",colorMask:!1,androidHack:!1},definitions:{9:{validator:"[0-9]",cardinality:1,definitionSymbol:"*"},a:{validator:"[A-Za-z\u0410-\u044f\u0401\u0451\xc0-\xff\xb5]",cardinality:1,definitionSymbol:"*"},"*":{validator:"[0-9A-Za-z\u0410-\u044f\u0401\u0451\xc0-\xff\xb5]",cardinality:1}},aliases:{},masksCache:{},mask:function(g){function j(c,e,g,h){function i(a,e){null!==(e=e!==d?e:c.getAttribute(h+"-"+a))&&("string"==typeof e&&(0===a.indexOf("on")?e=b[e]:"false"===e?e=!1:"true"===e&&(e=!0)),g[a]=e)}("rtl"===c.dir||e.rightAlign)&&(c.style.textAlign="right"),("rtl"===c.dir||e.numericInput)&&(c.dir="ltr",c.removeAttribute("dir"),e.isRTL=!0);var j,k,l,m,n=c.getAttribute(h);if(n&&""!==n&&(n=n.replace(new RegExp("'","g"),'"'),k=JSON.parse("{"+n+"}")),k){l=d;for(m in k)if("alias"===m.toLowerCase()){l=k[m];break}}i("alias",l),g.alias&&f(g.alias,g,e);for(j in e){if(k){l=d;for(m in k)if(m.toLowerCase()===j.toLowerCase()){l=k[m];break}}i(j,l)}return a.extend(!0,e,g),e}var k=this;return"string"==typeof g&&(g=c.getElementById(g)||c.querySelectorAll(g)),g=g.nodeName?[g]:g,a.each(g,function(b,c){var f=a.extend(!0,{},k.opts);j(c,f,a.extend(!0,{},k.userOptions),k.dataAttribute);var g=h(f,k.noMasksCache);g!==d&&(c.inputmask!==d&&c.inputmask.remove(),c.inputmask=new e(d,d,!0),c.inputmask.opts=f,c.inputmask.noMasksCache=k.noMasksCache,c.inputmask.userOptions=a.extend(!0,{},k.userOptions),c.inputmask.isRTL=f.isRTL,c.inputmask.el=c,c.inputmask.maskset=g,a.data(c,"_inputmask_opts",f),i.call(c.inputmask,{action:"mask"}))}),g&&g[0]?g[0].inputmask||this:this},option:function(b,c){return"string"==typeof b?this.opts[b]:"object"===(void 0===b?"undefined":g(b))?(a.extend(this.userOptions,b),this.el&&!0!==c&&this.mask(this.el),this):void 0},unmaskedvalue:function(a){return this.maskset=this.maskset||h(this.opts,this.noMasksCache),i.call(this,{action:"unmaskedvalue",value:a})},remove:function(){return i.call(this,{action:"remove"})},getemptymask:function(){return this.maskset=this.maskset||h(this.opts,this.noMasksCache),i.call(this,{action:"getemptymask"})},hasMaskedValue:function(){return!this.opts.autoUnmask},isComplete:function(){return this.maskset=this.maskset||h(this.opts,this.noMasksCache),i.call(this,{action:"isComplete"})},getmetadata:function(){return this.maskset=this.maskset||h(this.opts,this.noMasksCache),i.call(this,{action:"getmetadata"})},isValid:function(a){return this.maskset=this.maskset||h(this.opts,this.noMasksCache),i.call(this,{action:"isValid",value:a})},format:function(a,b){return this.maskset=this.maskset||h(this.opts,this.noMasksCache),i.call(this,{action:"format",value:a,metadata:b})},analyseMask:function(b,c,f){function g(a,b,c,d){this.matches=[],this.openGroup=a||!1,this.alternatorGroup=!1,this.isGroup=a||!1,this.isOptional=b||!1,this.isQuantifier=c||!1,this.isAlternator=d||!1,this.quantifier={min:1,max:1}}function h(b,g,h){h=h!==d?h:b.matches.length;var i=b.matches[h-1];if(c)0===g.indexOf("[")||u?b.matches.splice(h++,0,{fn:new RegExp(g,f.casing?"i":""),cardinality:1,optionality:b.isOptional,newBlockMarker:i===d||i.def!==g,casing:null,def:g,placeholder:d,nativeDef:g}):a.each(g.split(""),function(a,c){i=b.matches[h-1],b.matches.splice(h++,0,{fn:null,cardinality:0,optionality:b.isOptional,newBlockMarker:i===d||i.def!==c&&null!==i.fn,casing:null,def:f.staticDefinitionSymbol||c,placeholder:f.staticDefinitionSymbol!==d?c:d,nativeDef:c})}),u=!1;else{var j=(f.definitions?f.definitions[g]:d)||e.prototype.definitions[g];if(j&&!u){for(var k=j.prevalidator,l=k?k.length:0,m=1;m<j.cardinality;m++){var n=l>=m?k[m-1]:[],o=n.validator,p=n.cardinality;b.matches.splice(h++,0,{fn:o?"string"==typeof o?new RegExp(o,f.casing?"i":""):new function(){this.test=o}:new RegExp("."),cardinality:p||1,optionality:b.isOptional,newBlockMarker:i===d||i.def!==(j.definitionSymbol||g),casing:j.casing,def:j.definitionSymbol||g,placeholder:j.placeholder,nativeDef:g}),i=b.matches[h-1]}b.matches.splice(h++,0,{fn:j.validator?"string"==typeof j.validator?new RegExp(j.validator,f.casing?"i":""):new function(){this.test=j.validator}:new RegExp("."),cardinality:j.cardinality,optionality:b.isOptional,newBlockMarker:i===d||i.def!==(j.definitionSymbol||g),casing:j.casing,def:j.definitionSymbol||g,placeholder:j.placeholder,nativeDef:g})}else b.matches.splice(h++,0,{fn:null,cardinality:0,optionality:b.isOptional,newBlockMarker:i===d||i.def!==g&&null!==i.fn,casing:null,def:f.staticDefinitionSymbol||g,placeholder:f.staticDefinitionSymbol!==d?g:d,nativeDef:g}),u=!1}}function i(b){b&&b.matches&&a.each(b.matches,function(a,e){var g=b.matches[a+1];(g===d||g.matches===d||!1===g.isQuantifier)&&e&&e.isGroup&&(e.isGroup=!1,c||(h(e,f.groupmarker.start,0),!0!==e.openGroup&&h(e,f.groupmarker.end))),i(e)})}function j(){if(w.length>0){if(o=w[w.length-1],h(o,m),o.isAlternator){p=w.pop();for(var a=0;a<p.matches.length;a++)p.matches[a].isGroup=!1;w.length>0?(o=w[w.length-1],o.matches.push(p)):v.matches.push(p)}}else h(v,m)}function k(a){a.matches=a.matches.reverse();for(var b in a.matches)if(a.matches.hasOwnProperty(b)){var c=parseInt(b);if(a.matches[b].isQuantifier&&a.matches[c+1]&&a.matches[c+1].isGroup){var e=a.matches[b];a.matches.splice(b,1),a.matches.splice(c+1,0,e)}a.matches[b].matches!==d?a.matches[b]=k(a.matches[b]):a.matches[b]=function(a){return a===f.optionalmarker.start?a=f.optionalmarker.end:a===f.optionalmarker.end?a=f.optionalmarker.start:a===f.groupmarker.start?a=f.groupmarker.end:a===f.groupmarker.end&&(a=f.groupmarker.start),a}(a.matches[b])}return a}var l,m,n,o,p,q,r,s=/(?:[?*+]|\{[0-9\+\*]+(?:,[0-9\+\*]*)?\})|[^.?*+^${[]()|\\]+|./g,t=/\[\^?]?(?:[^\\\]]+|\\[\S\s]?)*]?|\\(?:0(?:[0-3][0-7]{0,2}|[4-7][0-7]?)?|[1-9][0-9]*|x[0-9A-Fa-f]{2}|u[0-9A-Fa-f]{4}|c[A-Za-z]|[\S\s]?)|\((?:\?[:=!]?)?|(?:[?*+]|\{[0-9]+(?:,[0-9]*)?\})\??|[^.?*+^${[()|\\]+|./g,u=!1,v=new g,w=[],x=[];for(c&&(f.optionalmarker.start=d,f.optionalmarker.end=d);l=c?t.exec(b):s.exec(b);){if(m=l[0],c&&!0!==u)switch(m.charAt(0)){case"?":m="{0,1}";break;case"+":case"*":m="{"+m+"}"}if(u)j();else switch(m.charAt(0)){case f.escapeChar:u=!0,c&&j();break;case f.optionalmarker.end:case f.groupmarker.end:if(n=w.pop(),n.openGroup=!1,n!==d)if(w.length>0){if(o=w[w.length-1],o.matches.push(n),o.isAlternator){p=w.pop();for(var y=0;y<p.matches.length;y++)p.matches[y].isGroup=!1,p.matches[y].alternatorGroup=!1;w.length>0?(o=w[w.length-1],o.matches.push(p)):v.matches.push(p)}}else v.matches.push(n);else j();break;case f.optionalmarker.start:w.push(new g(!1,!0));break;case f.groupmarker.start:w.push(new g(!0));break;case f.quantifiermarker.start:var z=new g(!1,!1,!0);m=m.replace(/[{}]/g,"");var A=m.split(","),B=isNaN(A[0])?A[0]:parseInt(A[0]),C=1===A.length?B:isNaN(A[1])?A[1]:parseInt(A[1]);if("*"!==C&&"+"!==C||(B="*"===C?0:1),z.quantifier={min:B,max:C},w.length>0){var D=w[w.length-1].matches;l=D.pop(),l.isGroup||(r=new g(!0),r.matches.push(l),l=r),D.push(l),D.push(z)}else l=v.matches.pop(),l.isGroup||(c&&null===l.fn&&"."===l.def&&(l.fn=new RegExp(l.def,f.casing?"i":"")),r=new g(!0),r.matches.push(l),l=r),v.matches.push(l),v.matches.push(z);break;case f.alternatormarker:if(w.length>0){o=w[w.length-1];var E=o.matches[o.matches.length-1];q=o.openGroup&&(E.matches===d||!1===E.isGroup&&!1===E.isAlternator)?w.pop():o.matches.pop()}else q=v.matches.pop();if(q.isAlternator)w.push(q);else if(q.alternatorGroup?(p=w.pop(),q.alternatorGroup=!1):p=new g(!1,!1,!1,!0),p.matches.push(q),w.push(p),q.openGroup){q.openGroup=!1;var F=new g(!0);F.alternatorGroup=!0,w.push(F)}break;default:j()}}for(;w.length>0;)n=w.pop(),v.matches.push(n);return v.matches.length>0&&(i(v),x.push(v)),(f.numericInput||f.isRTL)&&k(x[0]),x}},e.extendDefaults=function(b){a.extend(!0,e.prototype.defaults,b)},e.extendDefinitions=function(b){a.extend(!0,e.prototype.definitions,b)},e.extendAliases=function(b){a.extend(!0,e.prototype.aliases,b)},e.format=function(a,b,c){return e(b).format(a,c)},e.unmask=function(a,b){return e(b).unmaskedvalue(a)},e.isValid=function(a,b){return e(b).isValid(a)},e.remove=function(b){a.each(b,function(a,b){b.inputmask&&b.inputmask.remove()})},e.escapeRegex=function(a){var b=["/",".","*","+","?","|","(",")","[","]","{","}","\\","$","^"];return a.replace(new RegExp("(\\"+b.join("|\\")+")","gim"),"\\$1")},e.keyCode={ALT:18,BACKSPACE:8,BACKSPACE_SAFARI:127,CAPS_LOCK:20,COMMA:188,COMMAND:91,COMMAND_LEFT:91,COMMAND_RIGHT:93,CONTROL:17,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,INSERT:45,LEFT:37,MENU:93,NUMPAD_ADD:107,NUMPAD_DECIMAL:110,NUMPAD_DIVIDE:111,NUMPAD_ENTER:108,NUMPAD_MULTIPLY:106,NUMPAD_SUBTRACT:109,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SHIFT:16,SPACE:32,TAB:9,UP:38,WINDOWS:91,X:88},e})},function(a,b){a.exports=jQuery},function(a,b,c){"use strict";var d,e,f;"function"==typeof Symbol&&Symbol.iterator;!function(g){e=[c(0),c(1)],d=g,void 0!==(f="function"==typeof d?d.apply(b,e):d)&&(a.exports=f)}(function(a,b){function c(a){return isNaN(a)||29===new Date(a,2,0).getDate()}return b.extendAliases({"dd/mm/yyyy":{mask:"1/2/y",placeholder:"dd/mm/yyyy",regex:{val1pre:new RegExp("[0-3]"),val1:new RegExp("0[1-9]|[12][0-9]|3[01]"),val2pre:function(a){var c=b.escapeRegex.call(this,a);return new RegExp("((0[1-9]|[12][0-9]|3[01])"+c+"[01])")},val2:function(a){var c=b.escapeRegex.call(this,a);return new RegExp("((0[1-9]|[12][0-9])"+c+"(0[1-9]|1[012]))|(30"+c+"(0[13-9]|1[012]))|(31"+c+"(0[13578]|1[02]))")}},leapday:"29/02/",separator:"/",yearrange:{minyear:1900,maxyear:2099},isInYearRange:function(a,b,c){if(isNaN(a))return!1;var d=parseInt(a.concat(b.toString().slice(a.length))),e=parseInt(a.concat(c.toString().slice(a.length)));return!isNaN(d)&&(b<=d&&d<=c)||!isNaN(e)&&(b<=e&&e<=c)},determinebaseyear:function(a,b,c){var d=(new Date).getFullYear();if(a>d)return a;if(b<d){for(var e=b.toString().slice(0,2),f=b.toString().slice(2,4);b<e+c;)e--;var g=e+f;return a>g?a:g}if(a<=d&&d<=b){for(var h=d.toString().slice(0,2);b<h+c;)h--;var i=h+c;return i<a?a:i}return d},onKeyDown:function(c,d,e,f){var g=a(this);if(c.ctrlKey&&c.keyCode===b.keyCode.RIGHT){var h=new Date;g.val(h.getDate().toString()+(h.getMonth()+1).toString()+h.getFullYear().toString()),g.trigger("setvalue")}},getFrontValue:function(a,b,c){for(var d=0,e=0,f=0;f<a.length&&"2"!==a.charAt(f);f++){var g=c.definitions[a.charAt(f)];g?(d+=e,e=g.cardinality):e++}return b.join("").substr(d,e)},postValidation:function(a,b,d){var e,f,g=a.join("");return 0===d.mask.indexOf("y")?(f=g.substr(0,4),e=g.substring(4,10)):(f=g.substring(6,10),e=g.substr(0,6)),b&&(e!==d.leapday||c(f))},definitions:{1:{validator:function(a,b,c,d,e){var f=e.regex.val1.test(a);return d||f||a.charAt(1)!==e.separator&&-1==="-./".indexOf(a.charAt(1))||!(f=e.regex.val1.test("0"+a.charAt(0)))?f:(b.buffer[c-1]="0",{refreshFromBuffer:{start:c-1,end:c},pos:c,c:a.charAt(0)})},cardinality:2,prevalidator:[{validator:function(a,b,c,d,e){var f=a;isNaN(b.buffer[c+1])||(f+=b.buffer[c+1]);var g=1===f.length?e.regex.val1pre.test(f):e.regex.val1.test(f);if(!d&&!g){if(g=e.regex.val1.test(a+"0"))return b.buffer[c]=a,b.buffer[++c]="0",{pos:c,c:"0"};if(g=e.regex.val1.test("0"+a))return b.buffer[c]="0",c++,{pos:c}}return g},cardinality:1}]},2:{validator:function(a,b,c,d,e){var f=e.getFrontValue(b.mask,b.buffer,e);-1!==f.indexOf(e.placeholder[0])&&(f="01"+e.separator);var g=e.regex.val2(e.separator).test(f+a);return d||g||a.charAt(1)!==e.separator&&-1==="-./".indexOf(a.charAt(1))||!(g=e.regex.val2(e.separator).test(f+"0"+a.charAt(0)))?g:(b.buffer[c-1]="0",{refreshFromBuffer:{start:c-1,end:c},pos:c,c:a.charAt(0)})},cardinality:2,prevalidator:[{validator:function(a,b,c,d,e){isNaN(b.buffer[c+1])||(a+=b.buffer[c+1]);var f=e.getFrontValue(b.mask,b.buffer,e);-1!==f.indexOf(e.placeholder[0])&&(f="01"+e.separator);var g=1===a.length?e.regex.val2pre(e.separator).test(f+a):e.regex.val2(e.separator).test(f+a);return d||g||!(g=e.regex.val2(e.separator).test(f+"0"+a))?g:(b.buffer[c]="0",c++,{pos:c})},cardinality:1}]},y:{validator:function(a,b,c,d,e){return e.isInYearRange(a,e.yearrange.minyear,e.yearrange.maxyear)},cardinality:4,prevalidator:[{validator:function(a,b,c,d,e){var f=e.isInYearRange(a,e.yearrange.minyear,e.yearrange.maxyear);if(!d&&!f){var g=e.determinebaseyear(e.yearrange.minyear,e.yearrange.maxyear,a+"0").toString().slice(0,1);if(f=e.isInYearRange(g+a,e.yearrange.minyear,e.yearrange.maxyear))return b.buffer[c++]=g.charAt(0),{pos:c};if(g=e.determinebaseyear(e.yearrange.minyear,e.yearrange.maxyear,a+"0").toString().slice(0,2),f=e.isInYearRange(g+a,e.yearrange.minyear,e.yearrange.maxyear))return b.buffer[c++]=g.charAt(0),b.buffer[c++]=g.charAt(1),{pos:c}}return f},cardinality:1},{validator:function(a,b,c,d,e){var f=e.isInYearRange(a,e.yearrange.minyear,e.yearrange.maxyear);if(!d&&!f){var g=e.determinebaseyear(e.yearrange.minyear,e.yearrange.maxyear,a).toString().slice(0,2);if(f=e.isInYearRange(a[0]+g[1]+a[1],e.yearrange.minyear,e.yearrange.maxyear))return b.buffer[c++]=g.charAt(1),{pos:c};if(g=e.determinebaseyear(e.yearrange.minyear,e.yearrange.maxyear,a).toString().slice(0,2),f=e.isInYearRange(g+a,e.yearrange.minyear,e.yearrange.maxyear))return b.buffer[c-1]=g.charAt(0),b.buffer[c++]=g.charAt(1),b.buffer[c++]=a.charAt(0),{refreshFromBuffer:{start:c-3,end:c},pos:c}}return f},cardinality:2},{validator:function(a,b,c,d,e){return e.isInYearRange(a,e.yearrange.minyear,e.yearrange.maxyear)},cardinality:3}]}},insertMode:!1,autoUnmask:!1},"mm/dd/yyyy":{placeholder:"mm/dd/yyyy",alias:"dd/mm/yyyy",regex:{val2pre:function(a){var c=b.escapeRegex.call(this,a);return new RegExp("((0[13-9]|1[012])"+c+"[0-3])|(02"+c+"[0-2])")},val2:function(a){var c=b.escapeRegex.call(this,a);return new RegExp("((0[1-9]|1[012])"+c+"(0[1-9]|[12][0-9]))|((0[13-9]|1[012])"+c+"30)|((0[13578]|1[02])"+c+"31)")},val1pre:new RegExp("[01]"),val1:new RegExp("0[1-9]|1[012]")},leapday:"02/29/",onKeyDown:function(c,d,e,f){var g=a(this);if(c.ctrlKey&&c.keyCode===b.keyCode.RIGHT){var h=new Date;g.val((h.getMonth()+1).toString()+h.getDate().toString()+h.getFullYear().toString()),g.trigger("setvalue")}}},"yyyy/mm/dd":{mask:"y/1/2",placeholder:"yyyy/mm/dd",alias:"mm/dd/yyyy",leapday:"/02/29",onKeyDown:function(c,d,e,f){var g=a(this);if(c.ctrlKey&&c.keyCode===b.keyCode.RIGHT){var h=new Date;g.val(h.getFullYear().toString()+(h.getMonth()+1).toString()+h.getDate().toString()),g.trigger("setvalue")}}},"dd.mm.yyyy":{mask:"1.2.y",placeholder:"dd.mm.yyyy",leapday:"29.02.",separator:".",alias:"dd/mm/yyyy"},"dd-mm-yyyy":{mask:"1-2-y",placeholder:"dd-mm-yyyy",leapday:"29-02-",separator:"-",alias:"dd/mm/yyyy"},"mm.dd.yyyy":{mask:"1.2.y",placeholder:"mm.dd.yyyy",leapday:"02.29.",separator:".",alias:"mm/dd/yyyy"},"mm-dd-yyyy":{mask:"1-2-y",placeholder:"mm-dd-yyyy",leapday:"02-29-",separator:"-",alias:"mm/dd/yyyy"},"yyyy.mm.dd":{mask:"y.1.2",placeholder:"yyyy.mm.dd",leapday:".02.29",separator:".",alias:"yyyy/mm/dd"},"yyyy-mm-dd":{mask:"y-1-2",placeholder:"yyyy-mm-dd",leapday:"-02-29",separator:"-",alias:"yyyy/mm/dd"},datetime:{mask:"1/2/y h:s",placeholder:"dd/mm/yyyy hh:mm",alias:"dd/mm/yyyy",regex:{hrspre:new RegExp("[012]"),hrs24:new RegExp("2[0-4]|1[3-9]"),hrs:new RegExp("[01][0-9]|2[0-4]"),ampm:new RegExp("^[a|p|A|P][m|M]"),mspre:new RegExp("[0-5]"),ms:new RegExp("[0-5][0-9]")},timeseparator:":",hourFormat:"24",definitions:{h:{validator:function(a,b,c,d,e){if("24"===e.hourFormat&&24===parseInt(a,10))return b.buffer[c-1]="0",b.buffer[c]="0",{refreshFromBuffer:{start:c-1,end:c},c:"0"};var f=e.regex.hrs.test(a);if(!d&&!f&&(a.charAt(1)===e.timeseparator||-1!=="-.:".indexOf(a.charAt(1)))&&(f=e.regex.hrs.test("0"+a.charAt(0))))return b.buffer[c-1]="0",b.buffer[c]=a.charAt(0),c++,{refreshFromBuffer:{start:c-2,end:c},pos:c,c:e.timeseparator};if(f&&"24"!==e.hourFormat&&e.regex.hrs24.test(a)){var g=parseInt(a,10);return 24===g?(b.buffer[c+5]="a",b.buffer[c+6]="m"):(b.buffer[c+5]="p",b.buffer[c+6]="m"),g-=12,g<10?(b.buffer[c]=g.toString(),b.buffer[c-1]="0"):(b.buffer[c]=g.toString().charAt(1),b.buffer[c-1]=g.toString().charAt(0)),{refreshFromBuffer:{start:c-1,end:c+6},c:b.buffer[c]}}return f},cardinality:2,prevalidator:[{validator:function(a,b,c,d,e){var f=e.regex.hrspre.test(a);return d||f||!(f=e.regex.hrs.test("0"+a))?f:(b.buffer[c]="0",c++,{pos:c})},cardinality:1}]},s:{validator:"[0-5][0-9]",cardinality:2,prevalidator:[{validator:function(a,b,c,d,e){var f=e.regex.mspre.test(a);return d||f||!(f=e.regex.ms.test("0"+a))?f:(b.buffer[c]="0",c++,{pos:c})},cardinality:1}]},t:{validator:function(a,b,c,d,e){return e.regex.ampm.test(a+"m")},casing:"lower",cardinality:1}},insertMode:!1,autoUnmask:!1},datetime12:{mask:"1/2/y h:s t\\m",placeholder:"dd/mm/yyyy hh:mm xm",alias:"datetime",hourFormat:"12"},"mm/dd/yyyy hh:mm xm":{mask:"1/2/y h:s t\\m",placeholder:"mm/dd/yyyy hh:mm xm",alias:"datetime12",regex:{val2pre:function(a){var c=b.escapeRegex.call(this,a);return new RegExp("((0[13-9]|1[012])"+c+"[0-3])|(02"+c+"[0-2])")},val2:function(a){var c=b.escapeRegex.call(this,a);return new RegExp("((0[1-9]|1[012])"+c+"(0[1-9]|[12][0-9]))|((0[13-9]|1[012])"+c+"30)|((0[13578]|1[02])"+c+"31)")},val1pre:new RegExp("[01]"),val1:new RegExp("0[1-9]|1[012]")},leapday:"02/29/",onKeyDown:function(c,d,e,f){var g=a(this);if(c.ctrlKey&&c.keyCode===b.keyCode.RIGHT){var h=new Date;g.val((h.getMonth()+1).toString()+h.getDate().toString()+h.getFullYear().toString()),g.trigger("setvalue")}}},"hh:mm t":{mask:"h:s t\\m",placeholder:"hh:mm xm",alias:"datetime",hourFormat:"12"},"h:s t":{mask:"h:s t\\m",placeholder:"hh:mm xm",alias:"datetime",hourFormat:"12"},"hh:mm:ss":{mask:"h:s:s",placeholder:"hh:mm:ss",alias:"datetime",autoUnmask:!1},"hh:mm":{mask:"h:s",placeholder:"hh:mm",alias:"datetime",autoUnmask:!1},date:{alias:"dd/mm/yyyy"},"mm/yyyy":{mask:"1/y",placeholder:"mm/yyyy",leapday:"donotuse",separator:"/",alias:"mm/dd/yyyy"},shamsi:{regex:{val2pre:function(a){var c=b.escapeRegex.call(this,a);return new RegExp("((0[1-9]|1[012])"+c+"[0-3])")},val2:function(a){var c=b.escapeRegex.call(this,a);return new RegExp("((0[1-9]|1[012])"+c+"(0[1-9]|[12][0-9]))|((0[1-9]|1[012])"+c+"30)|((0[1-6])"+c+"31)")},val1pre:new RegExp("[01]"),val1:new RegExp("0[1-9]|1[012]")},yearrange:{minyear:1300,maxyear:1499},mask:"y/1/2",leapday:"/12/30",placeholder:"yyyy/mm/dd",alias:"mm/dd/yyyy",clearIncomplete:!0},"yyyy-mm-dd hh:mm:ss":{mask:"y-1-2 h:s:s",placeholder:"yyyy-mm-dd hh:mm:ss",alias:"datetime",separator:"-",leapday:"-02-29",regex:{val2pre:function(a){var c=b.escapeRegex.call(this,a);return new RegExp("((0[13-9]|1[012])"+c+"[0-3])|(02"+c+"[0-2])")},val2:function(a){var c=b.escapeRegex.call(this,a);return new RegExp("((0[1-9]|1[012])"+c+"(0[1-9]|[12][0-9]))|((0[13-9]|1[012])"+c+"30)|((0[13578]|1[02])"+c+"31)")},val1pre:new RegExp("[01]"),val1:new RegExp("0[1-9]|1[012]")},onKeyDown:function(a,b,c,d){}}}),b})},function(a,b,c){"use strict";var d,e,f;"function"==typeof Symbol&&Symbol.iterator;!function(g){e=[c(0),c(1)],d=g,void 0!==(f="function"==typeof d?d.apply(b,e):d)&&(a.exports=f)}(function(a,b){return b.extendDefinitions({A:{validator:"[A-Za-z\u0410-\u044f\u0401\u0451\xc0-\xff\xb5]",cardinality:1,casing:"upper"},"&":{validator:"[0-9A-Za-z\u0410-\u044f\u0401\u0451\xc0-\xff\xb5]",cardinality:1,casing:"upper"},"#":{validator:"[0-9A-Fa-f]",cardinality:1,casing:"upper"}}),b.extendAliases({url:{definitions:{i:{validator:".",cardinality:1}},mask:"(\\http://)|(\\http\\s://)|(ftp://)|(ftp\\s://)i{+}",insertMode:!1,autoUnmask:!1,inputmode:"url"},ip:{mask:"i[i[i]].i[i[i]].i[i[i]].i[i[i]]",definitions:{i:{validator:function(a,b,c,d,e){return c-1>-1&&"."!==b.buffer[c-1]?(a=b.buffer[c-1]+a,a=c-2>-1&&"."!==b.buffer[c-2]?b.buffer[c-2]+a:"0"+a):a="00"+a,new RegExp("25[0-5]|2[0-4][0-9]|[01][0-9][0-9]").test(a)},cardinality:1}},onUnMask:function(a,b,c){return a},inputmode:"numeric"},email:{mask:"*{1,64}[.*{1,64}][.*{1,64}][.*{1,63}]@-{1,63}.-{1,63}[.-{1,63}][.-{1,63}]",greedy:!1,onBeforePaste:function(a,b){return a=a.toLowerCase(),a.replace("mailto:","")},definitions:{"*":{validator:"[0-9A-Za-z!#$%&'*+/=?^_`{|}~-]",cardinality:1,casing:"lower"},"-":{validator:"[0-9A-Za-z-]",cardinality:1,casing:"lower"}},onUnMask:function(a,b,c){return a},inputmode:"email"},mac:{mask:"##:##:##:##:##:##"},vin:{mask:"V{13}9{4}",definitions:{V:{validator:"[A-HJ-NPR-Za-hj-npr-z\\d]",cardinality:1,casing:"upper"}},clearIncomplete:!0,autoUnmask:!0}}),b})},function(a,b,c){"use strict";var d,e,f;"function"==typeof Symbol&&Symbol.iterator;!function(g){e=[c(0),c(1)],d=g,void 0!==(f="function"==typeof d?d.apply(b,e):d)&&(a.exports=f)}(function(a,b,c){function d(a,c){
for(var d="",e=0;e<a.length;e++)b.prototype.definitions[a.charAt(e)]||c.definitions[a.charAt(e)]||c.optionalmarker.start===a.charAt(e)||c.optionalmarker.end===a.charAt(e)||c.quantifiermarker.start===a.charAt(e)||c.quantifiermarker.end===a.charAt(e)||c.groupmarker.start===a.charAt(e)||c.groupmarker.end===a.charAt(e)||c.alternatormarker===a.charAt(e)?d+="\\"+a.charAt(e):d+=a.charAt(e);return d}return b.extendAliases({numeric:{mask:function(a){if(0!==a.repeat&&isNaN(a.integerDigits)&&(a.integerDigits=a.repeat),a.repeat=0,a.groupSeparator===a.radixPoint&&("."===a.radixPoint?a.groupSeparator=",":","===a.radixPoint?a.groupSeparator=".":a.groupSeparator="")," "===a.groupSeparator&&(a.skipOptionalPartCharacter=c),a.autoGroup=a.autoGroup&&""!==a.groupSeparator,a.autoGroup&&("string"==typeof a.groupSize&&isFinite(a.groupSize)&&(a.groupSize=parseInt(a.groupSize)),isFinite(a.integerDigits))){var b=Math.floor(a.integerDigits/a.groupSize),e=a.integerDigits%a.groupSize;a.integerDigits=parseInt(a.integerDigits)+(0===e?b-1:b),a.integerDigits<1&&(a.integerDigits="*")}a.placeholder.length>1&&(a.placeholder=a.placeholder.charAt(0)),"radixFocus"===a.positionCaretOnClick&&""===a.placeholder&&!1===a.integerOptional&&(a.positionCaretOnClick="lvp"),a.definitions[";"]=a.definitions["~"],a.definitions[";"].definitionSymbol="~",!0===a.numericInput&&(a.positionCaretOnClick="radixFocus"===a.positionCaretOnClick?"lvp":a.positionCaretOnClick,a.digitsOptional=!1,isNaN(a.digits)&&(a.digits=2),a.decimalProtect=!1);var f="[+]";if(f+=d(a.prefix,a),!0===a.integerOptional?f+="~{1,"+a.integerDigits+"}":f+="~{"+a.integerDigits+"}",a.digits!==c){a.radixPointDefinitionSymbol=a.decimalProtect?":":a.radixPoint;var g=a.digits.toString().split(",");isFinite(g[0]&&g[1]&&isFinite(g[1]))?f+=a.radixPointDefinitionSymbol+";{"+a.digits+"}":(isNaN(a.digits)||parseInt(a.digits)>0)&&(a.digitsOptional?f+="["+a.radixPointDefinitionSymbol+";{1,"+a.digits+"}]":f+=a.radixPointDefinitionSymbol+";{"+a.digits+"}")}return f+=d(a.suffix,a),f+="[-]",a.greedy=!1,f},placeholder:"",greedy:!1,digits:"*",digitsOptional:!0,enforceDigitsOnBlur:!1,radixPoint:".",positionCaretOnClick:"radixFocus",groupSize:3,groupSeparator:"",autoGroup:!1,allowMinus:!0,negationSymbol:{front:"-",back:""},integerDigits:"+",integerOptional:!0,prefix:"",suffix:"",rightAlign:!0,decimalProtect:!0,min:null,max:null,step:1,insertMode:!0,autoUnmask:!1,unmaskAsNumber:!1,inputmode:"numeric",preValidation:function(b,d,e,f,g){if("-"===e||e==g.negationSymbol.front)return!0===g.allowMinus&&(g.isNegative=g.isNegative===c||!g.isNegative,""===b.join("")||{caret:d,dopost:!0});if(!1===f&&e===g.radixPoint&&g.digits!==c&&(isNaN(g.digits)||parseInt(g.digits)>0)){var h=a.inArray(g.radixPoint,b);if(-1!==h)return!0===g.numericInput?d===h:{caret:h+1}}return!0},postValidation:function(d,e,f){var g=f.suffix.split(""),h=f.prefix.split("");if(e.pos==c&&e.caret!==c&&!0!==e.dopost)return e;var i=e.caret!=c?e.caret:e.pos,j=d.slice();f.numericInput&&(i=j.length-i-1,j=j.reverse());var k=j[i];if(k===f.groupSeparator&&(i+=1,k=j[i]),i==j.length-f.suffix.length-1&&k===f.radixPoint)return e;k!==c&&k!==f.radixPoint&&k!==f.negationSymbol.front&&k!==f.negationSymbol.back&&(j[i]="?",f.prefix.length>0&&i>=(!1===f.isNegative?1:0)&&i<f.prefix.length-1+(!1===f.isNegative?1:0)?h[i-(!1===f.isNegative?1:0)]="?":f.suffix.length>0&&i>=j.length-f.suffix.length-(!1===f.isNegative?1:0)&&(g[i-(j.length-f.suffix.length-(!1===f.isNegative?1:0))]="?")),h=h.join(""),g=g.join("");var l=j.join("").replace(h,"");if(l=l.replace(g,""),l=l.replace(new RegExp(b.escapeRegex(f.groupSeparator),"g"),""),l=l.replace(new RegExp("[-"+b.escapeRegex(f.negationSymbol.front)+"]","g"),""),l=l.replace(new RegExp(b.escapeRegex(f.negationSymbol.back)+"$"),""),isNaN(f.placeholder)&&(l=l.replace(new RegExp(b.escapeRegex(f.placeholder),"g"),"")),l.length>1&&1!==l.indexOf(f.radixPoint)&&("0"==k&&(l=l.replace(/^\?/g,"")),l=l.replace(/^0/g,"")),l.charAt(0)===f.radixPoint&&""!==f.radixPoint&&!0!==f.numericInput&&(l="0"+l),""!==l){if(l=l.split(""),(!f.digitsOptional||f.enforceDigitsOnBlur&&"blur"===e.event)&&isFinite(f.digits)){var m=a.inArray(f.radixPoint,l),n=a.inArray(f.radixPoint,j);-1===m&&(l.push(f.radixPoint),m=l.length-1);for(var o=1;o<=f.digits;o++)f.digitsOptional&&(!f.enforceDigitsOnBlur||"blur"!==e.event)||l[m+o]!==c&&l[m+o]!==f.placeholder.charAt(0)?-1!==n&&j[n+o]!==c&&(l[m+o]=l[m+o]||j[n+o]):l[m+o]=e.placeholder||f.placeholder.charAt(0)}!0!==f.autoGroup||""===f.groupSeparator||k===f.radixPoint&&e.pos===c&&!e.dopost?l=l.join(""):(l=b(function(a,b){var c="";if(c+="("+b.groupSeparator+"*{"+b.groupSize+"}){*}",""!==b.radixPoint){var d=a.join("").split(b.radixPoint);d[1]&&(c+=b.radixPoint+"*{"+d[1].match(/^\d*\??\d*/)[0].length+"}")}return c}(l,f),{numericInput:!0,jitMasking:!0,definitions:{"*":{validator:"[0-9?]",cardinality:1}}}).format(l.join("")),l.charAt(0)===f.groupSeparator&&l.substr(1))}if(f.isNegative&&"blur"===e.event&&(f.isNegative="0"!==l),l=h+l,l+=g,f.isNegative&&(l=f.negationSymbol.front+l,l+=f.negationSymbol.back),l=l.split(""),k!==c)if(k!==f.radixPoint&&k!==f.negationSymbol.front&&k!==f.negationSymbol.back)i=a.inArray("?",l),i>-1?l[i]=k:i=e.caret||0;else if(k===f.radixPoint||k===f.negationSymbol.front||k===f.negationSymbol.back){var p=a.inArray(k,l);-1!==p&&(i=p)}f.numericInput&&(i=l.length-i-1,l=l.reverse());var q={caret:k===c||e.pos!==c?i+(f.numericInput?-1:1):i,buffer:l,refreshFromBuffer:e.dopost||d.join("")!==l.join("")};return q.refreshFromBuffer?q:e},onBeforeWrite:function(d,e,f,g){if(d)switch(d.type){case"keydown":return g.postValidation(e,{caret:f,dopost:!0},g);case"blur":case"checkval":var h;if(function(a){a.parseMinMaxOptions===c&&(null!==a.min&&(a.min=a.min.toString().replace(new RegExp(b.escapeRegex(a.groupSeparator),"g"),""),","===a.radixPoint&&(a.min=a.min.replace(a.radixPoint,".")),a.min=isFinite(a.min)?parseFloat(a.min):NaN,isNaN(a.min)&&(a.min=Number.MIN_VALUE)),null!==a.max&&(a.max=a.max.toString().replace(new RegExp(b.escapeRegex(a.groupSeparator),"g"),""),","===a.radixPoint&&(a.max=a.max.replace(a.radixPoint,".")),a.max=isFinite(a.max)?parseFloat(a.max):NaN,isNaN(a.max)&&(a.max=Number.MAX_VALUE)),a.parseMinMaxOptions="done")}(g),null!==g.min||null!==g.max){if(h=g.onUnMask(e.join(""),c,a.extend({},g,{unmaskAsNumber:!0})),null!==g.min&&h<g.min)return g.isNegative=g.min<0,g.postValidation(g.min.toString().replace(".",g.radixPoint).split(""),{caret:f,dopost:!0,placeholder:"0"},g);if(null!==g.max&&h>g.max)return g.isNegative=g.max<0,g.postValidation(g.max.toString().replace(".",g.radixPoint).split(""),{caret:f,dopost:!0,placeholder:"0"},g)}return g.postValidation(e,{caret:f,dopost:!0,placeholder:"0",event:"blur"},g);case"_checkval":return{caret:f}}},regex:{integerPart:function(a,c){return c?new RegExp("["+b.escapeRegex(a.negationSymbol.front)+"+]?"):new RegExp("["+b.escapeRegex(a.negationSymbol.front)+"+]?\\d+")},integerNPart:function(a){return new RegExp("[\\d"+b.escapeRegex(a.groupSeparator)+b.escapeRegex(a.placeholder.charAt(0))+"]+")}},definitions:{"~":{validator:function(a,d,e,f,g,h){var i=f?new RegExp("[0-9"+b.escapeRegex(g.groupSeparator)+"]").test(a):new RegExp("[0-9]").test(a);if(!0===i){if(!0!==g.numericInput&&d.validPositions[e]!==c&&"~"===d.validPositions[e].match.def&&!h){var j=d.buffer.join("");j=j.replace(new RegExp("[-"+b.escapeRegex(g.negationSymbol.front)+"]","g"),""),j=j.replace(new RegExp(b.escapeRegex(g.negationSymbol.back)+"$"),"");var k=j.split(g.radixPoint);k.length>1&&(k[1]=k[1].replace(/0/g,g.placeholder.charAt(0))),"0"===k[0]&&(k[0]=k[0].replace(/0/g,g.placeholder.charAt(0))),j=k[0]+g.radixPoint+k[1]||"";var l=d._buffer.join("");for(j===g.radixPoint&&(j=l);null===j.match(b.escapeRegex(l)+"$");)l=l.slice(1);j=j.replace(l,""),j=j.split(""),i=j[e]===c?{pos:e,remove:e}:{pos:e}}}else f||a!==g.radixPoint||d.validPositions[e-1]!==c||(d.buffer[e]="0",i={pos:e+1});return i},cardinality:1},"+":{validator:function(a,b,c,d,e){return e.allowMinus&&("-"===a||a===e.negationSymbol.front)},cardinality:1,placeholder:""},"-":{validator:function(a,b,c,d,e){return e.allowMinus&&a===e.negationSymbol.back},cardinality:1,placeholder:""},":":{validator:function(a,c,d,e,f){var g="["+b.escapeRegex(f.radixPoint)+"]",h=new RegExp(g).test(a);return h&&c.validPositions[d]&&c.validPositions[d].match.placeholder===f.radixPoint&&(h={caret:d+1}),h},cardinality:1,placeholder:function(a){return a.radixPoint}}},onUnMask:function(a,c,d){if(""===c&&!0===d.nullable)return c;var e=a.replace(d.prefix,"");return e=e.replace(d.suffix,""),e=e.replace(new RegExp(b.escapeRegex(d.groupSeparator),"g"),""),""!==d.placeholder.charAt(0)&&(e=e.replace(new RegExp(d.placeholder.charAt(0),"g"),"0")),d.unmaskAsNumber?(""!==d.radixPoint&&-1!==e.indexOf(d.radixPoint)&&(e=e.replace(b.escapeRegex.call(this,d.radixPoint),".")),e=e.replace(new RegExp("^"+b.escapeRegex(d.negationSymbol.front)),"-"),e=e.replace(new RegExp(b.escapeRegex(d.negationSymbol.back)+"$"),""),Number(e)):e},isComplete:function(a,c){var d=a.join("");if(a.slice().join("")!==d)return!1;var e=d.replace(c.prefix,"");return e=e.replace(c.suffix,""),e=e.replace(new RegExp(b.escapeRegex(c.groupSeparator),"g"),""),","===c.radixPoint&&(e=e.replace(b.escapeRegex(c.radixPoint),".")),isFinite(e)},onBeforeMask:function(a,d){if(d.isNegative=c,a=a.toString().charAt(a.length-1)===d.radixPoint?a.toString().substr(0,a.length-1):a.toString(),""!==d.radixPoint&&isFinite(a)){var e=a.split("."),f=""!==d.groupSeparator?parseInt(d.groupSize):0;2===e.length&&(e[0].length>f||e[1].length>f||e[0].length<=f&&e[1].length<f)&&(a=a.replace(".",d.radixPoint))}var g=a.match(/,/g),h=a.match(/\./g);if(h&&g?h.length>g.length?(a=a.replace(/\./g,""),a=a.replace(",",d.radixPoint)):g.length>h.length?(a=a.replace(/,/g,""),a=a.replace(".",d.radixPoint)):a=a.indexOf(".")<a.indexOf(",")?a.replace(/\./g,""):a=a.replace(/,/g,""):a=a.replace(new RegExp(b.escapeRegex(d.groupSeparator),"g"),""),0===d.digits&&(-1!==a.indexOf(".")?a=a.substring(0,a.indexOf(".")):-1!==a.indexOf(",")&&(a=a.substring(0,a.indexOf(",")))),""!==d.radixPoint&&isFinite(d.digits)&&-1!==a.indexOf(d.radixPoint)){var i=a.split(d.radixPoint),j=i[1].match(new RegExp("\\d*"))[0];if(parseInt(d.digits)<j.toString().length){var k=Math.pow(10,parseInt(d.digits));a=a.replace(b.escapeRegex(d.radixPoint),"."),a=Math.round(parseFloat(a)*k)/k,a=a.toString().replace(".",d.radixPoint)}}return a},canClearPosition:function(a,b,c,d,e){var f=a.validPositions[b],g=f.input!==e.radixPoint||null!==a.validPositions[b].match.fn&&!1===e.decimalProtect||f.input===e.radixPoint&&a.validPositions[b+1]&&null===a.validPositions[b+1].match.fn||isFinite(f.input)||b===c||f.input===e.groupSeparator||f.input===e.negationSymbol.front||f.input===e.negationSymbol.back;return!g||"+"!=f.match.nativeDef&&"-"!=f.match.nativeDef||(e.isNegative=!1),g},onKeyDown:function(c,d,e,f){var g=a(this);if(c.ctrlKey)switch(c.keyCode){case b.keyCode.UP:g.val(parseFloat(this.inputmask.unmaskedvalue())+parseInt(f.step)),g.trigger("setvalue");break;case b.keyCode.DOWN:g.val(parseFloat(this.inputmask.unmaskedvalue())-parseInt(f.step)),g.trigger("setvalue")}}},currency:{prefix:"$ ",groupSeparator:",",alias:"numeric",placeholder:"0",autoGroup:!0,digits:2,digitsOptional:!1,clearMaskOnLostFocus:!1},decimal:{alias:"numeric"},integer:{alias:"numeric",digits:0,radixPoint:""},percentage:{alias:"numeric",digits:2,digitsOptional:!0,radixPoint:".",placeholder:"0",autoGroup:!1,min:0,max:100,suffix:" %",allowMinus:!1}}),b})},function(a,b,c){"use strict";var d,e,f;"function"==typeof Symbol&&Symbol.iterator;!function(g){e=[c(0),c(1)],d=g,void 0!==(f="function"==typeof d?d.apply(b,e):d)&&(a.exports=f)}(function(a,b){function c(a,b){var c=(a.mask||a).replace(/#/g,"9").replace(/\)/,"9").replace(/[+()#-]/g,""),d=(b.mask||b).replace(/#/g,"9").replace(/\)/,"9").replace(/[+()#-]/g,""),e=(a.mask||a).split("#")[0],f=(b.mask||b).split("#")[0];return 0===f.indexOf(e)?-1:0===e.indexOf(f)?1:c.localeCompare(d)}var d=b.prototype.analyseMask;return b.prototype.analyseMask=function(b,c,e){function f(a,c,d){c=c||"",d=d||h,""!==c&&(d[c]={});for(var e="",g=d[c]||d,i=a.length-1;i>=0;i--)b=a[i].mask||a[i],e=b.substr(0,1),g[e]=g[e]||[],g[e].unshift(b.substr(1)),a.splice(i,1);for(var j in g)g[j].length>500&&f(g[j].slice(),j,g)}function g(b){var c="",d=[];for(var f in b)a.isArray(b[f])?1===b[f].length?d.push(f+b[f]):d.push(f+e.groupmarker.start+b[f].join(e.groupmarker.end+e.alternatormarker+e.groupmarker.start)+e.groupmarker.end):d.push(f+g(b[f]));return 1===d.length?c+=d[0]:c+=e.groupmarker.start+d.join(e.groupmarker.end+e.alternatormarker+e.groupmarker.start)+e.groupmarker.end,c}var h={};return e.phoneCodes&&(e.phoneCodes&&e.phoneCodes.length>1e3&&(b=b.substr(1,b.length-2),f(b.split(e.groupmarker.end+e.alternatormarker+e.groupmarker.start)),b=g(h)),b=b.replace(/9/g,"\\9")),d.call(this,b,c,e)},b.extendAliases({abstractphone:{groupmarker:{start:"<",end:">"},countrycode:"",phoneCodes:[],mask:function(a){return a.definitions={"#":b.prototype.definitions[9]},a.phoneCodes.sort(c)},keepStatic:!0,onBeforeMask:function(a,b){var c=a.replace(/^0{1,2}/,"").replace(/[\s]/g,"");return(c.indexOf(b.countrycode)>1||-1===c.indexOf(b.countrycode))&&(c="+"+b.countrycode+c),c},onUnMask:function(a,b,c){return a.replace(/[()#-]/g,"")},inputmode:"tel"}}),b})},function(a,b,c){"use strict";var d,e,f;"function"==typeof Symbol&&Symbol.iterator;!function(g){e=[c(0),c(1)],d=g,void 0!==(f="function"==typeof d?d.apply(b,e):d)&&(a.exports=f)}(function(a,b){return b.extendAliases({Regex:{mask:"r",greedy:!1,repeat:"*",regex:null,regexTokens:null,tokenizer:/\[\^?]?(?:[^\\\]]+|\\[\S\s]?)*]?|\\(?:0(?:[0-3][0-7]{0,2}|[4-7][0-7]?)?|[1-9][0-9]*|x[0-9A-Fa-f]{2}|u[0-9A-Fa-f]{4}|c[A-Za-z]|[\S\s]?)|\((?:\?[:=!]?)?|(?:[?*+]|\{[0-9]+(?:,[0-9]*)?\})\??|[^.?*+^${[()|\\]+|./g,quantifierFilter:/[0-9]+[^,]/,isComplete:function(a,b){return new RegExp(b.regex,b.casing?"i":"").test(a.join(""))},definitions:{r:{validator:function(b,c,d,e,f){function g(a,b){this.matches=[],this.isGroup=a||!1,this.isQuantifier=b||!1,this.quantifier={min:1,max:1},this.repeaterPart=void 0}function h(b,c){var d=!1;c&&(l+="(",n++);for(var e=0;e<b.matches.length;e++){var g=b.matches[e];if(!0===g.isGroup)d=h(g,!0);else if(!0===g.isQuantifier){var j=a.inArray(g,b.matches),k=b.matches[j-1],m=l;if(isNaN(g.quantifier.max)){for(;g.repeaterPart&&g.repeaterPart!==l&&g.repeaterPart.length>l.length&&!(d=h(k,!0)););d=d||h(k,!0),d&&(g.repeaterPart=l),l=m+g.quantifier.max}else{for(var o=0,p=g.quantifier.max-1;o<p&&!(d=h(k,!0));o++);l=m+"{"+g.quantifier.min+","+g.quantifier.max+"}"}}else if(void 0!==g.matches)for(var q=0;q<g.length&&!(d=h(g[q],c));q++);else{var r;if("["==g.charAt(0)){r=l,r+=g;for(var s=0;s<n;s++)r+=")";var t=new RegExp("^("+r+")$",f.casing?"i":"");d=t.test(i)}else for(var u=0,v=g.length;u<v;u++)if("\\"!==g.charAt(u)){r=l,r+=g.substr(0,u+1),r=r.replace(/\|$/,"");for(var s=0;s<n;s++)r+=")";var t=new RegExp("^("+r+")$",f.casing?"i":"");if(d=t.test(i))break}l+=g}if(d)break}return c&&(l+=")",n--),d}var i,j,k=c.buffer.slice(),l="",m=!1,n=0;null===f.regexTokens&&function(){var a,b,c=new g,d=[];for(f.regexTokens=[];a=f.tokenizer.exec(f.regex);)switch(b=a[0],b.charAt(0)){case"(":d.push(new g(!0));break;case")":j=d.pop(),d.length>0?d[d.length-1].matches.push(j):c.matches.push(j);break;case"{":case"+":case"*":var e=new g(!1,!0);b=b.replace(/[{}]/g,"");var h=b.split(","),i=isNaN(h[0])?h[0]:parseInt(h[0]),k=1===h.length?i:isNaN(h[1])?h[1]:parseInt(h[1]);if(e.quantifier={min:i,max:k},d.length>0){var l=d[d.length-1].matches;a=l.pop(),a.isGroup||(j=new g(!0),j.matches.push(a),a=j),l.push(a),l.push(e)}else a=c.matches.pop(),a.isGroup||(j=new g(!0),j.matches.push(a),a=j),c.matches.push(a),c.matches.push(e);break;default:d.length>0?d[d.length-1].matches.push(b):c.matches.push(b)}c.matches.length>0&&f.regexTokens.push(c)}(),k.splice(d,0,b),i=k.join("");for(var o=0;o<f.regexTokens.length;o++){var p=f.regexTokens[o];if(m=h(p,p.isGroup))break}return m},cardinality:1}}}}),b})},function(a,b,c){"use strict";var d,e,f,g="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(a){return typeof a}:function(a){return a&&"function"==typeof Symbol&&a.constructor===Symbol&&a!==Symbol.prototype?"symbol":typeof a};!function(g){e=[c(2),c(1)],d=g,void 0!==(f="function"==typeof d?d.apply(b,e):d)&&(a.exports=f)}(function(a,b){return void 0===a.fn.inputmask&&(a.fn.inputmask=function(c,d){var e,f=this[0];if(void 0===d&&(d={}),"string"==typeof c)switch(c){case"unmaskedvalue":return f&&f.inputmask?f.inputmask.unmaskedvalue():a(f).val();case"remove":return this.each(function(){this.inputmask&&this.inputmask.remove()});case"getemptymask":return f&&f.inputmask?f.inputmask.getemptymask():"";case"hasMaskedValue":return!(!f||!f.inputmask)&&f.inputmask.hasMaskedValue();case"isComplete":return!f||!f.inputmask||f.inputmask.isComplete();case"getmetadata":return f&&f.inputmask?f.inputmask.getmetadata():void 0;case"setvalue":a(f).val(d),f&&void 0===f.inputmask&&a(f).triggerHandler("setvalue");break;case"option":if("string"!=typeof d)return this.each(function(){if(void 0!==this.inputmask)return this.inputmask.option(d)});if(f&&void 0!==f.inputmask)return f.inputmask.option(d);break;default:return d.alias=c,e=new b(d),this.each(function(){e.mask(this)})}else{if("object"==(void 0===c?"undefined":g(c)))return e=new b(c),void 0===c.mask&&void 0===c.alias?this.each(function(){if(void 0!==this.inputmask)return this.inputmask.option(c);e.mask(this)}):this.each(function(){e.mask(this)});if(void 0===c)return this.each(function(){e=new b(d),e.mask(this)})}}),a.fn.inputmask})},function(a,b,c){var d=c(13);"string"==typeof d&&(d=[[a.i,d,""]]);c(15)(d,{});d.locals&&(a.exports=d.locals)},function(a,b,c){"use strict";function d(a){return a&&a.__esModule?a:{default:a}}c(9),c(3),c(4),c(5),c(6),c(7);var e=c(1),f=d(e),g=c(0),h=d(g),i=c(2),j=d(i);h.default===j.default&&c(8),window.Inputmask=f.default},function(a,b,c){"use strict";var d;"function"==typeof Symbol&&Symbol.iterator;void 0!==(d=function(){return document}.call(b,c,b,a))&&(a.exports=d)},function(a,b,c){"use strict";var d;"function"==typeof Symbol&&Symbol.iterator;void 0!==(d=function(){return window}.call(b,c,b,a))&&(a.exports=d)},function(a,b,c){b=a.exports=c(14)(void 0),b.push([a.i,".im-caret {\r\n\t-webkit-animation: 1s blink step-end infinite;\r\n\tanimation: 1s blink step-end infinite;\r\n}\r\n\r\n@keyframes blink {\r\n\tfrom, to {\r\n\t\tborder-right-color: black;\r\n\t}\r\n\t50% {\r\n\t\tborder-right-color: transparent;\r\n\t}\r\n}\r\n\r\n@-webkit-keyframes blink {\r\n\tfrom, to {\r\n\t\tborder-right-color: black;\r\n\t}\r\n\t50% {\r\n\t\tborder-right-color: transparent;\r\n\t}\r\n}\r\n\r\n.im-static {\r\n\tcolor: grey;\r\n}\r\n",""])},function(a,b){function c(a,b){var c=a[1]||"",e=a[3];if(!e)return c;if(b&&"function"==typeof btoa){var f=d(e),g=e.sources.map(function(a){return"/*# sourceURL="+e.sourceRoot+a+" */"});return[c].concat(g).concat([f]).join("\n")}return[c].join("\n")}function d(a){return"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(a))))+" */"}a.exports=function(a){var b=[];return b.toString=function(){return this.map(function(b){var d=c(b,a);return b[2]?"@media "+b[2]+"{"+d+"}":d}).join("")},b.i=function(a,c){"string"==typeof a&&(a=[[null,a,""]]);for(var d={},e=0;e<this.length;e++){var f=this[e][0];"number"==typeof f&&(d[f]=!0)}for(e=0;e<a.length;e++){var g=a[e];"number"==typeof g[0]&&d[g[0]]||(c&&!g[2]?g[2]=c:c&&(g[2]="("+g[2]+") and ("+c+")"),b.push(g))}},b}},function(a,b,c){function d(a,b){for(var c=0;c<a.length;c++){var d=a[c],e=o[d.id];if(e){e.refs++;for(var f=0;f<e.parts.length;f++)e.parts[f](d.parts[f]);for(;f<d.parts.length;f++)e.parts.push(k(d.parts[f],b))}else{for(var g=[],f=0;f<d.parts.length;f++)g.push(k(d.parts[f],b));o[d.id]={id:d.id,refs:1,parts:g}}}}function e(a){for(var b=[],c={},d=0;d<a.length;d++){var e=a[d],f=e[0],g=e[1],h=e[2],i=e[3],j={css:g,media:h,sourceMap:i};c[f]?c[f].parts.push(j):b.push(c[f]={id:f,parts:[j]})}return b}function f(a,b){var c=q(a.insertInto);if(!c)throw new Error("Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid.");var d=t[t.length-1];if("top"===a.insertAt)d?d.nextSibling?c.insertBefore(b,d.nextSibling):c.appendChild(b):c.insertBefore(b,c.firstChild),t.push(b);else{if("bottom"!==a.insertAt)throw new Error("Invalid value for parameter 'insertAt'. Must be 'top' or 'bottom'.");c.appendChild(b)}}function g(a){a.parentNode.removeChild(a);var b=t.indexOf(a);b>=0&&t.splice(b,1)}function h(a){var b=document.createElement("style");return a.attrs.type="text/css",j(b,a.attrs),f(a,b),b}function i(a){var b=document.createElement("link");return a.attrs.type="text/css",a.attrs.rel="stylesheet",j(b,a.attrs),f(a,b),b}function j(a,b){Object.keys(b).forEach(function(c){a.setAttribute(c,b[c])})}function k(a,b){var c,d,e;if(b.singleton){var f=s++;c=r||(r=h(b)),d=l.bind(null,c,f,!1),e=l.bind(null,c,f,!0)}else a.sourceMap&&"function"==typeof URL&&"function"==typeof URL.createObjectURL&&"function"==typeof URL.revokeObjectURL&&"function"==typeof Blob&&"function"==typeof btoa?(c=i(b),d=n.bind(null,c,b),e=function(){g(c),c.href&&URL.revokeObjectURL(c.href)}):(c=h(b),d=m.bind(null,c),e=function(){g(c)});return d(a),function(b){if(b){if(b.css===a.css&&b.media===a.media&&b.sourceMap===a.sourceMap)return;d(a=b)}else e()}}function l(a,b,c,d){var e=c?"":d.css;if(a.styleSheet)a.styleSheet.cssText=v(b,e);else{var f=document.createTextNode(e),g=a.childNodes;g[b]&&a.removeChild(g[b]),g.length?a.insertBefore(f,g[b]):a.appendChild(f)}}function m(a,b){var c=b.css,d=b.media;if(d&&a.setAttribute("media",d),a.styleSheet)a.styleSheet.cssText=c;else{for(;a.firstChild;)a.removeChild(a.firstChild);a.appendChild(document.createTextNode(c))}}function n(a,b,c){var d=c.css,e=c.sourceMap,f=void 0===b.convertToAbsoluteUrls&&e;(b.convertToAbsoluteUrls||f)&&(d=u(d)),e&&(d+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(e))))+" */");var g=new Blob([d],{type:"text/css"}),h=a.href;a.href=URL.createObjectURL(g),h&&URL.revokeObjectURL(h)}var o={},p=function(a){var b;return function(){return void 0===b&&(b=a.apply(this,arguments)),b}}(function(){return window&&document&&document.all&&!window.atob}),q=function(a){var b={};return function(c){return void 0===b[c]&&(b[c]=a.call(this,c)),b[c]}}(function(a){return document.querySelector(a)}),r=null,s=0,t=[],u=c(16);a.exports=function(a,b){if("undefined"!=typeof DEBUG&&DEBUG&&"object"!=typeof document)throw new Error("The style-loader cannot be used in a non-browser environment");b=b||{},b.attrs="object"==typeof b.attrs?b.attrs:{},void 0===b.singleton&&(b.singleton=p()),void 0===b.insertInto&&(b.insertInto="head"),void 0===b.insertAt&&(b.insertAt="bottom");var c=e(a);return d(c,b),function(a){for(var f=[],g=0;g<c.length;g++){var h=c[g],i=o[h.id];i.refs--,f.push(i)}if(a){d(e(a),b)}for(var g=0;g<f.length;g++){var i=f[g];if(0===i.refs){for(var j=0;j<i.parts.length;j++)i.parts[j]();delete o[i.id]}}}};var v=function(){var a=[];return function(b,c){return a[b]=c,a.filter(Boolean).join("\n")}}()},function(a,b){a.exports=function(a){var b="undefined"!=typeof window&&window.location;if(!b)throw new Error("fixUrls requires window.location");if(!a||"string"!=typeof a)return a;var c=b.protocol+"//"+b.host,d=c+b.pathname.replace(/\/[^\/]*$/,"/");return a.replace(/url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi,function(a,b){var e=b.trim().replace(/^"(.*)"$/,function(a,b){return b}).replace(/^'(.*)'$/,function(a,b){return b});if(/^(#|data:|http:\/\/|https:\/\/|file:\/\/\/)/i.test(e))return a;var f;return f=0===e.indexOf("//")?e:0===e.indexOf("/")?c+e:d+e.replace(/^\.\//,""),"url("+JSON.stringify(f)+")"})}}]);/*!
* phone-codes/phone.min.js
* https://github.com/RobinHerbots/Inputmask
* Copyright (c) 2010 - 2017 Robin Herbots
* Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php)
* Version: 3.3.7
*/

!function(a){"function"==typeof define&&define.amd?define(["../inputmask"],a):"object"==typeof exports?module.exports=a(require("../inputmask")):a(window.Inputmask)}(function(a){return a.extendAliases({phone:{alias:"abstractphone",phoneCodes:[{mask:"+247-####",cc:"AC",cd:"Ascension",desc_en:"",name_ru:"\u041e\u0441\u0442\u0440\u043e\u0432 \u0412\u043e\u0437\u043d\u0435\u0441\u0435\u043d\u0438\u044f",desc_ru:""},{mask:"+376-###-###",cc:"AD",cd:"Andorra",desc_en:"",name_ru:"\u0410\u043d\u0434\u043e\u0440\u0440\u0430",desc_ru:""},{mask:"+971-5#-###-####",cc:"AE",cd:"United Arab Emirates",desc_en:"mobile",name_ru:"\u041e\u0431\u044a\u0435\u0434\u0438\u043d\u0435\u043d\u043d\u044b\u0435 \u0410\u0440\u0430\u0431\u0441\u043a\u0438\u0435 \u042d\u043c\u0438\u0440\u0430\u0442\u044b",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+971-#-###-####",cc:"AE",cd:"United Arab Emirates",desc_en:"",name_ru:"\u041e\u0431\u044a\u0435\u0434\u0438\u043d\u0435\u043d\u043d\u044b\u0435 \u0410\u0440\u0430\u0431\u0441\u043a\u0438\u0435 \u042d\u043c\u0438\u0440\u0430\u0442\u044b",desc_ru:""},{mask:"+93-##-###-####",cc:"AF",cd:"Afghanistan",desc_en:"",name_ru:"\u0410\u0444\u0433\u0430\u043d\u0438\u0441\u0442\u0430\u043d",desc_ru:""},{mask:"+1(268)###-####",cc:"AG",cd:"Antigua & Barbuda",desc_en:"",name_ru:"\u0410\u043d\u0442\u0438\u0433\u0443\u0430 \u0438 \u0411\u0430\u0440\u0431\u0443\u0434\u0430",desc_ru:""},{mask:"+1(264)###-####",cc:"AI",cd:"Anguilla",desc_en:"",name_ru:"\u0410\u043d\u0433\u0438\u043b\u044c\u044f",desc_ru:""},{mask:"+355(###)###-###",cc:"AL",cd:"Albania",desc_en:"",name_ru:"\u0410\u043b\u0431\u0430\u043d\u0438\u044f",desc_ru:""},{mask:"+374-##-###-###",cc:"AM",cd:"Armenia",desc_en:"",name_ru:"\u0410\u0440\u043c\u0435\u043d\u0438\u044f",desc_ru:""},{mask:"+599-###-####",cc:"AN",cd:"Caribbean Netherlands",desc_en:"",name_ru:"\u041a\u0430\u0440\u0438\u0431\u0441\u043a\u0438\u0435 \u041d\u0438\u0434\u0435\u0440\u043b\u0430\u043d\u0434\u044b",desc_ru:""},{mask:"+599-###-####",cc:"AN",cd:"Netherlands Antilles",desc_en:"",name_ru:"\u041d\u0438\u0434\u0435\u0440\u043b\u0430\u043d\u0434\u0441\u043a\u0438\u0435 \u0410\u043d\u0442\u0438\u043b\u044c\u0441\u043a\u0438\u0435 \u043e\u0441\u0442\u0440\u043e\u0432\u0430",desc_ru:""},{mask:"+599-9###-####",cc:"AN",cd:"Netherlands Antilles",desc_en:"Curacao",name_ru:"\u041d\u0438\u0434\u0435\u0440\u043b\u0430\u043d\u0434\u0441\u043a\u0438\u0435 \u0410\u043d\u0442\u0438\u043b\u044c\u0441\u043a\u0438\u0435 \u043e\u0441\u0442\u0440\u043e\u0432\u0430",desc_ru:"\u041a\u044e\u0440\u0430\u0441\u0430\u043e"},{mask:"+244(###)###-###",cc:"AO",cd:"Angola",desc_en:"",name_ru:"\u0410\u043d\u0433\u043e\u043b\u0430",desc_ru:""},{mask:"+672-1##-###",cc:"AQ",cd:"Australian bases in Antarctica",desc_en:"",name_ru:"\u0410\u0432\u0441\u0442\u0440\u0430\u043b\u0438\u0439\u0441\u043a\u0430\u044f \u0430\u043d\u0442\u0430\u0440\u043a\u0442\u0438\u0447\u0435\u0441\u043a\u0430\u044f \u0431\u0430\u0437\u0430",desc_ru:""},{mask:"+54(###)###-####",cc:"AR",cd:"Argentina",desc_en:"",name_ru:"\u0410\u0440\u0433\u0435\u043d\u0442\u0438\u043d\u0430",desc_ru:""},{mask:"+1(684)###-####",cc:"AS",cd:"American Samoa",desc_en:"",name_ru:"\u0410\u043c\u0435\u0440\u0438\u043a\u0430\u043d\u0441\u043a\u043e\u0435 \u0421\u0430\u043c\u043e\u0430",desc_ru:""},{mask:"+43(###)###-####",cc:"AT",cd:"Austria",desc_en:"",name_ru:"\u0410\u0432\u0441\u0442\u0440\u0438\u044f",desc_ru:""},{mask:"+61-#-####-####",cc:"AU",cd:"Australia",desc_en:"",name_ru:"\u0410\u0432\u0441\u0442\u0440\u0430\u043b\u0438\u044f",desc_ru:""},{mask:"+297-###-####",cc:"AW",cd:"Aruba",desc_en:"",name_ru:"\u0410\u0440\u0443\u0431\u0430",desc_ru:""},{mask:"+994-##-###-##-##",cc:"AZ",cd:"Azerbaijan",desc_en:"",name_ru:"\u0410\u0437\u0435\u0440\u0431\u0430\u0439\u0434\u0436\u0430\u043d",desc_ru:""},{mask:"+387-##-#####",cc:"BA",cd:"Bosnia and Herzegovina",desc_en:"",name_ru:"\u0411\u043e\u0441\u043d\u0438\u044f \u0438 \u0413\u0435\u0440\u0446\u0435\u0433\u043e\u0432\u0438\u043d\u0430",desc_ru:""},{mask:"+387-##-####",cc:"BA",cd:"Bosnia and Herzegovina",desc_en:"",name_ru:"\u0411\u043e\u0441\u043d\u0438\u044f \u0438 \u0413\u0435\u0440\u0446\u0435\u0433\u043e\u0432\u0438\u043d\u0430",desc_ru:""},{mask:"+1(246)###-####",cc:"BB",cd:"Barbados",desc_en:"",name_ru:"\u0411\u0430\u0440\u0431\u0430\u0434\u043e\u0441",desc_ru:""},{mask:"+880-##-###-###",cc:"BD",cd:"Bangladesh",desc_en:"",name_ru:"\u0411\u0430\u043d\u0433\u043b\u0430\u0434\u0435\u0448",desc_ru:""},{mask:"+32(###)###-###",cc:"BE",cd:"Belgium",desc_en:"",name_ru:"\u0411\u0435\u043b\u044c\u0433\u0438\u044f",desc_ru:""},{mask:"+226-##-##-####",cc:"BF",cd:"Burkina Faso",desc_en:"",name_ru:"\u0411\u0443\u0440\u043a\u0438\u043d\u0430 \u0424\u0430\u0441\u043e",desc_ru:""},{mask:"+359(###)###-###",cc:"BG",cd:"Bulgaria",desc_en:"",name_ru:"\u0411\u043e\u043b\u0433\u0430\u0440\u0438\u044f",desc_ru:""},{mask:"+973-####-####",cc:"BH",cd:"Bahrain",desc_en:"",name_ru:"\u0411\u0430\u0445\u0440\u0435\u0439\u043d",desc_ru:""},{mask:"+257-##-##-####",cc:"BI",cd:"Burundi",desc_en:"",name_ru:"\u0411\u0443\u0440\u0443\u043d\u0434\u0438",desc_ru:""},{mask:"+229-##-##-####",cc:"BJ",cd:"Benin",desc_en:"",name_ru:"\u0411\u0435\u043d\u0438\u043d",desc_ru:""},{mask:"+1(441)###-####",cc:"BM",cd:"Bermuda",desc_en:"",name_ru:"\u0411\u0435\u0440\u043c\u0443\u0434\u0441\u043a\u0438\u0435 \u043e\u0441\u0442\u0440\u043e\u0432\u0430",desc_ru:""},{mask:"+673-###-####",cc:"BN",cd:"Brunei Darussalam",desc_en:"",name_ru:"\u0411\u0440\u0443\u043d\u0435\u0439-\u0414\u0430\u0440\u0443\u0441\u0441\u0430\u043b\u0430\u043c",desc_ru:""},{mask:"+591-#-###-####",cc:"BO",cd:"Bolivia",desc_en:"",name_ru:"\u0411\u043e\u043b\u0438\u0432\u0438\u044f",desc_ru:""},{mask:"+55-##-####-####",cc:"BR",cd:"Brazil",desc_en:"",name_ru:"\u0411\u0440\u0430\u0437\u0438\u043b\u0438\u044f",desc_ru:""},{mask:"+55-##-#####-####",cc:"BR",cd:"Brazil",desc_en:"",name_ru:"\u0411\u0440\u0430\u0437\u0438\u043b\u0438\u044f",desc_ru:""},{mask:"+1(242)###-####",cc:"BS",cd:"Bahamas",desc_en:"",name_ru:"\u0411\u0430\u0433\u0430\u043c\u0441\u043a\u0438\u0435 \u041e\u0441\u0442\u0440\u043e\u0432\u0430",desc_ru:""},{mask:"+975-17-###-###",cc:"BT",cd:"Bhutan",desc_en:"",name_ru:"\u0411\u0443\u0442\u0430\u043d",desc_ru:""},{mask:"+975-#-###-###",cc:"BT",cd:"Bhutan",desc_en:"",name_ru:"\u0411\u0443\u0442\u0430\u043d",desc_ru:""},{mask:"+267-##-###-###",cc:"BW",cd:"Botswana",desc_en:"",name_ru:"\u0411\u043e\u0442\u0441\u0432\u0430\u043d\u0430",desc_ru:""},{mask:"+375(##)###-##-##",cc:"BY",cd:"Belarus",desc_en:"",name_ru:"\u0411\u0435\u043b\u0430\u0440\u0443\u0441\u044c (\u0411\u0435\u043b\u043e\u0440\u0443\u0441\u0441\u0438\u044f)",desc_ru:""},{mask:"+501-###-####",cc:"BZ",cd:"Belize",desc_en:"",name_ru:"\u0411\u0435\u043b\u0438\u0437",desc_ru:""},{mask:"+243(###)###-###",cc:"CD",cd:"Dem. Rep. Congo",desc_en:"",name_ru:"\u0414\u0435\u043c. \u0420\u0435\u0441\u043f. \u041a\u043e\u043d\u0433\u043e (\u041a\u0438\u043d\u0448\u0430\u0441\u0430)",desc_ru:""},{mask:"+236-##-##-####",cc:"CF",cd:"Central African Republic",desc_en:"",name_ru:"\u0426\u0435\u043d\u0442\u0440\u0430\u043b\u044c\u043d\u043e\u0430\u0444\u0440\u0438\u043a\u0430\u043d\u0441\u043a\u0430\u044f \u0420\u0435\u0441\u043f\u0443\u0431\u043b\u0438\u043a\u0430",desc_ru:""},{mask:"+242-##-###-####",cc:"CG",cd:"Congo (Brazzaville)",desc_en:"",name_ru:"\u041a\u043e\u043d\u0433\u043e (\u0411\u0440\u0430\u0437\u0437\u0430\u0432\u0438\u043b\u044c)",desc_ru:""},{mask:"+41-##-###-####",cc:"CH",cd:"Switzerland",desc_en:"",name_ru:"\u0428\u0432\u0435\u0439\u0446\u0430\u0440\u0438\u044f",desc_ru:""},{mask:"+225-##-###-###",cc:"CI",cd:"Cote d\u2019Ivoire\xa0(Ivory Coast)",desc_en:"",name_ru:"\u041a\u043e\u0442-\u0434\u2019\u0418\u0432\u0443\u0430\u0440",desc_ru:""},{mask:"+682-##-###",cc:"CK",cd:"Cook Islands",desc_en:"",name_ru:"\u041e\u0441\u0442\u0440\u043e\u0432\u0430 \u041a\u0443\u043a\u0430",desc_ru:""},{mask:"+56-#-####-####",cc:"CL",cd:"Chile",desc_en:"",name_ru:"\u0427\u0438\u043b\u0438",desc_ru:""},{mask:"+237-####-####",cc:"CM",cd:"Cameroon",desc_en:"",name_ru:"\u041a\u0430\u043c\u0435\u0440\u0443\u043d",desc_ru:""},{mask:"+86(###)####-####",cc:"CN",cd:"China (PRC)",desc_en:"",name_ru:"\u041a\u0438\u0442\u0430\u0439\u0441\u043a\u0430\u044f \u041d.\u0420.",desc_ru:""},{mask:"+86(###)####-###",cc:"CN",cd:"China (PRC)",desc_en:"",name_ru:"\u041a\u0438\u0442\u0430\u0439\u0441\u043a\u0430\u044f \u041d.\u0420.",desc_ru:""},{mask:"+86-##-#####-#####",cc:"CN",cd:"China (PRC)",desc_en:"",name_ru:"\u041a\u0438\u0442\u0430\u0439\u0441\u043a\u0430\u044f \u041d.\u0420.",desc_ru:""},{mask:"+57(###)###-####",cc:"CO",cd:"Colombia",desc_en:"",name_ru:"\u041a\u043e\u043b\u0443\u043c\u0431\u0438\u044f",desc_ru:""},{mask:"+506-####-####",cc:"CR",cd:"Costa Rica",desc_en:"",name_ru:"\u041a\u043e\u0441\u0442\u0430-\u0420\u0438\u043a\u0430",desc_ru:""},{mask:"+53-#-###-####",cc:"CU",cd:"Cuba",desc_en:"",name_ru:"\u041a\u0443\u0431\u0430",desc_ru:""},{mask:"+238(###)##-##",cc:"CV",cd:"Cape Verde",desc_en:"",name_ru:"\u041a\u0430\u0431\u043e-\u0412\u0435\u0440\u0434\u0435",desc_ru:""},{mask:"+599-###-####",cc:"CW",cd:"Curacao",desc_en:"",name_ru:"\u041a\u044e\u0440\u0430\u0441\u0430\u043e",desc_ru:""},{mask:"+357-##-###-###",cc:"CY",cd:"Cyprus",desc_en:"",name_ru:"\u041a\u0438\u043f\u0440",desc_ru:""},{mask:"+420(###)###-###",cc:"CZ",cd:"Czech Republic",desc_en:"",name_ru:"\u0427\u0435\u0445\u0438\u044f",desc_ru:""},{mask:"+49(####)###-####",cc:"DE",cd:"Germany",desc_en:"",name_ru:"\u0413\u0435\u0440\u043c\u0430\u043d\u0438\u044f",desc_ru:""},{mask:"+49(###)###-####",cc:"DE",cd:"Germany",desc_en:"",name_ru:"\u0413\u0435\u0440\u043c\u0430\u043d\u0438\u044f",desc_ru:""},{mask:"+49(###)##-####",cc:"DE",cd:"Germany",desc_en:"",name_ru:"\u0413\u0435\u0440\u043c\u0430\u043d\u0438\u044f",desc_ru:""},{mask:"+49(###)##-###",cc:"DE",cd:"Germany",desc_en:"",name_ru:"\u0413\u0435\u0440\u043c\u0430\u043d\u0438\u044f",desc_ru:""},{mask:"+49(###)##-##",cc:"DE",cd:"Germany",desc_en:"",name_ru:"\u0413\u0435\u0440\u043c\u0430\u043d\u0438\u044f",desc_ru:""},{mask:"+49-###-###",cc:"DE",cd:"Germany",desc_en:"",name_ru:"\u0413\u0435\u0440\u043c\u0430\u043d\u0438\u044f",desc_ru:""},{mask:"+253-##-##-##-##",cc:"DJ",cd:"Djibouti",desc_en:"",name_ru:"\u0414\u0436\u0438\u0431\u0443\u0442\u0438",desc_ru:""},{mask:"+45-##-##-##-##",cc:"DK",cd:"Denmark",desc_en:"",name_ru:"\u0414\u0430\u043d\u0438\u044f",desc_ru:""},{mask:"+1(767)###-####",cc:"DM",cd:"Dominica",desc_en:"",name_ru:"\u0414\u043e\u043c\u0438\u043d\u0438\u043a\u0430",desc_ru:""},{mask:"+1(809)###-####",cc:"DO",cd:"Dominican Republic",desc_en:"",name_ru:"\u0414\u043e\u043c\u0438\u043d\u0438\u043a\u0430\u043d\u0441\u043a\u0430\u044f \u0420\u0435\u0441\u043f\u0443\u0431\u043b\u0438\u043a\u0430",desc_ru:""},{mask:"+1(829)###-####",cc:"DO",cd:"Dominican Republic",desc_en:"",name_ru:"\u0414\u043e\u043c\u0438\u043d\u0438\u043a\u0430\u043d\u0441\u043a\u0430\u044f \u0420\u0435\u0441\u043f\u0443\u0431\u043b\u0438\u043a\u0430",desc_ru:""},{mask:"+1(849)###-####",cc:"DO",cd:"Dominican Republic",desc_en:"",name_ru:"\u0414\u043e\u043c\u0438\u043d\u0438\u043a\u0430\u043d\u0441\u043a\u0430\u044f \u0420\u0435\u0441\u043f\u0443\u0431\u043b\u0438\u043a\u0430",desc_ru:""},{mask:"+213-##-###-####",cc:"DZ",cd:"Algeria",desc_en:"",name_ru:"\u0410\u043b\u0436\u0438\u0440",desc_ru:""},{mask:"+593-##-###-####",cc:"EC",cd:"Ecuador ",desc_en:"mobile",name_ru:"\u042d\u043a\u0432\u0430\u0434\u043e\u0440 ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+593-#-###-####",cc:"EC",cd:"Ecuador",desc_en:"",name_ru:"\u042d\u043a\u0432\u0430\u0434\u043e\u0440",desc_ru:""},{mask:"+372-####-####",cc:"EE",cd:"Estonia ",desc_en:"mobile",name_ru:"\u042d\u0441\u0442\u043e\u043d\u0438\u044f ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+372-###-####",cc:"EE",cd:"Estonia",desc_en:"",name_ru:"\u042d\u0441\u0442\u043e\u043d\u0438\u044f",desc_ru:""},{mask:"+20(###)###-####",cc:"EG",cd:"Egypt",desc_en:"",name_ru:"\u0415\u0433\u0438\u043f\u0435\u0442",desc_ru:""},{mask:"+291-#-###-###",cc:"ER",cd:"Eritrea",desc_en:"",name_ru:"\u042d\u0440\u0438\u0442\u0440\u0435\u044f",desc_ru:""},{mask:"+34(###)###-###",cc:"ES",cd:"Spain",desc_en:"",name_ru:"\u0418\u0441\u043f\u0430\u043d\u0438\u044f",desc_ru:""},{mask:"+251-##-###-####",cc:"ET",cd:"Ethiopia",desc_en:"",name_ru:"\u042d\u0444\u0438\u043e\u043f\u0438\u044f",desc_ru:""},{mask:"+358(###)###-##-##",cc:"FI",cd:"Finland",desc_en:"",name_ru:"\u0424\u0438\u043d\u043b\u044f\u043d\u0434\u0438\u044f",desc_ru:""},{mask:"+679-##-#####",cc:"FJ",cd:"Fiji",desc_en:"",name_ru:"\u0424\u0438\u0434\u0436\u0438",desc_ru:""},{mask:"+500-#####",cc:"FK",cd:"Falkland Islands",desc_en:"",name_ru:"\u0424\u043e\u043b\u043a\u043b\u0435\u043d\u0434\u0441\u043a\u0438\u0435 \u043e\u0441\u0442\u0440\u043e\u0432\u0430",desc_ru:""},{mask:"+691-###-####",cc:"FM",cd:"F.S. Micronesia",desc_en:"",name_ru:"\u0424.\u0428. \u041c\u0438\u043a\u0440\u043e\u043d\u0435\u0437\u0438\u0438",desc_ru:""},{mask:"+298-###-###",cc:"FO",cd:"Faroe Islands",desc_en:"",name_ru:"\u0424\u0430\u0440\u0435\u0440\u0441\u043a\u0438\u0435 \u043e\u0441\u0442\u0440\u043e\u0432\u0430",desc_ru:""},{mask:"+262-#####-####",cc:"FR",cd:"Mayotte",desc_en:"",name_ru:"\u041c\u0430\u0439\u043e\u0442\u0442\u0430",desc_ru:""},{mask:"+33(###)###-###",cc:"FR",cd:"France",desc_en:"",name_ru:"\u0424\u0440\u0430\u043d\u0446\u0438\u044f",desc_ru:""},{mask:"+508-##-####",cc:"FR",cd:"St Pierre & Miquelon",desc_en:"",name_ru:"\u0421\u0435\u043d-\u041f\u044c\u0435\u0440 \u0438 \u041c\u0438\u043a\u0435\u043b\u043e\u043d",desc_ru:""},{mask:"+590(###)###-###",cc:"FR",cd:"Guadeloupe",desc_en:"",name_ru:"\u0413\u0432\u0430\u0434\u0435\u043b\u0443\u043f\u0430",desc_ru:""},{mask:"+241-#-##-##-##",cc:"GA",cd:"Gabon",desc_en:"",name_ru:"\u0413\u0430\u0431\u043e\u043d",desc_ru:""},{mask:"+1(473)###-####",cc:"GD",cd:"Grenada",desc_en:"",name_ru:"\u0413\u0440\u0435\u043d\u0430\u0434\u0430",desc_ru:""},{mask:"+995(###)###-###",cc:"GE",cd:"Rep. of Georgia",desc_en:"",name_ru:"\u0413\u0440\u0443\u0437\u0438\u044f",desc_ru:""},{mask:"+594-#####-####",cc:"GF",cd:"Guiana (French)",desc_en:"",name_ru:"\u0424\u0440. \u0413\u0432\u0438\u0430\u043d\u0430",desc_ru:""},{mask:"+233(###)###-###",cc:"GH",cd:"Ghana",desc_en:"",name_ru:"\u0413\u0430\u043d\u0430",desc_ru:""},{mask:"+350-###-#####",cc:"GI",cd:"Gibraltar",desc_en:"",name_ru:"\u0413\u0438\u0431\u0440\u0430\u043b\u0442\u0430\u0440",desc_ru:""},{mask:"+299-##-##-##",cc:"GL",cd:"Greenland",desc_en:"",name_ru:"\u0413\u0440\u0435\u043d\u043b\u0430\u043d\u0434\u0438\u044f",desc_ru:""},{mask:"+220(###)##-##",cc:"GM",cd:"Gambia",desc_en:"",name_ru:"\u0413\u0430\u043c\u0431\u0438\u044f",desc_ru:""},{mask:"+224-##-###-###",cc:"GN",cd:"Guinea",desc_en:"",name_ru:"\u0413\u0432\u0438\u043d\u0435\u044f",desc_ru:""},{mask:"+240-##-###-####",cc:"GQ",cd:"Equatorial Guinea",desc_en:"",name_ru:"\u042d\u043a\u0432\u0430\u0442\u043e\u0440\u0438\u0430\u043b\u044c\u043d\u0430\u044f \u0413\u0432\u0438\u043d\u0435\u044f",desc_ru:""},{mask:"+30(###)###-####",cc:"GR",cd:"Greece",desc_en:"",name_ru:"\u0413\u0440\u0435\u0446\u0438\u044f",desc_ru:""},{mask:"+502-#-###-####",cc:"GT",cd:"Guatemala",desc_en:"",name_ru:"\u0413\u0432\u0430\u0442\u0435\u043c\u0430\u043b\u0430",desc_ru:""},{mask:"+1(671)###-####",cc:"GU",cd:"Guam",desc_en:"",name_ru:"\u0413\u0443\u0430\u043c",desc_ru:""},{mask:"+245-#-######",cc:"GW",cd:"Guinea-Bissau",desc_en:"",name_ru:"\u0413\u0432\u0438\u043d\u0435\u044f-\u0411\u0438\u0441\u0430\u0443",desc_ru:""},{mask:"+592-###-####",cc:"GY",cd:"Guyana",desc_en:"",name_ru:"\u0413\u0430\u0439\u0430\u043d\u0430",desc_ru:""},{mask:"+852-####-####",cc:"HK",cd:"Hong Kong",desc_en:"",name_ru:"\u0413\u043e\u043d\u043a\u043e\u043d\u0433",desc_ru:""},{mask:"+504-####-####",cc:"HN",cd:"Honduras",desc_en:"",name_ru:"\u0413\u043e\u043d\u0434\u0443\u0440\u0430\u0441",desc_ru:""},{mask:"+385-(##)-###-###",cc:"HR",cd:"Croatia",desc_en:"",name_ru:"\u0425\u043e\u0440\u0432\u0430\u0442\u0438\u044f",desc_ru:""},{mask:"+385-(##)-###-####",cc:"HR",cd:"Croatia",desc_en:"",name_ru:"\u0425\u043e\u0440\u0432\u0430\u0442\u0438\u044f",desc_ru:""},{mask:"+385-1-####-###",cc:"HR",cd:"Croatia",desc_en:"",name_ru:"\u0425\u043e\u0440\u0432\u0430\u0442\u0438\u044f",desc_ru:""},{mask:"+509-##-##-####",cc:"HT",cd:"Haiti",desc_en:"",name_ru:"\u0413\u0430\u0438\u0442\u0438",desc_ru:""},{mask:"+36(###)###-###",cc:"HU",cd:"Hungary",desc_en:"",name_ru:"\u0412\u0435\u043d\u0433\u0440\u0438\u044f",desc_ru:""},{mask:"+62(8##)###-####",cc:"ID",cd:"Indonesia ",desc_en:"mobile",name_ru:"\u0418\u043d\u0434\u043e\u043d\u0435\u0437\u0438\u044f ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+62-##-###-##",cc:"ID",cd:"Indonesia",desc_en:"",name_ru:"\u0418\u043d\u0434\u043e\u043d\u0435\u0437\u0438\u044f",desc_ru:""},{mask:"+62-##-###-###",cc:"ID",cd:"Indonesia",desc_en:"",name_ru:"\u0418\u043d\u0434\u043e\u043d\u0435\u0437\u0438\u044f",desc_ru:""},{mask:"+62-##-###-####",cc:"ID",cd:"Indonesia",desc_en:"",name_ru:"\u0418\u043d\u0434\u043e\u043d\u0435\u0437\u0438\u044f",desc_ru:""},{mask:"+62(8##)###-###",cc:"ID",cd:"Indonesia ",desc_en:"mobile",name_ru:"\u0418\u043d\u0434\u043e\u043d\u0435\u0437\u0438\u044f ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+62(8##)###-##-###",cc:"ID",cd:"Indonesia ",desc_en:"mobile",name_ru:"\u0418\u043d\u0434\u043e\u043d\u0435\u0437\u0438\u044f ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+353(###)###-###",cc:"IE",cd:"Ireland",desc_en:"",name_ru:"\u0418\u0440\u043b\u0430\u043d\u0434\u0438\u044f",desc_ru:""},{mask:"+972-5#-###-####",cc:"IL",cd:"Israel ",desc_en:"mobile",name_ru:"\u0418\u0437\u0440\u0430\u0438\u043b\u044c ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+972-#-###-####",cc:"IL",cd:"Israel",desc_en:"",name_ru:"\u0418\u0437\u0440\u0430\u0438\u043b\u044c",desc_ru:""},{mask:"+91(####)###-###",cc:"IN",cd:"India",desc_en:"",name_ru:"\u0418\u043d\u0434\u0438\u044f",desc_ru:""},{mask:"+246-###-####",cc:"IO",cd:"Diego Garcia",desc_en:"",name_ru:"\u0414\u0438\u0435\u0433\u043e-\u0413\u0430\u0440\u0441\u0438\u044f",desc_ru:""},{mask:"+964(###)###-####",cc:"IQ",cd:"Iraq",desc_en:"",name_ru:"\u0418\u0440\u0430\u043a",desc_ru:""},{mask:"+98(###)###-####",cc:"IR",cd:"Iran",desc_en:"",name_ru:"\u0418\u0440\u0430\u043d",desc_ru:""},{mask:"+354-###-####",cc:"IS",cd:"Iceland",desc_en:"",name_ru:"\u0418\u0441\u043b\u0430\u043d\u0434\u0438\u044f",desc_ru:""},{mask:"+39(###)####-###",cc:"IT",cd:"Italy",desc_en:"",name_ru:"\u0418\u0442\u0430\u043b\u0438\u044f",desc_ru:""},{mask:"+1(876)###-####",cc:"JM",cd:"Jamaica",desc_en:"",name_ru:"\u042f\u043c\u0430\u0439\u043a\u0430",desc_ru:""},{mask:"+962-#-####-####",cc:"JO",cd:"Jordan",desc_en:"",name_ru:"\u0418\u043e\u0440\u0434\u0430\u043d\u0438\u044f",desc_ru:""},{mask:"+81-##-####-####",cc:"JP",cd:"Japan ",desc_en:"mobile",name_ru:"\u042f\u043f\u043e\u043d\u0438\u044f ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+81(###)###-###",cc:"JP",cd:"Japan",desc_en:"",name_ru:"\u042f\u043f\u043e\u043d\u0438\u044f",desc_ru:""},{mask:"+254-###-######",cc:"KE",cd:"Kenya",desc_en:"",name_ru:"\u041a\u0435\u043d\u0438\u044f",desc_ru:""},{mask:"+996(###)###-###",cc:"KG",cd:"Kyrgyzstan",desc_en:"",name_ru:"\u041a\u0438\u0440\u0433\u0438\u0437\u0438\u044f",desc_ru:""},{mask:"+855-##-###-###",cc:"KH",cd:"Cambodia",desc_en:"",name_ru:"\u041a\u0430\u043c\u0431\u043e\u0434\u0436\u0430",desc_ru:""},{mask:"+686-##-###",cc:"KI",cd:"Kiribati",desc_en:"",name_ru:"\u041a\u0438\u0440\u0438\u0431\u0430\u0442\u0438",desc_ru:""},{mask:"+269-##-#####",cc:"KM",cd:"Comoros",desc_en:"",name_ru:"\u041a\u043e\u043c\u043e\u0440\u044b",desc_ru:""},{mask:"+1(869)###-####",cc:"KN",cd:"Saint Kitts & Nevis",desc_en:"",name_ru:"\u0421\u0435\u043d\u0442-\u041a\u0438\u0442\u0441 \u0438 \u041d\u0435\u0432\u0438\u0441",desc_ru:""},{mask:"+850-191-###-####",cc:"KP",cd:"DPR Korea (North) ",desc_en:"mobile",name_ru:"\u041a\u043e\u0440\u0435\u0439\u0441\u043a\u0430\u044f \u041d\u0414\u0420 ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+850-##-###-###",cc:"KP",cd:"DPR Korea (North)",desc_en:"",name_ru:"\u041a\u043e\u0440\u0435\u0439\u0441\u043a\u0430\u044f \u041d\u0414\u0420",desc_ru:""},{mask:"+850-###-####-###",cc:"KP",cd:"DPR Korea (North)",desc_en:"",name_ru:"\u041a\u043e\u0440\u0435\u0439\u0441\u043a\u0430\u044f \u041d\u0414\u0420",desc_ru:""},{mask:"+850-###-###",cc:"KP",cd:"DPR Korea (North)",desc_en:"",name_ru:"\u041a\u043e\u0440\u0435\u0439\u0441\u043a\u0430\u044f \u041d\u0414\u0420",desc_ru:""},{mask:"+850-####-####",cc:"KP",cd:"DPR Korea (North)",desc_en:"",name_ru:"\u041a\u043e\u0440\u0435\u0439\u0441\u043a\u0430\u044f \u041d\u0414\u0420",desc_ru:""},{mask:"+850-####-#############",cc:"KP",cd:"DPR Korea (North)",desc_en:"",name_ru:"\u041a\u043e\u0440\u0435\u0439\u0441\u043a\u0430\u044f \u041d\u0414\u0420",desc_ru:""},{mask:"+82-##-###-####",cc:"KR",cd:"Korea (South)",desc_en:"",name_ru:"\u0420\u0435\u0441\u043f. \u041a\u043e\u0440\u0435\u044f",desc_ru:""},{mask:"+965-####-####",cc:"KW",cd:"Kuwait",desc_en:"",name_ru:"\u041a\u0443\u0432\u0435\u0439\u0442",desc_ru:""},{mask:"+1(345)###-####",cc:"KY",cd:"Cayman Islands",desc_en:"",name_ru:"\u041a\u0430\u0439\u043c\u0430\u043d\u043e\u0432\u044b \u043e\u0441\u0442\u0440\u043e\u0432\u0430",desc_ru:""},{mask:"+7(6##)###-##-##",cc:"KZ",cd:"Kazakhstan",desc_en:"",name_ru:"\u041a\u0430\u0437\u0430\u0445\u0441\u0442\u0430\u043d",desc_ru:""},{mask:"+7(7##)###-##-##",cc:"KZ",cd:"Kazakhstan",desc_en:"",name_ru:"\u041a\u0430\u0437\u0430\u0445\u0441\u0442\u0430\u043d",desc_ru:""},{mask:"+856(20##)###-###",cc:"LA",cd:"Laos ",desc_en:"mobile",name_ru:"\u041b\u0430\u043e\u0441 ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+856-##-###-###",cc:"LA",cd:"Laos",desc_en:"",name_ru:"\u041b\u0430\u043e\u0441",desc_ru:""},{mask:"+961-##-###-###",cc:"LB",cd:"Lebanon ",desc_en:"mobile",name_ru:"\u041b\u0438\u0432\u0430\u043d ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+961-#-###-###",cc:"LB",cd:"Lebanon",desc_en:"",name_ru:"\u041b\u0438\u0432\u0430\u043d",desc_ru:""},{mask:"+1(758)###-####",cc:"LC",cd:"Saint Lucia",desc_en:"",name_ru:"\u0421\u0435\u043d\u0442-\u041b\u044e\u0441\u0438\u044f",desc_ru:""},{mask:"+423(###)###-####",cc:"LI",cd:"Liechtenstein",desc_en:"",name_ru:"\u041b\u0438\u0445\u0442\u0435\u043d\u0448\u0442\u0435\u0439\u043d",desc_ru:""},{mask:"+94-##-###-####",cc:"LK",cd:"Sri Lanka",desc_en:"",name_ru:"\u0428\u0440\u0438-\u041b\u0430\u043d\u043a\u0430",desc_ru:""},{mask:"+231-##-###-###",cc:"LR",cd:"Liberia",desc_en:"",name_ru:"\u041b\u0438\u0431\u0435\u0440\u0438\u044f",desc_ru:""},{mask:"+266-#-###-####",cc:"LS",cd:"Lesotho",desc_en:"",name_ru:"\u041b\u0435\u0441\u043e\u0442\u043e",desc_ru:""},{mask:"+370(###)##-###",cc:"LT",cd:"Lithuania",desc_en:"",name_ru:"\u041b\u0438\u0442\u0432\u0430",desc_ru:""},{mask:"+352-###-###",cc:"LU",cd:"Luxembourg",desc_en:"",name_ru:"\u041b\u044e\u043a\u0441\u0435\u043c\u0431\u0443\u0440\u0433",desc_ru:""},{mask:"+352-####-###",cc:"LU",cd:"Luxembourg",desc_en:"",name_ru:"\u041b\u044e\u043a\u0441\u0435\u043c\u0431\u0443\u0440\u0433",desc_ru:""},{mask:"+352-#####-###",cc:"LU",cd:"Luxembourg",desc_en:"",name_ru:"\u041b\u044e\u043a\u0441\u0435\u043c\u0431\u0443\u0440\u0433",desc_ru:""},{mask:"+352-######-###",cc:"LU",cd:"Luxembourg",desc_en:"",name_ru:"\u041b\u044e\u043a\u0441\u0435\u043c\u0431\u0443\u0440\u0433",desc_ru:""},{mask:"+371-##-###-###",cc:"LV",cd:"Latvia",desc_en:"",name_ru:"\u041b\u0430\u0442\u0432\u0438\u044f",desc_ru:""},{mask:"+218-##-###-###",cc:"LY",cd:"Libya",desc_en:"",name_ru:"\u041b\u0438\u0432\u0438\u044f",desc_ru:""},{mask:"+218-21-###-####",cc:"LY",cd:"Libya",desc_en:"Tripoli",name_ru:"\u041b\u0438\u0432\u0438\u044f",desc_ru:"\u0422\u0440\u0438\u043f\u043e\u043b\u0438"},{mask:"+212-##-####-###",cc:"MA",cd:"Morocco",desc_en:"",name_ru:"\u041c\u0430\u0440\u043e\u043a\u043a\u043e",desc_ru:""},{mask:"+377(###)###-###",cc:"MC",cd:"Monaco",desc_en:"",name_ru:"\u041c\u043e\u043d\u0430\u043a\u043e",desc_ru:""},{mask:"+377-##-###-###",cc:"MC",cd:"Monaco",desc_en:"",name_ru:"\u041c\u043e\u043d\u0430\u043a\u043e",desc_ru:""},{mask:"+373-####-####",cc:"MD",cd:"Moldova",desc_en:"",name_ru:"\u041c\u043e\u043b\u0434\u043e\u0432\u0430",desc_ru:""},{mask:"+382-##-###-###",cc:"ME",cd:"Montenegro",desc_en:"",name_ru:"\u0427\u0435\u0440\u043d\u043e\u0433\u043e\u0440\u0438\u044f",desc_ru:""},{mask:"+261-##-##-#####",cc:"MG",cd:"Madagascar",desc_en:"",name_ru:"\u041c\u0430\u0434\u0430\u0433\u0430\u0441\u043a\u0430\u0440",desc_ru:""},{mask:"+692-###-####",cc:"MH",cd:"Marshall Islands",desc_en:"",name_ru:"\u041c\u0430\u0440\u0448\u0430\u043b\u043b\u043e\u0432\u044b \u041e\u0441\u0442\u0440\u043e\u0432\u0430",desc_ru:""},{mask:"+389-##-###-###",cc:"MK",cd:"Republic of Macedonia",desc_en:"",name_ru:"\u0420\u0435\u0441\u043f. \u041c\u0430\u043a\u0435\u0434\u043e\u043d\u0438\u044f",desc_ru:""},{mask:"+223-##-##-####",cc:"ML",cd:"Mali",desc_en:"",name_ru:"\u041c\u0430\u043b\u0438",desc_ru:""},{mask:"+95-##-###-###",cc:"MM",cd:"Burma (Myanmar)",desc_en:"",name_ru:"\u0411\u0438\u0440\u043c\u0430 (\u041c\u044c\u044f\u043d\u043c\u0430)",desc_ru:""},{mask:"+95-#-###-###",cc:"MM",cd:"Burma (Myanmar)",desc_en:"",name_ru:"\u0411\u0438\u0440\u043c\u0430 (\u041c\u044c\u044f\u043d\u043c\u0430)",desc_ru:""},{mask:"+95-###-###",cc:"MM",cd:"Burma (Myanmar)",desc_en:"",name_ru:"\u0411\u0438\u0440\u043c\u0430 (\u041c\u044c\u044f\u043d\u043c\u0430)",desc_ru:""},{mask:"+976-##-##-####",cc:"MN",cd:"Mongolia",desc_en:"",name_ru:"\u041c\u043e\u043d\u0433\u043e\u043b\u0438\u044f",desc_ru:""},{mask:"+853-####-####",cc:"MO",cd:"Macau",desc_en:"",name_ru:"\u041c\u0430\u043a\u0430\u043e",desc_ru:""},{mask:"+1(670)###-####",cc:"MP",cd:"Northern Mariana Islands",desc_en:"",name_ru:"\u0421\u0435\u0432\u0435\u0440\u043d\u044b\u0435 \u041c\u0430\u0440\u0438\u0430\u043d\u0441\u043a\u0438\u0435 \u043e\u0441\u0442\u0440\u043e\u0432\u0430\xa0\u0421\u0430\u0439\u043f\u0430\u043d",desc_ru:""},{mask:"+596(###)##-##-##",cc:"MQ",cd:"Martinique",desc_en:"",name_ru:"\u041c\u0430\u0440\u0442\u0438\u043d\u0438\u043a\u0430",desc_ru:""},{mask:"+222-##-##-####",cc:"MR",cd:"Mauritania",desc_en:"",name_ru:"\u041c\u0430\u0432\u0440\u0438\u0442\u0430\u043d\u0438\u044f",desc_ru:""},{mask:"+1(664)###-####",cc:"MS",cd:"Montserrat",desc_en:"",name_ru:"\u041c\u043e\u043d\u0442\u0441\u0435\u0440\u0440\u0430\u0442",desc_ru:""},{mask:"+356-####-####",cc:"MT",cd:"Malta",desc_en:"",name_ru:"\u041c\u0430\u043b\u044c\u0442\u0430",desc_ru:""},{mask:"+230-###-####",cc:"MU",cd:"Mauritius",desc_en:"",name_ru:"\u041c\u0430\u0432\u0440\u0438\u043a\u0438\u0439",desc_ru:""},{mask:"+960-###-####",cc:"MV",cd:"Maldives",desc_en:"",name_ru:"\u041c\u0430\u043b\u044c\u0434\u0438\u0432\u0441\u043a\u0438\u0435 \u043e\u0441\u0442\u0440\u043e\u0432\u0430",desc_ru:""},{mask:"+265-1-###-###",cc:"MW",cd:"Malawi",desc_en:"Telecom Ltd",name_ru:"\u041c\u0430\u043b\u0430\u0432\u0438",desc_ru:"Telecom Ltd"},{mask:"+265-#-####-####",cc:"MW",cd:"Malawi",desc_en:"",name_ru:"\u041c\u0430\u043b\u0430\u0432\u0438",desc_ru:""},{mask:"+52(###)###-####",cc:"MX",cd:"Mexico",desc_en:"",name_ru:"\u041c\u0435\u043a\u0441\u0438\u043a\u0430",desc_ru:""},{mask:"+52-##-##-####",cc:"MX",cd:"Mexico",desc_en:"",name_ru:"\u041c\u0435\u043a\u0441\u0438\u043a\u0430",desc_ru:""},{mask:"+60-##-###-####",cc:"MY",cd:"Malaysia ",desc_en:"mobile",name_ru:"\u041c\u0430\u043b\u0430\u0439\u0437\u0438\u044f ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+60-11-####-####",cc:"MY",cd:"Malaysia ",desc_en:"mobile",name_ru:"\u041c\u0430\u043b\u0430\u0439\u0437\u0438\u044f ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+60(###)###-###",cc:"MY",cd:"Malaysia",desc_en:"",name_ru:"\u041c\u0430\u043b\u0430\u0439\u0437\u0438\u044f",desc_ru:""},{mask:"+60-##-###-###",cc:"MY",cd:"Malaysia",desc_en:"",name_ru:"\u041c\u0430\u043b\u0430\u0439\u0437\u0438\u044f",desc_ru:""},{mask:"+60-#-###-###",cc:"MY",cd:"Malaysia",desc_en:"",name_ru:"\u041c\u0430\u043b\u0430\u0439\u0437\u0438\u044f",desc_ru:""},{mask:"+258-##-###-###",cc:"MZ",cd:"Mozambique",desc_en:"",name_ru:"\u041c\u043e\u0437\u0430\u043c\u0431\u0438\u043a",desc_ru:""},{mask:"+264-##-###-####",cc:"NA",cd:"Namibia",desc_en:"",name_ru:"\u041d\u0430\u043c\u0438\u0431\u0438\u044f",desc_ru:""},{mask:"+687-##-####",cc:"NC",cd:"New Caledonia",desc_en:"",name_ru:"\u041d\u043e\u0432\u0430\u044f \u041a\u0430\u043b\u0435\u0434\u043e\u043d\u0438\u044f",desc_ru:""},{mask:"+227-##-##-####",cc:"NE",cd:"Niger",desc_en:"",name_ru:"\u041d\u0438\u0433\u0435\u0440",desc_ru:""},{mask:"+672-3##-###",cc:"NF",cd:"Norfolk Island",desc_en:"",name_ru:"\u041d\u043e\u0440\u0444\u043e\u043b\u043a (\u043e\u0441\u0442\u0440\u043e\u0432)",desc_ru:""},{mask:"+234(###)###-####",cc:"NG",cd:"Nigeria",desc_en:"",name_ru:"\u041d\u0438\u0433\u0435\u0440\u0438\u044f",desc_ru:""},{mask:"+234-##-###-###",cc:"NG",cd:"Nigeria",desc_en:"",name_ru:"\u041d\u0438\u0433\u0435\u0440\u0438\u044f",desc_ru:""},{mask:"+234-##-###-##",cc:"NG",cd:"Nigeria",desc_en:"",name_ru:"\u041d\u0438\u0433\u0435\u0440\u0438\u044f",desc_ru:""},{mask:"+234(###)###-####",cc:"NG",cd:"Nigeria ",desc_en:"mobile",name_ru:"\u041d\u0438\u0433\u0435\u0440\u0438\u044f ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+505-####-####",cc:"NI",cd:"Nicaragua",desc_en:"",name_ru:"\u041d\u0438\u043a\u0430\u0440\u0430\u0433\u0443\u0430",desc_ru:""},{mask:"+31-##-###-####",cc:"NL",cd:"Netherlands",desc_en:"",name_ru:"\u041d\u0438\u0434\u0435\u0440\u043b\u0430\u043d\u0434\u044b",desc_ru:""},{mask:"+47(###)##-###",cc:"NO",cd:"Norway",desc_en:"",name_ru:"\u041d\u043e\u0440\u0432\u0435\u0433\u0438\u044f",desc_ru:""},{mask:"+977-##-###-###",cc:"NP",cd:"Nepal",desc_en:"",name_ru:"\u041d\u0435\u043f\u0430\u043b",desc_ru:""},{mask:"+674-###-####",cc:"NR",cd:"Nauru",desc_en:"",name_ru:"\u041d\u0430\u0443\u0440\u0443",desc_ru:""},{mask:"+683-####",cc:"NU",cd:"Niue",desc_en:"",name_ru:"\u041d\u0438\u0443\u044d",desc_ru:""},{mask:"+64(###)###-###",cc:"NZ",cd:"New Zealand",desc_en:"",name_ru:"\u041d\u043e\u0432\u0430\u044f \u0417\u0435\u043b\u0430\u043d\u0434\u0438\u044f",desc_ru:""},{mask:"+64-##-###-###",cc:"NZ",cd:"New Zealand",desc_en:"",name_ru:"\u041d\u043e\u0432\u0430\u044f \u0417\u0435\u043b\u0430\u043d\u0434\u0438\u044f",desc_ru:""},{mask:"+64(###)###-####",cc:"NZ",cd:"New Zealand",desc_en:"",name_ru:"\u041d\u043e\u0432\u0430\u044f \u0417\u0435\u043b\u0430\u043d\u0434\u0438\u044f",desc_ru:""},{mask:"+968-##-###-###",cc:"OM",cd:"Oman",desc_en:"",name_ru:"\u041e\u043c\u0430\u043d",desc_ru:""},{mask:"+507-###-####",cc:"PA",cd:"Panama",desc_en:"",name_ru:"\u041f\u0430\u043d\u0430\u043c\u0430",desc_ru:""},{mask:"+51(###)###-###",cc:"PE",cd:"Peru",desc_en:"",name_ru:"\u041f\u0435\u0440\u0443",desc_ru:""},{mask:"+689-##-##-##",cc:"PF",cd:"French Polynesia",desc_en:"",name_ru:"\u0424\u0440\u0430\u043d\u0446\u0443\u0437\u0441\u043a\u0430\u044f \u041f\u043e\u043b\u0438\u043d\u0435\u0437\u0438\u044f (\u0422\u0430\u0438\u0442\u0438)",desc_ru:""},{mask:"+675(###)##-###",cc:"PG",cd:"Papua New Guinea",desc_en:"",name_ru:"\u041f\u0430\u043f\u0443\u0430-\u041d\u043e\u0432\u0430\u044f \u0413\u0432\u0438\u043d\u0435\u044f",desc_ru:""},{mask:"+63(###)###-####",cc:"PH",cd:"Philippines",desc_en:"",name_ru:"\u0424\u0438\u043b\u0438\u043f\u043f\u0438\u043d\u044b",desc_ru:""},{mask:"+92(###)###-####",cc:"PK",cd:"Pakistan",desc_en:"",name_ru:"\u041f\u0430\u043a\u0438\u0441\u0442\u0430\u043d",desc_ru:""},{mask:"+48(###)###-###",cc:"PL",cd:"Poland",desc_en:"",name_ru:"\u041f\u043e\u043b\u044c\u0448\u0430",desc_ru:""},{mask:"+970-##-###-####",cc:"PS",cd:"Palestine",desc_en:"",name_ru:"\u041f\u0430\u043b\u0435\u0441\u0442\u0438\u043d\u0430",
desc_ru:""},{mask:"+351-##-###-####",cc:"PT",cd:"Portugal",desc_en:"",name_ru:"\u041f\u043e\u0440\u0442\u0443\u0433\u0430\u043b\u0438\u044f",desc_ru:""},{mask:"+680-###-####",cc:"PW",cd:"Palau",desc_en:"",name_ru:"\u041f\u0430\u043b\u0430\u0443",desc_ru:""},{mask:"+595(###)###-###",cc:"PY",cd:"Paraguay",desc_en:"",name_ru:"\u041f\u0430\u0440\u0430\u0433\u0432\u0430\u0439",desc_ru:""},{mask:"+974-####-####",cc:"QA",cd:"Qatar",desc_en:"",name_ru:"\u041a\u0430\u0442\u0430\u0440",desc_ru:""},{mask:"+262-#####-####",cc:"RE",cd:"Reunion",desc_en:"",name_ru:"\u0420\u0435\u044e\u043d\u044c\u043e\u043d",desc_ru:""},{mask:"+40-##-###-####",cc:"RO",cd:"Romania",desc_en:"",name_ru:"\u0420\u0443\u043c\u044b\u043d\u0438\u044f",desc_ru:""},{mask:"+381-##-###-####",cc:"RS",cd:"Serbia",desc_en:"",name_ru:"\u0421\u0435\u0440\u0431\u0438\u044f",desc_ru:""},{mask:"+7(###)###-##-##",cc:"RU",cd:"Russia",desc_en:"",name_ru:"\u0420\u043e\u0441\u0441\u0438\u044f",desc_ru:""},{mask:"+250(###)###-###",cc:"RW",cd:"Rwanda",desc_en:"",name_ru:"\u0420\u0443\u0430\u043d\u0434\u0430",desc_ru:""},{mask:"+966-5-####-####",cc:"SA",cd:"Saudi Arabia ",desc_en:"mobile",name_ru:"\u0421\u0430\u0443\u0434\u043e\u0432\u0441\u043a\u0430\u044f \u0410\u0440\u0430\u0432\u0438\u044f ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+966-#-###-####",cc:"SA",cd:"Saudi Arabia",desc_en:"",name_ru:"\u0421\u0430\u0443\u0434\u043e\u0432\u0441\u043a\u0430\u044f \u0410\u0440\u0430\u0432\u0438\u044f",desc_ru:""},{mask:"+677-###-####",cc:"SB",cd:"Solomon Islands ",desc_en:"mobile",name_ru:"\u0421\u043e\u043b\u043e\u043c\u043e\u043d\u043e\u0432\u044b \u041e\u0441\u0442\u0440\u043e\u0432\u0430 ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+677-#####",cc:"SB",cd:"Solomon Islands",desc_en:"",name_ru:"\u0421\u043e\u043b\u043e\u043c\u043e\u043d\u043e\u0432\u044b \u041e\u0441\u0442\u0440\u043e\u0432\u0430",desc_ru:""},{mask:"+248-#-###-###",cc:"SC",cd:"Seychelles",desc_en:"",name_ru:"\u0421\u0435\u0439\u0448\u0435\u043b\u044b",desc_ru:""},{mask:"+249-##-###-####",cc:"SD",cd:"Sudan",desc_en:"",name_ru:"\u0421\u0443\u0434\u0430\u043d",desc_ru:""},{mask:"+46-##-###-####",cc:"SE",cd:"Sweden",desc_en:"",name_ru:"\u0428\u0432\u0435\u0446\u0438\u044f",desc_ru:""},{mask:"+65-####-####",cc:"SG",cd:"Singapore",desc_en:"",name_ru:"\u0421\u0438\u043d\u0433\u0430\u043f\u0443\u0440",desc_ru:""},{mask:"+290-####",cc:"SH",cd:"Saint Helena",desc_en:"",name_ru:"\u041e\u0441\u0442\u0440\u043e\u0432 \u0421\u0432\u044f\u0442\u043e\u0439 \u0415\u043b\u0435\u043d\u044b",desc_ru:""},{mask:"+290-####",cc:"SH",cd:"Tristan da Cunha",desc_en:"",name_ru:"\u0422\u0440\u0438\u0441\u0442\u0430\u043d-\u0434\u0430-\u041a\u0443\u043d\u044c\u044f",desc_ru:""},{mask:"+386-##-###-###",cc:"SI",cd:"Slovenia",desc_en:"",name_ru:"\u0421\u043b\u043e\u0432\u0435\u043d\u0438\u044f",desc_ru:""},{mask:"+421(###)###-###",cc:"SK",cd:"Slovakia",desc_en:"",name_ru:"\u0421\u043b\u043e\u0432\u0430\u043a\u0438\u044f",desc_ru:""},{mask:"+232-##-######",cc:"SL",cd:"Sierra Leone",desc_en:"",name_ru:"\u0421\u044c\u0435\u0440\u0440\u0430-\u041b\u0435\u043e\u043d\u0435",desc_ru:""},{mask:"+378-####-######",cc:"SM",cd:"San Marino",desc_en:"",name_ru:"\u0421\u0430\u043d-\u041c\u0430\u0440\u0438\u043d\u043e",desc_ru:""},{mask:"+221-##-###-####",cc:"SN",cd:"Senegal",desc_en:"",name_ru:"\u0421\u0435\u043d\u0435\u0433\u0430\u043b",desc_ru:""},{mask:"+252-##-###-###",cc:"SO",cd:"Somalia",desc_en:"",name_ru:"\u0421\u043e\u043c\u0430\u043b\u0438",desc_ru:""},{mask:"+252-#-###-###",cc:"SO",cd:"Somalia",desc_en:"",name_ru:"\u0421\u043e\u043c\u0430\u043b\u0438",desc_ru:""},{mask:"+252-#-###-###",cc:"SO",cd:"Somalia ",desc_en:"mobile",name_ru:"\u0421\u043e\u043c\u0430\u043b\u0438 ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+597-###-####",cc:"SR",cd:"Suriname ",desc_en:"mobile",name_ru:"\u0421\u0443\u0440\u0438\u043d\u0430\u043c ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+597-###-###",cc:"SR",cd:"Suriname",desc_en:"",name_ru:"\u0421\u0443\u0440\u0438\u043d\u0430\u043c",desc_ru:""},{mask:"+211-##-###-####",cc:"SS",cd:"South Sudan",desc_en:"",name_ru:"\u042e\u0436\u043d\u044b\u0439 \u0421\u0443\u0434\u0430\u043d",desc_ru:""},{mask:"+239-##-#####",cc:"ST",cd:"Sao Tome and Principe",desc_en:"",name_ru:"\u0421\u0430\u043d-\u0422\u043e\u043c\u0435 \u0438 \u041f\u0440\u0438\u043d\u0441\u0438\u043f\u0438",desc_ru:""},{mask:"+503-##-##-####",cc:"SV",cd:"El Salvador",desc_en:"",name_ru:"\u0421\u0430\u043b\u044c\u0432\u0430\u0434\u043e\u0440",desc_ru:""},{mask:"+1(721)###-####",cc:"SX",cd:"Sint Maarten",desc_en:"",name_ru:"\u0421\u0438\u043d\u0442-\u041c\u0430\u0430\u0440\u0442\u0435\u043d",desc_ru:""},{mask:"+963-##-####-###",cc:"SY",cd:"Syrian Arab Republic",desc_en:"",name_ru:"\u0421\u0438\u0440\u0438\u0439\u0441\u043a\u0430\u044f \u0430\u0440\u0430\u0431\u0441\u043a\u0430\u044f \u0440\u0435\u0441\u043f\u0443\u0431\u043b\u0438\u043a\u0430",desc_ru:""},{mask:"+268-##-##-####",cc:"SZ",cd:"Swaziland",desc_en:"",name_ru:"\u0421\u0432\u0430\u0437\u0438\u043b\u0435\u043d\u0434",desc_ru:""},{mask:"+1(649)###-####",cc:"TC",cd:"Turks & Caicos",desc_en:"",name_ru:"\u0422\u0451\u0440\u043a\u0441 \u0438 \u041a\u0430\u0439\u043a\u043e\u0441",desc_ru:""},{mask:"+235-##-##-##-##",cc:"TD",cd:"Chad",desc_en:"",name_ru:"\u0427\u0430\u0434",desc_ru:""},{mask:"+228-##-###-###",cc:"TG",cd:"Togo",desc_en:"",name_ru:"\u0422\u043e\u0433\u043e",desc_ru:""},{mask:"+66-##-###-####",cc:"TH",cd:"Thailand ",desc_en:"mobile",name_ru:"\u0422\u0430\u0438\u043b\u0430\u043d\u0434 ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+66-##-###-###",cc:"TH",cd:"Thailand",desc_en:"",name_ru:"\u0422\u0430\u0438\u043b\u0430\u043d\u0434",desc_ru:""},{mask:"+992-##-###-####",cc:"TJ",cd:"Tajikistan",desc_en:"",name_ru:"\u0422\u0430\u0434\u0436\u0438\u043a\u0438\u0441\u0442\u0430\u043d",desc_ru:""},{mask:"+690-####",cc:"TK",cd:"Tokelau",desc_en:"",name_ru:"\u0422\u043e\u043a\u0435\u043b\u0430\u0443",desc_ru:""},{mask:"+670-###-####",cc:"TL",cd:"East Timor",desc_en:"",name_ru:"\u0412\u043e\u0441\u0442\u043e\u0447\u043d\u044b\u0439 \u0422\u0438\u043c\u043e\u0440",desc_ru:""},{mask:"+670-77#-#####",cc:"TL",cd:"East Timor",desc_en:"Timor Telecom",name_ru:"\u0412\u043e\u0441\u0442\u043e\u0447\u043d\u044b\u0439 \u0422\u0438\u043c\u043e\u0440",desc_ru:"Timor Telecom"},{mask:"+670-78#-#####",cc:"TL",cd:"East Timor",desc_en:"Timor Telecom",name_ru:"\u0412\u043e\u0441\u0442\u043e\u0447\u043d\u044b\u0439 \u0422\u0438\u043c\u043e\u0440",desc_ru:"Timor Telecom"},{mask:"+993-#-###-####",cc:"TM",cd:"Turkmenistan",desc_en:"",name_ru:"\u0422\u0443\u0440\u043a\u043c\u0435\u043d\u0438\u0441\u0442\u0430\u043d",desc_ru:""},{mask:"+216-##-###-###",cc:"TN",cd:"Tunisia",desc_en:"",name_ru:"\u0422\u0443\u043d\u0438\u0441",desc_ru:""},{mask:"+676-#####",cc:"TO",cd:"Tonga",desc_en:"",name_ru:"\u0422\u043e\u043d\u0433\u0430",desc_ru:""},{mask:"+90(###)###-####",cc:"TR",cd:"Turkey",desc_en:"",name_ru:"\u0422\u0443\u0440\u0446\u0438\u044f",desc_ru:""},{mask:"+1(868)###-####",cc:"TT",cd:"Trinidad & Tobago",desc_en:"",name_ru:"\u0422\u0440\u0438\u043d\u0438\u0434\u0430\u0434 \u0438 \u0422\u043e\u0431\u0430\u0433\u043e",desc_ru:""},{mask:"+688-90####",cc:"TV",cd:"Tuvalu ",desc_en:"mobile",name_ru:"\u0422\u0443\u0432\u0430\u043b\u0443 ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+688-2####",cc:"TV",cd:"Tuvalu",desc_en:"",name_ru:"\u0422\u0443\u0432\u0430\u043b\u0443",desc_ru:""},{mask:"+886-#-####-####",cc:"TW",cd:"Taiwan",desc_en:"",name_ru:"\u0422\u0430\u0439\u0432\u0430\u043d\u044c",desc_ru:""},{mask:"+886-####-####",cc:"TW",cd:"Taiwan",desc_en:"",name_ru:"\u0422\u0430\u0439\u0432\u0430\u043d\u044c",desc_ru:""},{mask:"+255-##-###-####",cc:"TZ",cd:"Tanzania",desc_en:"",name_ru:"\u0422\u0430\u043d\u0437\u0430\u043d\u0438\u044f",desc_ru:""},{mask:"+380(##)###-##-##",cc:"UA",cd:"Ukraine",desc_en:"",name_ru:"\u0423\u043a\u0440\u0430\u0438\u043d\u0430",desc_ru:""},{mask:"+256(###)###-###",cc:"UG",cd:"Uganda",desc_en:"",name_ru:"\u0423\u0433\u0430\u043d\u0434\u0430",desc_ru:""},{mask:"+44-##-####-####",cc:"UK",cd:"United Kingdom",desc_en:"",name_ru:"\u0412\u0435\u043b\u0438\u043a\u043e\u0431\u0440\u0438\u0442\u0430\u043d\u0438\u044f",desc_ru:""},{mask:"+598-#-###-##-##",cc:"UY",cd:"Uruguay",desc_en:"",name_ru:"\u0423\u0440\u0443\u0433\u0432\u0430\u0439",desc_ru:""},{mask:"+998-##-###-####",cc:"UZ",cd:"Uzbekistan",desc_en:"",name_ru:"\u0423\u0437\u0431\u0435\u043a\u0438\u0441\u0442\u0430\u043d",desc_ru:""},{mask:"+39-6-698-#####",cc:"VA",cd:"Vatican City",desc_en:"",name_ru:"\u0412\u0430\u0442\u0438\u043a\u0430\u043d",desc_ru:""},{mask:"+1(784)###-####",cc:"VC",cd:"Saint Vincent & the Grenadines",desc_en:"",name_ru:"\u0421\u0435\u043d\u0442-\u0412\u0438\u043d\u0441\u0435\u043d\u0442 \u0438 \u0413\u0440\u0435\u043d\u0430\u0434\u0438\u043d\u044b",desc_ru:""},{mask:"+58(###)###-####",cc:"VE",cd:"Venezuela",desc_en:"",name_ru:"\u0412\u0435\u043d\u0435\u0441\u0443\u044d\u043b\u0430",desc_ru:""},{mask:"+1(284)###-####",cc:"VG",cd:"British Virgin Islands",desc_en:"",name_ru:"\u0411\u0440\u0438\u0442\u0430\u043d\u0441\u043a\u0438\u0435 \u0412\u0438\u0440\u0433\u0438\u043d\u0441\u043a\u0438\u0435 \u043e\u0441\u0442\u0440\u043e\u0432\u0430",desc_ru:""},{mask:"+1(340)###-####",cc:"VI",cd:"US Virgin Islands",desc_en:"",name_ru:"\u0410\u043c\u0435\u0440\u0438\u043a\u0430\u043d\u0441\u043a\u0438\u0435 \u0412\u0438\u0440\u0433\u0438\u043d\u0441\u043a\u0438\u0435 \u043e\u0441\u0442\u0440\u043e\u0432\u0430",desc_ru:""},{mask:"+84-##-####-###",cc:"VN",cd:"Vietnam",desc_en:"",name_ru:"\u0412\u044c\u0435\u0442\u043d\u0430\u043c",desc_ru:""},{mask:"+84(###)####-###",cc:"VN",cd:"Vietnam",desc_en:"",name_ru:"\u0412\u044c\u0435\u0442\u043d\u0430\u043c",desc_ru:""},{mask:"+678-##-#####",cc:"VU",cd:"Vanuatu ",desc_en:"mobile",name_ru:"\u0412\u0430\u043d\u0443\u0430\u0442\u0443 ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+678-#####",cc:"VU",cd:"Vanuatu",desc_en:"",name_ru:"\u0412\u0430\u043d\u0443\u0430\u0442\u0443",desc_ru:""},{mask:"+681-##-####",cc:"WF",cd:"Wallis and Futuna",desc_en:"",name_ru:"\u0423\u043e\u043b\u043b\u0438\u0441 \u0438 \u0424\u0443\u0442\u0443\u043d\u0430",desc_ru:""},{mask:"+685-##-####",cc:"WS",cd:"Samoa",desc_en:"",name_ru:"\u0421\u0430\u043c\u043e\u0430",desc_ru:""},{mask:"+967-###-###-###",cc:"YE",cd:"Yemen ",desc_en:"mobile",name_ru:"\u0419\u0435\u043c\u0435\u043d ",desc_ru:"\u043c\u043e\u0431\u0438\u043b\u044c\u043d\u044b\u0435"},{mask:"+967-#-###-###",cc:"YE",cd:"Yemen",desc_en:"",name_ru:"\u0419\u0435\u043c\u0435\u043d",desc_ru:""},{mask:"+967-##-###-###",cc:"YE",cd:"Yemen",desc_en:"",name_ru:"\u0419\u0435\u043c\u0435\u043d",desc_ru:""},{mask:"+27-##-###-####",cc:"ZA",cd:"South Africa",desc_en:"",name_ru:"\u042e\u0436\u043d\u043e-\u0410\u0444\u0440\u0438\u043a\u0430\u043d\u0441\u043a\u0430\u044f \u0420\u0435\u0441\u043f.",desc_ru:""},{mask:"+260-##-###-####",cc:"ZM",cd:"Zambia",desc_en:"",name_ru:"\u0417\u0430\u043c\u0431\u0438\u044f",desc_ru:""},{mask:"+263-#-######",cc:"ZW",cd:"Zimbabwe",desc_en:"",name_ru:"\u0417\u0438\u043c\u0431\u0430\u0431\u0432\u0435",desc_ru:""},{mask:"+1(###)###-####",cc:["US","CA"],cd:"USA and Canada",desc_en:"",name_ru:"\u0421\u0428\u0410 \u0438 \u041a\u0430\u043d\u0430\u0434\u0430",desc_ru:""}]}}),a});/*!
 * validate.js 0.11.1
 *
 * (c) 2013-2016 Nicklas Ansman, 2013 Wrapp
 * Validate.js may be freely distributed under the MIT license.
 * For all details and documentation:
 * http://validatejs.org/
 */

(function(exports, module, define) {
  "use strict";

  // The main function that calls the validators specified by the constraints.
  // The options are the following:
  //   - format (string) - An option that controls how the returned value is formatted
  //     * flat - Returns a flat array of just the error messages
  //     * grouped - Returns the messages grouped by attribute (default)
  //     * detailed - Returns an array of the raw validation data
  //   - fullMessages (boolean) - If `true` (default) the attribute name is prepended to the error.
  //
  // Please note that the options are also passed to each validator.
  var validate = function(attributes, constraints, options) {
    options = v.extend({}, v.options, options);

    var results = v.runValidations(attributes, constraints, options)
      , attr
      , validator;

    for (attr in results) {
      for (validator in results[attr]) {
        if (v.isPromise(results[attr][validator])) {
          throw new Error("Use validate.async if you want support for promises");
        }
      }
    }
    return validate.processValidationResults(results, options);
  };

  var v = validate;

  // Copies over attributes from one or more sources to a single destination.
  // Very much similar to underscore's extend.
  // The first argument is the target object and the remaining arguments will be
  // used as sources.
  v.extend = function(obj) {
    [].slice.call(arguments, 1).forEach(function(source) {
      for (var attr in source) {
        obj[attr] = source[attr];
      }
    });
    return obj;
  };

  v.extend(validate, {
    // This is the version of the library as a semver.
    // The toString function will allow it to be coerced into a string
    version: {
      major: 0,
      minor: 11,
      patch: 1,
      metadata: null,
      toString: function() {
        var version = v.format("%{major}.%{minor}.%{patch}", v.version);
        if (!v.isEmpty(v.version.metadata)) {
          version += "+" + v.version.metadata;
        }
        return version;
      }
    },

    // Below is the dependencies that are used in validate.js

    // The constructor of the Promise implementation.
    // If you are using Q.js, RSVP or any other A+ compatible implementation
    // override this attribute to be the constructor of that promise.
    // Since jQuery promises aren't A+ compatible they won't work.
    Promise: typeof Promise !== "undefined" ? Promise : /* istanbul ignore next */ null,

    EMPTY_STRING_REGEXP: /^\s*$/,

    // Runs the validators specified by the constraints object.
    // Will return an array of the format:
    //     [{attribute: "<attribute name>", error: "<validation result>"}, ...]
    runValidations: function(attributes, constraints, options) {
      var results = []
        , attr
        , validatorName
        , value
        , validators
        , validator
        , validatorOptions
        , error;

      if (v.isDomElement(attributes) || v.isJqueryElement(attributes)) {
        attributes = v.collectFormValues(attributes);
      }

      // Loops through each constraints, finds the correct validator and run it.
      for (attr in constraints) {
        value = v.getDeepObjectValue(attributes, attr);
        // This allows the constraints for an attribute to be a function.
        // The function will be called with the value, attribute name, the complete dict of
        // attributes as well as the options and constraints passed in.
        // This is useful when you want to have different
        // validations depending on the attribute value.
        validators = v.result(constraints[attr], value, attributes, attr, options, constraints);

        for (validatorName in validators) {
          validator = v.validators[validatorName];

          if (!validator) {
            error = v.format("Unknown validator %{name}", {name: validatorName});
            throw new Error(error);
          }

          validatorOptions = validators[validatorName];
          // This allows the options to be a function. The function will be
          // called with the value, attribute name, the complete dict of
          // attributes as well as the options and constraints passed in.
          // This is useful when you want to have different
          // validations depending on the attribute value.
          validatorOptions = v.result(validatorOptions, value, attributes, attr, options, constraints);
          if (!validatorOptions) {
            continue;
          }
          results.push({
            attribute: attr,
            value: value,
            validator: validatorName,
            globalOptions: options,
            attributes: attributes,
            options: validatorOptions,
            error: validator.call(validator,
                value,
                validatorOptions,
                attr,
                attributes,
                options)
          });
        }
      }

      return results;
    },

    // Takes the output from runValidations and converts it to the correct
    // output format.
    processValidationResults: function(errors, options) {
      errors = v.pruneEmptyErrors(errors, options);
      errors = v.expandMultipleErrors(errors, options);
      errors = v.convertErrorMessages(errors, options);

      var format = options.format || "grouped";

      if (typeof v.formatters[format] === 'function') {
        errors = v.formatters[format](errors);
      } else {
        throw new Error(v.format("Unknown format %{format}", options));
      }

      return v.isEmpty(errors) ? undefined : errors;
    },

    // Runs the validations with support for promises.
    // This function will return a promise that is settled when all the
    // validation promises have been completed.
    // It can be called even if no validations returned a promise.
    async: function(attributes, constraints, options) {
      options = v.extend({}, v.async.options, options);

      var WrapErrors = options.wrapErrors || function(errors) {
        return errors;
      };

      // Removes unknown attributes
      if (options.cleanAttributes !== false) {
        attributes = v.cleanAttributes(attributes, constraints);
      }

      var results = v.runValidations(attributes, constraints, options);

      return new v.Promise(function(resolve, reject) {
        v.waitForResults(results).then(function() {
          var errors = v.processValidationResults(results, options);
          if (errors) {
            reject(new WrapErrors(errors, options, attributes, constraints));
          } else {
            resolve(attributes);
          }
        }, function(err) {
          reject(err);
        });
      });
    },

    single: function(value, constraints, options) {
      options = v.extend({}, v.single.options, options, {
        format: "flat",
        fullMessages: false
      });
      return v({single: value}, {single: constraints}, options);
    },

    // Returns a promise that is resolved when all promises in the results array
    // are settled. The promise returned from this function is always resolved,
    // never rejected.
    // This function modifies the input argument, it replaces the promises
    // with the value returned from the promise.
    waitForResults: function(results) {
      // Create a sequence of all the results starting with a resolved promise.
      return results.reduce(function(memo, result) {
        // If this result isn't a promise skip it in the sequence.
        if (!v.isPromise(result.error)) {
          return memo;
        }

        return memo.then(function() {
          return result.error.then(function(error) {
            result.error = error || null;
          });
        });
      }, new v.Promise(function(r) { r(); })); // A resolved promise
    },

    // If the given argument is a call: function the and: function return the value
    // otherwise just return the value. Additional arguments will be passed as
    // arguments to the function.
    // Example:
    // ```
    // result('foo') // 'foo'
    // result(Math.max, 1, 2) // 2
    // ```
    result: function(value) {
      var args = [].slice.call(arguments, 1);
      if (typeof value === 'function') {
        value = value.apply(null, args);
      }
      return value;
    },

    // Checks if the value is a number. This function does not consider NaN a
    // number like many other `isNumber` functions do.
    isNumber: function(value) {
      return typeof value === 'number' && !isNaN(value);
    },

    // Returns false if the object is not a function
    isFunction: function(value) {
      return typeof value === 'function';
    },

    // A simple check to verify that the value is an integer. Uses `isNumber`
    // and a simple modulo check.
    isInteger: function(value) {
      return v.isNumber(value) && value % 1 === 0;
    },

    // Checks if the value is a boolean
    isBoolean: function(value) {
      return typeof value === 'boolean';
    },

    // Uses the `Object` function to check if the given argument is an object.
    isObject: function(obj) {
      return obj === Object(obj);
    },

    // Simply checks if the object is an instance of a date
    isDate: function(obj) {
      return obj instanceof Date;
    },

    // Returns false if the object is `null` of `undefined`
    isDefined: function(obj) {
      return obj !== null && obj !== undefined;
    },

    // Checks if the given argument is a promise. Anything with a `then`
    // function is considered a promise.
    isPromise: function(p) {
      return !!p && v.isFunction(p.then);
    },

    isJqueryElement: function(o) {
      return o && v.isString(o.jquery);
    },

    isDomElement: function(o) {
      if (!o) {
        return false;
      }

      if (!o.querySelectorAll || !o.querySelector) {
        return false;
      }

      if (v.isObject(document) && o === document) {
        return true;
      }

      // http://stackoverflow.com/a/384380/699304
      /* istanbul ignore else */
      if (typeof HTMLElement === "object") {
        return o instanceof HTMLElement;
      } else {
        return o &&
          typeof o === "object" &&
          o !== null &&
          o.nodeType === 1 &&
          typeof o.nodeName === "string";
      }
    },

    isEmpty: function(value) {
      var attr;

      // Null and undefined are empty
      if (!v.isDefined(value)) {
        return true;
      }

      // functions are non empty
      if (v.isFunction(value)) {
        return false;
      }

      // Whitespace only strings are empty
      if (v.isString(value)) {
        return v.EMPTY_STRING_REGEXP.test(value);
      }

      // For arrays we use the length property
      if (v.isArray(value)) {
        return value.length === 0;
      }

      // Dates have no attributes but aren't empty
      if (v.isDate(value)) {
        return false;
      }

      // If we find at least one property we consider it non empty
      if (v.isObject(value)) {
        for (attr in value) {
          return false;
        }
        return true;
      }

      return false;
    },

    // Formats the specified strings with the given values like so:
    // ```
    // format("Foo: %{foo}", {foo: "bar"}) // "Foo bar"
    // ```
    // If you want to write %{...} without having it replaced simply
    // prefix it with % like this `Foo: %%{foo}` and it will be returned
    // as `"Foo: %{foo}"`
    format: v.extend(function(str, vals) {
      if (!v.isString(str)) {
        return str;
      }
      return str.replace(v.format.FORMAT_REGEXP, function(m0, m1, m2) {
        if (m1 === '%') {
          return "%{" + m2 + "}";
        } else {
          return String(vals[m2]);
        }
      });
    }, {
      // Finds %{key} style patterns in the given string
      FORMAT_REGEXP: /(%?)%\{([^\}]+)\}/g
    }),

    // "Prettifies" the given string.
    // Prettifying means replacing [.\_-] with spaces as well as splitting
    // camel case words.
    prettify: function(str) {
      if (v.isNumber(str)) {
        // If there are more than 2 decimals round it to two
        if ((str * 100) % 1 === 0) {
          return "" + str;
        } else {
          return parseFloat(Math.round(str * 100) / 100).toFixed(2);
        }
      }

      if (v.isArray(str)) {
        return str.map(function(s) { return v.prettify(s); }).join(", ");
      }

      if (v.isObject(str)) {
        return str.toString();
      }

      // Ensure the string is actually a string
      str = "" + str;

      return str
        // Splits keys separated by periods
        .replace(/([^\s])\.([^\s])/g, '$1 $2')
        // Removes backslashes
        .replace(/\\+/g, '')
        // Replaces - and - with space
        .replace(/[_-]/g, ' ')
        // Splits camel cased words
        .replace(/([a-z])([A-Z])/g, function(m0, m1, m2) {
          return "" + m1 + " " + m2.toLowerCase();
        })
        .toLowerCase();
    },

    stringifyValue: function(value) {
      return v.prettify(value);
    },

    isString: function(value) {
      return typeof value === 'string';
    },

    isArray: function(value) {
      return {}.toString.call(value) === '[object Array]';
    },

    // Checks if the object is a hash, which is equivalent to an object that
    // is neither an array nor a function.
    isHash: function(value) {
      return v.isObject(value) && !v.isArray(value) && !v.isFunction(value);
    },

    contains: function(obj, value) {
      if (!v.isDefined(obj)) {
        return false;
      }
      if (v.isArray(obj)) {
        return obj.indexOf(value) !== -1;
      }
      return value in obj;
    },

    unique: function(array) {
      if (!v.isArray(array)) {
        return array;
      }
      return array.filter(function(el, index, array) {
        return array.indexOf(el) == index;
      });
    },

    forEachKeyInKeypath: function(object, keypath, callback) {
      if (!v.isString(keypath)) {
        return undefined;
      }

      var key = ""
        , i
        , escape = false;

      for (i = 0; i < keypath.length; ++i) {
        switch (keypath[i]) {
          case '.':
            if (escape) {
              escape = false;
              key += '.';
            } else {
              object = callback(object, key, false);
              key = "";
            }
            break;

          case '\\':
            if (escape) {
              escape = false;
              key += '\\';
            } else {
              escape = true;
            }
            break;

          default:
            escape = false;
            key += keypath[i];
            break;
        }
      }

      return callback(object, key, true);
    },

    getDeepObjectValue: function(obj, keypath) {
      if (!v.isObject(obj)) {
        return undefined;
      }

      return v.forEachKeyInKeypath(obj, keypath, function(obj, key) {
        if (v.isObject(obj)) {
          return obj[key];
        }
      });
    },

    // This returns an object with all the values of the form.
    // It uses the input name as key and the value as value
    // So for example this:
    // <input type="text" name="email" value="foo@bar.com" />
    // would return:
    // {email: "foo@bar.com"}
    collectFormValues: function(form, options) {
      var values = {}
        , i
        , j
        , input
        , inputs
        , option
        , value;

      if (v.isJqueryElement(form)) {
        form = form[0];
      }

      if (!form) {
        return values;
      }

      options = options || {};

      inputs = form.querySelectorAll("input[name], textarea[name]");
      for (i = 0; i < inputs.length; ++i) {
        input = inputs.item(i);

        if (v.isDefined(input.getAttribute("data-ignored"))) {
          continue;
        }

        value = v.sanitizeFormValue(input.value, options);
        if (input.type === "number") {
          value = value ? +value : null;
        } else if (input.type === "checkbox") {
          if (input.attributes.value) {
            if (!input.checked) {
              value = values[input.name] || null;
            }
          } else {
            value = input.checked;
          }
        } else if (input.type === "radio") {
          if (!input.checked) {
            value = values[input.name] || null;
          }
        }
        values[input.name] = value;
      }

      inputs = form.querySelectorAll("select[name]");
      for (i = 0; i < inputs.length; ++i) {
        input = inputs.item(i);
        if (input.multiple) {
          value = [];
          for (j in input.options) {
            option = input.options[j];
            if (option.selected) {
              value.push(v.sanitizeFormValue(option.value, options));
            }
          }
        } else {
          value = v.sanitizeFormValue(input.options[input.selectedIndex].value, options);
        }
        values[input.name] = value;
      }

      return values;
    },

    sanitizeFormValue: function(value, options) {
      if (options.trim && v.isString(value)) {
        value = value.trim();
      }

      if (options.nullify !== false && value === "") {
        return null;
      }
      return value;
    },

    capitalize: function(str) {
      if (!v.isString(str)) {
        return str;
      }
      return str[0].toUpperCase() + str.slice(1);
    },

    // Remove all errors who's error attribute is empty (null or undefined)
    pruneEmptyErrors: function(errors) {
      return errors.filter(function(error) {
        return !v.isEmpty(error.error);
      });
    },

    // In
    // [{error: ["err1", "err2"], ...}]
    // Out
    // [{error: "err1", ...}, {error: "err2", ...}]
    //
    // All attributes in an error with multiple messages are duplicated
    // when expanding the errors.
    expandMultipleErrors: function(errors) {
      var ret = [];
      errors.forEach(function(error) {
        // Removes errors without a message
        if (v.isArray(error.error)) {
          error.error.forEach(function(msg) {
            ret.push(v.extend({}, error, {error: msg}));
          });
        } else {
          ret.push(error);
        }
      });
      return ret;
    },

    // Converts the error mesages by prepending the attribute name unless the
    // message is prefixed by ^
    convertErrorMessages: function(errors, options) {
      options = options || {};

      var ret = [];
      errors.forEach(function(errorInfo) {
        var error = v.result(errorInfo.error,
            errorInfo.value,
            errorInfo.attribute,
            errorInfo.options,
            errorInfo.attributes,
            errorInfo.globalOptions);

        if (!v.isString(error)) {
          ret.push(errorInfo);
          return;
        }

        if (error[0] === '^') {
          error = error.slice(1);
        } else if (options.fullMessages !== false) {
          error = v.capitalize(v.prettify(errorInfo.attribute)) + " " + error;
        }
        error = error.replace(/\\\^/g, "^");
        error = v.format(error, {value: v.stringifyValue(errorInfo.value)});
        ret.push(v.extend({}, errorInfo, {error: error}));
      });
      return ret;
    },

    // In:
    // [{attribute: "<attributeName>", ...}]
    // Out:
    // {"<attributeName>": [{attribute: "<attributeName>", ...}]}
    groupErrorsByAttribute: function(errors) {
      var ret = {};
      errors.forEach(function(error) {
        var list = ret[error.attribute];
        if (list) {
          list.push(error);
        } else {
          ret[error.attribute] = [error];
        }
      });
      return ret;
    },

    // In:
    // [{error: "<message 1>", ...}, {error: "<message 2>", ...}]
    // Out:
    // ["<message 1>", "<message 2>"]
    flattenErrorsToArray: function(errors) {
      return errors
        .map(function(error) { return error.error; })
        .filter(function(value, index, self) {
          return self.indexOf(value) === index;
        });
    },

    cleanAttributes: function(attributes, whitelist) {
      function whitelistCreator(obj, key, last) {
        if (v.isObject(obj[key])) {
          return obj[key];
        }
        return (obj[key] = last ? true : {});
      }

      function buildObjectWhitelist(whitelist) {
        var ow = {}
          , lastObject
          , attr;
        for (attr in whitelist) {
          if (!whitelist[attr]) {
            continue;
          }
          v.forEachKeyInKeypath(ow, attr, whitelistCreator);
        }
        return ow;
      }

      function cleanRecursive(attributes, whitelist) {
        if (!v.isObject(attributes)) {
          return attributes;
        }

        var ret = v.extend({}, attributes)
          , w
          , attribute;

        for (attribute in attributes) {
          w = whitelist[attribute];

          if (v.isObject(w)) {
            ret[attribute] = cleanRecursive(ret[attribute], w);
          } else if (!w) {
            delete ret[attribute];
          }
        }
        return ret;
      }

      if (!v.isObject(whitelist) || !v.isObject(attributes)) {
        return {};
      }

      whitelist = buildObjectWhitelist(whitelist);
      return cleanRecursive(attributes, whitelist);
    },

    exposeModule: function(validate, root, exports, module, define) {
      if (exports) {
        if (module && module.exports) {
          exports = module.exports = validate;
        }
        exports.validate = validate;
      } else {
        root.validate = validate;
        if (validate.isFunction(define) && define.amd) {
          define([], function () { return validate; });
        }
      }
    },

    warn: function(msg) {
      if (typeof console !== "undefined" && console.warn) {
        console.warn("[validate.js] " + msg);
      }
    },

    error: function(msg) {
      if (typeof console !== "undefined" && console.error) {
        console.error("[validate.js] " + msg);
      }
    }
  });

  validate.validators = {
    // Presence validates that the value isn't empty
    presence: function(value, options) {
      options = v.extend({}, this.options, options);
      if (options.allowEmpty ? !v.isDefined(value) : v.isEmpty(value)) {
        return options.message || this.message || "can't be blank";
      }
    },
    length: function(value, options, attribute) {
      // Empty values are allowed
      if (!v.isDefined(value)) {
        return;
      }

      options = v.extend({}, this.options, options);

      var is = options.is
        , maximum = options.maximum
        , minimum = options.minimum
        , tokenizer = options.tokenizer || function(val) { return val; }
        , err
        , errors = [];

      value = tokenizer(value);
      var length = value.length;
      if(!v.isNumber(length)) {
        v.error(v.format("Attribute %{attr} has a non numeric value for `length`", {attr: attribute}));
        return options.message || this.notValid || "has an incorrect length";
      }

      // Is checks
      if (v.isNumber(is) && length !== is) {
        err = options.wrongLength ||
          this.wrongLength ||
          "is the wrong length (should be %{count} characters)";
        errors.push(v.format(err, {count: is}));
      }

      if (v.isNumber(minimum) && length < minimum) {
        err = options.tooShort ||
          this.tooShort ||
          "is too short (minimum is %{count} characters)";
        errors.push(v.format(err, {count: minimum}));
      }

      if (v.isNumber(maximum) && length > maximum) {
        err = options.tooLong ||
          this.tooLong ||
          "is too long (maximum is %{count} characters)";
        errors.push(v.format(err, {count: maximum}));
      }

      if (errors.length > 0) {
        return options.message || errors;
      }
    },
    numericality: function(value, options) {
      // Empty values are fine
      if (!v.isDefined(value)) {
        return;
      }

      options = v.extend({}, this.options, options);

      var errors = []
        , name
        , count
        , checks = {
            greaterThan:          function(v, c) { return v > c; },
            greaterThanOrEqualTo: function(v, c) { return v >= c; },
            equalTo:              function(v, c) { return v === c; },
            lessThan:             function(v, c) { return v < c; },
            lessThanOrEqualTo:    function(v, c) { return v <= c; },
            divisibleBy:          function(v, c) { return v % c === 0; }
          };

      // Strict will check that it is a valid looking number
      if (v.isString(value) && options.strict) {
        var pattern = "^(0|[1-9]\\d*)";
        if (!options.onlyInteger) {
          pattern += "(\\.\\d+)?";
        }
        pattern += "$";

        if (!(new RegExp(pattern).test(value))) {
          return options.message ||
            options.notValid ||
            this.notValid ||
            this.message ||
            "must be a valid number";
        }
      }

      // Coerce the value to a number unless we're being strict.
      if (options.noStrings !== true && v.isString(value) && !v.isEmpty(value)) {
        value = +value;
      }

      // If it's not a number we shouldn't continue since it will compare it.
      if (!v.isNumber(value)) {
        return options.message ||
          options.notValid ||
          this.notValid ||
          this.message ||
          "is not a number";
      }

      // Same logic as above, sort of. Don't bother with comparisons if this
      // doesn't pass.
      if (options.onlyInteger && !v.isInteger(value)) {
        return options.message ||
          options.notInteger ||
          this.notInteger ||
          this.message ||
          "must be an integer";
      }

      for (name in checks) {
        count = options[name];
        if (v.isNumber(count) && !checks[name](value, count)) {
          // This picks the default message if specified
          // For example the greaterThan check uses the message from
          // this.notGreaterThan so we capitalize the name and prepend "not"
          var key = "not" + v.capitalize(name);
          var msg = options[key] ||
            this[key] ||
            this.message ||
            "must be %{type} %{count}";

          errors.push(v.format(msg, {
            count: count,
            type: v.prettify(name)
          }));
        }
      }

      if (options.odd && value % 2 !== 1) {
        errors.push(options.notOdd ||
            this.notOdd ||
            this.message ||
            "must be odd");
      }
      if (options.even && value % 2 !== 0) {
        errors.push(options.notEven ||
            this.notEven ||
            this.message ||
            "must be even");
      }

      if (errors.length) {
        return options.message || errors;
      }
    },
    datetime: v.extend(function(value, options) {
      if (!v.isFunction(this.parse) || !v.isFunction(this.format)) {
        throw new Error("Both the parse and format functions needs to be set to use the datetime/date validator");
      }

      // Empty values are fine
      if (!v.isDefined(value)) {
        return;
      }

      options = v.extend({}, this.options, options);

      var err
        , errors = []
        , earliest = options.earliest ? this.parse(options.earliest, options) : NaN
        , latest = options.latest ? this.parse(options.latest, options) : NaN;

      value = this.parse(value, options);

      // 86400000 is the number of seconds in a day, this is used to remove
      // the time from the date
      if (isNaN(value) || options.dateOnly && value % 86400000 !== 0) {
        err = options.notValid ||
          options.message ||
          this.notValid ||
          "must be a valid date";
        return v.format(err, {value: arguments[0]});
      }

      if (!isNaN(earliest) && value < earliest) {
        err = options.tooEarly ||
          options.message ||
          this.tooEarly ||
          "must be no earlier than %{date}";
        err = v.format(err, {
          value: this.format(value, options),
          date: this.format(earliest, options)
        });
        errors.push(err);
      }

      if (!isNaN(latest) && value > latest) {
        err = options.tooLate ||
          options.message ||
          this.tooLate ||
          "must be no later than %{date}";
        err = v.format(err, {
          date: this.format(latest, options),
          value: this.format(value, options)
        });
        errors.push(err);
      }

      if (errors.length) {
        return v.unique(errors);
      }
    }, {
      parse: null,
      format: null
    }),
    date: function(value, options) {
      options = v.extend({}, options, {dateOnly: true});
      return v.validators.datetime.call(v.validators.datetime, value, options);
    },
    format: function(value, options) {
      if (v.isString(options) || (options instanceof RegExp)) {
        options = {pattern: options};
      }

      options = v.extend({}, this.options, options);

      var message = options.message || this.message || "is invalid"
        , pattern = options.pattern
        , match;

      // Empty values are allowed
      if (!v.isDefined(value)) {
        return;
      }
      if (!v.isString(value)) {
        return message;
      }

      if (v.isString(pattern)) {
        pattern = new RegExp(options.pattern, options.flags);
      }
      match = pattern.exec(value);
      if (!match || match[0].length != value.length) {
        return message;
      }
    },
    inclusion: function(value, options) {
      // Empty values are fine
      if (!v.isDefined(value)) {
        return;
      }
      if (v.isArray(options)) {
        options = {within: options};
      }
      options = v.extend({}, this.options, options);
      if (v.contains(options.within, value)) {
        return;
      }
      var message = options.message ||
        this.message ||
        "^%{value} is not included in the list";
      return v.format(message, {value: value});
    },
    exclusion: function(value, options) {
      // Empty values are fine
      if (!v.isDefined(value)) {
        return;
      }
      if (v.isArray(options)) {
        options = {within: options};
      }
      options = v.extend({}, this.options, options);
      if (!v.contains(options.within, value)) {
        return;
      }
      var message = options.message || this.message || "^%{value} is restricted";
      return v.format(message, {value: value});
    },
    email: v.extend(function(value, options) {
      options = v.extend({}, this.options, options);
      var message = options.message || this.message || "is not a valid email";
      // Empty values are fine
      if (!v.isDefined(value)) {
        return;
      }
      if (!v.isString(value)) {
        return message;
      }
      if (!this.PATTERN.exec(value)) {
        return message;
      }
    }, {
      PATTERN: /^[a-z0-9\u007F-\uffff!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9\u007F-\uffff!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z]{2,}$/i
    }),
    equality: function(value, options, attribute, attributes) {
      if (!v.isDefined(value)) {
        return;
      }

      if (v.isString(options)) {
        options = {attribute: options};
      }
      options = v.extend({}, this.options, options);
      var message = options.message ||
        this.message ||
        "is not equal to %{attribute}";

      if (v.isEmpty(options.attribute) || !v.isString(options.attribute)) {
        throw new Error("The attribute must be a non empty string");
      }

      var otherValue = v.getDeepObjectValue(attributes, options.attribute)
        , comparator = options.comparator || function(v1, v2) {
          return v1 === v2;
        };

      if (!comparator(value, otherValue, options, attribute, attributes)) {
        return v.format(message, {attribute: v.prettify(options.attribute)});
      }
    },

    // A URL validator that is used to validate URLs with the ability to
    // restrict schemes and some domains.
    url: function(value, options) {
      if (!v.isDefined(value)) {
        return;
      }

      options = v.extend({}, this.options, options);

      var message = options.message || this.message || "is not a valid url"
        , schemes = options.schemes || this.schemes || ['http', 'https']
        , allowLocal = options.allowLocal || this.allowLocal || false;

      if (!v.isString(value)) {
        return message;
      }

      // https://gist.github.com/dperini/729294
      var regex =
        "^" +
        // protocol identifier
        "(?:(?:" + schemes.join("|") + ")://)" +
        // user:pass authentication
        "(?:\\S+(?::\\S*)?@)?" +
        "(?:";

      var tld = "(?:\\.(?:[a-z\\u00a1-\\uffff]{2,}))";

      if (allowLocal) {
        tld += "?";
      } else {
        regex +=
          // IP address exclusion
          // private & local networks
          "(?!(?:10|127)(?:\\.\\d{1,3}){3})" +
          "(?!(?:169\\.254|192\\.168)(?:\\.\\d{1,3}){2})" +
          "(?!172\\.(?:1[6-9]|2\\d|3[0-1])(?:\\.\\d{1,3}){2})";
      }

      regex +=
          // IP address dotted notation octets
          // excludes loopback network 0.0.0.0
          // excludes reserved space >= 224.0.0.0
          // excludes network & broacast addresses
          // (first & last IP address of each class)
          "(?:[1-9]\\d?|1\\d\\d|2[01]\\d|22[0-3])" +
          "(?:\\.(?:1?\\d{1,2}|2[0-4]\\d|25[0-5])){2}" +
          "(?:\\.(?:[1-9]\\d?|1\\d\\d|2[0-4]\\d|25[0-4]))" +
        "|" +
          // host name
          "(?:(?:[a-z\\u00a1-\\uffff0-9]-*)*[a-z\\u00a1-\\uffff0-9]+)" +
          // domain name
          "(?:\\.(?:[a-z\\u00a1-\\uffff0-9]-*)*[a-z\\u00a1-\\uffff0-9]+)*" +
          tld +
        ")" +
        // port number
        "(?::\\d{2,5})?" +
        // resource path
        "(?:[/?#]\\S*)?" +
      "$";

      var PATTERN = new RegExp(regex, 'i');
      if (!PATTERN.exec(value)) {
        return message;
      }
    }
  };

  validate.formatters = {
    detailed: function(errors) {return errors;},
    flat: v.flattenErrorsToArray,
    grouped: function(errors) {
      var attr;

      errors = v.groupErrorsByAttribute(errors);
      for (attr in errors) {
        errors[attr] = v.flattenErrorsToArray(errors[attr]);
      }
      return errors;
    },
    constraint: function(errors) {
      var attr;
      errors = v.groupErrorsByAttribute(errors);
      for (attr in errors) {
        errors[attr] = errors[attr].map(function(result) {
          return result.validator;
        }).sort();
      }
      return errors;
    }
  };

  validate.exposeModule(validate, this, exports, module, define);
}).call(this,
        typeof exports !== 'undefined' ? /* istanbul ignore next */ exports : null,
        typeof module !== 'undefined' ? /* istanbul ignore next */ module : null,
        typeof define !== 'undefined' ? /* istanbul ignore next */ define : null);
/*
jQuery.wizard v1.1.3
https://github.com/kflorence/jquery-wizard/
An asynchronous form wizard that supports branching.

Requires:
 - jQuery 1.6.0+
 - jQuery UI widget 1.9.0+

Copyright (c) 2017 Kyle Florence
Dual licensed under the MIT and GPLv2 licenses.
*/

(function( $, undefined ) {

var count = 0,
	selector = {},
	className = {},

	// Reference to commonly used methods
	aps = Array.prototype.slice,

	// Used to normalize function arguments that can be either
	// an array of values or a single value
	arr = function( obj ) {
		return $.isArray( obj ) ? obj : [ obj ];
	},

	// Commonly used strings
	id = "id",
	form = "form",
	click = "click",
	submit = "submit",
	disabled = "disabled",
	namespace = "kf-wizard",
	wizard = "wizard",

	def = "default",
	num = "number",
	obj = "object",
	str = "string",
	bool = "boolean",

	// Events
	afterBackward = "afterBackward",
	afterDestroy = "afterDestroy",
	afterForward = "afterForward",
	afterSelect = "afterSelect",
	beforeBackward = "beforeBackward",
	beforeDestroy = "beforeDestroy",
	beforeForward = "beforeForward",
	beforeSelect = "beforeSelect",
	beforeSubmit = "beforeSubmit";

// Generate selectors and class names for common wizard elements
$.each( "branch form header step wrapper".split( " " ), function() {
	selector[ this ] = "." + ( className[ this ] = wizard + "-" + this );
});

$.widget( "kf." + wizard, {
	version: "1.1.3",
	options: {
		animations: {
			show: {
				options: {
					duration: 0
				},
				properties: {
					opacity: "show"
				}
			},
			hide: {
				options: {
					duration: 0
				},
				properties: {
					opacity: "hide"
				}
			}
		},
		backward: ".backward",
		branches: ".branch",
		disabled: false,
		enableSubmit: false,
		forward: ".forward",
		header: ":header:first",
		initialStep: 0,
		stateAttribute: "data-state",
		stepClasses: {
			current: "current",
			exclude: "exclude",
			stop: "stop",
			submit: "submit",
			unidirectional: "unidirectional"
		},
		steps: ".step",
		submit: ":submit",
		transitions: {},
		unidirectional: false,

		/* callbacks */
		afterBackward: null,
		afterDestroy: null,
		afterForward: null,
		afterSelect: null,
		beforeBackward: null,
		beforeDestroy: null,
		beforeForward: null,
		beforeSelect: null,
		create: null
	},

	_create: function() {
		var $form, $header,
			self = this,
			o = self.options,
			$element = self.element,
			$steps = $element.find( o.steps ),
			$stepsWrapper = $steps.eq( 0 ).parent();

		if ( $element[ 0 ].elements ) {
			$form = $element;

		// If element isn't form, look inside and outside element
		} else if ( !( $form = $element.find( form ) ).length ) {
			$form = $element.closest( form );
		}

		// If header isn't found in element, look in form scope
		if ( !( $header = $element.find( o.header ) ).length ) {
			$header = $form.find( o.header );
		}

		self.elements = {
			form: $form.addClass( className.form ),
			submit: $form.find( o.submit ),
			forward: $form.find( o.forward ),
			backward: $form.find( o.backward ),
			header: $header.addClass( className.header ),
			steps: $element.find( o.steps ).hide().addClass( className.step ),
			branches: $element.find( o.branches ).add( $stepsWrapper ).addClass( className.branch ),
			stepsWrapper: $stepsWrapper.addClass( className.wrapper ),
			wizard: $element.addClass( wizard )
		};

		if ( !$stepsWrapper.attr( id ) ) {

			// stepsWrapper must have an ID as it also functions as the default branch
			$stepsWrapper.attr( id, wizard + "-" + ( ++count ) );
		}

		self.elements.forward.on( "click." + namespace, function( event ) {
			event.preventDefault();
			self.forward( event );
		});

		self.elements.backward.on( "click." + namespace, function( event ) {
			event.preventDefault();
			self.backward( event );
		});

		self._currentState = {
			branchesActivated: [],
			stepsActivated: []
		};

		self._stepCount = self.elements.steps.length;
		self._lastStepIndex = self._stepCount - 1;

		// Cache branch labels for quick access later
		self._branchLabels = [];
		self.elements.steps.each(function( i ) {
			self._branchLabels[ i ] = $( this ).parent().attr( id );
		});

		// Called in the context of jQuery's .filter() method in _state()
		self._excludesFilter = function() {
			return !$( this ).hasClass( o.stepClasses.exclude );
		};

		// Add default transition function if one wasn't defined
		if ( !o.transitions[ def ] ) {
			o.transitions[ def ] = function( state ) {
				return self.stepIndex( state.step.nextAll( selector.step ) );
			};
		}

		// Select initial step
		self.select.apply( self, arr( o.initialStep ) );
	},

	_fastForward: function( toIndex, relative, callback ) {
		var i = 0,
			self = this,
			stepIndex = self._currentState.stepIndex,
			stepsTaken = [ stepIndex ];

		if ( $.isFunction( relative ) ) {
			callback = relative;
			relative = undefined;
		}

		(function next() {
			self._transition( self._state( stepIndex, stepsTaken ), function( step, branch ) {
				if ( ( stepIndex = self.stepIndex( step, branch ) ) === -1 ) {
					throw new Error( '[_fastForward]: Invalid step "' + step + '"' );

				} else if ( $.inArray( stepIndex, stepsTaken ) >= 0 ) {
					throw new Error( '[_fastForward]: Recursion detected on step "' + step + '"' );

				} else {
					stepsTaken.push( stepIndex );

					if ( stepIndex === self._lastStepIndex ||
						( relative ? ++i : stepIndex ) === toIndex ) {
						callback.call( self, stepIndex, stepsTaken );

					} else {
						next();
					}
				}
			});
		})();
	},

	_find: function( needles, haystack, wrap ) {
		var element, i, l, needle, type,
			found = [],
			$haystack = haystack instanceof jQuery ? haystack : $( haystack );

		function matchElement( i, current ) {
			if ( current === needle ) {
				element = current;

				// Break from .each loop
				return false;
			}
		}

		if ( needles !== null && $haystack.length ) {
			needles = arr( needles );

			for ( i = 0, l = needles.length; i < l; i++ ) {
				element = null;
				needle = needles[ i ];
				type = typeof needle;

				if ( type === num ) {
					element = $haystack.get( needle );

				} else if ( type === str ) {
					element = document.getElementById( needle.replace( '#', '' ) );

				} else if ( type === obj ) {
					if ( needle instanceof jQuery && needle.length ) {
						needle = needle[ 0 ];
					}

					if ( needle.nodeType ) {
						$haystack.each( matchElement );
					}
				}

				if ( element ) {
					found.push( element );
				}
			}
		}

		// Returns a jQuery object by default. If the wrap argument is
		// false, it will return an array of elements instead.
		return wrap === false ? found : $( found );
	},

	_move: function( step, branch, relative, history, callback ) {
		var self = this,
			current = self._currentState;

		if ( typeof branch === bool ) {
			callback = history;
			history = relative;
			relative = branch;
			branch = undefined;
		}

		function move( stepIndex, stepsTaken ) {
			callback.call( self, stepIndex, $.isArray( history ) ?
				history : history !== false ? stepsTaken : undefined );
		}

		if ( relative === true ) {
			if ( step > 0 ) {
				self._fastForward( step, relative, move );

			} else {
				callback.call( self, current.stepsActivated[
					// Normalize to zero if negative
					Math.max( 0, step + ( current.stepsActivated.length - 1 ) ) ] );
			}

		// Don't attempt to move to invalid steps
		} else if ( ( step = self.stepIndex( step, branch ) ) !== -1 ) {
			if ( step > current.stepIndex ) {
				self._fastForward( step, move );

			} else {
				move.call( self, step );
			}
		}
	},

	_state: function( stepIndex, stepsTaken ) {
		if ( !this.isValidStepIndex( stepIndex ) ) {
			return null;
		}

		var o = this.options,
			state = $.extend( true, {}, this._currentState );

		// stepsTaken must be an array of at least one step
		stepsTaken = arr( stepsTaken || stepIndex );

		state.step = this.elements.steps.eq( stepIndex );
		state.branch = state.step.parent();
		state.branchStepCount = state.branch.children( selector.step ).length;
		state.isMovingForward = stepIndex > state.stepIndex;
		state.stepIndexInBranch = state.branch.children( selector.step ).index( state.step );

		var branchLabel, indexOfBranch, indexOfStep,
			i = 0,
			l = stepsTaken.length;

		for ( ; i < l; i++ ) {
			stepIndex = stepsTaken[ i ];
			branchLabel = this._branchLabels[ stepIndex ];

			// Going forward
			if ( !state.stepIndex || state.stepIndex < stepIndex ) {

				// No duplicate steps
				if ( $.inArray( stepIndex, state.stepsActivated ) < 0 ) {
					state.stepsActivated.push( stepIndex );

					// No duplicate branch labels
					if ( $.inArray( branchLabel, state.branchesActivated ) < 0 ) {
						state.branchesActivated.push( branchLabel );
					}
				}

			// Going backward
			} else if ( state.stepIndex > stepIndex ) {
				indexOfBranch = $.inArray( branchLabel, state.branchesActivated ) + 1;
				indexOfStep = $.inArray( stepIndex, state.stepsActivated ) + 1;

				// Don't remove initial branch
				if ( indexOfBranch > 0 ) {
					state.branchesActivated.splice( indexOfBranch,
							// IE requires this argument
							state.branchesActivated.length - 1 );
				}

				// Don't remove the initial step
				if ( indexOfStep > 0 ) {
					state.stepsActivated.splice( indexOfStep,
							// IE requires this argument
							state.stepsActivated.length - 1 );
				}
			}

			state.stepIndex = stepIndex;
			state.branchLabel = branchLabel;
		}

		// Steps completed: the number of steps we have visited
		state.stepsComplete = Math.max( 0, this._find(
			state.stepsActivated, this.elements.steps
		).filter( this._excludesFilter ).length - 1 );

		// Steps possible: the number of steps in all of the branches we have visited
		state.stepsPossible = Math.max( 0, this._find(
			state.branchesActivated, this.elements.branches
		).children( selector.step ).filter( this._excludesFilter ).length - 1 );

		$.extend( state, {
			branchLabel: this._branchLabels[ stepIndex ],
			isFirstStep: stepIndex === 0,
			isFirstStepInBranch: state.stepIndexInBranch === 0,
			isLastStep: stepIndex === this._lastStepIndex,
			isLastStepInBranch: state.stepIndexInBranch === state.branchStepCount - 1,
			percentComplete: ( 100 * state.stepsComplete / state.stepsPossible ),
			stepsRemaining: ( state.stepsPossible - state.stepsComplete )
		});

		return state;
	},

	_transition: function( state, action ) {
		var response,
			self = this,
			o = self.options,
			stateName = state.step.attr( o.stateAttribute ),
			transitionFunc = stateName ? o.transitions[ stateName ] : o.transitions[ def ];

		if ( $.isFunction( transitionFunc ) ) {
			response = transitionFunc.call( self, state, function() {
				return action.apply( self, aps.call( arguments ) );
			});

		} else {
			response = stateName;
		}

		// A response of 'undefined' or 'false' will halt immediate action
		// waiting instead for the transition function to handle the call
		if ( response !== undefined && response !== false ) {

			// Response could be array like [ step, branch ]
			action.apply( self, arr( response ) );
		}
	},

	_update: function( event, state, force ) {
		var self = this,
			current = self._currentState,
			data = [ state, function( response ) {
				self._update( event, state, response !== false );
			} ],
			o = self.options;

		if ( current.step ) {
			if (
				!state ||
				o.disabled ||
				state.stepIndex === current.stepIndex ||
				force !== true && (
					!this._trigger( beforeSelect, event, data ) ||
					( state.isMovingForward && !this._trigger( beforeForward, event, data ) ) ||
					( !state.isMovingForward && !this._trigger( beforeBackward, event, data ) )
				)
			) {
				return;
			}

			current.step.removeClass( o.stepClasses.current )
				.animate( o.animations.hide.properties,
					// Fixes #3583 - http://bugs.jquery.com/ticket/3583
					$.extend( {}, o.animations.hide.options ) );
		}

		// Note that this does not affect the value of 'current'
		this._currentState = state;

		state.step.addClass( o.stepClasses.current )
			.animate( o.animations.show.properties,
				// Fixes #3583 - http://bugs.jquery.com/ticket/3583
				$.extend( {}, o.animations.show.options ) );

		if ( state.isFirstStep || o.unidirectional ||
			state.step.hasClass( o.stepClasses.unidirectional ) ) {
			this.elements.backward.attr( disabled, true );

		} else {
			this.elements.backward.removeAttr( disabled );
		}

		if ( ( state.isLastStepInBranch && !state.step.attr( o.stateAttribute ) ) ||
			state.step.hasClass( o.stepClasses.stop ) ) {
			this.elements.forward.attr( disabled, true );

		} else {
			this.elements.forward.removeAttr( disabled );
		}

		if ( o.enableSubmit || state.step.hasClass( o.stepClasses.submit ) ) {
			this.elements.submit.removeAttr( disabled );

		} else {
			this.elements.submit.attr( disabled, true );
		}

		if ( current.step ) {
			this._trigger( afterSelect, event, state );
			this._trigger( state.isMovingForward ? afterForward : afterBackward, event, state );
		}
	},

	backward: function( event, howMany ) {
		if ( typeof event === num ) {
			howMany = event;
			event = undefined;

		}

		if ( howMany === undefined ) {
			howMany = 1;
		}

		if ( this._currentState.isFirstStep || typeof howMany !== num ) {
			return;
		}

		this._move( -howMany, true, false, function( stepIndex, stepsTaken ) {
			this._update( event, this._state( stepIndex, stepsTaken ) );
		});
	},

	branch: function( branch ) {
		return arguments.length ?
			this._find( branch, this.elements.branches ) : this._currentState.branch;
	},

	branches: function( branch ) {
		return arguments.length ?
			this.branch( branch ).children( selector.branch ) : this.elements.branches;
	},

	branchesActivated: function() {
		return this._find( this._currentState.branchesActivated, this.elements.branches );
	},

	destroy: function( event, force ) {
		var self = this,
			$elements = self.elements,
			data = [ self.state(), function( response ) {
				return self.destroy( event, response !== false );
			} ];

		// args: force
		if ( typeof event === bool ) {
			force = event;
			event = undefined;
		}

		if ( force !== true && !self._trigger( beforeDestroy, event, data ) ) {
			return;
		}

		self.elements.backward.off( "." + namespace );
		self.elements.forward.off( "." + namespace );

		self.element.removeClass( wizard );

		$elements.form.removeClass( className.form );
		$elements.header.removeClass( className.header );
		$elements.steps.show().removeClass( className.step );
		$elements.stepsWrapper.removeClass( className.wrapper );
		$elements.branches.removeClass( className.branch );

		$.Widget.prototype.destroy.call( self );

		self._trigger( afterDestroy );
	},

	form: function() {
		return this.elements.form;
	},

	forward: function( event, howMany, history ) {
		if ( typeof event === num ) {
			history = howMany;
			howMany = event;
			event = undefined;

		}

		if ( howMany === undefined ) {
			howMany = 1;
		}

		if ( this._currentState.isLastStep || typeof howMany !== num ) {
			return;
		}

		this._move( howMany, true, history, function( stepIndex, stepsTaken ) {
			this._update( event, this._state( stepIndex, stepsTaken ) );
		});
	},

	isValidStep: function( step, branch ) {
		return this.isValidStepIndex( this.stepIndex( step, branch ) );
	},

	isValidStepIndex: function( stepIndex ) {
		return typeof stepIndex === num && stepIndex >= 0 && stepIndex <= this._lastStepIndex;
	},

	stepCount: function() {
		return this._stepCount;
	},

	select: function( event, step, branch, relative, history ) {

		// args: step, branch, relative, history
		if ( !( event instanceof $.Event ) ) {
			history = relative;
			relative = branch;
			branch = step;
			step = event;
			event = undefined;
		}

		if ( step === undefined ) {
			return;
		}

		// args: [ step, branch ], relative, history
		if ( $.isArray( step ) ) {
			history = relative;
			relative = branch;
			branch = step[ 1 ];
			step = step[ 0 ];

		// args: step, relative, history
		} else if ( typeof branch === bool ) {
			history = relative;
			relative = branch;
			branch = undefined;

		// args: step, history
		} else if ( $.isArray( branch ) ) {
			history = branch;
			branch = undefined;
		}

		this._move( step, branch, relative, history, function( stepIndex, stepsTaken ) {
			this._update( event, this._state( stepIndex, stepsTaken ) );
		});
	},

	state: function( step, branch, stepsTaken ) {
		if ( !arguments.length ) {
			return this._currentState;
		}

		// args: [ step, branch ], stepsTaken
		if ( $.isArray( step ) ) {
			stepsTaken = branch;
			branch = step[ 1 ];
			step = step[ 0 ];

		// args: step, stepsTaken
		} else if ( $.isArray( branch ) ) {
			stepsTaken = branch;
			branch = undefined;
		}

		return this._state( this.stepIndex( step, branch ), stepsTaken );
	},

	step: function( step, branch ) {
		if ( !arguments.length ) {
			return this._currentState.step;
		}

		// args: [ step, branch ]
		if ( $.isArray( step ) ) {
			branch = step[ 1 ];
			step = step[ 0 ];
		}

		var $step,
			type = typeof step;

		// Searching for a step by index
		if ( type === num ) {
			$step = this._find( step,
				// Search within branch, if defined, otherwise search all steps
				branch !== undefined ? this.steps( branch ) : this.elements.steps );

		// Searching for a step or branch by string ID, DOM element or jQuery object
		} else {
			$step = this._find( step, this.elements.steps.add( this.elements.branches ) );

			if ( $step && $step.hasClass( className.branch ) ) {

				// If a branch is found, the arguments are essentially flip-flopped
				$step = this._find( branch || 0, this.steps( $step ) );
			}
		}

		return $step;
	},

	stepIndex: function( step, branch, relative ) {
		if ( !arguments.length ) {
			return this._currentState.stepIndex;
		}

		var $step;

		// args: [ step, branch ], relative
		if ( $.isArray( step ) ) {
			relative = branch;
			branch = step[ 1 ];
			step = step[ 0 ];

		// args: step, relative
		} else if ( typeof branch === bool ) {
			relative = branch;
			branch = undefined;
		}

		return ( $step = this.step( step, branch ) ) ?
			// The returned index can be relative to a branch, or to all steps
			( relative ? $step.siblings( selector.step ).andSelf() : this.elements.steps ).index( $step )
			: -1;
	},

	steps: function( branch ) {
		return arguments.length ?
			this.branch( branch ).children( selector.step ) : this.elements.steps;
	},

	stepsActivated: function() {
		return this._find( this._currentState.stepsActivated, this.elements.steps );
	},

	submit: function() {
		this.elements.form.submit();
	}
});

})( jQuery );
/*

 arcticModal — jQuery plugin
 Version: 0.3
 Author: Sergey Predvoditelev (sergey.predvoditelev@gmail.com)
 Company: Arctic Laboratory (http://arcticlab.ru/)

 Docs & Examples: http://arcticlab.ru/arcticmodal/

 */
(function(d){var g={type:"html",content:"",url:"",ajax:{},ajax_request:null,closeOnEsc:!0,closeOnOverlayClick:!0,clone:!1,overlay:{block:void 0,tpl:'<div class="arcticmodal-overlay"></div>',css:{backgroundColor:"#000",opacity:0.6}},container:{block:void 0,tpl:'<div class="arcticmodal-container"><table class="arcticmodal-container_i"><tr><td class="arcticmodal-container_i2"></td></tr></table></div>'},wrap:void 0,body:void 0,errors:{tpl:'<div class="arcticmodal-error arcticmodal-close"></div>',autoclose_delay:2E3,
ajax_unsuccessful_load:"Error"},openEffect:{type:"fade",speed:400},closeEffect:{type:"fade",speed:400},beforeOpen:d.noop,afterOpen:d.noop,beforeClose:d.noop,afterClose:d.noop,afterLoading:d.noop,afterLoadingOnShow:d.noop,errorLoading:d.noop},j=0,e=d([]),m={isEventOut:function(a,b){var c=!0;d(a).each(function(){d(b.target).get(0)==d(this).get(0)&&(c=!1);0==d(b.target).closest("HTML",d(this).get(0)).length&&(c=!1)});return c}},f={getParentEl:function(a){var b=d(a);return b.data("arcticmodal")?b:(b=
d(a).closest(".arcticmodal-container").data("arcticmodalParentEl"))?b:!1},transition:function(a,b,c,e){e=void 0==e?d.noop:e;switch(c.type){case "fade":"show"==b?a.fadeIn(c.speed,e):a.fadeOut(c.speed,e);break;case "none":"show"==b?a.show():a.hide(),e()}},prepare_body:function(a,b){d(".arcticmodal-close",a.body).unbind("click.arcticmodal").bind("click.arcticmodal",function(){b.arcticmodal("close");return!1})},init_el:function(a,b){var c=a.data("arcticmodal");if(!c){c=b;j++;c.modalID=j;c.overlay.block=
d(c.overlay.tpl);c.overlay.block.css(c.overlay.css);c.container.block=d(c.container.tpl);c.body=d(".arcticmodal-container_i2",c.container.block);b.clone?c.body.html(a.clone(!0)):(a.before('<div id="arcticmodalReserve'+c.modalID+'" style="display: none" />'),c.body.html(a));f.prepare_body(c,a);c.closeOnOverlayClick&&c.overlay.block.add(c.container.block).click(function(b){m.isEventOut(d(">*",c.body),b)&&a.arcticmodal("close")});c.container.block.data("arcticmodalParentEl",a);a.data("arcticmodal",c);
e=d.merge(e,a);d.proxy(h.show,a)();if("html"==c.type)return a;if(void 0!=c.ajax.beforeSend){var k=c.ajax.beforeSend;delete c.ajax.beforeSend}if(void 0!=c.ajax.success){var g=c.ajax.success;delete c.ajax.success}if(void 0!=c.ajax.error){var l=c.ajax.error;delete c.ajax.error}var n=d.extend(!0,{url:c.url,beforeSend:function(){void 0==k?c.body.html('<div class="arcticmodal-loading" />'):k(c,a)},success:function(b){a.trigger("afterLoading");c.afterLoading(c,a,b);void 0==g?c.body.html(b):g(c,a,b);f.prepare_body(c,
a);a.trigger("afterLoadingOnShow");c.afterLoadingOnShow(c,a,b)},error:function(){a.trigger("errorLoading");c.errorLoading(c,a);void 0==l?(c.body.html(c.errors.tpl),d(".arcticmodal-error",c.body).html(c.errors.ajax_unsuccessful_load),d(".arcticmodal-close",c.body).click(function(){a.arcticmodal("close");return!1}),c.errors.autoclose_delay&&setTimeout(function(){a.arcticmodal("close")},c.errors.autoclose_delay)):l(c,a)}},c.ajax);c.ajax_request=d.ajax(n);a.data("arcticmodal",c)}},init:function(a){a=
d.extend(!0,{},g,a);if(d.isFunction(this))if(void 0==a)d.error("jquery.arcticmodal: Uncorrect parameters");else if(""==a.type)d.error('jquery.arcticmodal: Don\'t set parameter "type"');else switch(a.type){case "html":if(""==a.content){d.error('jquery.arcticmodal: Don\'t set parameter "content"');break}var b=a.content;a.content="";return f.init_el(d(b),a);case "ajax":if(""==a.url){d.error('jquery.arcticmodal: Don\'t set parameter "url"');break}return f.init_el(d("<div />"),a)}else return this.each(function(){f.init_el(d(this),
d.extend(!0,{},a))})}},h={show:function(){var a=f.getParentEl(this);if(!1===a)d.error("jquery.arcticmodal: Uncorrect call");else{var b=a.data("arcticmodal");b.overlay.block.hide();b.container.block.hide();d("BODY").append(b.overlay.block);d("BODY").append(b.container.block);b.beforeOpen(b,a);a.trigger("beforeOpen");if("hidden"!=b.wrap.css("overflow")){b.wrap.data("arcticmodalOverflow",b.wrap.css("overflow"));var c=b.wrap.outerWidth(!0);b.wrap.css("overflow","hidden");var g=b.wrap.outerWidth(!0);g!=
c&&b.wrap.css("marginRight",g-c+"px")}e.not(a).each(function(){d(this).data("arcticmodal").overlay.block.hide()});f.transition(b.overlay.block,"show",1<e.length?{type:"none"}:b.openEffect);f.transition(b.container.block,"show",1<e.length?{type:"none"}:b.openEffect,function(){b.afterOpen(b,a);a.trigger("afterOpen")});return a}},close:function(){if(d.isFunction(this))e.each(function(){d(this).arcticmodal("close")});else return this.each(function(){var a=f.getParentEl(this);if(!1===a)d.error("jquery.arcticmodal: Uncorrect call");
else{var b=a.data("arcticmodal");!1!==b.beforeClose(b,a)&&(a.trigger("beforeClose"),e.not(a).last().each(function(){d(this).data("arcticmodal").overlay.block.show()}),f.transition(b.overlay.block,"hide",1<e.length?{type:"none"}:b.closeEffect),f.transition(b.container.block,"hide",1<e.length?{type:"none"}:b.closeEffect,function(){b.afterClose(b,a);a.trigger("afterClose");b.clone||d("#arcticmodalReserve"+b.modalID).replaceWith(b.body.find(">*"));b.overlay.block.remove();b.container.block.remove();a.data("arcticmodal",
null);d(".arcticmodal-container").length||(b.wrap.data("arcticmodalOverflow")&&b.wrap.css("overflow",b.wrap.data("arcticmodalOverflow")),b.wrap.css("marginRight",0))}),"ajax"==b.type&&b.ajax_request.abort(),e=e.not(a))}})},setDefault:function(a){d.extend(!0,g,a)}};d(function(){g.wrap=d(document.all&&!document.querySelector?"html":"body")});d(document).bind("keyup.arcticmodal",function(a){var b=e.last();b.length&&b.data("arcticmodal").closeOnEsc&&27===a.keyCode&&b.arcticmodal("close")});d.arcticmodal=
d.fn.arcticmodal=function(a){if(h[a])return h[a].apply(this,Array.prototype.slice.call(arguments,1));if("object"===typeof a||!a)return f.init.apply(this,arguments);d.error("jquery.arcticmodal: Method "+a+" does not exist")}})(jQuery);/* Chosen v1.7.0 | (c) 2011-2017 by Harvest | MIT License, https://github.com/harvesthq/chosen/blob/master/LICENSE.md */
(function(){var a,b,c,d,e,f=function(a,b){return function(){return a.apply(b,arguments)}},g={}.hasOwnProperty,h=function(a,b){function c(){this.constructor=a}for(var d in b)g.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a};d=function(){function a(){this.options_index=0,this.parsed=[]}return a.prototype.add_node=function(a){return"OPTGROUP"===a.nodeName.toUpperCase()?this.add_group(a):this.add_option(a)},a.prototype.add_group=function(a){var b,c,d,e,f,g;for(b=this.parsed.length,this.parsed.push({array_index:b,group:!0,label:this.escapeExpression(a.label),title:a.title?a.title:void 0,children:0,disabled:a.disabled,classes:a.className}),f=a.childNodes,g=[],d=0,e=f.length;e>d;d++)c=f[d],g.push(this.add_option(c,b,a.disabled));return g},a.prototype.add_option=function(a,b,c){return"OPTION"===a.nodeName.toUpperCase()?(""!==a.text?(null!=b&&(this.parsed[b].children+=1),this.parsed.push({array_index:this.parsed.length,options_index:this.options_index,value:a.value,text:a.text,html:a.innerHTML,title:a.title?a.title:void 0,selected:a.selected,disabled:c===!0?c:a.disabled,group_array_index:b,group_label:null!=b?this.parsed[b].label:null,classes:a.className,style:a.style.cssText})):this.parsed.push({array_index:this.parsed.length,options_index:this.options_index,empty:!0}),this.options_index+=1):void 0},a.prototype.escapeExpression=function(a){var b,c;return null==a||a===!1?"":/[\&\<\>\"\'\`]/.test(a)?(b={"<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#x27;","`":"&#x60;"},c=/&(?!\w+;)|[\<\>\"\'\`]/g,a.replace(c,function(a){return b[a]||"&amp;"})):a},a}(),d.select_to_array=function(a){var b,c,e,f,g;for(c=new d,g=a.childNodes,e=0,f=g.length;f>e;e++)b=g[e],c.add_node(b);return c.parsed},b=function(){function a(b,c){this.form_field=b,this.options=null!=c?c:{},this.label_click_handler=f(this.label_click_handler,this),a.browser_is_supported()&&(this.is_multiple=this.form_field.multiple,this.set_default_text(),this.set_default_values(),this.setup(),this.set_up_html(),this.register_observers(),this.on_ready())}return a.prototype.set_default_values=function(){var a=this;return this.click_test_action=function(b){return a.test_active_click(b)},this.activate_action=function(b){return a.activate_field(b)},this.active_field=!1,this.mouse_on_container=!1,this.results_showing=!1,this.result_highlighted=null,this.is_rtl=this.options.rtl||/\bchosen-rtl\b/.test(this.form_field.className),this.allow_single_deselect=null!=this.options.allow_single_deselect&&null!=this.form_field.options[0]&&""===this.form_field.options[0].text?this.options.allow_single_deselect:!1,this.disable_search_threshold=this.options.disable_search_threshold||0,this.disable_search=this.options.disable_search||!1,this.enable_split_word_search=null!=this.options.enable_split_word_search?this.options.enable_split_word_search:!0,this.group_search=null!=this.options.group_search?this.options.group_search:!0,this.search_contains=this.options.search_contains||!1,this.single_backstroke_delete=null!=this.options.single_backstroke_delete?this.options.single_backstroke_delete:!0,this.max_selected_options=this.options.max_selected_options||1/0,this.inherit_select_classes=this.options.inherit_select_classes||!1,this.display_selected_options=null!=this.options.display_selected_options?this.options.display_selected_options:!0,this.display_disabled_options=null!=this.options.display_disabled_options?this.options.display_disabled_options:!0,this.include_group_label_in_selected=this.options.include_group_label_in_selected||!1,this.max_shown_results=this.options.max_shown_results||Number.POSITIVE_INFINITY,this.case_sensitive_search=this.options.case_sensitive_search||!1,this.hide_results_on_select=null!=this.options.hide_results_on_select?this.options.hide_results_on_select:!0},a.prototype.set_default_text=function(){return this.form_field.getAttribute("data-placeholder")?this.default_text=this.form_field.getAttribute("data-placeholder"):this.is_multiple?this.default_text=this.options.placeholder_text_multiple||this.options.placeholder_text||a.default_multiple_text:this.default_text=this.options.placeholder_text_single||this.options.placeholder_text||a.default_single_text,this.default_text=this.escape_html(this.default_text),this.results_none_found=this.form_field.getAttribute("data-no_results_text")||this.options.no_results_text||a.default_no_result_text},a.prototype.choice_label=function(a){return this.include_group_label_in_selected&&null!=a.group_label?"<b class='group-name'>"+a.group_label+"</b>"+a.html:a.html},a.prototype.mouse_enter=function(){return this.mouse_on_container=!0},a.prototype.mouse_leave=function(){return this.mouse_on_container=!1},a.prototype.input_focus=function(a){var b=this;if(this.is_multiple){if(!this.active_field)return setTimeout(function(){return b.container_mousedown()},50)}else if(!this.active_field)return this.activate_field()},a.prototype.input_blur=function(a){var b=this;return this.mouse_on_container?void 0:(this.active_field=!1,setTimeout(function(){return b.blur_test()},100))},a.prototype.label_click_handler=function(a){return this.is_multiple?this.container_mousedown(a):this.activate_field()},a.prototype.results_option_build=function(a){var b,c,d,e,f,g,h;for(b="",e=0,h=this.results_data,f=0,g=h.length;g>f&&(c=h[f],d="",d=c.group?this.result_add_group(c):this.result_add_option(c),""!==d&&(e++,b+=d),(null!=a?a.first:void 0)&&(c.selected&&this.is_multiple?this.choice_build(c):c.selected&&!this.is_multiple&&this.single_set_selected_text(this.choice_label(c))),!(e>=this.max_shown_results));f++);return b},a.prototype.result_add_option=function(a){var b,c;return a.search_match&&this.include_option_in_results(a)?(b=[],a.disabled||a.selected&&this.is_multiple||b.push("active-result"),!a.disabled||a.selected&&this.is_multiple||b.push("disabled-result"),a.selected&&b.push("result-selected"),null!=a.group_array_index&&b.push("group-option"),""!==a.classes&&b.push(a.classes),c=document.createElement("li"),c.className=b.join(" "),c.style.cssText=a.style,c.setAttribute("data-option-array-index",a.array_index),c.innerHTML=a.search_text,a.title&&(c.title=a.title),this.outerHTML(c)):""},a.prototype.result_add_group=function(a){var b,c;return(a.search_match||a.group_match)&&a.active_options>0?(b=[],b.push("group-result"),a.classes&&b.push(a.classes),c=document.createElement("li"),c.className=b.join(" "),c.innerHTML=a.search_text,a.title&&(c.title=a.title),this.outerHTML(c)):""},a.prototype.results_update_field=function(){return this.set_default_text(),this.is_multiple||this.results_reset_cleanup(),this.result_clear_highlight(),this.results_build(),this.results_showing?this.winnow_results():void 0},a.prototype.reset_single_select_options=function(){var a,b,c,d,e;for(d=this.results_data,e=[],b=0,c=d.length;c>b;b++)a=d[b],a.selected?e.push(a.selected=!1):e.push(void 0);return e},a.prototype.results_toggle=function(){return this.results_showing?this.results_hide():this.results_show()},a.prototype.results_search=function(a){return this.results_showing?this.winnow_results():this.results_show()},a.prototype.winnow_results=function(){var a,b,c,d,e,f,g,h,i,j,k,l;for(this.no_results_clear(),e=0,g=this.get_search_text(),a=g.replace(/[-[\]{}()*+?.,\\^$|#\s]/g,"\\$&"),d=this.get_search_regex(a),b=this.get_highlight_regex(a),l=this.results_data,j=0,k=l.length;k>j;j++)c=l[j],c.search_match=!1,f=null,this.include_option_in_results(c)&&(c.group&&(c.group_match=!1,c.active_options=0),null!=c.group_array_index&&this.results_data[c.group_array_index]&&(f=this.results_data[c.group_array_index],0===f.active_options&&f.search_match&&(e+=1),f.active_options+=1),c.search_text=c.group?c.label:c.html,(!c.group||this.group_search)&&(c.search_match=this.search_string_match(c.search_text,d),c.search_match&&!c.group&&(e+=1),c.search_match?(g.length&&(h=c.search_text.search(b),i=c.search_text.substr(0,h+g.length)+"</em>"+c.search_text.substr(h+g.length),c.search_text=i.substr(0,h)+"<em>"+i.substr(h)),null!=f&&(f.group_match=!0)):null!=c.group_array_index&&this.results_data[c.group_array_index].search_match&&(c.search_match=!0)));return this.result_clear_highlight(),1>e&&g.length?(this.update_results_content(""),this.no_results(g)):(this.update_results_content(this.results_option_build()),this.winnow_results_set_highlight())},a.prototype.get_search_regex=function(a){var b,c;return b=this.search_contains?"":"^",c=this.case_sensitive_search?"":"i",new RegExp(b+a,c)},a.prototype.get_highlight_regex=function(a){var b,c;return b=this.search_contains?"":"\\b",c=this.case_sensitive_search?"":"i",new RegExp(b+a,c)},a.prototype.search_string_match=function(a,b){var c,d,e,f;if(b.test(a))return!0;if(this.enable_split_word_search&&(a.indexOf(" ")>=0||0===a.indexOf("["))&&(d=a.replace(/\[|\]/g,"").split(" "),d.length))for(e=0,f=d.length;f>e;e++)if(c=d[e],b.test(c))return!0},a.prototype.choices_count=function(){var a,b,c,d;if(null!=this.selected_option_count)return this.selected_option_count;for(this.selected_option_count=0,d=this.form_field.options,b=0,c=d.length;c>b;b++)a=d[b],a.selected&&(this.selected_option_count+=1);return this.selected_option_count},a.prototype.choices_click=function(a){return a.preventDefault(),this.activate_field(),this.results_showing||this.is_disabled?void 0:this.results_show()},a.prototype.keydown_checker=function(a){var b,c;switch(b=null!=(c=a.which)?c:a.keyCode,this.search_field_scale(),8!==b&&this.pending_backstroke&&this.clear_backstroke(),b){case 8:this.backstroke_length=this.get_search_field_value().length;break;case 9:this.results_showing&&!this.is_multiple&&this.result_select(a),this.mouse_on_container=!1;break;case 13:this.results_showing&&a.preventDefault();break;case 27:this.results_showing&&a.preventDefault();break;case 32:this.disable_search&&a.preventDefault();break;case 38:a.preventDefault(),this.keyup_arrow();break;case 40:a.preventDefault(),this.keydown_arrow()}},a.prototype.keyup_checker=function(a){var b,c;switch(b=null!=(c=a.which)?c:a.keyCode,this.search_field_scale(),b){case 8:this.is_multiple&&this.backstroke_length<1&&this.choices_count()>0?this.keydown_backstroke():this.pending_backstroke||(this.result_clear_highlight(),this.results_search());break;case 13:a.preventDefault(),this.results_showing&&this.result_select(a);break;case 27:this.results_showing&&this.results_hide();break;case 9:case 16:case 17:case 18:case 38:case 40:case 91:break;default:this.results_search()}},a.prototype.clipboard_event_checker=function(a){var b=this;if(!this.is_disabled)return setTimeout(function(){return b.results_search()},50)},a.prototype.container_width=function(){return null!=this.options.width?this.options.width:""+this.form_field.offsetWidth+"px"},a.prototype.include_option_in_results=function(a){return this.is_multiple&&!this.display_selected_options&&a.selected?!1:!this.display_disabled_options&&a.disabled?!1:a.empty?!1:!0},a.prototype.search_results_touchstart=function(a){return this.touch_started=!0,this.search_results_mouseover(a)},a.prototype.search_results_touchmove=function(a){return this.touch_started=!1,this.search_results_mouseout(a)},a.prototype.search_results_touchend=function(a){return this.touch_started?this.search_results_mouseup(a):void 0},a.prototype.outerHTML=function(a){var b;return a.outerHTML?a.outerHTML:(b=document.createElement("div"),b.appendChild(a),b.innerHTML)},a.prototype.get_single_html=function(){return'<a class="chosen-single chosen-default">\n  <span>'+this.default_text+'</span>\n  <div><b></b></div>\n</a>\n<div class="chosen-drop">\n  <div class="chosen-search">\n    <input class="chosen-search-input" type="text" autocomplete="off" />\n  </div>\n  <ul class="chosen-results"></ul>\n</div>'},a.prototype.get_multi_html=function(){return'<ul class="chosen-choices">\n  <li class="search-field">\n    <input class="chosen-search-input" type="text" autocomplete="off" value="'+this.default_text+'" />\n  </li>\n</ul>\n<div class="chosen-drop">\n  <ul class="chosen-results"></ul>\n</div>'},a.prototype.get_no_results_html=function(a){return'<li class="no-results">\n  '+this.results_none_found+" <span>"+a+"</span>\n</li>"},a.browser_is_supported=function(){return"Microsoft Internet Explorer"===window.navigator.appName?document.documentMode>=8:/iP(od|hone)/i.test(window.navigator.userAgent)||/IEMobile/i.test(window.navigator.userAgent)||/Windows Phone/i.test(window.navigator.userAgent)||/BlackBerry/i.test(window.navigator.userAgent)||/BB10/i.test(window.navigator.userAgent)||/Android.*Mobile/i.test(window.navigator.userAgent)?!1:!0},a.default_multiple_text="Select Some Options",a.default_single_text="Select an Option",a.default_no_result_text="No results match",a}(),a=jQuery,a.fn.extend({chosen:function(d){return b.browser_is_supported()?this.each(function(b){var e,f;return e=a(this),f=e.data("chosen"),"destroy"===d?void(f instanceof c&&f.destroy()):void(f instanceof c||e.data("chosen",new c(this,d)))}):this}}),c=function(b){function c(){return e=c.__super__.constructor.apply(this,arguments)}return h(c,b),c.prototype.setup=function(){return this.form_field_jq=a(this.form_field),this.current_selectedIndex=this.form_field.selectedIndex},c.prototype.set_up_html=function(){var b,c;return b=["chosen-container"],b.push("chosen-container-"+(this.is_multiple?"multi":"single")),this.inherit_select_classes&&this.form_field.className&&b.push(this.form_field.className),this.is_rtl&&b.push("chosen-rtl"),c={"class":b.join(" "),title:this.form_field.title},this.form_field.id.length&&(c.id=this.form_field.id.replace(/[^\w]/g,"_")+"_chosen"),this.container=a("<div />",c),this.container.width(this.container_width()),this.is_multiple?this.container.html(this.get_multi_html()):this.container.html(this.get_single_html()),this.form_field_jq.hide().after(this.container),this.dropdown=this.container.find("div.chosen-drop").first(),this.search_field=this.container.find("input").first(),this.search_results=this.container.find("ul.chosen-results").first(),this.search_field_scale(),this.search_no_results=this.container.find("li.no-results").first(),this.is_multiple?(this.search_choices=this.container.find("ul.chosen-choices").first(),this.search_container=this.container.find("li.search-field").first()):(this.search_container=this.container.find("div.chosen-search").first(),this.selected_item=this.container.find(".chosen-single").first()),this.results_build(),this.set_tab_index(),this.set_label_behavior()},c.prototype.on_ready=function(){return this.form_field_jq.trigger("chosen:ready",{chosen:this})},c.prototype.register_observers=function(){var a=this;return this.container.bind("touchstart.chosen",function(b){a.container_mousedown(b)}),this.container.bind("touchend.chosen",function(b){a.container_mouseup(b)}),this.container.bind("mousedown.chosen",function(b){a.container_mousedown(b)}),this.container.bind("mouseup.chosen",function(b){a.container_mouseup(b)}),this.container.bind("mouseenter.chosen",function(b){a.mouse_enter(b)}),this.container.bind("mouseleave.chosen",function(b){a.mouse_leave(b)}),this.search_results.bind("mouseup.chosen",function(b){a.search_results_mouseup(b)}),this.search_results.bind("mouseover.chosen",function(b){a.search_results_mouseover(b)}),this.search_results.bind("mouseout.chosen",function(b){a.search_results_mouseout(b)}),this.search_results.bind("mousewheel.chosen DOMMouseScroll.chosen",function(b){a.search_results_mousewheel(b)}),this.search_results.bind("touchstart.chosen",function(b){a.search_results_touchstart(b)}),this.search_results.bind("touchmove.chosen",function(b){a.search_results_touchmove(b)}),this.search_results.bind("touchend.chosen",function(b){a.search_results_touchend(b)}),this.form_field_jq.bind("chosen:updated.chosen",function(b){a.results_update_field(b)}),this.form_field_jq.bind("chosen:activate.chosen",function(b){a.activate_field(b)}),this.form_field_jq.bind("chosen:open.chosen",function(b){a.container_mousedown(b)}),this.form_field_jq.bind("chosen:close.chosen",function(b){a.close_field(b)}),this.search_field.bind("blur.chosen",function(b){a.input_blur(b)}),this.search_field.bind("keyup.chosen",function(b){a.keyup_checker(b)}),this.search_field.bind("keydown.chosen",function(b){a.keydown_checker(b)}),this.search_field.bind("focus.chosen",function(b){a.input_focus(b)}),this.search_field.bind("cut.chosen",function(b){a.clipboard_event_checker(b)}),this.search_field.bind("paste.chosen",function(b){a.clipboard_event_checker(b)}),this.is_multiple?this.search_choices.bind("click.chosen",function(b){a.choices_click(b)}):this.container.bind("click.chosen",function(a){a.preventDefault()})},c.prototype.destroy=function(){return a(this.container[0].ownerDocument).unbind("click.chosen",this.click_test_action),this.form_field_label.length>0&&this.form_field_label.unbind("click.chosen"),this.search_field[0].tabIndex&&(this.form_field_jq[0].tabIndex=this.search_field[0].tabIndex),this.container.remove(),this.form_field_jq.removeData("chosen"),this.form_field_jq.show()},c.prototype.search_field_disabled=function(){return this.is_disabled=this.form_field.disabled||this.form_field_jq.parents("fieldset").is(":disabled"),this.container.toggleClass("chosen-disabled",this.is_disabled),this.search_field[0].disabled=this.is_disabled,this.is_multiple||this.selected_item.unbind("focus.chosen",this.activate_field),this.is_disabled?this.close_field():this.is_multiple?void 0:this.selected_item.bind("focus.chosen",this.activate_field)},c.prototype.container_mousedown=function(b){var c;if(!this.is_disabled)return!b||"mousedown"!==(c=b.type)&&"touchstart"!==c||this.results_showing||b.preventDefault(),null!=b&&a(b.target).hasClass("search-choice-close")?void 0:(this.active_field?this.is_multiple||!b||a(b.target)[0]!==this.selected_item[0]&&!a(b.target).parents("a.chosen-single").length||(b.preventDefault(),this.results_toggle()):(this.is_multiple&&this.search_field.val(""),a(this.container[0].ownerDocument).bind("click.chosen",this.click_test_action),this.results_show()),this.activate_field())},c.prototype.container_mouseup=function(a){return"ABBR"!==a.target.nodeName||this.is_disabled?void 0:this.results_reset(a)},c.prototype.search_results_mousewheel=function(a){var b;return a.originalEvent&&(b=a.originalEvent.deltaY||-a.originalEvent.wheelDelta||a.originalEvent.detail),null!=b?(a.preventDefault(),"DOMMouseScroll"===a.type&&(b=40*b),this.search_results.scrollTop(b+this.search_results.scrollTop())):void 0},c.prototype.blur_test=function(a){return!this.active_field&&this.container.hasClass("chosen-container-active")?this.close_field():void 0},c.prototype.close_field=function(){return a(this.container[0].ownerDocument).unbind("click.chosen",this.click_test_action),this.active_field=!1,this.results_hide(),this.container.removeClass("chosen-container-active"),this.clear_backstroke(),this.show_search_field_default(),this.search_field_scale(),this.search_field.blur()},c.prototype.activate_field=function(){return this.is_disabled?void 0:(this.container.addClass("chosen-container-active"),this.active_field=!0,this.search_field.val(this.search_field.val()),this.search_field.focus())},c.prototype.test_active_click=function(b){var c;return c=a(b.target).closest(".chosen-container"),c.length&&this.container[0]===c[0]?this.active_field=!0:this.close_field()},c.prototype.results_build=function(){return this.parsing=!0,this.selected_option_count=null,this.results_data=d.select_to_array(this.form_field),this.is_multiple?this.search_choices.find("li.search-choice").remove():this.is_multiple||(this.single_set_selected_text(),this.disable_search||this.form_field.options.length<=this.disable_search_threshold?(this.search_field[0].readOnly=!0,this.container.addClass("chosen-container-single-nosearch")):(this.search_field[0].readOnly=!1,this.container.removeClass("chosen-container-single-nosearch"))),this.update_results_content(this.results_option_build({first:!0})),this.search_field_disabled(),this.show_search_field_default(),this.search_field_scale(),this.parsing=!1},c.prototype.result_do_highlight=function(a){var b,c,d,e,f;if(a.length){if(this.result_clear_highlight(),this.result_highlight=a,this.result_highlight.addClass("highlighted"),d=parseInt(this.search_results.css("maxHeight"),10),f=this.search_results.scrollTop(),e=d+f,c=this.result_highlight.position().top+this.search_results.scrollTop(),b=c+this.result_highlight.outerHeight(),b>=e)return this.search_results.scrollTop(b-d>0?b-d:0);if(f>c)return this.search_results.scrollTop(c)}},c.prototype.result_clear_highlight=function(){return this.result_highlight&&this.result_highlight.removeClass("highlighted"),this.result_highlight=null},c.prototype.results_show=function(){return this.is_multiple&&this.max_selected_options<=this.choices_count()?(this.form_field_jq.trigger("chosen:maxselected",{chosen:this}),!1):(this.container.addClass("chosen-with-drop"),this.results_showing=!0,this.search_field.focus(),this.search_field.val(this.get_search_field_value()),this.winnow_results(),this.form_field_jq.trigger("chosen:showing_dropdown",{chosen:this}))},c.prototype.update_results_content=function(a){return this.search_results.html(a)},c.prototype.results_hide=function(){return this.results_showing&&(this.result_clear_highlight(),this.container.removeClass("chosen-with-drop"),this.form_field_jq.trigger("chosen:hiding_dropdown",{chosen:this})),this.results_showing=!1},c.prototype.set_tab_index=function(a){var b;return this.form_field.tabIndex?(b=this.form_field.tabIndex,this.form_field.tabIndex=-1,this.search_field[0].tabIndex=b):void 0},c.prototype.set_label_behavior=function(){return this.form_field_label=this.form_field_jq.parents("label"),!this.form_field_label.length&&this.form_field.id.length&&(this.form_field_label=a("label[for='"+this.form_field.id+"']")),this.form_field_label.length>0?this.form_field_label.bind("click.chosen",this.label_click_handler):void 0},c.prototype.show_search_field_default=function(){return this.is_multiple&&this.choices_count()<1&&!this.active_field?(this.search_field.val(this.default_text),this.search_field.addClass("default")):(this.search_field.val(""),this.search_field.removeClass("default"))},c.prototype.search_results_mouseup=function(b){var c;return c=a(b.target).hasClass("active-result")?a(b.target):a(b.target).parents(".active-result").first(),c.length?(this.result_highlight=c,this.result_select(b),this.search_field.focus()):void 0},c.prototype.search_results_mouseover=function(b){var c;return c=a(b.target).hasClass("active-result")?a(b.target):a(b.target).parents(".active-result").first(),c?this.result_do_highlight(c):void 0},c.prototype.search_results_mouseout=function(b){return a(b.target).hasClass("active-result")?this.result_clear_highlight():void 0},c.prototype.choice_build=function(b){var c,d,e=this;return c=a("<li />",{"class":"search-choice"}).html("<span>"+this.choice_label(b)+"</span>"),b.disabled?c.addClass("search-choice-disabled"):(d=a("<a />",{"class":"search-choice-close","data-option-array-index":b.array_index}),d.bind("click.chosen",function(a){return e.choice_destroy_link_click(a)}),c.append(d)),this.search_container.before(c)},c.prototype.choice_destroy_link_click=function(b){return b.preventDefault(),b.stopPropagation(),this.is_disabled?void 0:this.choice_destroy(a(b.target))},c.prototype.choice_destroy=function(a){return this.result_deselect(a[0].getAttribute("data-option-array-index"))?(this.active_field?this.search_field.focus():this.show_search_field_default(),this.is_multiple&&this.choices_count()>0&&this.get_search_field_value().length<1&&this.results_hide(),a.parents("li").first().remove(),this.search_field_scale()):void 0},c.prototype.results_reset=function(){return this.reset_single_select_options(),this.form_field.options[0].selected=!0,this.single_set_selected_text(),this.show_search_field_default(),this.results_reset_cleanup(),this.trigger_form_field_change(),this.active_field?this.results_hide():void 0},c.prototype.results_reset_cleanup=function(){return this.current_selectedIndex=this.form_field.selectedIndex,this.selected_item.find("abbr").remove()},c.prototype.result_select=function(a){var b,c;return this.result_highlight?(b=this.result_highlight,this.result_clear_highlight(),this.is_multiple&&this.max_selected_options<=this.choices_count()?(this.form_field_jq.trigger("chosen:maxselected",{chosen:this}),!1):(this.is_multiple?b.removeClass("active-result"):this.reset_single_select_options(),b.addClass("result-selected"),c=this.results_data[b[0].getAttribute("data-option-array-index")],c.selected=!0,this.form_field.options[c.options_index].selected=!0,this.selected_option_count=null,this.is_multiple?this.choice_build(c):this.single_set_selected_text(this.choice_label(c)),(!this.is_multiple||this.hide_results_on_select&&!a.metaKey&&!a.ctrlKey)&&(this.results_hide(),this.show_search_field_default()),(this.is_multiple||this.form_field.selectedIndex!==this.current_selectedIndex)&&this.trigger_form_field_change({selected:this.form_field.options[c.options_index].value}),this.current_selectedIndex=this.form_field.selectedIndex,a.preventDefault(),this.search_field_scale())):void 0},c.prototype.single_set_selected_text=function(a){return null==a&&(a=this.default_text),a===this.default_text?this.selected_item.addClass("chosen-default"):(this.single_deselect_control_build(),this.selected_item.removeClass("chosen-default")),this.selected_item.find("span").html(a)},c.prototype.result_deselect=function(a){var b;return b=this.results_data[a],this.form_field.options[b.options_index].disabled?!1:(b.selected=!1,this.form_field.options[b.options_index].selected=!1,this.selected_option_count=null,this.result_clear_highlight(),this.results_showing&&this.winnow_results(),this.trigger_form_field_change({deselected:this.form_field.options[b.options_index].value}),this.search_field_scale(),!0)},c.prototype.single_deselect_control_build=function(){return this.allow_single_deselect?(this.selected_item.find("abbr").length||this.selected_item.find("span").first().after('<abbr class="search-choice-close"></abbr>'),this.selected_item.addClass("chosen-single-with-deselect")):void 0},c.prototype.get_search_field_value=function(){return this.search_field.val()},c.prototype.get_search_text=function(){return this.escape_html(a.trim(this.get_search_field_value()))},c.prototype.escape_html=function(b){return a("<div/>").text(b).html()},c.prototype.winnow_results_set_highlight=function(){var a,b;return b=this.is_multiple?[]:this.search_results.find(".result-selected.active-result"),a=b.length?b.first():this.search_results.find(".active-result").first(),null!=a?this.result_do_highlight(a):void 0},c.prototype.no_results=function(a){var b;return b=this.get_no_results_html(a),this.search_results.append(b),this.form_field_jq.trigger("chosen:no_results",{chosen:this})},c.prototype.no_results_clear=function(){return this.search_results.find(".no-results").remove()},c.prototype.keydown_arrow=function(){var a;return this.results_showing&&this.result_highlight?(a=this.result_highlight.nextAll("li.active-result").first())?this.result_do_highlight(a):void 0:this.results_show()},c.prototype.keyup_arrow=function(){var a;return this.results_showing||this.is_multiple?this.result_highlight?(a=this.result_highlight.prevAll("li.active-result"),a.length?this.result_do_highlight(a.first()):(this.choices_count()>0&&this.results_hide(),this.result_clear_highlight())):void 0:this.results_show()},c.prototype.keydown_backstroke=function(){var a;return this.pending_backstroke?(this.choice_destroy(this.pending_backstroke.find("a").first()),this.clear_backstroke()):(a=this.search_container.siblings("li.search-choice").last(),a.length&&!a.hasClass("search-choice-disabled")?(this.pending_backstroke=a,this.single_backstroke_delete?this.keydown_backstroke():this.pending_backstroke.addClass("search-choice-focus")):void 0)},c.prototype.clear_backstroke=function(){return this.pending_backstroke&&this.pending_backstroke.removeClass("search-choice-focus"),this.pending_backstroke=null},c.prototype.search_field_scale=function(){var b,c,d,e,f,g,h,i;if(this.is_multiple){for(e={position:"absolute",left:"-1000px",top:"-1000px",display:"none",whiteSpace:"pre"},f=["fontSize","fontStyle","fontWeight","fontFamily","lineHeight","textTransform","letterSpacing"],h=0,i=f.length;i>h;h++)d=f[h],e[d]=this.search_field.css(d);return c=a("<div />").css(e),c.text(this.get_search_field_value()),a("body").append(c),g=c.width()+25,c.remove(),b=this.container.outerWidth(),g=Math.min(b-10,g),this.search_field.width(g)}},c.prototype.trigger_form_field_change=function(a){return this.form_field_jq.trigger("input",a),this.form_field_jq.trigger("change",a)},c}(b)}).call(this);/*
 * jQuery Plugin: Tokenizing Autocomplete Text Entry
 * Version 1.6.2
 *
 * Copyright (c) 2009 James Smith (http://loopj.com)
 * Licensed jointly under the GPL and MIT licenses,
 * choose which one suits your project best!
 *
 */
;(function ($) {
  var DEFAULT_SETTINGS = {
    // Search settings
    method: "GET",
    ajaxHeaders: {},
    queryParam: "q",
    queryDefault: "",
    searchDelay: 300,
    minChars: 1,
    propertyToSearch: "name",
    jsonContainer: null,
    contentType: "json",
    excludeCurrent: false,
    excludeCurrentParameter: "x",

    // Prepopulation settings
    prePopulate: null,
    processPrePopulate: false,

    // Display settings
    hintText: "Type in a search term",
    noResultsText: "No results",
    searchingText: "Searching...",
    deleteText: "&#215;",
    animateDropdown: true,
    placeholder: null,
    theme: null,
    zindex: 999,
    resultsLimit: null,

    enableHTML: false,

    resultsFormatter: function(item) {
      var string = item[this.propertyToSearch];
      return "<li>" + (this.enableHTML ? string : _escapeHTML(string)) + "</li>";
    },

    tokenFormatter: function(item) {
      var string = item[this.propertyToSearch];
      return "<li><p>" + (this.enableHTML ? string : _escapeHTML(string)) + "</p></li>";
    },

    // Tokenization settings
    tokenLimit: null,
    tokenDelimiter: ",",
    preventDuplicates: false,
    tokenValue: "id",

    // Behavioral settings
    allowFreeTagging: false,
    allowTabOut: false,
    autoSelectFirstResult: false,

    // Callbacks
    onResult: null,
    onCachedResult: null,
    onAdd: null,
    onFreeTaggingAdd: null,
    onDelete: null,
    onReady: null,

    // Other settings
    idPrefix: "token-input-",

    // Keep track if the input is currently in disabled mode
    disabled: false
  };

  // Default classes to use when theming
  var DEFAULT_CLASSES = {
    tokenList            : "token-input-list",
    token                : "token-input-token",
    tokenReadOnly        : "token-input-token-readonly",
    tokenDelete          : "token-input-delete-token",
    selectedToken        : "token-input-selected-token",
    highlightedToken     : "token-input-highlighted-token",
    dropdown             : "token-input-dropdown",
    dropdownItem         : "token-input-dropdown-item",
    dropdownItem2        : "token-input-dropdown-item2",
    selectedDropdownItem : "token-input-selected-dropdown-item",
    inputToken           : "token-input-input-token",
    focused              : "token-input-focused",
    disabled             : "token-input-disabled"
  };

  // Input box position "enum"
  var POSITION = {
    BEFORE : 0,
    AFTER  : 1,
    END    : 2
  };

  // Keys "enum"
  var KEY = {
    BACKSPACE    : 8,
    TAB          : 9,
    ENTER        : 13,
    ESCAPE       : 27,
    SPACE        : 32,
    PAGE_UP      : 33,
    PAGE_DOWN    : 34,
    END          : 35,
    HOME         : 36,
    LEFT         : 37,
    UP           : 38,
    RIGHT        : 39,
    DOWN         : 40,
    NUMPAD_ENTER : 108,
    COMMA        : 188
  };

  var HTML_ESCAPES = {
    '&' : '&amp;',
    '<' : '&lt;',
    '>' : '&gt;',
    '"' : '&quot;',
    "'" : '&#x27;',
    '/' : '&#x2F;'
  };

  var HTML_ESCAPE_CHARS = /[&<>"'\/]/g;

  function coerceToString(val) {
    return String((val === null || val === undefined) ? '' : val);
  }

  function _escapeHTML(text) {
    return coerceToString(text).replace(HTML_ESCAPE_CHARS, function(match) {
      return HTML_ESCAPES[match];
    });
  }

  // Additional public (exposed) methods
  var methods = {
      init: function(url_or_data_or_function, options) {
          var settings = $.extend({}, DEFAULT_SETTINGS, options || {});

          return this.each(function () {
              $(this).data("settings", settings);
              $(this).data("tokenInputObject", new $.TokenList(this, url_or_data_or_function, settings));
          });
      },
      clear: function() {
          this.data("tokenInputObject").clear();
          return this;
      },
      add: function(item) {
          this.data("tokenInputObject").add(item);
          return this;
      },
      remove: function(item) {
          this.data("tokenInputObject").remove(item);
          return this;
      },
      get: function() {
          return this.data("tokenInputObject").getTokens();
      },
      toggleDisabled: function(disable) {
          this.data("tokenInputObject").toggleDisabled(disable);
          return this;
      },
      setOptions: function(options){
          $(this).data("settings", $.extend({}, $(this).data("settings"), options || {}));
          return this;
      },
      destroy: function () {
        if (this.data("tokenInputObject")) {
          this.data("tokenInputObject").clear();
          var tmpInput = this;
          var closest = this.parent();
          closest.empty();
          tmpInput.show();
          closest.append(tmpInput);
          return tmpInput;
        }
      }
  };

  // Expose the .tokenInput function to jQuery as a plugin
  $.fn.tokenInput = function (method) {
      // Method calling and initialization logic
      if (methods[method]) {
          return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
      } else {
          return methods.init.apply(this, arguments);
      }
  };

  // TokenList class for each input
  $.TokenList = function (input, url_or_data, settings) {
      //
      // Initialization
      //

      // Configure the data source
      if (typeof(url_or_data) === "string" || typeof(url_or_data) === "function") {
          // Set the url to query against
          $(input).data("settings").url = url_or_data;

          // If the URL is a function, evaluate it here to do our initalization work
          var url = computeURL();

          // Make a smart guess about cross-domain if it wasn't explicitly specified
          if ($(input).data("settings").crossDomain === undefined && typeof url === "string") {
              if(url.indexOf("://") === -1) {
                  $(input).data("settings").crossDomain = false;
              } else {
                  $(input).data("settings").crossDomain = (location.href.split(/\/+/g)[1] !== url.split(/\/+/g)[1]);
              }
          }
      } else if (typeof(url_or_data) === "object") {
          // Set the local data to search through
          $(input).data("settings").local_data = url_or_data;
      }

      // Build class names
      if($(input).data("settings").classes) {
          // Use custom class names
          $(input).data("settings").classes = $.extend({}, DEFAULT_CLASSES, $(input).data("settings").classes);
      } else if($(input).data("settings").theme) {
          // Use theme-suffixed default class names
          $(input).data("settings").classes = {};
          $.each(DEFAULT_CLASSES, function(key, value) {
              $(input).data("settings").classes[key] = value + "-" + $(input).data("settings").theme;
          });
      } else {
          $(input).data("settings").classes = DEFAULT_CLASSES;
      }

      // Save the tokens
      var saved_tokens = [];

      // Keep track of the number of tokens in the list
      var token_count = 0;

      // Basic cache to save on db hits
      var cache = new $.TokenList.Cache();

      // Keep track of the timeout, old vals
      var timeout;
      var input_val;

      // Create a new text input an attach keyup events
      var input_box = $("<input type=\"text\" autocomplete=\"off\" autocapitalize=\"off\"/>")
          .css({
              outline: "none"
          })
          .attr("id", $(input).data("settings").idPrefix + input.id)
          .focus(function () {
              if ($(input).data("settings").disabled) {
                  return false;
              } else
              if ($(input).data("settings").tokenLimit === null || $(input).data("settings").tokenLimit !== token_count) {
                  show_dropdown_hint();
              }
              token_list.addClass($(input).data("settings").classes.focused);
          })
          .blur(function () {
              hide_dropdown();

              if ($(input).data("settings").allowFreeTagging) {
                add_freetagging_tokens();
              }

              $(this).val("");
              token_list.removeClass($(input).data("settings").classes.focused);
          })
          .bind("keyup keydown blur update", resize_input)
          .keydown(function (event) {
              var previous_token;
              var next_token;
              console.log(event.keyCode);

              switch(event.keyCode) {
                  case KEY.LEFT:
                  case KEY.RIGHT:
                  case KEY.UP:
                  case KEY.DOWN:
                    if(this.value.length === 0) {
                        previous_token = input_token.prev();
                        next_token = input_token.next();

                        if((previous_token.length && previous_token.get(0) === selected_token) ||
						   (next_token.length && next_token.get(0) === selected_token)) {
                            // Check if there is a previous/next token and it is selected
                            if(event.keyCode === KEY.LEFT || event.keyCode === KEY.UP) {
                                deselect_token($(selected_token), POSITION.BEFORE);
                            } else {
                                deselect_token($(selected_token), POSITION.AFTER);
                            }
                        } else if((event.keyCode === KEY.LEFT || event.keyCode === KEY.UP) && previous_token.length) {
                            // We are moving left, select the previous token if it exists
                            select_token($(previous_token.get(0)));
                        } else if((event.keyCode === KEY.RIGHT || event.keyCode === KEY.DOWN) && next_token.length) {
                            // We are moving right, select the next token if it exists
                            select_token($(next_token.get(0)));
                        }
                    } else {
                      var dropdown_item = null;

                      if (event.keyCode === KEY.DOWN || event.keyCode === KEY.RIGHT) {
                        dropdown_item = $(dropdown).find('li').first();

                        if (selected_dropdown_item) {
                          dropdown_item = $(selected_dropdown_item).next();
                        }
                      } else {
                        dropdown_item = $(dropdown).find('li').last();

                        if (selected_dropdown_item) {
                          dropdown_item = $(selected_dropdown_item).prev();
                        }
                      }

                      select_dropdown_item(dropdown_item);
                    }

                    break;

                  case KEY.BACKSPACE:
                      previous_token = input_token.prev();

                      if (this.value.length === 0) {
                        if (selected_token) {
                          delete_token($(selected_token));
                          hiddenInput.change();
                        } else if(previous_token.length) {
                          select_token($(previous_token.get(0)));
                        }

                        return false;
                      } else if($(this).val().length === 1) {
                          hide_dropdown();
                      } else {
                          // set a timeout just long enough to let this function finish.
                          setTimeout(function(){ do_search(); }, 5);
                      }
                      break;

                  case KEY.TAB:
                  case KEY.ENTER:
                  case KEY.NUMPAD_ENTER:
                  //case KEY.COMMA:
                    if(selected_dropdown_item) {
                      add_token($(selected_dropdown_item).data("tokeninput"));
                      hiddenInput.change();
                    } else {
                      if ($(input).data("settings").allowFreeTagging) {
                        if($(input).data("settings").allowTabOut && $(this).val() === "") {
                          return true;
                        } else {
                          add_freetagging_tokens();
                        }
                      } else {
                        $(this).val("");
                        if($(input).data("settings").allowTabOut) {
                          return true;
                        }
                      }
                      event.stopPropagation();
                      event.preventDefault();
                    }
                    return false;

                  case KEY.ESCAPE:
                    hide_dropdown();
                    return true;

                  default:
                    if (String.fromCharCode(event.which)) {
                      // set a timeout just long enough to let this function finish.
                      setTimeout(function(){ do_search(); }, 5);
                    }
                    break;
              }
          });

      // Keep reference for placeholder
      if (settings.placeholder) {
        input_box.attr("placeholder", settings.placeholder);
      }

      // Keep a reference to the original input box
      var hiddenInput = $(input)
        .hide()
        .val("")
        .focus(function () {
          focusWithTimeout(input_box);
        })
        .blur(function () {
          input_box.blur();

          //return the object to this can be referenced in the callback functions.
          return hiddenInput;
        })
      ;

      // Keep a reference to the selected token and dropdown item
      var selected_token = null;
      var selected_token_index = 0;
      var selected_dropdown_item = null;

      // The list to store the token items in
      var token_list = $("<ul />")
          .addClass($(input).data("settings").classes.tokenList)
          .click(function (event) {
              var li = $(event.target).closest("li");
              if(li && li.get(0) && $.data(li.get(0), "tokeninput")) {
                  toggle_select_token(li);
              } else {
                  // Deselect selected token
                  if(selected_token) {
                      deselect_token($(selected_token), POSITION.END);
                  }

                  // Focus input box
                  focusWithTimeout(input_box);
              }
          })
          .mouseover(function (event) {
              var li = $(event.target).closest("li");
              if(li && selected_token !== this) {
                  li.addClass($(input).data("settings").classes.highlightedToken);
              }
          })
          .mouseout(function (event) {
              var li = $(event.target).closest("li");
              if(li && selected_token !== this) {
                  li.removeClass($(input).data("settings").classes.highlightedToken);
              }
          })
          .insertBefore(hiddenInput);

      // The token holding the input box
      var input_token = $("<li />")
          .addClass($(input).data("settings").classes.inputToken)
          .appendTo(token_list)
          .append(input_box);

      // The list to store the dropdown items in
      var dropdown = $("<div/>")
          .addClass($(input).data("settings").classes.dropdown)
          .appendTo("body")
          .hide();

      // Magic element to help us resize the text input
      var input_resizer = $("<tester/>")
          .insertAfter(input_box)
          .css({
              position: "absolute",
              top: -9999,
              left: -9999,
              width: "auto",
              fontSize: input_box.css("fontSize"),
              fontFamily: input_box.css("fontFamily"),
              fontWeight: input_box.css("fontWeight"),
              letterSpacing: input_box.css("letterSpacing"),
              whiteSpace: "nowrap"
          });

      // Pre-populate list if items exist
      hiddenInput.val("");
      var li_data = $(input).data("settings").prePopulate || hiddenInput.data("pre");

      if ($(input).data("settings").processPrePopulate && $.isFunction($(input).data("settings").onResult)) {
          li_data = $(input).data("settings").onResult.call(hiddenInput, li_data);
      }

      if (li_data && li_data.length) {
          $.each(li_data, function (index, value) {
              insert_token(value);
              checkTokenLimit();
              //input_box.attr("placeholder", null)
          });
      }

      // Check if widget should initialize as disabled
      if ($(input).data("settings").disabled) {
          toggleDisabled(true);
      }

      // Initialization is done
      if (typeof($(input).data("settings").onReady) === "function") {
        $(input).data("settings").onReady.call();
      }

      //
      // Public functions
      //

      this.clear = function() {
          token_list.children("li").each(function() {
              if ($(this).children("input").length === 0) {
                  delete_token($(this));
              }
          });
      };

      this.add = function(item) {
          add_token(item);
      };

      this.remove = function(item) {
          token_list.children("li").each(function() {
              if ($(this).children("input").length === 0) {
                  var currToken = $(this).data("tokeninput");
                  var match = true;
                  for (var prop in item) {
                      if (item[prop] !== currToken[prop]) {
                          match = false;
                          break;
                      }
                  }
                  if (match) {
                      delete_token($(this));
                  }
              }
          });
      };

      this.getTokens = function() {
          return saved_tokens;
      };

      this.toggleDisabled = function(disable) {
          toggleDisabled(disable);
      };

      // Resize input to maximum width so the placeholder can be seen
      resize_input();

      //
      // Private functions
      //

      function escapeHTML(text) {
        return $(input).data("settings").enableHTML ? text : _escapeHTML(text);
      }

      // Toggles the widget between enabled and disabled state, or according
      // to the [disable] parameter.
      function toggleDisabled(disable) {
          if (typeof disable === 'boolean') {
              $(input).data("settings").disabled = disable
          } else {
              $(input).data("settings").disabled = !$(input).data("settings").disabled;
          }
          input_box.attr('disabled', $(input).data("settings").disabled);
          token_list.toggleClass($(input).data("settings").classes.disabled, $(input).data("settings").disabled);
          // if there is any token selected we deselect it
          if(selected_token) {
              deselect_token($(selected_token), POSITION.END);
          }
          hiddenInput.attr('disabled', $(input).data("settings").disabled);
      }

      function checkTokenLimit() {
          if($(input).data("settings").tokenLimit !== null && token_count >= $(input).data("settings").tokenLimit) {
              input_box.hide();
              hide_dropdown();
              return;
          }
      }

      function resize_input() {
          if(input_val === (input_val = input_box.val())) {return;}

          // Get width left on the current line
          var width_left = token_list.width() - input_box.offset().left - token_list.offset().left;
          // Enter new content into resizer and resize input accordingly
          input_resizer.html(_escapeHTML(input_val) || _escapeHTML(settings.placeholder));
          // Get maximum width, minimum the size of input and maximum the widget's width
          input_box.width(Math.min(token_list.width(),
                                   Math.max(width_left, input_resizer.width() + 30)));
      }

      function add_freetagging_tokens() {
          var value = $.trim(input_box.val());
          var tokens = value.split($(input).data("settings").tokenDelimiter);
          $.each(tokens, function(i, token) {
            if (!token) {
              return;
            }

            if ($.isFunction($(input).data("settings").onFreeTaggingAdd)) {
              token = $(input).data("settings").onFreeTaggingAdd.call(hiddenInput, token);
            }
            var object = {};
            object[$(input).data("settings").tokenValue] = object[$(input).data("settings").propertyToSearch] = token;
            add_token(object);
          });
      }

      // Inner function to a token to the list
      function insert_token(item) {
          var $this_token = $($(input).data("settings").tokenFormatter(item));
          var readonly = item.readonly === true;

          if(readonly) $this_token.addClass($(input).data("settings").classes.tokenReadOnly);

          $this_token.addClass($(input).data("settings").classes.token).insertBefore(input_token);

          // The 'delete token' button
          if(!readonly) {
            $("<span>" + $(input).data("settings").deleteText + "</span>")
                .addClass($(input).data("settings").classes.tokenDelete)
                .appendTo($this_token)
                .click(function () {
                    if (!$(input).data("settings").disabled) {
                        delete_token($(this).parent());
                        hiddenInput.change();
                        return false;
                    }
                });
          }

          // Store data on the token
          var token_data = item;
          $.data($this_token.get(0), "tokeninput", item);

          // Save this token for duplicate checking
          saved_tokens = saved_tokens.slice(0,selected_token_index).concat([token_data]).concat(saved_tokens.slice(selected_token_index));
          selected_token_index++;

          // Update the hidden input
          update_hiddenInput(saved_tokens, hiddenInput);

          token_count += 1;

          // Check the token limit
          if($(input).data("settings").tokenLimit !== null && token_count >= $(input).data("settings").tokenLimit) {
              input_box.hide();
              hide_dropdown();
          }

          return $this_token;
      }

      // Add a token to the token list based on user input
      function add_token (item) {
          var callback = $(input).data("settings").onAdd;

          // See if the token already exists and select it if we don't want duplicates
          if(token_count > 0 && $(input).data("settings").preventDuplicates) {
              var found_existing_token = null;
              token_list.children().each(function () {
                  var existing_token = $(this);
                  var existing_data = $.data(existing_token.get(0), "tokeninput");
                  if(existing_data && existing_data[settings.tokenValue] === item[settings.tokenValue]) {
                      found_existing_token = existing_token;
                      return false;
                  }
              });

              if(found_existing_token) {
                  select_token(found_existing_token);
                  input_token.insertAfter(found_existing_token);
                  focusWithTimeout(input_box);
                  return;
              }
          }

          // Squeeze input_box so we force no unnecessary line break
          input_box.width(1);

          // Insert the new tokens
          if($(input).data("settings").tokenLimit == null || token_count < $(input).data("settings").tokenLimit) {
              insert_token(item);
              // Remove the placeholder so it's not seen after you've added a token
              //input_box.attr("placeholder", null);
              checkTokenLimit();
          }

          // Clear input box
          input_box.val("");

          // Don't show the help dropdown, they've got the idea
          hide_dropdown();

          // Execute the onAdd callback if defined
          if($.isFunction(callback)) {
              callback.call(hiddenInput,item);
          }
      }

      // Select a token in the token list
      function select_token (token) {
          if (!$(input).data("settings").disabled) {
              token.addClass($(input).data("settings").classes.selectedToken);
              selected_token = token.get(0);

              // Hide input box
              input_box.val("");

              // Hide dropdown if it is visible (eg if we clicked to select token)
              hide_dropdown();
          }
      }

      // Deselect a token in the token list
      function deselect_token (token, position) {
          token.removeClass($(input).data("settings").classes.selectedToken);
          selected_token = null;

          if(position === POSITION.BEFORE) {
              input_token.insertBefore(token);
              selected_token_index--;
          } else if(position === POSITION.AFTER) {
              input_token.insertAfter(token);
              selected_token_index++;
          } else {
              input_token.appendTo(token_list);
              selected_token_index = token_count;
          }

          // Show the input box and give it focus again
          focusWithTimeout(input_box);
      }

      // Toggle selection of a token in the token list
      function toggle_select_token(token) {
          var previous_selected_token = selected_token;

          if(selected_token) {
              deselect_token($(selected_token), POSITION.END);
          }

          if(previous_selected_token === token.get(0)) {
              deselect_token(token, POSITION.END);
          } else {
              select_token(token);
          }
      }

      // Delete a token from the token list
      function delete_token (token) {
          // Remove the id from the saved list
          var token_data = $.data(token.get(0), "tokeninput");
          var callback = $(input).data("settings").onDelete;

          var index = token.prevAll().length;
          if(index > selected_token_index) index--;

          // Delete the token
          token.remove();
          selected_token = null;

          // Show the input box and give it focus again
          focusWithTimeout(input_box);

          // Remove this token from the saved list
          saved_tokens = saved_tokens.slice(0,index).concat(saved_tokens.slice(index+1));
          if (saved_tokens.length == 0) {
              input_box.attr("placeholder", settings.placeholder)
          }
          if(index < selected_token_index) selected_token_index--;

          // Update the hidden input
          update_hiddenInput(saved_tokens, hiddenInput);

          token_count -= 1;

          if($(input).data("settings").tokenLimit !== null) {
              input_box
                  .show()
                  .val("");
              focusWithTimeout(input_box);
          }

          // Execute the onDelete callback if defined
          if($.isFunction(callback)) {
              callback.call(hiddenInput,token_data);
          }
      }

      // Update the hidden input box value
      function update_hiddenInput(saved_tokens, hiddenInput) {
          var token_values = $.map(saved_tokens, function (el) {
              if(typeof $(input).data("settings").tokenValue == 'function')
                return $(input).data("settings").tokenValue.call(this, el);

              return el[$(input).data("settings").tokenValue];
          });
          hiddenInput.val(token_values.join($(input).data("settings").tokenDelimiter));

      }

      // Hide and clear the results dropdown
      function hide_dropdown () {
          dropdown.hide().empty();
          selected_dropdown_item = null;
      }

      function show_dropdown() {
          dropdown
              .css({
                  position: "absolute",
                  top: token_list.offset().top + token_list.outerHeight(true),
                  left: token_list.offset().left,
                  width: token_list.width(),
                  'z-index': $(input).data("settings").zindex
              })
              .show();
      }

      function show_dropdown_searching () {
          if($(input).data("settings").searchingText) {
              dropdown.html("<p>" + escapeHTML($(input).data("settings").searchingText) + "</p>");
              show_dropdown();
          }
      }

      function show_dropdown_hint () {
          if($(input).data("settings").hintText) {
              dropdown.html("<p>" + escapeHTML($(input).data("settings").hintText) + "</p>");
              show_dropdown();
          }
      }

      var regexp_special_chars = new RegExp('[.\\\\+*?\\[\\^\\]$(){}=!<>|:\\-]', 'g');
      function regexp_escape(term) {
          return term;
          return term.replace(regexp_special_chars, '\\$&');
      }

      // Highlight the query part of the search term
      function highlight_term(value, term) {
          return value;
          return value.replace(
            new RegExp(
              "(?![^&;]+;)(?!<[^<>]*)(" + regexp_escape(term) + ")(?![^<>]*>)(?![^&;]+;)",
              "gi"
            ), function(match, p1) {
              return "<b>" + escapeHTML(p1) + "</b>";
            }
          );
      }

      function find_value_and_highlight_term(template, value, term) {
          return template.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + regexp_escape(value) + ")(?![^<>]*>)(?![^&;]+;)", "g"), highlight_term(value, term));
      }

      // exclude existing tokens from dropdown, so the list is clearer
      function excludeCurrent(results) {
          if ($(input).data("settings").excludeCurrent) {
              var currentTokens = $(input).data("tokenInputObject").getTokens(),
                  trimmedList = [];
              if (currentTokens.length) {
                  $.each(results, function(index, value) {
                      var notFound = true;
                      $.each(currentTokens, function(cIndex, cValue) {
                          if (value[$(input).data("settings").propertyToSearch] == cValue[$(input).data("settings").propertyToSearch]) {
                              notFound = false;
                              return false;
                          }
                      });

                      if (notFound) {
                          trimmedList.push(value);
                      }
                  });
                  results = trimmedList;
              }
          }

          return results;
      }

      // Populate the results dropdown with some results
      function populateDropdown (query, results) {
          console.log('populateDropdown');
          console.log(results);
          // exclude current tokens if configured
          results = excludeCurrent(results);

          if(results && results.length) {
              dropdown.empty();
              var dropdown_ul = $("<ul/>")
                  .appendTo(dropdown)
                  .mouseover(function (event) {
                      select_dropdown_item($(event.target).closest("li"));
                  })
                  .mousedown(function (event) {
                      add_token($(event.target).closest("li").data("tokeninput"));
                      hiddenInput.change();
                      return false;
                  })
                  .hide();

              if ($(input).data("settings").resultsLimit && results.length > $(input).data("settings").resultsLimit) {
                  results = results.slice(0, $(input).data("settings").resultsLimit);
              }

              $.each(results, function(index, value) {
                  var this_li = $(input).data("settings").resultsFormatter(value);

                  this_li = find_value_and_highlight_term(this_li ,value[$(input).data("settings").propertyToSearch], query);
                  this_li = $(this_li).appendTo(dropdown_ul);

                  if(index % 2) {
                      this_li.addClass($(input).data("settings").classes.dropdownItem);
                  } else {
                      this_li.addClass($(input).data("settings").classes.dropdownItem2);
                  }

                  if(index === 0 && $(input).data("settings").autoSelectFirstResult) {
                      select_dropdown_item(this_li);
                  }

                  $.data(this_li.get(0), "tokeninput", value);
              });

              show_dropdown();

              if($(input).data("settings").animateDropdown) {
                  dropdown_ul.slideDown("fast");
              } else {
                  dropdown_ul.show();
              }
          } else {
              if($(input).data("settings").noResultsText) {
                  dropdown.html("<p>" + escapeHTML($(input).data("settings").noResultsText) + "</p>");
                  show_dropdown();
              }
          }
      }

      // Highlight an item in the results dropdown
      function select_dropdown_item (item) {
          if(item) {
              if(selected_dropdown_item) {
                  deselect_dropdown_item($(selected_dropdown_item));
              }

              item.addClass($(input).data("settings").classes.selectedDropdownItem);
              selected_dropdown_item = item.get(0);
          }
      }

      // Remove highlighting from an item in the results dropdown
      function deselect_dropdown_item (item) {
          item.removeClass($(input).data("settings").classes.selectedDropdownItem);
          selected_dropdown_item = null;
      }

      // Do a search and show the "searching" dropdown if the input is longer
      // than $(input).data("settings").minChars
      function do_search() {
          var query = input_box.val();

          if(query && query.length) {
              if(selected_token) {
                  deselect_token($(selected_token), POSITION.AFTER);
              }

              if(query.length >= $(input).data("settings").minChars) {
                  show_dropdown_searching();
                  clearTimeout(timeout);

                  timeout = setTimeout(function(){
                      run_search(query);
                  }, $(input).data("settings").searchDelay);
              } else {
                  hide_dropdown();
              }
          }
      }

      // Do the actual search
      function run_search(query) {
          //query = $(input).data("settings").queryDefault + query;
          console.log(query);
          var cache_key = query + computeURL();
          var cached_results = cache.get(cache_key);
          if (cached_results) {
              if ($.isFunction($(input).data("settings").onCachedResult)) {
                cached_results = $(input).data("settings").onCachedResult.call(hiddenInput, cached_results);
              }
              populateDropdown(query, cached_results);
          } else {
              // Are we doing an ajax search or local data search?
              if($(input).data("settings").url) {
                  var url = computeURL();
                  // Extract existing get params
                  var ajax_params = {};
                  ajax_params.data = {};
                  
                  if(url.indexOf("?") > -1) {
                      var parts = url.split("?");
                      ajax_params.url = parts[0];

                      var param_array = parts[1].split("&");
                      $.each(param_array, function (index, value) {
                          var kv = value.split("=");
                          ajax_params.data[kv[0]] = kv[1];
                      });
                  } else {
                      ajax_params.url = url;
                  }

                  // Prepare the request
                  ajax_params.data[$(input).data("settings").queryParam] = $(input).data("settings").queryDefault + query;
                  
                  ajax_params.type = $(input).data("settings").method;
                  //ajax_params.dataType = $(input).data("settings").contentType;
                  ajax_params.contentType = $(input).data("settings").contentType;
                  
                  ///if ($(input).data("settings").crossDomain) {
                   //   ajax_params.dataType = "jsonp";
                  //}
                  ajax_params.headers = $(input).data("settings").ajaxHeaders;
                  /*
                  $.each($(input).data("settings").ajaxHeaders, function(k, v){
                      ajax_params[k] = v;
                  });
                  */
                  // exclude current tokens?
                  // send exclude list to the server, so it can also exclude existing tokens
                  if ($(input).data("settings").excludeCurrent) {
                      var currentTokens = $(input).data("tokenInputObject").getTokens();
                      var tokenList = $.map(currentTokens, function (el) {
                          if(typeof $(input).data("settings").tokenValue == 'function')
                              return $(input).data("settings").tokenValue.call(this, el);

                          return el[$(input).data("settings").tokenValue];
                      });

                      ajax_params.data[$(input).data("settings").excludeCurrentParameter] = tokenList.join($(input).data("settings").tokenDelimiter);
                  }

                  // Attach the success callback
                  ajax_params.success = function(results) {
                      console.log('success');
                      console.log(results);
                    
                    cache.add(cache_key, $(input).data("settings").jsonContainer ? results[$(input).data("settings").jsonContainer] : results);
                    
                    if($.isFunction($(input).data("settings").onResult)) {
                        results = $(input).data("settings").onResult.call(hiddenInput, results);
                    }

                    // only populate the dropdown if the results are associated with the active search query
                    if(input_box.val() === query) {
                      //console.log($(input).data("settings").jsonContainer ? results[$(input).data("settings").jsonContainer] : results);
                        populateDropdown(query, $(input).data("settings").jsonContainer ? results[$(input).data("settings").jsonContainer] : results);
                    }
                  };

                  // Provide a beforeSend callback
                  if (settings.onSend) {
                    settings.onSend(ajax_params);
                  }

                  if ($(input).data("settings").dataStringify) {
                      ajax_params.data = JSON.stringify(ajax_params.data);
                  }
                  console.log(ajax_params);
                  // Make the request
                  $.ajax(ajax_params);
              } else if($(input).data("settings").local_data) {
                  // Do the search through local data
                  var results = $.grep($(input).data("settings").local_data, function (row) {
                      return row[$(input).data("settings").propertyToSearch].toLowerCase().indexOf(query.toLowerCase()) > -1;
                  });

                  cache.add(cache_key, results);
                  if($.isFunction($(input).data("settings").onResult)) {
                      results = $(input).data("settings").onResult.call(hiddenInput, results);
                  }
                  populateDropdown(query, results);
              }
          }
      }

      // compute the dynamic URL
      function computeURL() {
          var settings = $(input).data("settings");
          return typeof settings.url == 'function' ? settings.url.call(settings) : settings.url;
      }

      // Bring browser focus to the specified object.
      // Use of setTimeout is to get around an IE bug.
      // (See, e.g., http://stackoverflow.com/questions/2600186/focus-doesnt-work-in-ie)
      //
      // obj: a jQuery object to focus()
      function focusWithTimeout(object) {
          setTimeout(
            function() {
			  object.focus();
            },
			50
		  );
      }
  };

  // Really basic cache for the results
  $.TokenList.Cache = function (options) {
    var settings, data = {}, size = 0, flush;

    settings = $.extend({ max_size: 500 }, options);

    flush = function () {
      data = {};
      size = 0;
    };

    this.add = function (query, results) {
      if (size > settings.max_size) {
        flush();
      }

      if (!data[query]) {
        size += 1;
      }

      data[query] = results;
    };

    this.get = function (query) {
      return data[query];
    };
  };

}(jQuery));
/*!
 * fullPage 2.9.4
 * https://github.com/alvarotrigo/fullPage.js
 * @license MIT licensed
 *
 * Copyright (C) 2015 alvarotrigo.com - A project by Alvaro Trigo
 */
(function(global, factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], function($) {
          return factory($, global, global.document, global.Math);
        });
    } else if (typeof exports === "object" && exports) {
        module.exports = factory(require('jquery'), global, global.document, global.Math);
    } else {
        factory(jQuery, global, global.document, global.Math);
    }
})(typeof window !== 'undefined' ? window : this, function($, window, document, Math, undefined) {
    'use strict';

    // keeping central set of classnames and selectors
    var WRAPPER =               'fullpage-wrapper';
    var WRAPPER_SEL =           '.' + WRAPPER;

    // slimscroll
    var SCROLLABLE =            'fp-scrollable';
    var SCROLLABLE_SEL =        '.' + SCROLLABLE;

    // util
    var RESPONSIVE =            'fp-responsive';
    var NO_TRANSITION =         'fp-notransition';
    var DESTROYED =             'fp-destroyed';
    var ENABLED =               'fp-enabled';
    var VIEWING_PREFIX =        'fp-viewing';
    var ACTIVE =                'active';
    var ACTIVE_SEL =            '.' + ACTIVE;
    var COMPLETELY =            'fp-completely';
    var COMPLETELY_SEL =        '.' + COMPLETELY;

    // section
    var SECTION_DEFAULT_SEL =   '.section';
    var SECTION =               'fp-section';
    var SECTION_SEL =           '.' + SECTION;
    var SECTION_ACTIVE_SEL =    SECTION_SEL + ACTIVE_SEL;
    var SECTION_FIRST_SEL =     SECTION_SEL + ':first';
    var SECTION_LAST_SEL =      SECTION_SEL + ':last';
    var TABLE_CELL =            'fp-tableCell';
    var TABLE_CELL_SEL =        '.' + TABLE_CELL;
    var AUTO_HEIGHT =           'fp-auto-height';
    var AUTO_HEIGHT_SEL =       '.fp-auto-height';
    var NORMAL_SCROLL =         'fp-normal-scroll';
    var NORMAL_SCROLL_SEL =     '.fp-normal-scroll';

    // section nav
    var SECTION_NAV =           'fp-nav';
    var SECTION_NAV_SEL =       '#' + SECTION_NAV;
    var SECTION_NAV_TOOLTIP =   'fp-tooltip';
    var SECTION_NAV_TOOLTIP_SEL='.'+SECTION_NAV_TOOLTIP;
    var SHOW_ACTIVE_TOOLTIP =   'fp-show-active';

    // slide
    var SLIDE_DEFAULT_SEL =     '.slide';
    var SLIDE =                 'fp-slide';
    var SLIDE_SEL =             '.' + SLIDE;
    var SLIDE_ACTIVE_SEL =      SLIDE_SEL + ACTIVE_SEL;
    var SLIDES_WRAPPER =        'fp-slides';
    var SLIDES_WRAPPER_SEL =    '.' + SLIDES_WRAPPER;
    var SLIDES_CONTAINER =      'fp-slidesContainer';
    var SLIDES_CONTAINER_SEL =  '.' + SLIDES_CONTAINER;
    var TABLE =                 'fp-table';

    // slide nav
    var SLIDES_NAV =            'fp-slidesNav';
    var SLIDES_NAV_SEL =        '.' + SLIDES_NAV;
    var SLIDES_NAV_LINK_SEL =   SLIDES_NAV_SEL + ' a';
    var SLIDES_ARROW =          'fp-controlArrow';
    var SLIDES_ARROW_SEL =      '.' + SLIDES_ARROW;
    var SLIDES_PREV =           'fp-prev';
    var SLIDES_PREV_SEL =       '.' + SLIDES_PREV;
    var SLIDES_ARROW_PREV =     SLIDES_ARROW + ' ' + SLIDES_PREV;
    var SLIDES_ARROW_PREV_SEL = SLIDES_ARROW_SEL + SLIDES_PREV_SEL;
    var SLIDES_NEXT =           'fp-next';
    var SLIDES_NEXT_SEL =       '.' + SLIDES_NEXT;
    var SLIDES_ARROW_NEXT =     SLIDES_ARROW + ' ' + SLIDES_NEXT;
    var SLIDES_ARROW_NEXT_SEL = SLIDES_ARROW_SEL + SLIDES_NEXT_SEL;

    var $window = $(window);
    var $document = $(document);

    // Default options for iScroll.js used when using scrollOverflow
    var iscrollOptions = {
        scrollbars: true,
        mouseWheel: true,
        hideScrollbars: false,
        fadeScrollbars: false,
        disableMouse: true,
        interactiveScrollbars: true
    };

    $.fn.fullpage = function(options) {
        //only once my friend!
        if($('html').hasClass(ENABLED)){ displayWarnings(); return; }

        // common jQuery objects
        var $htmlBody = $('html, body');
        var $body = $('body');

        var FP = $.fn.fullpage;

        // Creating some defaults, extending them with any options that were provided
        options = $.extend({
            //navigation
            menu: false,
            anchors:[],
            lockAnchors: false,
            navigation: false,
            navigationPosition: 'right',
            navigationTooltips: [],
            showActiveTooltip: false,
            slidesNavigation: false,
            slidesNavPosition: 'bottom',
            scrollBar: false,
            hybrid: false,

            //scrolling
            css3: true,
            scrollingSpeed: 700,
            autoScrolling: true,
            fitToSection: true,
            fitToSectionDelay: 1000,
            easing: 'easeInOutCubic',
            easingcss3: 'ease',
            loopBottom: false,
            loopTop: false,
            loopHorizontal: true,
            continuousVertical: false,
            continuousHorizontal: false,
            scrollHorizontally: false,
            interlockedSlides: false,
            dragAndMove: false,
            offsetSections: false,
            resetSliders: false,
            fadingEffect: false,
            normalScrollElements: null,
            scrollOverflow: false,
            scrollOverflowReset: false,
            scrollOverflowHandler: iscrollHandler,
            scrollOverflowOptions: null,
            touchSensitivity: 5,
            normalScrollElementTouchThreshold: 5,
            bigSectionsDestination: null,

            //Accessibility
            keyboardScrolling: true,
            animateAnchor: true,
            recordHistory: true,

            //design
            controlArrows: true,
            controlArrowColor: '#fff',
            verticalCentered: true,
            sectionsColor : [],
            paddingTop: 0,
            paddingBottom: 0,
            fixedElements: null,
            responsive: 0, //backwards compabitility with responsiveWiddth
            responsiveWidth: 0,
            responsiveHeight: 0,
            responsiveSlides: false,
            parallax: false,
            parallaxOptions: {
                type: 'reveal',
                percentage: 62,
                property: 'translate'
            },

            //Custom selectors
            sectionSelector: SECTION_DEFAULT_SEL,
            slideSelector: SLIDE_DEFAULT_SEL,

            //events
            afterLoad: null,
            onLeave: null,
            afterRender: null,
            afterResize: null,
            afterReBuild: null,
            afterSlideLoad: null,
            onSlideLeave: null,
            afterResponsive: null,

            lazyLoading: true
        }, options);

        //flag to avoid very fast sliding for landscape sliders
        var slideMoving = false;

        var isTouchDevice = navigator.userAgent.match(/(iPhone|iPod|iPad|Android|playbook|silk|BlackBerry|BB10|Windows Phone|Tizen|Bada|webOS|IEMobile|Opera Mini)/);
        var isTouch = (('ontouchstart' in window) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));
        var container = $(this);
        var windowsHeight = $window.height();
        var isResizing = false;
        var isWindowFocused = true;
        var lastScrolledDestiny;
        var lastScrolledSlide;
        var canScroll = true;
        var scrollings = [];
        var controlPressed;
        var startingSection;
        var isScrollAllowed = {};
        isScrollAllowed.m = {  'up':true, 'down':true, 'left':true, 'right':true };
        isScrollAllowed.k = $.extend(true,{}, isScrollAllowed.m);
        var MSPointer = getMSPointer();
        var events = {
            touchmove: 'ontouchmove' in window ? 'touchmove' :  MSPointer.move,
            touchstart: 'ontouchstart' in window ? 'touchstart' :  MSPointer.down
        };

        //timeouts
        var resizeId;
        var afterSectionLoadsId;
        var afterSlideLoadsId;
        var scrollId;
        var scrollId2;
        var keydownId;
        var originals = $.extend(true, {}, options); //deep copy

        displayWarnings();

        //fixing bug in iScroll with links: https://github.com/cubiq/iscroll/issues/783
        iscrollOptions.click = isTouch; // see #2035

        //extending iScroll options with the user custom ones
        iscrollOptions = $.extend(iscrollOptions, options.scrollOverflowOptions);

        //easeInOutCubic animation included in the plugin
        $.extend($.easing,{ easeInOutCubic: function (x, t, b, c, d) {if ((t/=d/2) < 1) return c/2*t*t*t + b;return c/2*((t-=2)*t*t + 2) + b;}});

        /**
        * Sets the autoScroll option.
        * It changes the scroll bar visibility and the history of the site as a result.
        */
        function setAutoScrolling(value, type){
            //removing the transformation
            if(!value){
                silentScroll(0);
            }

            setVariableState('autoScrolling', value, type);

            var element = $(SECTION_ACTIVE_SEL);

            if(options.autoScrolling && !options.scrollBar){
                $htmlBody.css({
                    'overflow' : 'hidden',
                    'height' : '100%'
                });

                setRecordHistory(originals.recordHistory, 'internal');

                //for IE touch devices
                container.css({
                    '-ms-touch-action': 'none',
                    'touch-action': 'none'
                });

                if(element.length){
                    //moving the container up
                    silentScroll(element.position().top);
                }

            }else{
                $htmlBody.css({
                    'overflow' : 'visible',
                    'height' : 'initial'
                });

                setRecordHistory(false, 'internal');

                //for IE touch devices
                container.css({
                    '-ms-touch-action': '',
                    'touch-action': ''
                });

                //scrolling the page to the section with no animation
                if (element.length) {
                    $htmlBody.scrollTop(element.position().top);
                }
            }
        }

        /**
        * Defines wheter to record the history for each hash change in the URL.
        */
        function setRecordHistory(value, type){
            setVariableState('recordHistory', value, type);
        }

        /**
        * Defines the scrolling speed
        */
        function setScrollingSpeed(value, type){
            setVariableState('scrollingSpeed', value, type);
        }

        /**
        * Sets fitToSection
        */
        function setFitToSection(value, type){
            setVariableState('fitToSection', value, type);
        }

        /**
        * Sets lockAnchors
        */
        function setLockAnchors(value){
            options.lockAnchors = value;
        }

        /**
        * Adds or remove the possiblity of scrolling through sections by using the mouse wheel or the trackpad.
        */
        function setMouseWheelScrolling(value){
            if(value){
                addMouseWheelHandler();
                addMiddleWheelHandler();
            }else{
                removeMouseWheelHandler();
                removeMiddleWheelHandler();
            }
        }

        /**
        * Adds or remove the possibility of scrolling through sections by using the mouse wheel/trackpad or touch gestures.
        * Optionally a second parameter can be used to specify the direction for which the action will be applied.
        *
        * @param directions string containing the direction or directions separated by comma.
        */
        function setAllowScrolling(value, directions){
            if(typeof directions !== 'undefined'){
                directions = directions.replace(/ /g,'').split(',');

                $.each(directions, function (index, direction){
                    setIsScrollAllowed(value, direction, 'm');
                });
            }
            else if(value){
                setMouseWheelScrolling(true);
                addTouchHandler();
            }else{
                setMouseWheelScrolling(false);
                removeTouchHandler();
            }
        }

        /**
        * Adds or remove the possibility of scrolling through sections by using the keyboard arrow keys
        */
        function setKeyboardScrolling(value, directions){
            if(typeof directions !== 'undefined'){
                directions = directions.replace(/ /g,'').split(',');

                $.each(directions, function (index, direction){
                    setIsScrollAllowed(value, direction, 'k');
                });
            }else{
                options.keyboardScrolling = value;
            }
        }

        /**
        * Moves the page up one section.
        */
        function moveSectionUp(){
            var prev = $(SECTION_ACTIVE_SEL).prev(SECTION_SEL);

            //looping to the bottom if there's no more sections above
            if (!prev.length && (options.loopTop || options.continuousVertical)) {
                prev = $(SECTION_SEL).last();
            }

            if (prev.length) {
                scrollPage(prev, null, true);
            }
        }

        /**
        * Moves the page down one section.
        */
        function moveSectionDown(){
            var next = $(SECTION_ACTIVE_SEL).next(SECTION_SEL);

            //looping to the top if there's no more sections below
            if(!next.length &&
                (options.loopBottom || options.continuousVertical)){
                next = $(SECTION_SEL).first();
            }

            if(next.length){
                scrollPage(next, null, false);
            }
        }

        /**
        * Moves the page to the given section and slide with no animation.
        * Anchors or index positions can be used as params.
        */
        function silentMoveTo(sectionAnchor, slideAnchor){
            setScrollingSpeed (0, 'internal');
            moveTo(sectionAnchor, slideAnchor);
            setScrollingSpeed (originals.scrollingSpeed, 'internal');
        }

        /**
        * Moves the page to the given section and slide.
        * Anchors or index positions can be used as params.
        */
        function moveTo(sectionAnchor, slideAnchor){
            var destiny = getSectionByAnchor(sectionAnchor);

            if (typeof slideAnchor !== 'undefined'){
                scrollPageAndSlide(sectionAnchor, slideAnchor);
            }else if(destiny.length > 0){
                scrollPage(destiny);
            }
        }

        /**
        * Slides right the slider of the active section.
        * Optional `section` param.
        */
        function moveSlideRight(section){
            moveSlide('right', section);
        }

        /**
        * Slides left the slider of the active section.
        * Optional `section` param.
        */
        function moveSlideLeft(section){
            moveSlide('left', section);
        }

        /**
         * When resizing is finished, we adjust the slides sizes and positions
         */
        function reBuild(resizing){
            if(container.hasClass(DESTROYED)){ return; }  //nothing to do if the plugin was destroyed

            isResizing = true;

            windowsHeight = $window.height();  //updating global var

            $(SECTION_SEL).each(function(){
                var slidesWrap = $(this).find(SLIDES_WRAPPER_SEL);
                var slides = $(this).find(SLIDE_SEL);

                //adjusting the height of the table-cell for IE and Firefox
                if(options.verticalCentered){
                    $(this).find(TABLE_CELL_SEL).css('height', getTableHeight($(this)) + 'px');
                }

                $(this).css('height', windowsHeight + 'px');

                //resizing the scrolling divs
                if(options.scrollOverflow){
                    if(slides.length){
                        slides.each(function(){
                            createScrollBar($(this));
                        });
                    }else{
                        createScrollBar($(this));
                    }
                }

                //adjusting the position fo the FULL WIDTH slides...
                if (slides.length > 1) {
                    landscapeScroll(slidesWrap, slidesWrap.find(SLIDE_ACTIVE_SEL));
                }
            });

            var activeSection = $(SECTION_ACTIVE_SEL);
            var sectionIndex = activeSection.index(SECTION_SEL);

            //isn't it the first section?
            if(sectionIndex){
                //adjusting the position for the current section
                silentMoveTo(sectionIndex + 1);
            }

            isResizing = false;
            $.isFunction( options.afterResize ) && resizing && options.afterResize.call(container);
            $.isFunction( options.afterReBuild ) && !resizing && options.afterReBuild.call(container);
        }

        /**
        * Turns fullPage.js to normal scrolling mode when the viewport `width` or `height`
        * are smaller than the set limit values.
        */
        function setResponsive(active){
            var isResponsive = $body.hasClass(RESPONSIVE);

            if(active){
                if(!isResponsive){
                    setAutoScrolling(false, 'internal');
                    setFitToSection(false, 'internal');
                    $(SECTION_NAV_SEL).hide();
                    $body.addClass(RESPONSIVE);
                    $.isFunction( options.afterResponsive ) && options.afterResponsive.call( container, active);
                }
            }
            else if(isResponsive){
                setAutoScrolling(originals.autoScrolling, 'internal');
                setFitToSection(originals.autoScrolling, 'internal');
                $(SECTION_NAV_SEL).show();
                $body.removeClass(RESPONSIVE);
                $.isFunction( options.afterResponsive ) && options.afterResponsive.call( container, active);
            }
        }

        if($(this).length){
            //public functions
            FP.setAutoScrolling = setAutoScrolling;
            FP.setRecordHistory = setRecordHistory;
            FP.setScrollingSpeed = setScrollingSpeed;
            FP.setFitToSection = setFitToSection;
            FP.setLockAnchors = setLockAnchors;
            FP.setMouseWheelScrolling = setMouseWheelScrolling;
            FP.setAllowScrolling = setAllowScrolling;
            FP.setKeyboardScrolling = setKeyboardScrolling;
            FP.moveSectionUp = moveSectionUp;
            FP.moveSectionDown = moveSectionDown;
            FP.silentMoveTo = silentMoveTo;
            FP.moveTo = moveTo;
            FP.moveSlideRight = moveSlideRight;
            FP.moveSlideLeft = moveSlideLeft;
            FP.fitToSection = fitToSection;
            FP.reBuild = reBuild;
            FP.setResponsive = setResponsive;
            FP.destroy = destroy;

            init();

            bindEvents();
        }

        function init(){
            //if css3 is not supported, it will use jQuery animations
            if(options.css3){
                options.css3 = support3d();
            }

            options.scrollBar = options.scrollBar || options.hybrid;

            setOptionsFromDOM();
            prepareDom();
            setAllowScrolling(true);
            setAutoScrolling(options.autoScrolling, 'internal');
            responsive();

            //setting the class for the body element
            setBodyClass();

            if(document.readyState === 'complete'){
                scrollToAnchor();
            }
            $window.on('load', scrollToAnchor);
        }

        function bindEvents(){
            $window
                //when scrolling...
                .on('scroll', scrollHandler)

                //detecting any change on the URL to scroll to the given anchor link
                //(a way to detect back history button as we play with the hashes on the URL)
                .on('hashchange', hashChangeHandler)

                //when opening a new tab (ctrl + t), `control` won't be pressed when coming back.
                .blur(blurHandler)

                //when resizing the site, we adjust the heights of the sections, slimScroll...
                .resize(resizeHandler);

            $document
                //Sliding with arrow keys, both, vertical and horizontal
                .keydown(keydownHandler)

                //to prevent scrolling while zooming
                .keyup(keyUpHandler)

                //Scrolls to the section when clicking the navigation bullet
                .on('click touchstart', SECTION_NAV_SEL + ' a', sectionBulletHandler)

                //Scrolls the slider to the given slide destination for the given section
                .on('click touchstart', SLIDES_NAV_LINK_SEL, slideBulletHandler)

                .on('click', SECTION_NAV_TOOLTIP_SEL, tooltipTextHandler);

            //Scrolling horizontally when clicking on the slider controls.
            $(SECTION_SEL).on('click touchstart', SLIDES_ARROW_SEL, slideArrowHandler);

            /**
            * Applying normalScroll elements.
            * Ignoring the scrolls over the specified selectors.
            */
            if(options.normalScrollElements){
                $document.on('mouseenter', options.normalScrollElements, function () {
                    setMouseWheelScrolling(false);
                });

                $document.on('mouseleave', options.normalScrollElements, function(){
                    setMouseWheelScrolling(true);
                });
            }
        }

        /**
        * Setting options from DOM elements if they are not provided.
        */
        function setOptionsFromDOM(){
            var sections = container.find(options.sectionSelector);

            //no anchors option? Checking for them in the DOM attributes
            if(!options.anchors.length){
                options.anchors = sections.filter('[data-anchor]').map(function(){
                    return $(this).data('anchor').toString();
                }).get();
            }

            //no tooltips option? Checking for them in the DOM attributes
            if(!options.navigationTooltips.length){
                options.navigationTooltips = sections.filter('[data-tooltip]').map(function(){
                    return $(this).data('tooltip').toString();
                }).get();
            }
        }

        /**
        * Works over the DOM structure to set it up for the current fullpage options.
        */
        function prepareDom(){
            container.css({
                'height': '100%',
                'position': 'relative'
            });

            //adding a class to recognize the container internally in the code
            container.addClass(WRAPPER);
            $('html').addClass(ENABLED);

            //due to https://github.com/alvarotrigo/fullPage.js/issues/1502
            windowsHeight = $window.height();

            container.removeClass(DESTROYED); //in case it was destroyed before initializing it again

            addInternalSelectors();

             //styling the sections / slides / menu
            $(SECTION_SEL).each(function(index){
                var section = $(this);
                var slides = section.find(SLIDE_SEL);
                var numSlides = slides.length;

                styleSection(section, index);
                styleMenu(section, index);

                // if there's any slide
                if (numSlides > 0) {
                    styleSlides(section, slides, numSlides);
                }else{
                    if(options.verticalCentered){
                        addTableClass(section);
                    }
                }
            });

            //fixed elements need to be moved out of the plugin container due to problems with CSS3.
            if(options.fixedElements && options.css3){
                $(options.fixedElements).appendTo($body);
            }

            //vertical centered of the navigation + active bullet
            if(options.navigation){
                addVerticalNavigation();
            }

            enableYoutubeAPI();

            if(options.scrollOverflow){
                if(document.readyState === 'complete'){
                    createScrollBarHandler();
                }
                //after DOM and images are loaded
                $window.on('load', createScrollBarHandler);
            }else{
                afterRenderActions();
            }
        }

        /**
        * Styles the horizontal slides for a section.
        */
        function styleSlides(section, slides, numSlides){
            var sliderWidth = numSlides * 100;
            var slideWidth = 100 / numSlides;

            slides.wrapAll('<div class="' + SLIDES_CONTAINER + '" />');
            slides.parent().wrap('<div class="' + SLIDES_WRAPPER + '" />');

            section.find(SLIDES_CONTAINER_SEL).css('width', sliderWidth + '%');

            if(numSlides > 1){
                if(options.controlArrows){
                    createSlideArrows(section);
                }

                if(options.slidesNavigation){
                    addSlidesNavigation(section, numSlides);
                }
            }

            slides.each(function(index) {
                $(this).css('width', slideWidth + '%');

                if(options.verticalCentered){
                    addTableClass($(this));
                }
            });

            var startingSlide = section.find(SLIDE_ACTIVE_SEL);

            //if the slide won't be an starting point, the default will be the first one
            //the active section isn't the first one? Is not the first slide of the first section? Then we load that section/slide by default.
            if( startingSlide.length &&  ($(SECTION_ACTIVE_SEL).index(SECTION_SEL) !== 0 || ($(SECTION_ACTIVE_SEL).index(SECTION_SEL) === 0 && startingSlide.index() !== 0))){
                silentLandscapeScroll(startingSlide, 'internal');
            }else{
                slides.eq(0).addClass(ACTIVE);
            }
        }

        /**
        * Styling vertical sections
        */
        function styleSection(section, index){
            //if no active section is defined, the 1st one will be the default one
            if(!index && $(SECTION_ACTIVE_SEL).length === 0) {
                section.addClass(ACTIVE);
            }
            startingSection = $(SECTION_ACTIVE_SEL);

            section.css('height', windowsHeight + 'px');

            if(options.paddingTop){
                section.css('padding-top', options.paddingTop);
            }

            if(options.paddingBottom){
                section.css('padding-bottom', options.paddingBottom);
            }

            if (typeof options.sectionsColor[index] !==  'undefined') {
                section.css('background-color', options.sectionsColor[index]);
            }

            if (typeof options.anchors[index] !== 'undefined') {
                section.attr('data-anchor', options.anchors[index]);
            }
        }

        /**
        * Sets the data-anchor attributes to the menu elements and activates the current one.
        */
        function styleMenu(section, index){
            if (typeof options.anchors[index] !== 'undefined') {
                //activating the menu / nav element on load
                if(section.hasClass(ACTIVE)){
                    activateMenuAndNav(options.anchors[index], index);
                }
            }

            //moving the menu outside the main container if it is inside (avoid problems with fixed positions when using CSS3 tranforms)
            if(options.menu && options.css3 && $(options.menu).closest(WRAPPER_SEL).length){
                $(options.menu).appendTo($body);
            }
        }

        /**
        * Adds internal classes to be able to provide customizable selectors
        * keeping the link with the style sheet.
        */
        function addInternalSelectors(){
            container.find(options.sectionSelector).addClass(SECTION);
            container.find(options.slideSelector).addClass(SLIDE);
        }

        /**
        * Creates the control arrows for the given section
        */
        function createSlideArrows(section){
            section.find(SLIDES_WRAPPER_SEL).after('<div class="' + SLIDES_ARROW_PREV + '"></div><div class="' + SLIDES_ARROW_NEXT + '"></div>');

            if(options.controlArrowColor!='#fff'){
                section.find(SLIDES_ARROW_NEXT_SEL).css('border-color', 'transparent transparent transparent '+options.controlArrowColor);
                section.find(SLIDES_ARROW_PREV_SEL).css('border-color', 'transparent '+ options.controlArrowColor + ' transparent transparent');
            }

            if(!options.loopHorizontal){
                section.find(SLIDES_ARROW_PREV_SEL).hide();
            }
        }

        /**
        * Creates a vertical navigation bar.
        */
        function addVerticalNavigation(){
            $body.append('<div id="' + SECTION_NAV + '"><ul></ul></div>');
            var nav = $(SECTION_NAV_SEL);

            nav.addClass(function() {
                return options.showActiveTooltip ? SHOW_ACTIVE_TOOLTIP + ' ' + options.navigationPosition : options.navigationPosition;
            });

            for (var i = 0; i < $(SECTION_SEL).length; i++) {
                var link = '';
                if (options.anchors.length) {
                    link = options.anchors[i];
                }

                var li = '<li><a href="#' + link + '"><span></span></a>';

                // Only add tooltip if needed (defined by user)
                var tooltip = options.navigationTooltips[i];

                if (typeof tooltip !== 'undefined' && tooltip !== '') {
                    li += '<div class="' + SECTION_NAV_TOOLTIP + ' ' + options.navigationPosition + '">' + tooltip + '</div>';
                }

                li += '</li>';

                nav.find('ul').append(li);
            }

            //centering it vertically
            $(SECTION_NAV_SEL).css('margin-top', '-' + ($(SECTION_NAV_SEL).height()/2) + 'px');

            //activating the current active section
            $(SECTION_NAV_SEL).find('li').eq($(SECTION_ACTIVE_SEL).index(SECTION_SEL)).find('a').addClass(ACTIVE);
        }

        /**
        * Creates the slim scroll scrollbar for the sections and slides inside them.
        */
        function createScrollBarHandler(){
            $(SECTION_SEL).each(function(){
                var slides = $(this).find(SLIDE_SEL);

                if(slides.length){
                    slides.each(function(){
                        createScrollBar($(this));
                    });
                }else{
                    createScrollBar($(this));
                }

            });
            afterRenderActions();
        }

        /*
        * Enables the Youtube videos API so we can control their flow if necessary.
        */
        function enableYoutubeAPI(){
            container.find('iframe[src*="youtube.com/embed/"]').each(function(){
                addURLParam($(this), 'enablejsapi=1');
            });
        }

        /**
        * Adds a new parameter and its value to the `src` of a given element
        */
        function addURLParam(element, newParam){
            var originalSrc = element.attr('src');
            element.attr('src', originalSrc + getUrlParamSign(originalSrc) + newParam);
        }

        /*
        * Returns the prefix sign to use for a new parameter in an existen URL.
        *
        * @return {String}  ? | &
        */
        function getUrlParamSign(url){
            return ( !/\?/.test( url ) ) ? '?' : '&';
        }

        /**
        * Actions and callbacks to fire afterRender
        */
        function afterRenderActions(){
            var section = $(SECTION_ACTIVE_SEL);

            section.addClass(COMPLETELY);

            if(options.scrollOverflowHandler.afterRender){
                options.scrollOverflowHandler.afterRender(section);
            }
            lazyLoad(section);
            playMedia(section);
            options.scrollOverflowHandler.afterLoad();
            
            if(isDestinyTheStartingSection()){
                $.isFunction( options.afterLoad ) && options.afterLoad.call(section, section.data('anchor'), (section.index(SECTION_SEL) + 1));
            }

            $.isFunction( options.afterRender ) && options.afterRender.call(container);
        }

        /**
        * Determines if the URL anchor destiny is the starting section (the one using 'active' class before initialization)
        */
        function isDestinyTheStartingSection(){
            var anchors =  window.location.hash.replace('#', '').split('/');
            var destinationSection = getSectionByAnchor(decodeURIComponent(anchors[0]));
    
            return !destinationSection.length || destinationSection.length && destinationSection.index() === startingSection.index();
        }


        var isScrolling = false;
        var lastScroll = 0;

        //when scrolling...
        function scrollHandler(){
            var currentSection;

            if(!options.autoScrolling || options.scrollBar){
                var currentScroll = $window.scrollTop();
                var scrollDirection = getScrollDirection(currentScroll);
                var visibleSectionIndex = 0;
                var screen_mid = currentScroll + ($window.height() / 2.0);
                var isAtBottom = $body.height() - $window.height() === currentScroll;
                var sections =  document.querySelectorAll(SECTION_SEL);

                //when using `auto-height` for a small last section it won't be centered in the viewport
                if(isAtBottom){
                    visibleSectionIndex = sections.length - 1;
                }
                //is at top? when using `auto-height` for a small first section it won't be centered in the viewport
                else if(!currentScroll){
                    visibleSectionIndex = 0;
                }

                //taking the section which is showing more content in the viewport
                else{
                    for (var i = 0; i < sections.length; ++i) {
                        var section = sections[i];

                        // Pick the the last section which passes the middle line of the screen.
                        if (section.offsetTop <= screen_mid)
                        {
                            visibleSectionIndex = i;
                        }
                    }
                }

                if(isCompletelyInViewPort(scrollDirection)){
                    if(!$(SECTION_ACTIVE_SEL).hasClass(COMPLETELY)){
                        $(SECTION_ACTIVE_SEL).addClass(COMPLETELY).siblings().removeClass(COMPLETELY);
                    }
                }

                //geting the last one, the current one on the screen
                currentSection = $(sections).eq(visibleSectionIndex);

                //setting the visible section as active when manually scrolling
                //executing only once the first time we reach the section
                if(!currentSection.hasClass(ACTIVE)){
                    isScrolling = true;
                    var leavingSection = $(SECTION_ACTIVE_SEL);
                    var leavingSectionIndex = leavingSection.index(SECTION_SEL) + 1;
                    var yMovement = getYmovement(currentSection);
                    var anchorLink  = currentSection.data('anchor');
                    var sectionIndex = currentSection.index(SECTION_SEL) + 1;
                    var activeSlide = currentSection.find(SLIDE_ACTIVE_SEL);
                    var slideIndex;
                    var slideAnchorLink;

                    if(activeSlide.length){
                        slideAnchorLink = activeSlide.data('anchor');
                        slideIndex = activeSlide.index();
                    }

                    if(canScroll){
                        currentSection.addClass(ACTIVE).siblings().removeClass(ACTIVE);

                        $.isFunction( options.onLeave ) && options.onLeave.call( leavingSection, leavingSectionIndex, sectionIndex, yMovement);
                        $.isFunction( options.afterLoad ) && options.afterLoad.call( currentSection, anchorLink, sectionIndex);

                        stopMedia(leavingSection);
                        lazyLoad(currentSection);
                        playMedia(currentSection);

                        activateMenuAndNav(anchorLink, sectionIndex - 1);

                        if(options.anchors.length){
                            //needed to enter in hashChange event when using the menu with anchor links
                            lastScrolledDestiny = anchorLink;
                        }
                        setState(slideIndex, slideAnchorLink, anchorLink, sectionIndex);
                    }

                    //small timeout in order to avoid entering in hashChange event when scrolling is not finished yet
                    clearTimeout(scrollId);
                    scrollId = setTimeout(function(){
                        isScrolling = false;
                    }, 100);
                }

                if(options.fitToSection){
                    //for the auto adjust of the viewport to fit a whole section
                    clearTimeout(scrollId2);

                    scrollId2 = setTimeout(function(){
                        //checking it again in case it changed during the delay
                        if(options.fitToSection){
                            fitToSection();
                        }
                    }, options.fitToSectionDelay);
                }
            }
        }

        /**
        * Fits the site to the nearest active section
        */
        function fitToSection(){
            //checking fitToSection again in case it was set to false before the timeout delay
            if(canScroll){
                //allows to scroll to an active section and
                //if the section is already active, we prevent firing callbacks
                isResizing = true;

                scrollPage($(SECTION_ACTIVE_SEL));
                isResizing = false;
            }
        }

        /**
        * Determines whether the active section has seen in its whole or not.
        */
        function isCompletelyInViewPort(movement){
            var top = $(SECTION_ACTIVE_SEL).position().top;
            var bottom = top + $window.height();

            if(movement == 'up'){
                return bottom >= ($window.scrollTop() + $window.height());
            }
            return top <= $window.scrollTop();
        }

        /**
        * Gets the directon of the the scrolling fired by the scroll event.
        */
        function getScrollDirection(currentScroll){
            var direction = currentScroll > lastScroll ? 'down' : 'up';

            lastScroll = currentScroll;

            //needed for auto-height sections to determine if we want to scroll to the top or bottom of the destination
            previousDestTop = currentScroll;

            return direction;
        }

        /**
        * Determines the way of scrolling up or down:
        * by 'automatically' scrolling a section or by using the default and normal scrolling.
        */
        function scrolling(type, scrollable){
            if (!isScrollAllowed.m[type]){
                return;
            }
            var check = (type === 'down') ? 'bottom' : 'top';
            var scrollSection = (type === 'down') ? moveSectionDown : moveSectionUp;

            if(scrollable.length > 0 ){
                //is the scrollbar at the start/end of the scroll?
                if(options.scrollOverflowHandler.isScrolled(check, scrollable)){
                    scrollSection();
                }else{
                    return true;
                }
            }else{
                // moved up/down
                scrollSection();
            }
        }

        /*
        * Preventing bouncing in iOS #2285
        */
        function preventBouncing(event){
            var e = event.originalEvent;
            if(!checkParentForNormalScrollElement(event.target) && options.autoScrolling && isReallyTouch(e)){
                //preventing the easing on iOS devices
                event.preventDefault();
            }
        }

        var touchStartY = 0;
        var touchStartX = 0;
        var touchEndY = 0;
        var touchEndX = 0;

        /* Detecting touch events

        * As we are changing the top property of the page on scrolling, we can not use the traditional way to detect it.
        * This way, the touchstart and the touch moves shows an small difference between them which is the
        * used one to determine the direction.
        */
        function touchMoveHandler(event){
            var e = event.originalEvent;
            var activeSection = $(e.target).closest(SECTION_SEL);

            // additional: if one of the normalScrollElements isn't within options.normalScrollElementTouchThreshold hops up the DOM chain
            if (!checkParentForNormalScrollElement(event.target) && isReallyTouch(e) ) {

                if(options.autoScrolling){
                    //preventing the easing on iOS devices
                    event.preventDefault();
                }

                var scrollable = options.scrollOverflowHandler.scrollable(activeSection);
                var touchEvents = getEventsPage(e);

                touchEndY = touchEvents.y;
                touchEndX = touchEvents.x;

                //if movement in the X axys is greater than in the Y and the currect section has slides...
                if (activeSection.find(SLIDES_WRAPPER_SEL).length && Math.abs(touchStartX - touchEndX) > (Math.abs(touchStartY - touchEndY))) {

                    //is the movement greater than the minimum resistance to scroll?
                    if (!slideMoving && Math.abs(touchStartX - touchEndX) > ($window.outerWidth() / 100 * options.touchSensitivity)) {
                        if (touchStartX > touchEndX) {
                            if(isScrollAllowed.m.right){
                                moveSlideRight(activeSection); //next
                            }
                        } else {
                            if(isScrollAllowed.m.left){
                                moveSlideLeft(activeSection); //prev
                            }
                        }
                    }
                }

                //vertical scrolling (only when autoScrolling is enabled)
                else if(options.autoScrolling && canScroll){

                    //is the movement greater than the minimum resistance to scroll?
                    if (Math.abs(touchStartY - touchEndY) > ($window.height() / 100 * options.touchSensitivity)) {
                        if (touchStartY > touchEndY) {
                            scrolling('down', scrollable);
                        } else if (touchEndY > touchStartY) {
                            scrolling('up', scrollable);
                        }
                    }
                }
            }
        }

        /**
         * recursive function to loop up the parent nodes to check if one of them exists in options.normalScrollElements
         * Currently works well for iOS - Android might need some testing
         * @param  {Element} el  target element / jquery selector (in subsequent nodes)
         * @param  {int}     hop current hop compared to options.normalScrollElementTouchThreshold
         * @return {boolean} true if there is a match to options.normalScrollElements
         */
        function checkParentForNormalScrollElement (el, hop) {
            hop = hop || 0;
            var parent = $(el).parent();

            if (hop < options.normalScrollElementTouchThreshold &&
                parent.is(options.normalScrollElements) ) {
                return true;
            } else if (hop == options.normalScrollElementTouchThreshold) {
                return false;
            } else {
                return checkParentForNormalScrollElement(parent, ++hop);
            }
        }

        /**
        * As IE >= 10 fires both touch and mouse events when using a mouse in a touchscreen
        * this way we make sure that is really a touch event what IE is detecting.
        */
        function isReallyTouch(e){
            //if is not IE   ||  IE is detecting `touch` or `pen`
            return typeof e.pointerType === 'undefined' || e.pointerType != 'mouse';
        }

        /**
        * Handler for the touch start event.
        */
        function touchStartHandler(event){
            var e = event.originalEvent;

            //stopping the auto scroll to adjust to a section
            if(options.fitToSection){
                $htmlBody.stop();
            }

            if(isReallyTouch(e)){
                var touchEvents = getEventsPage(e);
                touchStartY = touchEvents.y;
                touchStartX = touchEvents.x;
            }
        }

        /**
        * Gets the average of the last `number` elements of the given array.
        */
        function getAverage(elements, number){
            var sum = 0;

            //taking `number` elements from the end to make the average, if there are not enought, 1
            var lastElements = elements.slice(Math.max(elements.length - number, 1));

            for(var i = 0; i < lastElements.length; i++){
                sum = sum + lastElements[i];
            }

            return Math.ceil(sum/number);
        }

        /**
         * Detecting mousewheel scrolling
         *
         * http://blogs.sitepointstatic.com/examples/tech/mouse-wheel/index.html
         * http://www.sitepoint.com/html5-javascript-mouse-wheel/
         */
        var prevTime = new Date().getTime();

        function MouseWheelHandler(e) {
            var curTime = new Date().getTime();
            var isNormalScroll = $(COMPLETELY_SEL).hasClass(NORMAL_SCROLL);

            //autoscrolling and not zooming?
            if(options.autoScrolling && !controlPressed && !isNormalScroll){
                // cross-browser wheel delta
                e = e || window.event;
                var value = e.wheelDelta || -e.deltaY || -e.detail;
                var delta = Math.max(-1, Math.min(1, value));

                var horizontalDetection = typeof e.wheelDeltaX !== 'undefined' || typeof e.deltaX !== 'undefined';
                var isScrollingVertically = (Math.abs(e.wheelDeltaX) < Math.abs(e.wheelDelta)) || (Math.abs(e.deltaX ) < Math.abs(e.deltaY) || !horizontalDetection);

                //Limiting the array to 150 (lets not waste memory!)
                if(scrollings.length > 149){
                    scrollings.shift();
                }

                //keeping record of the previous scrollings
                scrollings.push(Math.abs(value));

                //preventing to scroll the site on mouse wheel when scrollbar is present
                if(options.scrollBar){
                    e.preventDefault ? e.preventDefault() : e.returnValue = false;
                }

                var activeSection = $(SECTION_ACTIVE_SEL);
                var scrollable = options.scrollOverflowHandler.scrollable(activeSection);

                //time difference between the last scroll and the current one
                var timeDiff = curTime-prevTime;
                prevTime = curTime;

                //haven't they scrolled in a while?
                //(enough to be consider a different scrolling action to scroll another section)
                if(timeDiff > 200){
                    //emptying the array, we dont care about old scrollings for our averages
                    scrollings = [];
                }

                if(canScroll){
                    var averageEnd = getAverage(scrollings, 10);
                    var averageMiddle = getAverage(scrollings, 70);
                    var isAccelerating = averageEnd >= averageMiddle;

                    //to avoid double swipes...
                    if(isAccelerating && isScrollingVertically){
                        //scrolling down?
                        if (delta < 0) {
                            scrolling('down', scrollable);

                        //scrolling up?
                        }else {
                            scrolling('up', scrollable);
                        }
                    }
                }

                return false;
            }

            if(options.fitToSection){
                //stopping the auto scroll to adjust to a section
                $htmlBody.stop();
            }
        }

        /**
        * Slides a slider to the given direction.
        * Optional `section` param.
        */
        function moveSlide(direction, section){
            var activeSection = typeof section === 'undefined' ? $(SECTION_ACTIVE_SEL) : section;
            var slides = activeSection.find(SLIDES_WRAPPER_SEL);
            var numSlides = slides.find(SLIDE_SEL).length;

            // more than one slide needed and nothing should be sliding
            if (!slides.length || slideMoving || numSlides < 2) {
                return;
            }

            var currentSlide = slides.find(SLIDE_ACTIVE_SEL);
            var destiny = null;

            if(direction === 'left'){
                destiny = currentSlide.prev(SLIDE_SEL);
            }else{
                destiny = currentSlide.next(SLIDE_SEL);
            }

            //isn't there a next slide in the secuence?
            if(!destiny.length){
                //respect loopHorizontal settin
                if (!options.loopHorizontal) return;

                if(direction === 'left'){
                    destiny = currentSlide.siblings(':last');
                }else{
                    destiny = currentSlide.siblings(':first');
                }
            }

            slideMoving = true;

            landscapeScroll(slides, destiny, direction);
        }

        /**
        * Maintains the active slides in the viewport
        * (Because the `scroll` animation might get lost with some actions, such as when using continuousVertical)
        */
        function keepSlidesPosition(){
            $(SLIDE_ACTIVE_SEL).each(function(){
                silentLandscapeScroll($(this), 'internal');
            });
        }

        var previousDestTop = 0;
        /**
        * Returns the destination Y position based on the scrolling direction and
        * the height of the section.
        */
        function getDestinationPosition(element){
            var elemPosition = element.position();

            //top of the desination will be at the top of the viewport
            var position = elemPosition.top;
            var isScrollingDown =  elemPosition.top > previousDestTop;
            var sectionBottom = position - windowsHeight + element.outerHeight();
            var bigSectionsDestination = options.bigSectionsDestination;

            //is the destination element bigger than the viewport?
            if(element.outerHeight() > windowsHeight){
                //scrolling up?
                if(!isScrollingDown && !bigSectionsDestination || bigSectionsDestination === 'bottom' ){
                    position = sectionBottom;
                }
            }

            //sections equal or smaller than the viewport height && scrolling down? ||  is resizing and its in the last section
            else if(isScrollingDown || (isResizing && element.is(':last-child')) ){
                //The bottom of the destination will be at the bottom of the viewport
                position = sectionBottom;
            }

            /*
            Keeping record of the last scrolled position to determine the scrolling direction.
            No conventional methods can be used as the scroll bar might not be present
            AND the section might not be active if it is auto-height and didnt reach the middle
            of the viewport.
            */
            previousDestTop = position;
            return position;
        }

        /**
        * Scrolls the site to the given element and scrolls to the slide if a callback is given.
        */
        function scrollPage(element, callback, isMovementUp){
            if(typeof element === 'undefined'){ return; } //there's no element to scroll, leaving the function

            var dtop = getDestinationPosition(element);
            var slideAnchorLink;
            var slideIndex;

            //local variables
            var v = {
                element: element,
                callback: callback,
                isMovementUp: isMovementUp,
                dtop: dtop,
                yMovement: getYmovement(element),
                anchorLink: element.data('anchor'),
                sectionIndex: element.index(SECTION_SEL),
                activeSlide: element.find(SLIDE_ACTIVE_SEL),
                activeSection: $(SECTION_ACTIVE_SEL),
                leavingSection: $(SECTION_ACTIVE_SEL).index(SECTION_SEL) + 1,

                //caching the value of isResizing at the momment the function is called
                //because it will be checked later inside a setTimeout and the value might change
                localIsResizing: isResizing
            };

            //quiting when destination scroll is the same as the current one
            if((v.activeSection.is(element) && !isResizing) || (options.scrollBar && $window.scrollTop() === v.dtop && !element.hasClass(AUTO_HEIGHT) )){ return; }

            if(v.activeSlide.length){
                slideAnchorLink = v.activeSlide.data('anchor');
                slideIndex = v.activeSlide.index();
            }

            // If continuousVertical && we need to wrap around
            if (options.autoScrolling && options.continuousVertical && typeof (v.isMovementUp) !== "undefined" &&
                ((!v.isMovementUp && v.yMovement == 'up') || // Intending to scroll down but about to go up or
                (v.isMovementUp && v.yMovement == 'down'))) { // intending to scroll up but about to go down

                v = createInfiniteSections(v);
            }

            //callback (onLeave) if the site is not just resizing and readjusting the slides
            if($.isFunction(options.onLeave) && !v.localIsResizing){
                if(options.onLeave.call(v.activeSection, v.leavingSection, (v.sectionIndex + 1), v.yMovement) === false){
                    return;
                }
            }

            //pausing media of the leaving section (if we are not just resizing, as destinatino will be the same one)
            if(!v.localIsResizing){
                stopMedia(v.activeSection);
            }

            options.scrollOverflowHandler.beforeLeave();
            element.addClass(ACTIVE).siblings().removeClass(ACTIVE);
            lazyLoad(element);
            options.scrollOverflowHandler.onLeave();


            //preventing from activating the MouseWheelHandler event
            //more than once if the page is scrolling
            canScroll = false;

            setState(slideIndex, slideAnchorLink, v.anchorLink, v.sectionIndex);

            performMovement(v);

            //flag to avoid callingn `scrollPage()` twice in case of using anchor links
            lastScrolledDestiny = v.anchorLink;

            //avoid firing it twice (as it does also on scroll)
            activateMenuAndNav(v.anchorLink, v.sectionIndex);
        }

        /**
        * Performs the vertical movement (by CSS3 or by jQuery)
        */
        function performMovement(v){
            // using CSS3 translate functionality
            if (options.css3 && options.autoScrolling && !options.scrollBar) {

                // The first section can have a negative value in iOS 10. Not quite sure why: -0.0142822265625
                // that's why we round it to 0.
                var translate3d = 'translate3d(0px, -' + Math.round(v.dtop) + 'px, 0px)';
                transformContainer(translate3d, true);

                //even when the scrollingSpeed is 0 there's a little delay, which might cause the
                //scrollingSpeed to change in case of using silentMoveTo();
                if(options.scrollingSpeed){
                    clearTimeout(afterSectionLoadsId);
                    afterSectionLoadsId = setTimeout(function () {
                        afterSectionLoads(v);
                    }, options.scrollingSpeed);
                }else{
                    afterSectionLoads(v);
                }
            }

            // using jQuery animate
            else{
                var scrollSettings = getScrollSettings(v);

                $(scrollSettings.element).animate(
                    scrollSettings.options,
                options.scrollingSpeed, options.easing).promise().done(function () { //only one single callback in case of animating  `html, body`
                    if(options.scrollBar){

                        /* Hack!
                        The timeout prevents setting the most dominant section in the viewport as "active" when the user
                        scrolled to a smaller section by using the mousewheel (auto scrolling) rather than draging the scroll bar.

                        When using scrollBar:true It seems like the scroll events still getting propagated even after the scrolling animation has finished.
                        */
                        setTimeout(function(){
                            afterSectionLoads(v);
                        },30);
                    }else{
                        afterSectionLoads(v);
                    }
                });
            }
        }

        /**
        * Gets the scrolling settings depending on the plugin autoScrolling option
        */
        function getScrollSettings(v){
            var scroll = {};

            if(options.autoScrolling && !options.scrollBar){
                scroll.options = { 'top': -v.dtop};
                scroll.element = WRAPPER_SEL;
            }else{
                scroll.options = { 'scrollTop': v.dtop};
                scroll.element = 'html, body';
            }

            return scroll;
        }

        /**
        * Adds sections before or after the current one to create the infinite effect.
        */
        function createInfiniteSections(v){
            // Scrolling down
            if (!v.isMovementUp) {
                // Move all previous sections to after the active section
                $(SECTION_ACTIVE_SEL).after(v.activeSection.prevAll(SECTION_SEL).get().reverse());
            }
            else { // Scrolling up
                // Move all next sections to before the active section
                $(SECTION_ACTIVE_SEL).before(v.activeSection.nextAll(SECTION_SEL));
            }

            // Maintain the displayed position (now that we changed the element order)
            silentScroll($(SECTION_ACTIVE_SEL).position().top);

            // Maintain the active slides visible in the viewport
            keepSlidesPosition();

            // save for later the elements that still need to be reordered
            v.wrapAroundElements = v.activeSection;

            // Recalculate animation variables
            v.dtop = v.element.position().top;
            v.yMovement = getYmovement(v.element);

            return v;
        }

        /**
        * Fix section order after continuousVertical changes have been animated
        */
        function continuousVerticalFixSectionOrder (v) {
            // If continuousVertical is in effect (and autoScrolling would also be in effect then),
            // finish moving the elements around so the direct navigation will function more simply
            if (!v.wrapAroundElements || !v.wrapAroundElements.length) {
                return;
            }

            if (v.isMovementUp) {
                $(SECTION_FIRST_SEL).before(v.wrapAroundElements);
            }
            else {
                $(SECTION_LAST_SEL).after(v.wrapAroundElements);
            }

            silentScroll($(SECTION_ACTIVE_SEL).position().top);

            // Maintain the active slides visible in the viewport
            keepSlidesPosition();
        }


        /**
        * Actions to do once the section is loaded.
        */
        function afterSectionLoads (v){
            continuousVerticalFixSectionOrder(v);

            //callback (afterLoad) if the site is not just resizing and readjusting the slides
            $.isFunction(options.afterLoad) && !v.localIsResizing && options.afterLoad.call(v.element, v.anchorLink, (v.sectionIndex + 1));
            options.scrollOverflowHandler.afterLoad();

            if(!v.localIsResizing){
                playMedia(v.element);
            }

            v.element.addClass(COMPLETELY).siblings().removeClass(COMPLETELY);

            canScroll = true;

            $.isFunction(v.callback) && v.callback.call(this);
        }

        /**
        * Sets the value for the given attribute from the `data-` attribute with the same suffix
        * ie: data-srcset ==> srcset  |  data-src ==> src
        */
        function setSrc(element, attribute){
            element
                .attr(attribute, element.data(attribute))
                .removeAttr('data-' + attribute);
        }

        /**
        * Lazy loads image, video and audio elements.
        */
        function lazyLoad(destiny){
            if (!options.lazyLoading){
                return;
            }

            var panel = getSlideOrSection(destiny);
            var element;
            
            panel.find('img[data-src], img[data-srcset], source[data-src], audio[data-src], iframe[data-src]').each(function(){
                element = $(this);

                $.each(['src', 'srcset'], function(index, type){
                    var attribute = element.attr('data-' + type);
                    if(typeof attribute !== 'undefined' && attribute){
                        setSrc(element, type);
                    }
                });

                if(element.is('source')){
                    element.closest('video').get(0).load();
                }
            });
        }

        /**
        * Plays video and audio elements.
        */
        function playMedia(destiny){
            var panel = getSlideOrSection(destiny);

            //playing HTML5 media elements
            panel.find('video, audio').each(function(){
                var element = $(this).get(0);

                if( element.hasAttribute('data-autoplay') && typeof element.play === 'function' ) {
                    element.play();
                }
            });

            //youtube videos
            panel.find('iframe[src*="youtube.com/embed/"]').each(function(){
                var element = $(this).get(0);

                if ( element.hasAttribute('data-autoplay') ){
                    playYoutube(element);
                }

                //in case the URL was not loaded yet. On page load we need time for the new URL (with the API string) to load.
                element.onload = function() {
                    if ( element.hasAttribute('data-autoplay') ){
                        playYoutube(element);
                    }
                };
            });
        }

        /**
        * Plays a youtube video
        */
        function playYoutube(element){
            element.contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}', '*');
        }

        /**
        * Stops video and audio elements.
        */
        function stopMedia(destiny){
            var panel = getSlideOrSection(destiny);

            //stopping HTML5 media elements
            panel.find('video, audio').each(function(){
                var element = $(this).get(0);

                if( !element.hasAttribute('data-keepplaying') && typeof element.pause === 'function' ) {
                    element.pause();
                }
            });

            //youtube videos
            panel.find('iframe[src*="youtube.com/embed/"]').each(function(){
                var element = $(this).get(0);

                if( /youtube\.com\/embed\//.test($(this).attr('src')) && !element.hasAttribute('data-keepplaying')){
                    $(this).get(0).contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}','*');
                }
            });
        }

        /**
        * Gets the active slide (or section) for the given section
        */
        function getSlideOrSection(destiny){
            var slide = destiny.find(SLIDE_ACTIVE_SEL);
            if( slide.length ) {
                destiny = $(slide);
            }

            return destiny;
        }

        /**
        * Scrolls to the anchor in the URL when loading the site
        */
        function scrollToAnchor(){
            //getting the anchor link in the URL and deleting the `#`
            var value =  window.location.hash.replace('#', '').split('/');
            var sectionAnchor = decodeURIComponent(value[0]);
            var slideAnchor = decodeURIComponent(value[1]);

            if(sectionAnchor){  //if theres any #
                if(options.animateAnchor){
                    scrollPageAndSlide(sectionAnchor, slideAnchor);
                }else{
                    silentMoveTo(sectionAnchor, slideAnchor);
                }
            }
        }

        /**
        * Detecting any change on the URL to scroll to the given anchor link
        * (a way to detect back history button as we play with the hashes on the URL)
        */
        function hashChangeHandler(){
            if(!isScrolling && !options.lockAnchors){
                var value =  window.location.hash.replace('#', '').split('/');
                var sectionAnchor = decodeURIComponent(value[0]);
                var slideAnchor = decodeURIComponent(value[1]);

                    //when moving to a slide in the first section for the first time (first time to add an anchor to the URL)
                    var isFirstSlideMove =  (typeof lastScrolledDestiny === 'undefined');
                    var isFirstScrollMove = (typeof lastScrolledDestiny === 'undefined' && typeof slideAnchor === 'undefined' && !slideMoving);


                if(sectionAnchor.length){
                    /*in order to call scrollpage() only once for each destination at a time
                    It is called twice for each scroll otherwise, as in case of using anchorlinks `hashChange`
                    event is fired on every scroll too.*/
                    if ((sectionAnchor && sectionAnchor !== lastScrolledDestiny) && !isFirstSlideMove || isFirstScrollMove || (!slideMoving && lastScrolledSlide != slideAnchor ))  {
                        scrollPageAndSlide(sectionAnchor, slideAnchor);
                    }
                }
            }
        }

        //Sliding with arrow keys, both, vertical and horizontal
        function keydownHandler(e) {

            clearTimeout(keydownId);

            var activeElement = $(':focus');

            if(!activeElement.is('textarea') && !activeElement.is('input') && !activeElement.is('select') &&
                activeElement.attr('contentEditable') !== "true" && activeElement.attr('contentEditable') !== '' &&
                options.keyboardScrolling && options.autoScrolling){
                var keyCode = e.which;

                //preventing the scroll with arrow keys & spacebar & Page Up & Down keys
                var keyControls = [40, 38, 32, 33, 34];
                if($.inArray(keyCode, keyControls) > -1){
                    e.preventDefault();
                }

                controlPressed = e.ctrlKey;

                keydownId = setTimeout(function(){
                    onkeydown(e);
                },150);
            }
        }

        function tooltipTextHandler(){
            $(this).prev().trigger('click');
        }

        //to prevent scrolling while zooming
        function keyUpHandler(e){
            if(isWindowFocused){ //the keyup gets fired on new tab ctrl + t in Firefox
                controlPressed = e.ctrlKey;
            }
        }

        //binding the mousemove when the mouse's middle button is released
        function mouseDownHandler(e){
            //middle button
            if (e.which == 2){
                oldPageY = e.pageY;
                container.on('mousemove', mouseMoveHandler);
            }
        }

        //unbinding the mousemove when the mouse's middle button is released
        function mouseUpHandler(e){
            //middle button
            if (e.which == 2){
                container.off('mousemove');
            }
        }

        //Scrolling horizontally when clicking on the slider controls.
        function slideArrowHandler(){
            var section = $(this).closest(SECTION_SEL);

            if ($(this).hasClass(SLIDES_PREV)) {
                if(isScrollAllowed.m.left){
                    moveSlideLeft(section);
                }
            } else {
                if(isScrollAllowed.m.right){
                    moveSlideRight(section);
                }
            }
        }

        //when opening a new tab (ctrl + t), `control` won't be pressed when coming back.
        function blurHandler(){
            isWindowFocused = false;
            controlPressed = false;
        }

        //Scrolls to the section when clicking the navigation bullet
        function sectionBulletHandler(e){
            e.preventDefault();
            var index = $(this).parent().index();
            scrollPage($(SECTION_SEL).eq(index));
        }

        //Scrolls the slider to the given slide destination for the given section
        function slideBulletHandler(e){
            e.preventDefault();
            var slides = $(this).closest(SECTION_SEL).find(SLIDES_WRAPPER_SEL);
            var destiny = slides.find(SLIDE_SEL).eq($(this).closest('li').index());

            landscapeScroll(slides, destiny);
        }

        /**
        * Keydown event
        */
        function onkeydown(e){
            var shiftPressed = e.shiftKey;

            //do nothing if we can not scroll or we are not using horizotnal key arrows.
            if(!canScroll && [37,39].indexOf(e.which) < 0){
                return;
            }

            switch (e.which) {
                //up
                case 38:
                case 33:
                    if(isScrollAllowed.k.up){
                        moveSectionUp();
                    }
                    break;

                //down
                case 32: //spacebar
                    if(shiftPressed && isScrollAllowed.k.up){
                        moveSectionUp();
                        break;
                    }
                /* falls through */
                case 40:
                case 34:
                    if(isScrollAllowed.k.down){
                        moveSectionDown();
                    }
                    break;

                //Home
                case 36:
                    if(isScrollAllowed.k.up){
                        moveTo(1);
                    }
                    break;

                //End
                case 35:
                     if(isScrollAllowed.k.down){
                        moveTo( $(SECTION_SEL).length );
                    }
                    break;

                //left
                case 37:
                    if(isScrollAllowed.k.left){
                        moveSlideLeft();
                    }
                    break;

                //right
                case 39:
                    if(isScrollAllowed.k.right){
                        moveSlideRight();
                    }
                    break;

                default:
                    return; // exit this handler for other keys
            }
        }

        /**
        * Detecting the direction of the mouse movement.
        * Used only for the middle button of the mouse.
        */
        var oldPageY = 0;
        function mouseMoveHandler(e){
            if(canScroll){
                // moving up
                if (e.pageY < oldPageY && isScrollAllowed.m.up){
                    moveSectionUp();
                }

                // moving down
                else if(e.pageY > oldPageY && isScrollAllowed.m.down){
                    moveSectionDown();
                }
            }
            oldPageY = e.pageY;
        }

        /**
        * Scrolls horizontal sliders.
        */
        function landscapeScroll(slides, destiny, direction){
            var section = slides.closest(SECTION_SEL);
            var v = {
                slides: slides,
                destiny: destiny,
                direction: direction,
                destinyPos: destiny.position(),
                slideIndex: destiny.index(),
                section: section,
                sectionIndex: section.index(SECTION_SEL),
                anchorLink: section.data('anchor'),
                slidesNav: section.find(SLIDES_NAV_SEL),
                slideAnchor:  getAnchor(destiny),
                prevSlide: section.find(SLIDE_ACTIVE_SEL),
                prevSlideIndex: section.find(SLIDE_ACTIVE_SEL).index(),

                //caching the value of isResizing at the momment the function is called
                //because it will be checked later inside a setTimeout and the value might change
                localIsResizing: isResizing
            };
            v.xMovement = getXmovement(v.prevSlideIndex, v.slideIndex);

            //important!! Only do it when not resizing
            if(!v.localIsResizing){
                //preventing from scrolling to the next/prev section when using scrollHorizontally
                canScroll = false;
            }

            if(options.onSlideLeave){

                //if the site is not just resizing and readjusting the slides
                if(!v.localIsResizing && v.xMovement!=='none'){
                    if($.isFunction( options.onSlideLeave )){
                        if(options.onSlideLeave.call( v.prevSlide, v.anchorLink, (v.sectionIndex + 1), v.prevSlideIndex, v.xMovement, v.slideIndex ) === false){
                            slideMoving = false;
                            return;
                        }
                    }
                }
            }

            destiny.addClass(ACTIVE).siblings().removeClass(ACTIVE);

            if(!v.localIsResizing){
                stopMedia(v.prevSlide);
                lazyLoad(destiny);
            }

            if(!options.loopHorizontal && options.controlArrows){
                //hidding it for the fist slide, showing for the rest
                section.find(SLIDES_ARROW_PREV_SEL).toggle(v.slideIndex!==0);

                //hidding it for the last slide, showing for the rest
                section.find(SLIDES_ARROW_NEXT_SEL).toggle(!destiny.is(':last-child'));
            }

            //only changing the URL if the slides are in the current section (not for resize re-adjusting)
            if(section.hasClass(ACTIVE) && !v.localIsResizing){
                setState(v.slideIndex, v.slideAnchor, v.anchorLink, v.sectionIndex);
            }

            performHorizontalMove(slides, v, true);
        }


        function afterSlideLoads(v){
            activeSlidesNavigation(v.slidesNav, v.slideIndex);

            //if the site is not just resizing and readjusting the slides
            if(!v.localIsResizing){
                $.isFunction( options.afterSlideLoad ) && options.afterSlideLoad.call( v.destiny, v.anchorLink, (v.sectionIndex + 1), v.slideAnchor, v.slideIndex);

                //needs to be inside the condition to prevent problems with continuousVertical and scrollHorizontally
                //and to prevent double scroll right after a windows resize
                canScroll = true;

                playMedia(v.destiny);
            }

            //letting them slide again
            slideMoving = false;
        }

        /**
        * Performs the horizontal movement. (CSS3 or jQuery)
        *
        * @param fireCallback {Bool} - determines whether or not to fire the callback
        */
        function performHorizontalMove(slides, v, fireCallback){
            var destinyPos = v.destinyPos;

            if(options.css3){
                var translate3d = 'translate3d(-' + Math.round(destinyPos.left) + 'px, 0px, 0px)';

                addAnimation(slides.find(SLIDES_CONTAINER_SEL)).css(getTransforms(translate3d));

                afterSlideLoadsId = setTimeout(function(){
                    fireCallback && afterSlideLoads(v);
                }, options.scrollingSpeed, options.easing);
            }else{
                slides.animate({
                    scrollLeft : Math.round(destinyPos.left)
                }, options.scrollingSpeed, options.easing, function() {

                    fireCallback && afterSlideLoads(v);
                });
            }
        }

        /**
        * Sets the state for the horizontal bullet navigations.
        */
        function activeSlidesNavigation(slidesNav, slideIndex){
            slidesNav.find(ACTIVE_SEL).removeClass(ACTIVE);
            slidesNav.find('li').eq(slideIndex).find('a').addClass(ACTIVE);
        }

        var previousHeight = windowsHeight;

        //when resizing the site, we adjust the heights of the sections, slimScroll...
        function resizeHandler(){
            //checking if it needs to get responsive
            responsive();

            // rebuild immediately on touch devices
            if (isTouchDevice) {
                var activeElement = $(document.activeElement);

                //if the keyboard is NOT visible
                if (!activeElement.is('textarea') && !activeElement.is('input') && !activeElement.is('select')) {
                    var currentHeight = $window.height();

                    //making sure the change in the viewport size is enough to force a rebuild. (20 % of the window to avoid problems when hidding scroll bars)
                    if( Math.abs(currentHeight - previousHeight) > (20 * Math.max(previousHeight, currentHeight) / 100) ){
                        reBuild(true);
                        previousHeight = currentHeight;
                    }
                }
            }else{
                //in order to call the functions only when the resize is finished
                //http://stackoverflow.com/questions/4298612/jquery-how-to-call-resize-event-only-once-its-finished-resizing
                clearTimeout(resizeId);

                resizeId = setTimeout(function(){
                    reBuild(true);
                }, 350);
            }
        }

        /**
        * Checks if the site needs to get responsive and disables autoScrolling if so.
        * A class `fp-responsive` is added to the plugin's container in case the user wants to use it for his own responsive CSS.
        */
        function responsive(){
            var widthLimit = options.responsive || options.responsiveWidth; //backwards compatiblity
            var heightLimit = options.responsiveHeight;

            //only calculating what we need. Remember its called on the resize event.
            var isBreakingPointWidth = widthLimit && $window.outerWidth() < widthLimit;
            var isBreakingPointHeight = heightLimit && $window.height() < heightLimit;

            if(widthLimit && heightLimit){
                setResponsive(isBreakingPointWidth || isBreakingPointHeight);
            }
            else if(widthLimit){
                setResponsive(isBreakingPointWidth);
            }
            else if(heightLimit){
                setResponsive(isBreakingPointHeight);
            }
        }

        /**
        * Adds transition animations for the given element
        */
        function addAnimation(element){
            var transition = 'all ' + options.scrollingSpeed + 'ms ' + options.easingcss3;

            element.removeClass(NO_TRANSITION);
            return element.css({
                '-webkit-transition': transition,
                'transition': transition
            });
        }

        /**
        * Remove transition animations for the given element
        */
        function removeAnimation(element){
            return element.addClass(NO_TRANSITION);
        }

        /**
        * Activating the vertical navigation bullets according to the given slide name.
        */
        function activateNavDots(name, sectionIndex){
            if(options.navigation){
                $(SECTION_NAV_SEL).find(ACTIVE_SEL).removeClass(ACTIVE);
                if(name){
                    $(SECTION_NAV_SEL).find('a[href="#' + name + '"]').addClass(ACTIVE);
                }else{
                    $(SECTION_NAV_SEL).find('li').eq(sectionIndex).find('a').addClass(ACTIVE);
                }
            }
        }

        /**
        * Activating the website main menu elements according to the given slide name.
        */
        function activateMenuElement(name){
            if(options.menu){
                $(options.menu).find(ACTIVE_SEL).removeClass(ACTIVE);
                $(options.menu).find('[data-menuanchor="'+name+'"]').addClass(ACTIVE);
            }
        }

        /**
        * Sets to active the current menu and vertical nav items.
        */
        function activateMenuAndNav(anchor, index){
            activateMenuElement(anchor);
            activateNavDots(anchor, index);
        }

        /**
        * Retuns `up` or `down` depending on the scrolling movement to reach its destination
        * from the current section.
        */
        function getYmovement(destiny){
            var fromIndex = $(SECTION_ACTIVE_SEL).index(SECTION_SEL);
            var toIndex = destiny.index(SECTION_SEL);
            if( fromIndex == toIndex){
                return 'none';
            }
            if(fromIndex > toIndex){
                return 'up';
            }
            return 'down';
        }

        /**
        * Retuns `right` or `left` depending on the scrolling movement to reach its destination
        * from the current slide.
        */
        function getXmovement(fromIndex, toIndex){
            if( fromIndex == toIndex){
                return 'none';
            }
            if(fromIndex > toIndex){
                return 'left';
            }
            return 'right';
        }

        /**
        * Checks if the element needs scrollbar and if the user wants to apply it.
        * If so it creates it.
        *
        * @param {Object} element   jQuery object of the section or slide
        */
        function createScrollBar(element){
            //User doesn't want scrollbar here? Sayonara baby!
            if(element.hasClass('fp-noscroll')) return;

            //needed to make `scrollHeight` work under Opera 12
            element.css('overflow', 'hidden');

            var scrollOverflowHandler = options.scrollOverflowHandler;
            var wrap = scrollOverflowHandler.wrapContent();
            //in case element is a slide
            var section = element.closest(SECTION_SEL);
            var scrollable = scrollOverflowHandler.scrollable(element);
            var contentHeight;

            //if there was scroll, the contentHeight will be the one in the scrollable section
            if(scrollable.length){
                contentHeight = scrollOverflowHandler.scrollHeight(element);
            }else{
                contentHeight = element.get(0).scrollHeight;
                if(options.verticalCentered){
                    contentHeight = element.find(TABLE_CELL_SEL).get(0).scrollHeight;
                }
            }

            var scrollHeight = windowsHeight - parseInt(section.css('padding-bottom')) - parseInt(section.css('padding-top'));

            //needs scroll?
            if ( contentHeight > scrollHeight) {
                //did we already have an scrollbar ? Updating it
                if(scrollable.length){
                    scrollOverflowHandler.update(element, scrollHeight);
                }
                //creating the scrolling
                else{
                    if(options.verticalCentered){
                        element.find(TABLE_CELL_SEL).wrapInner(wrap);
                    }else{
                        element.wrapInner(wrap);
                    }
                    scrollOverflowHandler.create(element, scrollHeight);
                }
            }
            //removing the scrolling when it is not necessary anymore
            else{
                scrollOverflowHandler.remove(element);
            }

            //undo
            element.css('overflow', '');
        }

        function addTableClass(element){
            //In case we are styling for the 2nd time as in with reponsiveSlides
            if(!element.hasClass(TABLE)){
                element.addClass(TABLE).wrapInner('<div class="' + TABLE_CELL + '" style="height:' + getTableHeight(element) + 'px;" />');
            }
        }

        function getTableHeight(element){
            var sectionHeight = windowsHeight;

            if(options.paddingTop || options.paddingBottom){
                var section = element;
                if(!section.hasClass(SECTION)){
                    section = element.closest(SECTION_SEL);
                }

                var paddings = parseInt(section.css('padding-top')) + parseInt(section.css('padding-bottom'));
                sectionHeight = (windowsHeight - paddings);
            }

            return sectionHeight;
        }

        /**
        * Adds a css3 transform property to the container class with or without animation depending on the animated param.
        */
        function transformContainer(translate3d, animated){
            if(animated){
                addAnimation(container);
            }else{
                removeAnimation(container);
            }

            container.css(getTransforms(translate3d));

            //syncronously removing the class after the animation has been applied.
            setTimeout(function(){
                container.removeClass(NO_TRANSITION);
            },10);
        }

        /**
        * Gets a section by its anchor / index
        */
        function getSectionByAnchor(sectionAnchor){
            if(!sectionAnchor) return [];

            var section = container.find(SECTION_SEL + '[data-anchor="'+sectionAnchor+'"]');
            if(!section.length){
                section = $(SECTION_SEL).eq( sectionAnchor -1);
            }

            return section;
        }

        /**
        * Gets a slide inside a given section by its anchor / index
        */
        function getSlideByAnchor(slideAnchor, section){
            var slides = section.find(SLIDES_WRAPPER_SEL);
            var slide =  slides.find(SLIDE_SEL + '[data-anchor="'+slideAnchor+'"]');

            if(!slide.length){
                slide = slides.find(SLIDE_SEL).eq(slideAnchor);
            }

            return slide;
        }

        /**
        * Scrolls to the given section and slide anchors
        */
        function scrollPageAndSlide(destiny, slide){
            var section = getSectionByAnchor(destiny);

            //do nothing if there's no section with the given anchor name
            if(!section.length) return;

            //default slide
            if (typeof slide === 'undefined') {
                slide = 0;
            }

            //we need to scroll to the section and then to the slide
            if (destiny !== lastScrolledDestiny && !section.hasClass(ACTIVE)){
                scrollPage(section, function(){
                    scrollSlider(section, slide);
                });
            }
            //if we were already in the section
            else{
                scrollSlider(section, slide);
            }
        }

        /**
        * Scrolls the slider to the given slide destination for the given section
        */
        function scrollSlider(section, slideAnchor){
            if(typeof slideAnchor !== 'undefined'){
                var slides = section.find(SLIDES_WRAPPER_SEL);
                var destiny =  getSlideByAnchor(slideAnchor, section);

                if(destiny.length){
                    landscapeScroll(slides, destiny);
                }
            }
        }

        /**
        * Creates a landscape navigation bar with dots for horizontal sliders.
        */
        function addSlidesNavigation(section, numSlides){
            section.append('<div class="' + SLIDES_NAV + '"><ul></ul></div>');
            var nav = section.find(SLIDES_NAV_SEL);

            //top or bottom
            nav.addClass(options.slidesNavPosition);

            for(var i=0; i< numSlides; i++){
                nav.find('ul').append('<li><a href="#"><span></span></a></li>');
            }

            //centering it
            nav.css('margin-left', '-' + (nav.width()/2) + 'px');

            nav.find('li').first().find('a').addClass(ACTIVE);
        }


        /**
        * Sets the state of the website depending on the active section/slide.
        * It changes the URL hash when needed and updates the body class.
        */
        function setState(slideIndex, slideAnchor, anchorLink, sectionIndex){
            var sectionHash = '';

            if(options.anchors.length && !options.lockAnchors){

                //isn't it the first slide?
                if(slideIndex){
                    if(typeof anchorLink !== 'undefined'){
                        sectionHash = anchorLink;
                    }

                    //slide without anchor link? We take the index instead.
                    if(typeof slideAnchor === 'undefined'){
                        slideAnchor = slideIndex;
                    }

                    lastScrolledSlide = slideAnchor;
                    setUrlHash(sectionHash + '/' + slideAnchor);

                //first slide won't have slide anchor, just the section one
                }else if(typeof slideIndex !== 'undefined'){
                    lastScrolledSlide = slideAnchor;
                    setUrlHash(anchorLink);
                }

                //section without slides
                else{
                    setUrlHash(anchorLink);
                }
            }

            setBodyClass();
        }

        /**
        * Sets the URL hash.
        */
        function setUrlHash(url){
            if(options.recordHistory){
                location.hash = url;
            }else{
                //Mobile Chrome doesn't work the normal way, so... lets use HTML5 for phones :)
                if(isTouchDevice || isTouch){
                    window.history.replaceState(undefined, undefined, '#' + url);
                }else{
                    var baseUrl = window.location.href.split('#')[0];
                    window.location.replace( baseUrl + '#' + url );
                }
            }
        }

        /**
        * Gets the anchor for the given slide / section. Its index will be used if there's none.
        */
        function getAnchor(element){
            var anchor = element.data('anchor');
            var index = element.index();

            //Slide without anchor link? We take the index instead.
            if(typeof anchor === 'undefined'){
                anchor = index;
            }

            return anchor;
        }

        /**
        * Sets a class for the body of the page depending on the active section / slide
        */
        function setBodyClass(){
            var section = $(SECTION_ACTIVE_SEL);
            var slide = section.find(SLIDE_ACTIVE_SEL);

            var sectionAnchor = getAnchor(section);
            var slideAnchor = getAnchor(slide);

            var text = String(sectionAnchor);

            if(slide.length){
                text = text + '-' + slideAnchor;
            }

            //changing slash for dash to make it a valid CSS style
            text = text.replace('/', '-').replace('#','');

            //removing previous anchor classes
            var classRe = new RegExp('\\b\\s?' + VIEWING_PREFIX + '-[^\\s]+\\b', "g");
            $body[0].className = $body[0].className.replace(classRe, '');

            //adding the current anchor
            $body.addClass(VIEWING_PREFIX + '-' + text);
        }

        /**
        * Checks for translate3d support
        * @return boolean
        * http://stackoverflow.com/questions/5661671/detecting-transform-translate3d-support
        */
        function support3d() {
            var el = document.createElement('p'),
                has3d,
                transforms = {
                    'webkitTransform':'-webkit-transform',
                    'OTransform':'-o-transform',
                    'msTransform':'-ms-transform',
                    'MozTransform':'-moz-transform',
                    'transform':'transform'
                };

            // Add it to the body to get the computed style.
            document.body.insertBefore(el, null);

            for (var t in transforms) {
                if (el.style[t] !== undefined) {
                    el.style[t] = 'translate3d(1px,1px,1px)';
                    has3d = window.getComputedStyle(el).getPropertyValue(transforms[t]);
                }
            }

            document.body.removeChild(el);

            return (has3d !== undefined && has3d.length > 0 && has3d !== 'none');
        }

        /**
        * Removes the auto scrolling action fired by the mouse wheel and trackpad.
        * After this function is called, the mousewheel and trackpad movements won't scroll through sections.
        */
        function removeMouseWheelHandler(){
            if (document.addEventListener) {
                document.removeEventListener('mousewheel', MouseWheelHandler, false); //IE9, Chrome, Safari, Oper
                document.removeEventListener('wheel', MouseWheelHandler, false); //Firefox
                document.removeEventListener('MozMousePixelScroll', MouseWheelHandler, false); //old Firefox
            } else {
                document.detachEvent('onmousewheel', MouseWheelHandler); //IE 6/7/8
            }
        }

        /**
        * Adds the auto scrolling action for the mouse wheel and trackpad.
        * After this function is called, the mousewheel and trackpad movements will scroll through sections
        * https://developer.mozilla.org/en-US/docs/Web/Events/wheel
        */
        function addMouseWheelHandler(){
            var prefix = '';
            var _addEventListener;

            if (window.addEventListener){
                _addEventListener = "addEventListener";
            }else{
                _addEventListener = "attachEvent";
                prefix = 'on';
            }

             // detect available wheel event
            var support = 'onwheel' in document.createElement('div') ? 'wheel' : // Modern browsers support "wheel"
                      document.onmousewheel !== undefined ? 'mousewheel' : // Webkit and IE support at least "mousewheel"
                      'DOMMouseScroll'; // let's assume that remaining browsers are older Firefox


            if(support == 'DOMMouseScroll'){
                document[ _addEventListener ](prefix + 'MozMousePixelScroll', MouseWheelHandler, false);
            }

            //handle MozMousePixelScroll in older Firefox
            else{
                document[ _addEventListener ](prefix + support, MouseWheelHandler, false);
            }
        }

        /**
        * Binding the mousemove when the mouse's middle button is pressed
        */
        function addMiddleWheelHandler(){
            container
                .on('mousedown', mouseDownHandler)
                .on('mouseup', mouseUpHandler);
        }

        /**
        * Unbinding the mousemove when the mouse's middle button is released
        */
        function removeMiddleWheelHandler(){
            container
                .off('mousedown', mouseDownHandler)
                .off('mouseup', mouseUpHandler);
        }

        /**
        * Adds the possibility to auto scroll through sections on touch devices.
        */
        function addTouchHandler(){
            if(isTouchDevice || isTouch){
                if(options.autoScrolling){
                    $body.off(events.touchmove).on(events.touchmove, preventBouncing);
                }

                $(WRAPPER_SEL)
                    .off(events.touchstart).on(events.touchstart, touchStartHandler)
                    .off(events.touchmove).on(events.touchmove, touchMoveHandler);
            }
        }

        /**
        * Removes the auto scrolling for touch devices.
        */
        function removeTouchHandler(){
            if(isTouchDevice || isTouch){
                $(WRAPPER_SEL)
                    .off(events.touchstart)
                    .off(events.touchmove);
            }
        }

        /*
        * Returns and object with Microsoft pointers (for IE<11 and for IE >= 11)
        * http://msdn.microsoft.com/en-us/library/ie/dn304886(v=vs.85).aspx
        */
        function getMSPointer(){
            var pointer;

            //IE >= 11 & rest of browsers
            if(window.PointerEvent){
                pointer = { down: 'pointerdown', move: 'pointermove'};
            }

            //IE < 11
            else{
                pointer = { down: 'MSPointerDown', move: 'MSPointerMove'};
            }

            return pointer;
        }

        /**
        * Gets the pageX and pageY properties depending on the browser.
        * https://github.com/alvarotrigo/fullPage.js/issues/194#issuecomment-34069854
        */
        function getEventsPage(e){
            var events = [];

            events.y = (typeof e.pageY !== 'undefined' && (e.pageY || e.pageX) ? e.pageY : e.touches[0].pageY);
            events.x = (typeof e.pageX !== 'undefined' && (e.pageY || e.pageX) ? e.pageX : e.touches[0].pageX);

            //in touch devices with scrollBar:true, e.pageY is detected, but we have to deal with touch events. #1008
            if(isTouch && isReallyTouch(e) && options.scrollBar){
                events.y = e.touches[0].pageY;
                events.x = e.touches[0].pageX;
            }

            return events;
        }

        /**
        * Slides silently (with no animation) the active slider to the given slide.
        * @param noCallback {bool} true or defined -> no callbacks
        */
        function silentLandscapeScroll(activeSlide, noCallbacks){
            setScrollingSpeed (0, 'internal');

            if(typeof noCallbacks !== 'undefined'){
                //preventing firing callbacks afterSlideLoad etc.
                isResizing = true;
            }

            landscapeScroll(activeSlide.closest(SLIDES_WRAPPER_SEL), activeSlide);

            if(typeof noCallbacks !== 'undefined'){
                isResizing = false;
            }

            setScrollingSpeed(originals.scrollingSpeed, 'internal');
        }

        /**
        * Scrolls silently (with no animation) the page to the given Y position.
        */
        function silentScroll(top){
            // The first section can have a negative value in iOS 10. Not quite sure why: -0.0142822265625
            // that's why we round it to 0.
            var roundedTop = Math.round(top);

            if (options.css3 && options.autoScrolling && !options.scrollBar){
                var translate3d = 'translate3d(0px, -' + roundedTop + 'px, 0px)';
                transformContainer(translate3d, false);
            }
            else if(options.autoScrolling && !options.scrollBar){
                container.css('top', -roundedTop);
            }
            else{
                $htmlBody.scrollTop(roundedTop);
            }
        }

        /**
        * Returns the cross-browser transform string.
        */
        function getTransforms(translate3d){
            return {
                '-webkit-transform': translate3d,
                '-moz-transform': translate3d,
                '-ms-transform':translate3d,
                'transform': translate3d
            };
        }

        /**
        * Allowing or disallowing the mouse/swipe scroll in a given direction. (not for keyboard)
        * @type  m (mouse) or k (keyboard)
        */
        function setIsScrollAllowed(value, direction, type){
            switch (direction){
                case 'up': isScrollAllowed[type].up = value; break;
                case 'down': isScrollAllowed[type].down = value; break;
                case 'left': isScrollAllowed[type].left = value; break;
                case 'right': isScrollAllowed[type].right = value; break;
                case 'all':
                    if(type == 'm'){
                        setAllowScrolling(value);
                    }else{
                        setKeyboardScrolling(value);
                    }
            }
        }

        /*
        * Destroys fullpage.js plugin events and optinally its html markup and styles
        */
        function destroy(all){
            setAutoScrolling(false, 'internal');
            setAllowScrolling(false);
            setKeyboardScrolling(false);
            container.addClass(DESTROYED);

            clearTimeout(afterSlideLoadsId);
            clearTimeout(afterSectionLoadsId);
            clearTimeout(resizeId);
            clearTimeout(scrollId);
            clearTimeout(scrollId2);

            $window
                .off('scroll', scrollHandler)
                .off('hashchange', hashChangeHandler)
                .off('resize', resizeHandler);

            $document
                .off('click touchstart', SECTION_NAV_SEL + ' a')
                .off('mouseenter', SECTION_NAV_SEL + ' li')
                .off('mouseleave', SECTION_NAV_SEL + ' li')
                .off('click touchstart', SLIDES_NAV_LINK_SEL)
                .off('mouseover', options.normalScrollElements)
                .off('mouseout', options.normalScrollElements);

            $(SECTION_SEL)
                .off('click touchstart', SLIDES_ARROW_SEL);

            clearTimeout(afterSlideLoadsId);
            clearTimeout(afterSectionLoadsId);

            //lets make a mess!
            if(all){
                destroyStructure();
            }
        }

        /*
        * Removes inline styles added by fullpage.js
        */
        function destroyStructure(){
            //reseting the `top` or `translate` properties to 0
            silentScroll(0);

            //loading all the lazy load content
            container.find('img[data-src], source[data-src], audio[data-src], iframe[data-src]').each(function(){
                setSrc($(this), 'src');
            });

            container.find('img[data-srcset]').each(function(){
                setSrc($(this), 'srcset');
            });

            $(SECTION_NAV_SEL + ', ' + SLIDES_NAV_SEL +  ', ' + SLIDES_ARROW_SEL).remove();

            //removing inline styles
            $(SECTION_SEL).css( {
                'height': '',
                'background-color' : '',
                'padding': ''
            });

            $(SLIDE_SEL).css( {
                'width': ''
            });

            container.css({
                'height': '',
                'position': '',
                '-ms-touch-action': '',
                'touch-action': ''
            });

            $htmlBody.css({
                'overflow': '',
                'height': ''
            });

            // remove .fp-enabled class
            $('html').removeClass(ENABLED);

            // remove .fp-responsive class
            $body.removeClass(RESPONSIVE);

            // remove all of the .fp-viewing- classes
            $.each($body.get(0).className.split(/\s+/), function (index, className) {
                if (className.indexOf(VIEWING_PREFIX) === 0) {
                    $body.removeClass(className);
                }
            });

            //removing added classes
            $(SECTION_SEL + ', ' + SLIDE_SEL).each(function(){
                options.scrollOverflowHandler.remove($(this));
                $(this).removeClass(TABLE + ' ' + ACTIVE);
            });

            removeAnimation(container);

            //Unwrapping content
            container.find(TABLE_CELL_SEL + ', ' + SLIDES_CONTAINER_SEL + ', ' + SLIDES_WRAPPER_SEL).each(function(){
                //unwrap not being use in case there's no child element inside and its just text
                $(this).replaceWith(this.childNodes);
            });

            //removing the applied transition from the fullpage wrapper
            container.css({
                '-webkit-transition': 'none',
                'transition': 'none'
            });

            //scrolling the page to the top with no animation
            $htmlBody.scrollTop(0);

            //removing selectors
            var usedSelectors = [SECTION, SLIDE, SLIDES_CONTAINER];
            $.each(usedSelectors, function(index, value){
                $('.' + value).removeClass(value);
            });
        }

        /*
        * Sets the state for a variable with multiple states (original, and temporal)
        * Some variables such as `autoScrolling` or `recordHistory` might change automatically its state when using `responsive` or `autoScrolling:false`.
        * This function is used to keep track of both states, the original and the temporal one.
        * If type is not 'internal', then we assume the user is globally changing the variable.
        */
        function setVariableState(variable, value, type){
            options[variable] = value;
            if(type !== 'internal'){
                originals[variable] = value;
            }
        }

        /**
        * Displays warnings
        */
        function displayWarnings(){
            var extensions = ['fadingEffect', 'continuousHorizontal', 'scrollHorizontally', 'interlockedSlides', 'resetSliders', 'responsiveSlides', 'offsetSections', 'dragAndMove', 'scrollOverflowReset', 'parallax'];
            if($('html').hasClass(ENABLED)){
                showError('error', 'Fullpage.js can only be initialized once and you are doing it multiple times!');
                return;
            }

            // Disable mutually exclusive settings
            if (options.continuousVertical &&
                (options.loopTop || options.loopBottom)) {
                options.continuousVertical = false;
                showError('warn', 'Option `loopTop/loopBottom` is mutually exclusive with `continuousVertical`; `continuousVertical` disabled');
            }

            if(options.scrollBar && options.scrollOverflow){
                showError('warn', 'Option `scrollBar` is mutually exclusive with `scrollOverflow`. Sections with scrollOverflow might not work well in Firefox');
            }

            if(options.continuousVertical && (options.scrollBar || !options.autoScrolling)){
                options.continuousVertical = false;
                showError('warn', 'Scroll bars (`scrollBar:true` or `autoScrolling:false`) are mutually exclusive with `continuousVertical`; `continuousVertical` disabled');
            }

            //using extensions? Wrong file!
            $.each(extensions, function(index, extension){
                //is the option set to true?
                if(options[extension]){
                    showError('warn', 'fullpage.js extensions require jquery.fullpage.extensions.min.js file instead of the usual jquery.fullpage.js. Requested: '+ extension);
                }
            });

            //anchors can not have the same value as any element ID or NAME
            $.each(options.anchors, function(index, name){

                //case insensitive selectors (http://stackoverflow.com/a/19465187/1081396)
                var nameAttr = $document.find('[name]').filter(function() {
                    return $(this).attr('name') && $(this).attr('name').toLowerCase() == name.toLowerCase();
                });

                var idAttr = $document.find('[id]').filter(function() {
                    return $(this).attr('id') && $(this).attr('id').toLowerCase() == name.toLowerCase();
                });

                if(idAttr.length || nameAttr.length ){
                    showError('error', 'data-anchor tags can not have the same value as any `id` element on the site (or `name` element for IE).');
                    idAttr.length && showError('error', '"' + name + '" is is being used by another element `id` property');
                    nameAttr.length && showError('error', '"' + name + '" is is being used by another element `name` property');
                }
            });
        }

        /**
        * Shows a message in the console of the given type.
        */
        function showError(type, text){
            console && console[type] && console[type]('fullPage: ' + text);
        }

    }; //end of $.fn.fullpage

    if(typeof IScroll !== 'undefined'){
        /*
        * Turns iScroll `mousewheel` option off dynamically
        * https://github.com/cubiq/iscroll/issues/1036
        */
        IScroll.prototype.wheelOn = function () {
            this.wrapper.addEventListener('wheel', this);
            this.wrapper.addEventListener('mousewheel', this);
            this.wrapper.addEventListener('DOMMouseScroll', this);
        };

        /*
        * Turns iScroll `mousewheel` option on dynamically
        * https://github.com/cubiq/iscroll/issues/1036
        */
        IScroll.prototype.wheelOff = function () {
            this.wrapper.removeEventListener('wheel', this);
            this.wrapper.removeEventListener('mousewheel', this);
            this.wrapper.removeEventListener('DOMMouseScroll', this);
        };
    }

    /**
     * An object to handle overflow scrolling.
     * This uses jquery.slimScroll to accomplish overflow scrolling.
     * It is possible to pass in an alternate scrollOverflowHandler
     * to the fullpage.js option that implements the same functions
     * as this handler.
     *
     * @type {Object}
     */
    var iscrollHandler = {
        refreshId: null,
        iScrollInstances: [],

        // Enables or disables the mouse wheel for the active section or all slides in it
        toggleWheel: function(value){
            var scrollable = $(SECTION_ACTIVE_SEL).find(SCROLLABLE_SEL);
            scrollable.each(function(){
                var iScrollInstance = $(this).data('iscrollInstance');
                if(typeof iScrollInstance !== 'undefined' && iScrollInstance){
                    if(value){
                        iScrollInstance.wheelOn();
                    }
                    else{
                        iScrollInstance.wheelOff();
                    }
                }
            });
        },

        /**
        * Turns off iScroll for the destination section.
        * When scrolling very fast on some trackpads (and Apple laptops) the inertial scrolling would
        * scroll the destination section/slide before the sections animations ends.
        */
        onLeave: function(){
            iscrollHandler.toggleWheel(false);
        },

        // Turns off iScroll for the leaving section
        beforeLeave: function(){
            iscrollHandler.onLeave()
        },

        // Turns on iScroll on section load
        afterLoad: function(){
            iscrollHandler.toggleWheel(true);
        },

        /**
         * Called when overflow scrolling is needed for a section.
         *
         * @param  {Object} element      jQuery object containing current section
         * @param  {Number} scrollHeight Current window height in pixels
         */
        create: function(element, scrollHeight) {
            var scrollable = element.find(SCROLLABLE_SEL);

            scrollable.height(scrollHeight);
            scrollable.each(function() {
                var $this = $(this);
                var iScrollInstance = $this.data('iscrollInstance');
                if (iScrollInstance) {
                    $.each(iscrollHandler.iScrollInstances, function(){
                        $(this).destroy();
                    });
                }

                iScrollInstance = new IScroll($this.get(0), iscrollOptions);
                iscrollHandler.iScrollInstances.push(iScrollInstance);

                //off by default until the section gets active
                iScrollInstance.wheelOff();

                $this.data('iscrollInstance', iScrollInstance);
            });
        },

        /**
         * Return a boolean depending on whether the scrollable element is a
         * the end or at the start of the scrolling depending on the given type.
         *
         * @param  {String}  type       Either 'top' or 'bottom'
         * @param  {Object}  scrollable jQuery object for the scrollable element
         * @return {Boolean}
         */
        isScrolled: function(type, scrollable) {
            var scroller = scrollable.data('iscrollInstance');

            //no scroller?
            if (!scroller) {
                return true;
            }

            if (type === 'top') {
                return scroller.y >= 0 && !scrollable.scrollTop();
            } else if (type === 'bottom') {
                return (0 - scroller.y) + scrollable.scrollTop() + 1 + scrollable.innerHeight() >= scrollable[0].scrollHeight;
            }
        },

        /**
         * Returns the scrollable element for the given section.
         * If there are landscape slides, will only return a scrollable element
         * if it is in the active slide.
         *
         * @param  {Object}  activeSection jQuery object containing current section
         * @return {Boolean}
         */
        scrollable: function(activeSection){
            // if there are landscape slides, we check if the scrolling bar is in the current one or not
            if (activeSection.find(SLIDES_WRAPPER_SEL).length) {
                return activeSection.find(SLIDE_ACTIVE_SEL).find(SCROLLABLE_SEL);
            }
            return activeSection.find(SCROLLABLE_SEL);
        },

        /**
         * Returns the scroll height of the wrapped content.
         * If this is larger than the window height minus section padding,
         * overflow scrolling is needed.
         *
         * @param  {Object} element jQuery object containing current section
         * @return {Number}
         */
        scrollHeight: function(element) {
            return element.find(SCROLLABLE_SEL).children().first().get(0).scrollHeight;
        },

        /**
         * Called when overflow scrolling is no longer needed for a section.
         *
         * @param  {Object} element      jQuery object containing current section
         */
        remove: function(element) {
            var scrollable = element.find(SCROLLABLE_SEL);
            if (scrollable.length) {
                var iScrollInstance = scrollable.data('iscrollInstance');
                iScrollInstance.destroy();

                scrollable.data('iscrollInstance', null);
            }
            element.find(SCROLLABLE_SEL).children().first().children().first().unwrap().unwrap();
        },

        /**
         * Called when overflow scrolling has already been setup but the
         * window height has potentially changed.
         *
         * @param  {Object} element      jQuery object containing current section
         * @param  {Number} scrollHeight Current window height in pixels
         */
        update: function(element, scrollHeight) {
            //using a timeout in order to execute the refresh function only once when `update` is called multiple times in a
            //short period of time.
            //it also comes on handy because iScroll requires the use of timeout when using `refresh`.
            clearTimeout(iscrollHandler.refreshId);
            iscrollHandler.refreshId = setTimeout(function(){
                $.each(iscrollHandler.iScrollInstances, function(){
                    $(this).get(0).refresh();
                });
            }, 150);

            //updating the wrappers height
            element.find(SCROLLABLE_SEL).css('height', scrollHeight + 'px').parent().css('height', scrollHeight + 'px');
        },

        /**
         * Called to get any additional elements needed to wrap the section
         * content in order to facilitate overflow scrolling.
         *
         * @return {String|Object} Can be a string containing HTML,
         *                         a DOM element, or jQuery object.
         */
        wrapContent: function() {
            return '<div class="' + SCROLLABLE + '"><div class="fp-scroller"></div></div>';
        }
    };
});
/**
 * jQuery CSS Customizable Scrollbar
 *
 * Copyright 2015, Yuriy Khabarov
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *
 * If you found bug, please contact me via email <13real008@gmail.com>
 *
 * @author Yuriy Khabarov aka Gromo
 * @version 0.2.11
 * @url https://github.com/gromo/jquery.scrollbar/
 *
 */
;
(function (root, factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports !== "undefined") {
        factory(require('jquery'));
    } else {
        factory(root.jQuery);
    }
}(this, function ($) {
    'use strict';

    // init flags & variables
    var debug = false;

    var browser = {
        data: {
            index: 0,
            name: 'scrollbar'
        },
        firefox: /firefox/i.test(navigator.userAgent),
        macosx: /mac/i.test(navigator.platform),
        msedge: /edge\/\d+/i.test(navigator.userAgent),
        msie: /(msie|trident)/i.test(navigator.userAgent),
        mobile: /android|webos|iphone|ipad|ipod|blackberry/i.test(navigator.userAgent),
        overlay: null,
        scroll: null,
        scrolls: [],
        webkit: /webkit/i.test(navigator.userAgent) && !/edge\/\d+/i.test(navigator.userAgent)
    };

    browser.scrolls.add = function (instance) {
        this.remove(instance).push(instance);
    };
    browser.scrolls.remove = function (instance) {
        while ($.inArray(instance, this) >= 0) {
            this.splice($.inArray(instance, this), 1);
        }
        return this;
    };

    var defaults = {
        autoScrollSize: true, // automatically calculate scrollsize
        autoUpdate: true, // update scrollbar if content/container size changed
        debug: false, // debug mode
        disableBodyScroll: false, // disable body scroll if mouse over container
        duration: 200, // scroll animate duration in ms
        ignoreMobile: false, // ignore mobile devices
        ignoreOverlay: false, // ignore browsers with overlay scrollbars (mobile, MacOS)
        isRtl: false, // is RTL
        scrollStep: 30, // scroll step for scrollbar arrows
        showArrows: false, // add class to show arrows
        stepScrolling: true, // when scrolling to scrollbar mousedown position

        scrollx: null, // horizontal scroll element
        scrolly: null, // vertical scroll element

        onDestroy: null, // callback function on destroy,
        onFallback: null, // callback function if scrollbar is not initialized
        onInit: null, // callback function on first initialization
        onScroll: null, // callback function on content scrolling
        onUpdate: null            // callback function on init/resize (before scrollbar size calculation)
    };


    var BaseScrollbar = function (container) {

        if (!browser.scroll) {
            browser.overlay = isScrollOverlaysContent();
            browser.scroll = getBrowserScrollSize();
            updateScrollbars();

            $(window).resize(function () {
                var forceUpdate = false;
                if (browser.scroll && (browser.scroll.height || browser.scroll.width)) {
                    var scroll = getBrowserScrollSize();
                    if (scroll.height !== browser.scroll.height || scroll.width !== browser.scroll.width) {
                        browser.scroll = scroll;
                        forceUpdate = true; // handle page zoom
                    }
                }
                updateScrollbars(forceUpdate);
            });
        }

        this.container = container;
        this.namespace = '.scrollbar_' + browser.data.index++;
        this.options = $.extend({}, defaults, window.jQueryScrollbarOptions || {});
        this.scrollTo = null;
        this.scrollx = {};
        this.scrolly = {};

        container.data(browser.data.name, this);
        browser.scrolls.add(this);
    };

    BaseScrollbar.prototype = {
        destroy: function () {

            if (!this.wrapper) {
                return;
            }

            this.container.removeData(browser.data.name);
            browser.scrolls.remove(this);

            // init variables
            var scrollLeft = this.container.scrollLeft();
            var scrollTop = this.container.scrollTop();

            this.container.insertBefore(this.wrapper).css({
                "height": "",
                "margin": "",
                "max-height": ""
            })
                .removeClass('scroll-content scroll-scrollx_visible scroll-scrolly_visible')
                .off(this.namespace)
                .scrollLeft(scrollLeft)
                .scrollTop(scrollTop);

            this.scrollx.scroll.removeClass('scroll-scrollx_visible').find('div').addBack().off(this.namespace);
            this.scrolly.scroll.removeClass('scroll-scrolly_visible').find('div').addBack().off(this.namespace);

            this.wrapper.remove();

            $(document).add('body').off(this.namespace);

            if ($.isFunction(this.options.onDestroy)) {
                this.options.onDestroy.apply(this, [this.container]);
            }
        },
        init: function (options) {

            // init variables
            var S = this,
                c = this.container,
                cw = this.containerWrapper || c,
                namespace = this.namespace,
                o = $.extend(this.options, options || {}),
                s = {x: this.scrollx, y: this.scrolly},
            w = this.wrapper,
                cssOptions = {};

            var initScroll = {
                scrollLeft: c.scrollLeft(),
                scrollTop: c.scrollTop()
            };

            // do not init if in ignorable browser
            if ((browser.mobile && o.ignoreMobile)
                || (browser.overlay && o.ignoreOverlay)
                || (browser.macosx && !browser.webkit) // still required to ignore nonWebKit browsers on Mac
                ) {
                if ($.isFunction(o.onFallback)) {
                    o.onFallback.apply(this, [c]);
                }
                return false;
            }

            // init scroll container
            if (!w) {
                this.wrapper = w = $('<div>').addClass('scroll-wrapper').addClass(c.attr('class'))
                    .css('position', c.css('position') === 'absolute' ? 'absolute' : 'relative')
                    .insertBefore(c).append(c);

                if (o.isRtl) {
                    w.addClass('scroll--rtl');
                }

                if (c.is('textarea')) {
                    this.containerWrapper = cw = $('<div>').insertBefore(c).append(c);
                    w.addClass('scroll-textarea');
                }

                cssOptions = {
                    "height": "auto",
                    "margin-bottom": browser.scroll.height * -1 + 'px',
                    "max-height": ""
                };
                cssOptions[o.isRtl ? 'margin-left' : 'margin-right'] = browser.scroll.width * -1 + 'px';

                cw.addClass('scroll-content').css(cssOptions);

                c.on('scroll' + namespace, function (event) {
                    var scrollLeft = c.scrollLeft();
                    var scrollTop = c.scrollTop();
                    if (o.isRtl) {
                        // webkit   0:100
                        // ie/edge  100:0
                        // firefox -100:0
                        switch (true) {
                            case browser.firefox:
                                scrollLeft = Math.abs(scrollLeft);
                            case browser.msedge || browser.msie:
                                scrollLeft = c[0].scrollWidth - c[0].clientWidth - scrollLeft;
                                break;
                        }
                    }
                    if ($.isFunction(o.onScroll)) {
                        o.onScroll.call(S, {
                            maxScroll: s.y.maxScrollOffset,
                            scroll: scrollTop,
                            size: s.y.size,
                            visible: s.y.visible
                        }, {
                            maxScroll: s.x.maxScrollOffset,
                            scroll: scrollLeft,
                            size: s.x.size,
                            visible: s.x.visible
                        });
                    }
                    s.x.isVisible && s.x.scroll.bar.css('left', scrollLeft * s.x.kx + 'px');
                    s.y.isVisible && s.y.scroll.bar.css('top', scrollTop * s.y.kx + 'px');
                });

                /* prevent native scrollbars to be visible on #anchor click */
                w.on('scroll' + namespace, function () {
                    w.scrollTop(0).scrollLeft(0);
                });

                if (o.disableBodyScroll) {
                    var handleMouseScroll = function (event) {
                        isVerticalScroll(event) ?
                            s.y.isVisible && s.y.mousewheel(event) :
                            s.x.isVisible && s.x.mousewheel(event);
                    };
                    w.on('MozMousePixelScroll' + namespace, handleMouseScroll);
                    w.on('mousewheel' + namespace, handleMouseScroll);

                    if (browser.mobile) {
                        w.on('touchstart' + namespace, function (event) {
                            var touch = event.originalEvent.touches && event.originalEvent.touches[0] || event;
                            var originalTouch = {
                                pageX: touch.pageX,
                                pageY: touch.pageY
                            };
                            var originalScroll = {
                                left: c.scrollLeft(),
                                top: c.scrollTop()
                            };
                            $(document).on('touchmove' + namespace, function (event) {
                                var touch = event.originalEvent.targetTouches && event.originalEvent.targetTouches[0] || event;
                                c.scrollLeft(originalScroll.left + originalTouch.pageX - touch.pageX);
                                c.scrollTop(originalScroll.top + originalTouch.pageY - touch.pageY);
                                event.preventDefault();
                            });
                            $(document).on('touchend' + namespace, function () {
                                $(document).off(namespace);
                            });
                        });
                    }
                }
                if ($.isFunction(o.onInit)) {
                    o.onInit.apply(this, [c]);
                }
            } else {
                cssOptions = {
                    "height": "auto",
                    "margin-bottom": browser.scroll.height * -1 + 'px',
                    "max-height": ""
                };
                cssOptions[o.isRtl ? 'margin-left' : 'margin-right'] = browser.scroll.width * -1 + 'px';
                cw.css(cssOptions);
            }

            // init scrollbars & recalculate sizes
            $.each(s, function (d, scrollx) {

                var scrollCallback = null;
                var scrollForward = 1;
                var scrollOffset = (d === 'x') ? 'scrollLeft' : 'scrollTop';
                var scrollStep = o.scrollStep;
                var scrollTo = function () {
                    var currentOffset = c[scrollOffset]();
                    c[scrollOffset](currentOffset + scrollStep);
                    if (scrollForward == 1 && (currentOffset + scrollStep) >= scrollToValue)
                        currentOffset = c[scrollOffset]();
                    if (scrollForward == -1 && (currentOffset + scrollStep) <= scrollToValue)
                        currentOffset = c[scrollOffset]();
                    if (c[scrollOffset]() == currentOffset && scrollCallback) {
                        scrollCallback();
                    }
                }
                var scrollToValue = 0;

                if (!scrollx.scroll) {

                    scrollx.scroll = S._getScroll(o['scroll' + d]).addClass('scroll-' + d);

                    if (o.showArrows) {
                        scrollx.scroll.addClass('scroll-element_arrows_visible');
                    }

                    scrollx.mousewheel = function (event) {

                        if (!scrollx.isVisible || (d === 'x' && isVerticalScroll(event))) {
                            return true;
                        }
                        if (d === 'y' && !isVerticalScroll(event)) {
                            s.x.mousewheel(event);
                            return true;
                        }

                        var delta = event.originalEvent.wheelDelta * -1 || event.originalEvent.detail;
                        var maxScrollValue = scrollx.size - scrollx.visible - scrollx.offset;

                        // fix new mozilla
                        if (!delta) {
                            if (d === 'x' && !!event.originalEvent.deltaX) {
                                delta = event.originalEvent.deltaX * 40;
                            } else if (d === 'y' && !!event.originalEvent.deltaY) {
                                delta = event.originalEvent.deltaY * 40;
                            }
                        }

                        if ((delta > 0 && scrollToValue < maxScrollValue) || (delta < 0 && scrollToValue > 0)) {
                            scrollToValue = scrollToValue + delta;
                            if (scrollToValue < 0)
                                scrollToValue = 0;
                            if (scrollToValue > maxScrollValue)
                                scrollToValue = maxScrollValue;

                            S.scrollTo = S.scrollTo || {};
                            S.scrollTo[scrollOffset] = scrollToValue;
                            setTimeout(function () {
                                if (S.scrollTo) {
                                    c.stop().animate(S.scrollTo, 240, 'linear', function () {
                                        scrollToValue = c[scrollOffset]();
                                    });
                                    S.scrollTo = null;
                                }
                            }, 1);
                        }

                        event.preventDefault();
                        return false;
                    };

                    scrollx.scroll
                        .on('MozMousePixelScroll' + namespace, scrollx.mousewheel)
                        .on('mousewheel' + namespace, scrollx.mousewheel)
                        .on('mouseenter' + namespace, function () {
                            scrollToValue = c[scrollOffset]();
                        });

                    // handle arrows & scroll inner mousedown event
                    scrollx.scroll.find('.scroll-arrow, .scroll-element_track')
                        .on('mousedown' + namespace, function (event) {

                            if (event.which != 1) // lmb
                                return true;

                            scrollForward = 1;

                            var data = {
                                eventOffset: event[(d === 'x') ? 'pageX' : 'pageY'],
                                maxScrollValue: scrollx.size - scrollx.visible - scrollx.offset,
                                scrollbarOffset: scrollx.scroll.bar.offset()[(d === 'x') ? 'left' : 'top'],
                                scrollbarSize: scrollx.scroll.bar[(d === 'x') ? 'outerWidth' : 'outerHeight']()
                            };
                            var timeout = 0, timer = 0;

                            if ($(this).hasClass('scroll-arrow')) {
                                scrollForward = $(this).hasClass("scroll-arrow_more") ? 1 : -1;
                                scrollStep = o.scrollStep * scrollForward;
                                scrollToValue = scrollForward > 0 ? data.maxScrollValue : 0;
                                if (o.isRtl) {
                                    switch(true){
                                        case browser.firefox:
                                            scrollToValue = scrollForward > 0 ? 0: data.maxScrollValue * -1;
                                            break;
                                        case browser.msie || browser.msedge:
                                            break;
                                    }
                                }
                            } else {
                                scrollForward = (data.eventOffset > (data.scrollbarOffset + data.scrollbarSize) ? 1
                                    : (data.eventOffset < data.scrollbarOffset ? -1 : 0));
                                if(d === 'x' && o.isRtl && (browser.msie || browser.msedge))
                                    scrollForward = scrollForward * -1;
                                scrollStep = Math.round(scrollx.visible * 0.75) * scrollForward;
                                scrollToValue = (data.eventOffset - data.scrollbarOffset -
                                    (o.stepScrolling ? (scrollForward == 1 ? data.scrollbarSize : 0)
                                        : Math.round(data.scrollbarSize / 2)));
                                scrollToValue = c[scrollOffset]() + (scrollToValue / scrollx.kx);
                            }

                            S.scrollTo = S.scrollTo || {};
                            S.scrollTo[scrollOffset] = o.stepScrolling ? c[scrollOffset]() + scrollStep : scrollToValue;

                            if (o.stepScrolling) {
                                scrollCallback = function () {
                                    scrollToValue = c[scrollOffset]();
                                    clearInterval(timer);
                                    clearTimeout(timeout);
                                    timeout = 0;
                                    timer = 0;
                                };
                                timeout = setTimeout(function () {
                                    timer = setInterval(scrollTo, 40);
                                }, o.duration + 100);
                            }

                            setTimeout(function () {
                                if (S.scrollTo) {
                                    c.animate(S.scrollTo, o.duration);
                                    S.scrollTo = null;
                                }
                            }, 1);

                            return S._handleMouseDown(scrollCallback, event);
                        });

                    // handle scrollbar drag'n'drop
                    scrollx.scroll.bar.on('mousedown' + namespace, function (event) {

                        if (event.which != 1) // lmb
                            return true;

                        var eventPosition = event[(d === 'x') ? 'pageX' : 'pageY'];
                        var initOffset = c[scrollOffset]();

                        scrollx.scroll.addClass('scroll-draggable');

                        $(document).on('mousemove' + namespace, function (event) {
                            var diff = parseInt((event[(d === 'x') ? 'pageX' : 'pageY'] - eventPosition) / scrollx.kx, 10);
                            if (d === 'x' && o.isRtl && (browser.msie || browser.msedge))
                                diff = diff * -1;
                            c[scrollOffset](initOffset + diff);
                        });

                        return S._handleMouseDown(function () {
                            scrollx.scroll.removeClass('scroll-draggable');
                            scrollToValue = c[scrollOffset]();
                        }, event);
                    });
                }
            });

            // remove classes & reset applied styles
            $.each(s, function (d, scrollx) {
                var scrollClass = 'scroll-scroll' + d + '_visible';
                var scrolly = (d == "x") ? s.y : s.x;

                scrollx.scroll.removeClass(scrollClass);
                scrolly.scroll.removeClass(scrollClass);
                cw.removeClass(scrollClass);
            });

            // calculate init sizes
            $.each(s, function (d, scrollx) {
                $.extend(scrollx, (d == "x") ? {
                    offset: parseInt(c.css('left'), 10) || 0,
                    size: c.prop('scrollWidth'),
                    visible: w.width()
                } : {
                    offset: parseInt(c.css('top'), 10) || 0,
                    size: c.prop('scrollHeight'),
                    visible: w.height()
                });
            });

            // update scrollbar visibility/dimensions
            this._updateScroll('x', this.scrollx);
            this._updateScroll('y', this.scrolly);

            if ($.isFunction(o.onUpdate)) {
                o.onUpdate.apply(this, [c]);
            }

            // calculate scroll size
            $.each(s, function (d, scrollx) {

                var cssOffset = (d === 'x') ? 'left' : 'top';
                var cssFullSize = (d === 'x') ? 'outerWidth' : 'outerHeight';
                var cssSize = (d === 'x') ? 'width' : 'height';
                var offset = parseInt(c.css(cssOffset), 10) || 0;

                var AreaSize = scrollx.size;
                var AreaVisible = scrollx.visible + offset;

                var scrollSize = scrollx.scroll.size[cssFullSize]() + (parseInt(scrollx.scroll.size.css(cssOffset), 10) || 0);

                if (o.autoScrollSize) {
                    scrollx.scrollbarSize = parseInt(scrollSize * AreaVisible / AreaSize, 10);
                    scrollx.scroll.bar.css(cssSize, scrollx.scrollbarSize + 'px');
                }

                scrollx.scrollbarSize = scrollx.scroll.bar[cssFullSize]();
                scrollx.kx = ((scrollSize - scrollx.scrollbarSize) / (AreaSize - AreaVisible)) || 1;
                scrollx.maxScrollOffset = AreaSize - AreaVisible;
            });

            c.scrollLeft(initScroll.scrollLeft).scrollTop(initScroll.scrollTop).trigger('scroll');
        },
        /**
         * Get scrollx/scrolly object
         *
         * @param {Mixed} scroll
         * @returns {jQuery} scroll object
         */
        _getScroll: function (scroll) {
            var types = {
                advanced: [
                    '<div class="scroll-element">',
                    '<div class="scroll-element_corner"></div>',
                    '<div class="scroll-arrow scroll-arrow_less"></div>',
                    '<div class="scroll-arrow scroll-arrow_more"></div>',
                    '<div class="scroll-element_outer">',
                    '<div class="scroll-element_size"></div>', // required! used for scrollbar size calculation !
                    '<div class="scroll-element_inner-wrapper">',
                    '<div class="scroll-element_inner scroll-element_track">', // used for handling scrollbar click
                    '<div class="scroll-element_inner-bottom"></div>',
                    '</div>',
                    '</div>',
                    '<div class="scroll-bar">', // required
                    '<div class="scroll-bar_body">',
                    '<div class="scroll-bar_body-inner"></div>',
                    '</div>',
                    '<div class="scroll-bar_bottom"></div>',
                    '<div class="scroll-bar_center"></div>',
                    '</div>',
                    '</div>',
                    '</div>'
                ].join(''),
                simple: [
                    '<div class="scroll-element">',
                    '<div class="scroll-element_outer">',
                    '<div class="scroll-element_size"></div>', // required! used for scrollbar size calculation !
                    '<div class="scroll-element_track"></div>', // used for handling scrollbar click
                    '<div class="scroll-bar"></div>', // required
                    '</div>',
                    '</div>'
                ].join('')
            };
            if (types[scroll]) {
                scroll = types[scroll];
            }
            if (!scroll) {
                scroll = types['simple'];
            }
            if (typeof (scroll) == 'string') {
                scroll = $(scroll).appendTo(this.wrapper);
            } else {
                scroll = $(scroll);
            }
            $.extend(scroll, {
                bar: scroll.find('.scroll-bar'),
                size: scroll.find('.scroll-element_size'),
                track: scroll.find('.scroll-element_track')
            });
            return scroll;
        },
        _handleMouseDown: function (callback, event) {

            var namespace = this.namespace;

            $(document).on('blur' + namespace, function () {
                $(document).add('body').off(namespace);
                callback && callback();
            });
            $(document).on('dragstart' + namespace, function (event) {
                event.preventDefault();
                return false;
            });
            $(document).on('mouseup' + namespace, function () {
                $(document).add('body').off(namespace);
                callback && callback();
            });
            $('body').on('selectstart' + namespace, function (event) {
                event.preventDefault();
                return false;
            });

            event && event.preventDefault();
            return false;
        },
        _updateScroll: function (d, scrollx) {

            var container = this.container,
                containerWrapper = this.containerWrapper || container,
                scrollClass = 'scroll-scroll' + d + '_visible',
                scrolly = (d === 'x') ? this.scrolly : this.scrollx,
                offset = parseInt(this.container.css((d === 'x') ? 'left' : 'top'), 10) || 0,
                wrapper = this.wrapper;

            var AreaSize = scrollx.size;
            var AreaVisible = scrollx.visible + offset;

            scrollx.isVisible = (AreaSize - AreaVisible) > 1; // bug in IE9/11 with 1px diff
            if (scrollx.isVisible) {
                scrollx.scroll.addClass(scrollClass);
                scrolly.scroll.addClass(scrollClass);
                containerWrapper.addClass(scrollClass);
            } else {
                scrollx.scroll.removeClass(scrollClass);
                scrolly.scroll.removeClass(scrollClass);
                containerWrapper.removeClass(scrollClass);
            }

            if (d === 'y') {
                if (container.is('textarea') || AreaSize < AreaVisible) {
                    containerWrapper.css({
                        "height": (AreaVisible + browser.scroll.height) + 'px',
                        "max-height": "none"
                    });
                } else {
                    containerWrapper.css({
                        //"height": "auto", // do not reset height value: issue with height:100%!
                        "max-height": (AreaVisible + browser.scroll.height) + 'px'
                    });
                }
            }

            if (scrollx.size != container.prop('scrollWidth')
                || scrolly.size != container.prop('scrollHeight')
                || scrollx.visible != wrapper.width()
                || scrolly.visible != wrapper.height()
                || scrollx.offset != (parseInt(container.css('left'), 10) || 0)
                || scrolly.offset != (parseInt(container.css('top'), 10) || 0)
                ) {
                $.extend(this.scrollx, {
                    offset: parseInt(container.css('left'), 10) || 0,
                    size: container.prop('scrollWidth'),
                    visible: wrapper.width()
                });
                $.extend(this.scrolly, {
                    offset: parseInt(container.css('top'), 10) || 0,
                    size: this.container.prop('scrollHeight'),
                    visible: wrapper.height()
                });
                this._updateScroll(d === 'x' ? 'y' : 'x', scrolly);
            }
        }
    };

    var CustomScrollbar = BaseScrollbar;

    /*
     * Extend jQuery as plugin
     *
     * @param {Mixed} command to execute
     * @param {Mixed} arguments as Array
     * @return {jQuery}
     */
    $.fn.scrollbar = function (command, args) {
        if (typeof command !== 'string') {
            args = command;
            command = 'init';
        }
        if (typeof args === 'undefined') {
            args = [];
        }
        if (!$.isArray(args)) {
            args = [args];
        }
        this.not('body, .scroll-wrapper').each(function () {
            var element = $(this),
                instance = element.data(browser.data.name);
            if (instance || command === 'init') {
                if (!instance) {
                    instance = new CustomScrollbar(element);
                }
                if (instance[command]) {
                    instance[command].apply(instance, args);
                }
            }
        });
        return this;
    };

    /**
     * Connect default options to global object
     */
    $.fn.scrollbar.options = defaults;


    /**
     * Check if scroll content/container size is changed
     */

    var updateScrollbars = (function () {
        var timer = 0,
            timerCounter = 0;

        return function (force) {
            var i, container, options, scroll, wrapper, scrollx, scrolly;
            for (i = 0; i < browser.scrolls.length; i++) {
                scroll = browser.scrolls[i];
                container = scroll.container;
                options = scroll.options;
                wrapper = scroll.wrapper;
                scrollx = scroll.scrollx;
                scrolly = scroll.scrolly;
                if (force || (options.autoUpdate && wrapper && wrapper.is(':visible') &&
                    (container.prop('scrollWidth') != scrollx.size || container.prop('scrollHeight') != scrolly.size || wrapper.width() != scrollx.visible || wrapper.height() != scrolly.visible))) {
                    scroll.init();

                    if (options.debug) {
                        window.console && console.log({
                            scrollHeight: container.prop('scrollHeight') + ':' + scroll.scrolly.size,
                            scrollWidth: container.prop('scrollWidth') + ':' + scroll.scrollx.size,
                            visibleHeight: wrapper.height() + ':' + scroll.scrolly.visible,
                            visibleWidth: wrapper.width() + ':' + scroll.scrollx.visible
                        }, true);
                        timerCounter++;
                    }
                }
            }
            if (debug && timerCounter > 10) {
                window.console && console.log('Scroll updates exceed 10');
                updateScrollbars = function () {};
            } else {
                clearTimeout(timer);
                timer = setTimeout(updateScrollbars, 300);
            }
        };
    })();

    /* ADDITIONAL FUNCTIONS */
    /**
     * Get native browser scrollbar size (height/width)
     *
     * @param {Boolean} actual size or CSS size, default - CSS size
     * @returns {Object} with height, width
     */
    function getBrowserScrollSize(actualSize) {

        if (browser.webkit && !actualSize) {
            return {
                height: 0,
                width: 0
            };
        }

        if (!browser.data.outer) {
            var css = {
                "border": "none",
                "box-sizing": "content-box",
                "height": "200px",
                "margin": "0",
                "padding": "0",
                "width": "200px"
            };
            browser.data.inner = $("<div>").css($.extend({}, css));
            browser.data.outer = $("<div>").css($.extend({
                "left": "-1000px",
                "overflow": "scroll",
                "position": "absolute",
                "top": "-1000px"
            }, css)).append(browser.data.inner).appendTo("body");
        }

        browser.data.outer.scrollLeft(1000).scrollTop(1000);

        return {
            height: Math.ceil((browser.data.outer.offset().top - browser.data.inner.offset().top) || 0),
            width: Math.ceil((browser.data.outer.offset().left - browser.data.inner.offset().left) || 0)
        };
    }

    /**
     * Check if native browser scrollbars overlay content
     *
     * @returns {Boolean}
     */
    function isScrollOverlaysContent() {
        var scrollSize = getBrowserScrollSize(true);
        return !(scrollSize.height || scrollSize.width);
    }

    function isVerticalScroll(event) {
        var e = event.originalEvent;
        if (e.axis && e.axis === e.HORIZONTAL_AXIS)
            return false;
        if (e.wheelDeltaX)
            return false;
        return true;
    }


    /**
     * Extend AngularJS as UI directive
     * and expose a provider for override default config
     *
     */
    if (window.angular) {
        (function (angular) {
            angular.module('jQueryScrollbar', [])
                .provider('jQueryScrollbar', function () {
                    var defaultOptions = defaults;
                    return {
                        setOptions: function (options) {
                            angular.extend(defaultOptions, options);
                        },
                        $get: function () {
                            return {
                                options: angular.copy(defaultOptions)
                            };
                        }
                    };
                })
                .directive('jqueryScrollbar', ['jQueryScrollbar', '$parse', function (jQueryScrollbar, $parse) {
                        return {
                            restrict: "AC",
                            link: function (scope, element, attrs) {
                                var model = $parse(attrs.jqueryScrollbar),
                                    options = model(scope);
                                element.scrollbar(options || jQueryScrollbar.options)
                                    .on('$destroy', function () {
                                        element.scrollbar('destroy');
                                    });
                            }
                        };
                    }]);
        })(window.angular);
    }
}));
function simpleUpload(ajax_url,DOM_file,options){
    var forceIframe=false;var files=null;var limit=0;var max_file_size=0;var allowed_exts=[];var allowed_types=[];var expect_type="auto";var hash_worker=null;var on_hash_complete=null;var request_file_name="file";var request_data={};var xhrFields={};var on_init_callback=function(total_uploads){};var on_start_callback=function(file){};var on_progress_callback=function(progress){};var on_success_callback=function(data){};var on_error_callback=function(error){};var on_cancel_callback=function(){};var on_complete_callback=function(status){};var on_finish_callback=function(){};var upload_contexts=[];var private_upload_data=[];var instance_context={files:upload_contexts};var queued_files=0;var hidden_form=null;var file_completed=function(upload_num,status){on_complete(upload_num,status);queued_files--;if(queued_files==0)on_finish();simpleUpload.activeUploads--;simpleUpload.uploadNext();};var on_init=function(total_uploads){return on_init_callback.call(instance_context,total_uploads);};var on_start=function(upload_num,file){if(getUploadState(upload_num)>0)return false;if(on_start_callback.call(upload_contexts[upload_num],file)===false){setUploadState(upload_num,4);return false;}if(getUploadState(upload_num)>0)return false;setUploadState(upload_num,1);};var on_progress=function(upload_num,progress){if(getUploadState(upload_num)==1)on_progress_callback.call(upload_contexts[upload_num],progress);};var on_success=function(upload_num,data){if(getUploadState(upload_num)==1){setUploadState(upload_num,2);on_success_callback.call(upload_contexts[upload_num],data);file_completed(upload_num,"success");}};var on_error=function(upload_num,error){if(getUploadState(upload_num)==1){setUploadState(upload_num,3);on_error_callback.call(upload_contexts[upload_num],error);file_completed(upload_num,"error");}};var on_cancel=function(upload_num){on_cancel_callback.call(upload_contexts[upload_num]);file_completed(upload_num,"cancel");};var on_complete=function(upload_num,status){on_complete_callback.call(upload_contexts[upload_num],status);};var on_finish=function(){on_finish_callback.call(instance_context);if(hidden_form!=null)hidden_form.remove();};function create(){if(typeof options=="object"&&options!==null){if(typeof options.forceIframe=="boolean"){forceIframe=options.forceIframe;}if(typeof options.init=="function"){on_init_callback=options.init;}if(typeof options.start=="function"){on_start_callback=options.start;}if(typeof options.progress=="function"){on_progress_callback=options.progress;}if(typeof options.success=="function"){on_success_callback=options.success;}if(typeof options.error=="function"){on_error_callback=options.error;}if(typeof options.cancel=="function"){on_cancel_callback=options.cancel;}if(typeof options.complete=="function"){on_complete_callback=options.complete;}if(typeof options.finish=="function"){on_finish_callback=options.finish;}if(typeof options.hashWorker=="string"&&options.hashWorker!=""){hash_worker=options.hashWorker;}if(typeof options.hashComplete=="function"){on_hash_complete=options.hashComplete;}if(typeof options.data=="object"&&options.data!==null){for(var x in options.data){request_data[x]=options.data[x];}}if(typeof options.limit=="number"&&isInt(options.limit)&&options.limit>0){limit=options.limit;}if(typeof options.maxFileSize=="number"&&isInt(options.maxFileSize)&&options.maxFileSize>0){max_file_size=options.maxFileSize;}if(typeof options.allowedExts=="object"&&options.allowedExts!==null){for(var x in options.allowedExts){allowed_exts.push(options.allowedExts[x]);}}if(typeof options.allowedTypes=="object"&&options.allowedTypes!==null){for(var x in options.allowedTypes){allowed_types.push(options.allowedTypes[x]);}}if(typeof options.expect=="string"&&options.expect!=""){var lower_expect=options.expect.toLowerCase();var valid_expect_types=["auto","json","xml","html","script","text"];for(var x in valid_expect_types){if(valid_expect_types[x]==lower_expect){expect_type=lower_expect;break;}}}if(typeof options.xhrFields=="object"&&options.xhrFields!==null){for(var x in options.xhrFields){xhrFields[x]=options.xhrFields[x];}}}if(typeof DOM_file=="object"&&DOM_file!==null&&DOM_file instanceof jQuery){if(DOM_file.length>0){DOM_file=DOM_file.get(0);}else{return false;}}if(!forceIframe&&window.File&&window.FileReader&&window.FileList&&window.Blob){if(typeof options=="object"&&options!==null&&typeof options.files=="object"&&options.files!==null){files=options.files;}else if(typeof DOM_file=="object"&&DOM_file!==null&&typeof DOM_file.files=="object"&&DOM_file.files!==null){files=DOM_file.files;}}if((typeof DOM_file!="object"||DOM_file===null)&&files==null){return false;}if(typeof options=="object"&&options!==null&&typeof options.name=="string"&&options.name!=""){request_file_name=options.name.replace(/\[\s*\]/g,'[0]');}else if(typeof DOM_file=="object"&&DOM_file!==null&&typeof DOM_file.name=="string"&&DOM_file.name!=""){request_file_name=DOM_file.name.replace(/\[\s*\]/g,'[0]');}var num_files=0;if(files!=null){if(files.length>0){if(files.length>1&&window.FormData&&$.ajaxSettings.xhr().upload){if(limit>0&&files.length>limit){num_files=limit;}else{num_files=files.length;}}else{num_files=1;}}}else{if(DOM_file.value!=""){num_files=1;}}if(num_files>0){if(typeof DOM_file=="object"&&DOM_file!==null){var $DOM_file=$(DOM_file);hidden_form=$('<form>').hide().attr("enctype","multipart/form-data").attr("method","post").appendTo('body');$DOM_file.after($DOM_file.clone(true).val("")).removeAttr("onchange").off().removeAttr("id").attr("name",request_file_name).appendTo(hidden_form);}for(var i=0;i<num_files;i++){(function(i){private_upload_data[i]={state:0,hashWorker:null,xhr:null,iframe:null};upload_contexts[i]={upload:{index:i,state:"init",file:(files!=null)?files[i]:{name:DOM_file.value.split(/(\\|\/)/g).pop()},cancel:function(){if(getUploadState(i)==0){setUploadState(i,4);}else if(getUploadState(i)==1){setUploadState(i,4);if(private_upload_data[i].hashWorker!=null){private_upload_data[i].hashWorker.terminate();private_upload_data[i].hashWorker=null;}if(private_upload_data[i].xhr!=null){private_upload_data[i].xhr.abort();private_upload_data[i].xhr=null;}if(private_upload_data[i].iframe!=null){$('iframe[name=simpleUpload_iframe_'+private_upload_data[i].iframe+']').attr("src","javascript:false;");simpleUpload.dequeueIframe(private_upload_data[i].iframe);private_upload_data[i].iframe=null;}on_cancel(i);}else{return false;}return true;}}};})(i);}var init_value=on_init(num_files);if(init_value!==false){var num_files_limit=num_files;if(typeof init_value=="number"&&isInt(init_value)&&init_value>=0&&init_value<num_files){num_files_limit=init_value;for(var z=num_files_limit;z<num_files;z++){setUploadState(z,4);}}var remaining_uploads=[];for(var j=0;j<num_files_limit;j++){if(on_start(j,upload_contexts[j].upload.file)!==false)remaining_uploads[remaining_uploads.length]=j;}if(remaining_uploads.length>0){queued_files=remaining_uploads.length;simpleUpload.queueUpload(remaining_uploads,function(upload_num){validateFile(upload_num);});simpleUpload.uploadNext();}else{on_finish();}}else{for(var z in upload_contexts){setUploadState(z,4);}on_finish();}}}function validateFile(upload_num){if(getUploadState(upload_num)!=1)return;var file=null;if(files!=null){if(files[upload_num]!=undefined&&files[upload_num]!=null){file=files[upload_num];}else{on_error(upload_num,{name:"InternalError",message:"There was an error uploading the file"});return;}}else{if(DOM_file.value==""){on_error(upload_num,{name:"InternalError",message:"There was an error uploading the file"});return;}}if(allowed_exts.length>0&&!validateFileExtension(allowed_exts,file)){on_error(upload_num,{name:"InvalidFileExtensionError",message:"That file format is not allowed"});return;}if(allowed_types.length>0&&!validateFileMimeType(allowed_types,file)){on_error(upload_num,{name:"InvalidFileTypeError",message:"That file format is not allowed"});return;}if(max_file_size>0&&!validateFileSize(max_file_size,file)){on_error(upload_num,{name:"MaxFileSizeError",message:"That file is too big"});return;}if(hash_worker!=null&&on_hash_complete!=null){hashFile(upload_num);}else{uploadFile(upload_num);}}function hashFile(upload_num){if(files!=null){if(files[upload_num]!=undefined&&files[upload_num]!=null){if(window.Worker){var file=files[upload_num];if(file.size!=undefined&&file.size!=null&&file.size!=""&&isInt(file.size)&&(file.slice||file.webkitSlice||file.mozSlice)){try{var worker=new Worker(hash_worker);worker.addEventListener('error',function(event){worker.terminate();private_upload_data[upload_num].hashWorker=null;uploadFile(upload_num);},false);worker.addEventListener('message',function(event){if(event.data.result){var hash=event.data.result;worker.terminate();private_upload_data[upload_num].hashWorker=null;checkHash(upload_num,hash);}},false);var buffer_size,block,reader,blob,handle_hash_block,handle_load_block;handle_load_block=function(event){worker.postMessage({'message':event.target.result,'block':block});};handle_hash_block=function(event){if(block.end!==file.size){block.start+=buffer_size;block.end+=buffer_size;if(block.end>file.size){block.end=file.size;}reader=new FileReader();reader.onload=handle_load_block;if(file.slice){blob=file.slice(block.start,block.end);}else if(file.webkitSlice){blob=file.webkitSlice(block.start,block.end);}else if(file.mozSlice){blob=file.mozSlice(block.start,block.end);}reader.readAsArrayBuffer(blob);}};buffer_size=64*16*1024;block={'file_size':file.size,'start':0};block.end=buffer_size>file.size?file.size:buffer_size;worker.addEventListener('message',handle_hash_block,false);reader=new FileReader();reader.onload=handle_load_block;if(file.slice){blob=file.slice(block.start,block.end);}else if(file.webkitSlice){blob=file.webkitSlice(block.start,block.end);}else if(file.mozSlice){blob=file.mozSlice(block.start,block.end);}reader.readAsArrayBuffer(blob);private_upload_data[upload_num].hashWorker=worker;return;}catch(e){}}}}}uploadFile(upload_num);}function checkHash(upload_num,hash){if(getUploadState(upload_num)!=1)return;var callback_received=false;var success_callback=function(data){if(getUploadState(upload_num)!=1)return false;if(callback_received)return false;callback_received=true;on_progress(upload_num,100);on_success(upload_num,data);return true;};var proceed_callback=function(){if(getUploadState(upload_num)!=1)return false;if(callback_received)return false;callback_received=true;uploadFile(upload_num);return true;};var error_callback=function(error){if(getUploadState(upload_num)!=1)return false;if(callback_received)return false;callback_received=true;on_error(upload_num,{name:"HashError",message:error});return true;};on_hash_complete.call(upload_contexts[upload_num],hash,{success:success_callback,proceed:proceed_callback,error:error_callback});}
    
    function uploadFile(upload_num){
        if(getUploadState(upload_num)!=1)return;
        if(files!=null){
            if(files[upload_num]!=undefined&&files[upload_num]!=null){
                if(window.FormData){
                    var ajax_xhr=$.ajaxSettings.xhr();
                    if(ajax_xhr.upload){
                        var file=files[upload_num];
                        var formData=new FormData();
                        objectToFormData(formData,request_data);
                        formData.append(request_file_name,file);
                        var ajax_settings={
                            url:ajax_url,
                            data:formData,
                            type:'post',
                            cache:false,
                            xhrFields:xhrFields,
                            beforeSend:function(jqXHR){
                                private_upload_data[upload_num].xhr=jqXHR;
                            },
                            xhr:function(){
                                ajax_xhr.upload.addEventListener('progress',function(e){if(e.lengthComputable){on_progress(upload_num,(e.loaded/e.total)*100);}},false);return ajax_xhr;
                            },
                            error:function(e1,e2,e3){
                                console.log(e1);
                                console.log(e2);
                                console.log(e3);
                                private_upload_data[upload_num].xhr=null;
                                on_error(upload_num,{
                                    name:"RequestError",
                                    message:"Could not get response from server"
                                });
                            },
                            success:function(data){
                                private_upload_data[upload_num].xhr=null;on_progress(upload_num,100);on_success(upload_num,data);
                            },
                            contentType:false,
                            processData:false
                        };
                        if(expect_type!="auto"){
                            ajax_settings.dataType=expect_type;
                        }
                        $.ajax(ajax_settings);
                        return;
                    }
                }
            }else{
                on_error(upload_num,{
                    name:"InternalError",message:"There was an error uploading the file"
                });
                return;
            }
        }
        if(typeof DOM_file=="object"&&DOM_file!==null){
            uploadFileFallback(upload_num);
        }else{
            on_error(upload_num,{
                name:"UnsupportedError",
                message:"Your browser does not support this upload method"
            });
        }
    }
    
    function uploadFileFallback(upload_num){if(upload_num==0){var iframe_id=simpleUpload.queueIframe({origin:getOrigin(ajax_url),expect:expect_type,complete:function(data){if(getUploadState(upload_num)!=1)return;private_upload_data[upload_num].iframe=null;simpleUpload.dequeueIframe(iframe_id);on_progress(upload_num,100);on_success(upload_num,data);},error:function(error){if(getUploadState(upload_num)!=1)return;private_upload_data[upload_num].iframe=null;simpleUpload.dequeueIframe(iframe_id);on_error(upload_num,{name:"RequestError",message:error});}});private_upload_data[upload_num].iframe=iframe_id;var upload_data=objectToInput(request_data);hidden_form.attr("action",ajax_url+((ajax_url.lastIndexOf("?")==-1)?"?":"&")+"_iframeUpload="+iframe_id+"&_="+(new Date()).getTime()).attr("target","simpleUpload_iframe_"+iframe_id).prepend(upload_data).submit();}else{on_error(upload_num,{name:"UnsupportedError",message:"Multiple file uploads not supported"});}}
    
    function objectToInput(obj,parent_node){if(parent_node===undefined||parent_node===null||parent_node===""){parent_node=null;}var html="";for(var key in obj){if(obj[key]===undefined||obj[key]===null){html+=$('<div>').append($('<input type="hidden">').attr("name",(parent_node==null)?key+"":parent_node+"["+key+"]").val("")).html();}else if(typeof obj[key]=="object"){html+=objectToInput(obj[key],(parent_node==null)?key+"":parent_node+"["+key+"]");}else if(typeof obj[key]=="boolean"){html+=$('<div>').append($('<input type="hidden">').attr("name",(parent_node==null)?key+"":parent_node+"["+key+"]").val((obj[key])?"true":"false")).html();}else if(typeof obj[key]=="number"){html+=$('<div>').append($('<input type="hidden">').attr("name",(parent_node==null)?key+"":parent_node+"["+key+"]").val(obj[key]+"")).html();}else if(typeof obj[key]=="string"){html+=$('<div>').append($('<input type="hidden">').attr("name",(parent_node==null)?key+"":parent_node+"["+key+"]").val(obj[key])).html();}}return html;}
    function objectToFormData(formData,obj,parent_node){if(parent_node===undefined||parent_node===null||parent_node===""){parent_node=null;}for(var key in obj){if(obj[key]===undefined||obj[key]===null){formData.append((parent_node==null)?key+"":parent_node+"["+key+"]","");}else if(typeof obj[key]=="object"){objectToFormData(formData,obj[key],(parent_node==null)?key+"":parent_node+"["+key+"]");}else if(typeof obj[key]=="boolean"){formData.append((parent_node==null)?key+"":parent_node+"["+key+"]",(obj[key])?"true":"false");}else if(typeof obj[key]=="number"){formData.append((parent_node==null)?key+"":parent_node+"["+key+"]",obj[key]+"");}else if(typeof obj[key]=="string"){formData.append((parent_node==null)?key+"":parent_node+"["+key+"]",obj[key]);}}}
    function getUploadState(upload_num){return private_upload_data[upload_num].state;}
    function setUploadState(upload_num,state){var textState="";if(state==0)textState="init";else if(state==1)textState="uploading";else if(state==2)textState="success";else if(state==3)textState="error";else if(state==4)textState="cancel";else
    return false;private_upload_data[upload_num].state=state;
    upload_contexts[upload_num].upload.state=textState;}
    function getFileExtension(filename){var filename_dot_pos=filename.lastIndexOf('.');return(filename_dot_pos!=-1)?filename.substr(filename_dot_pos+1):"";}function validateFileExtension(valid_exts,file){if(file!=undefined&&file!=null){var file_name=file.name;if(file_name!=undefined&&file_name!=null&&file_name!=""){var file_ext=getFileExtension(file_name).toLowerCase();if(file_ext!=""){var valid_ext=false;for(var i in valid_exts){if(valid_exts[i].toLowerCase()==file_ext){valid_ext=true;break;}}if(valid_ext){return true;}else{return false;}}else{return false;}}}if(typeof DOM_file=="object"&&DOM_file!==null){var DOM_file_name=DOM_file.value;if(DOM_file_name!=""){var file_ext=getFileExtension(DOM_file_name).toLowerCase();if(file_ext!=""){var valid_ext=false;for(var i in valid_exts){if(valid_exts[i].toLowerCase()==file_ext){valid_ext=true;break;}}if(valid_ext){return true;}}}}else{return true;}return false;}function validateFileMimeType(valid_mime_types,file){if(file!=undefined&&file!=null){var file_mime_type=file.type;if(file_mime_type!=undefined&&file_mime_type!=null&&file_mime_type!=""){file_mime_type=file_mime_type.toLowerCase();var valid_mime_type=false;for(var i in valid_mime_types){if(valid_mime_types[i].toLowerCase()==file_mime_type){valid_mime_type=true;break;}}if(valid_mime_type){return true;}else{return false;}}}return true;}function validateFileSize(max_size,file){if(file!=undefined&&file!=null){var file_size=file.size;if(file_size!=undefined&&file_size!=null&&file_size!=""&&isInt(file_size)){if(file_size<=max_size){return true;}else{return false;}}}return true;}function isInt(num){if(!isNaN(num)){if((parseInt(num)+"")==num){return true;}}return false;}function getOrigin(url){var a=document.createElement('a');a.href=url;var host=a.host;var protocol=a.protocol;if(host=="")host=window.location.host;if(protocol==""||protocol==":")protocol=window.location.protocol;return protocol.replace(/\:$/,'')+"://"+host;}
create();
}

simpleUpload.maxUploads=10;
simpleUpload.activeUploads=0;
simpleUpload.uploads=[];
simpleUpload.iframes={};
simpleUpload.iframeCount=0;

simpleUpload.queueUpload=function(remaining_uploads,upload_callback){simpleUpload.uploads[simpleUpload.uploads.length]={uploads:remaining_uploads,callback:upload_callback};};
simpleUpload.uploadNext=function(){if(simpleUpload.uploads.length>0&&simpleUpload.activeUploads<simpleUpload.maxUploads){var upload_instance=simpleUpload.uploads[0];var upload_callback=upload_instance.callback;var upload_num=upload_instance.uploads.splice(0,1)[0];if(upload_instance.uploads.length==0){simpleUpload.uploads.splice(0,1);}simpleUpload.activeUploads++;upload_callback(upload_num);simpleUpload.uploadNext();}};
simpleUpload.queueIframe=function(opts){var id=0;while(id==0||id in simpleUpload.iframes){id=Math.floor((Math.random()*999999999)+1);}simpleUpload.iframes[id]=opts;simpleUpload.iframeCount++;$('body').append('<iframe name="simpleUpload_iframe_'+id+'" style="display: none;"></iframe>');return id;};
simpleUpload.dequeueIframe=function(id){if(id in simpleUpload.iframes){$('iframe[name=simpleUpload_iframe_'+id+']').remove();delete simpleUpload.iframes[id];simpleUpload.iframeCount--;}};
simpleUpload.convertDataType=function(expected_type,declared_type,data){var type="auto";if(expected_type=="auto"){if(typeof declared_type=="string"&&declared_type!=""){var lower_type=declared_type.toLowerCase();var valid_types=["json","xml","html","script","text"];for(var x in valid_types){if(valid_types[x]==lower_type){type=lower_type;break;}}}}else{type=expected_type;}if(type=="auto"){if(typeof data=="undefined"){return"";}if(typeof data=="object"){return data;}return String(data);}else if(type=="json"){if(typeof data=="undefined"||data===null){return null;}if(typeof data=="object"){return data;}if(typeof data=="string"){try{return $.parseJSON(data);}catch(e){return false;}}return false;}else if(type=="xml"){if(typeof data=="undefined"||data===null){return null;}if(typeof data=="string"){try{return $.parseXML(data);}catch(e){return false;}}return false;}else if(type=="script"){if(typeof data=="undefined"){return"";}if(typeof data=="string"){try{$.globalEval(data);return data;}catch(e){return false;}}return false;}else{if(typeof data=="undefined"){return"";}return String(data);}};
simpleUpload.iframeCallback=function(data){if(typeof data=="object"&&data!==null){var id=data.id;if(id in simpleUpload.iframes){var converted_data=simpleUpload.convertDataType(simpleUpload.iframes[id].expect,data.type,data.data);if(converted_data!==false){simpleUpload.iframes[id].complete(converted_data);}else{simpleUpload.iframes[id].error("Could not get response from server");}}}};
simpleUpload.postMessageCallback=function(e){try{var key=e.message?"message":"data";var data=e[key];if(typeof data=="string"&&data!=""){data=$.parseJSON(data);if(typeof data=="object"&&data!==null){if(typeof data.namespace=="string"&&data.namespace=="simpleUpload"){var id=data.id;if(id in simpleUpload.iframes){if(e.origin===simpleUpload.iframes[id].origin){var converted_data=simpleUpload.convertDataType(simpleUpload.iframes[id].expect,data.type,data.data);if(converted_data!==false){simpleUpload.iframes[id].complete(converted_data);}else{simpleUpload.iframes[id].error("Could not get response from server");}}}}}}}catch(e){}};
if(window.addEventListener){window.addEventListener("message",simpleUpload.postMessageCallback,false);}else{ window.attachEvent("onmessage",simpleUpload.postMessageCallback);}
(function($){
    $.fn.simpleUpload=function(url,opts){
        if($(this).length==0){if(typeof opts=="object"&&opts!==null&&typeof opts.files=="object"&&opts.files!==null){new simpleUpload(url,null,opts);return this;}}return this.each(function(){new simpleUpload(url,this,opts);});
    };
    $.fn.simpleUpload.maxSimultaneousUploads=function(num){
        if(typeof num==="undefined"){
            return simpleUpload.maxUploads;
        }else if(typeof num==="number"&&num>0){
            simpleUpload.maxUploads=num;return this;
        }}
        ;
})(jQuery);
/*
;(function(root, factory){
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports !== "undefined") {
        factory(require('jquery'));
    } else { factory(root.jQuery); }
}(this, function($){
    $.blaAlex = 1;
    console.log('simpleUpload');
    $.fn.simpleUpload=function(url,opts){if($(this).length==0){if(typeof opts=="object"&&opts!==null&&typeof opts.files=="object"&&opts.files!==null){new simpleUpload(url,null,opts);return this;}}return this.each(function(){new simpleUpload(url,this,opts);});};
    $.fn.simpleUpload.maxSimultaneousUploads=function(num){if(typeof num==="undefined"){return simpleUpload.maxUploads;}else if(typeof num==="number"&&num>0){simpleUpload.maxUploads=num;return this;}};
}));

console.log($.blaAlex);
*/