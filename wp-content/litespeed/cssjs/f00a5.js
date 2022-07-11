!function(a,b){"function"==typeof define&&define.amd?define(["jquery"],function(c){return b(a,c)}):"object"==typeof module&&"object"==typeof module.exports?module.exports=b(a,require("jquery")):a.lity=b(a,a.jQuery||a.Zepto)}("undefined"!=typeof window?window:this,function(a,b){"use strict";function c(a){var b=z();return K&&a.length?(a.one(K,b.resolve),setTimeout(b.resolve,500)):b.resolve(),b.promise()}function d(a,c,d){if(1===arguments.length)return b.extend({},a);if("string"==typeof c){if("undefined"==typeof d)return"undefined"==typeof a[c]?null:a[c];a[c]=d}else b.extend(a,c);return this}function e(a){for(var b,c=decodeURI(a).split("&"),d={},e=0,f=c.length;e<f;e++)c[e]&&(b=c[e].split("="),d[b[0]]=b[1]);return d}function f(a,c){return a+(a.indexOf("?")>-1?"&":"?")+b.param(c)}function g(a){return b('<span class="lity-error"/>').append(a)}function h(a,c){var d=c.opener()&&c.opener().data("lity-desc")||"Image with no description",e=b('<img src="'+a+'" alt="'+d+'"/>'),f=z(),h=function(){f.reject(g("Failed loading image"))};return e.on("load",function(){return 0===this.naturalWidth?h():void f.resolve(e)}).on("error",h),f.promise()}function i(a,c){var d,e,f;try{d=b(a)}catch(a){return!1}return!!d.length&&(e=b('<i style="display:none !important"/>'),f=d.hasClass("lity-hide"),c.element().one("lity:remove",function(){e.before(d).remove(),f&&!d.closest(".lity-content").length&&d.addClass("lity-hide")}),d.removeClass("lity-hide").after(e))}function j(a){var c=H.exec(a);return!!c&&m(f("https://www.youtube"+(c[2]||"")+".com/embed/"+c[4],b.extend({autoplay:1},e(c[5]||""))))}function k(a){var c=I.exec(a);return!!c&&m(f("https://player.vimeo.com/video/"+c[3],b.extend({autoplay:1},e(c[4]||""))))}function l(a){var b=J.exec(a);return!!b&&m(f("https://www.google."+b[3]+"/maps?"+b[6],{output:b[6].indexOf("layer=c")>0?"svembed":"embed"}))}function m(a){return'<div class="lity-iframe-container"><iframe frameborder="0" allowfullscreen src="'+a+'"/></div>'}function n(){return x.documentElement.clientHeight?x.documentElement.clientHeight:Math.round(y.height())}function o(a){var b=t();b&&(27===a.keyCode&&b.close(),9===a.keyCode&&p(a,b))}function p(a,b){var c=b.element().find(E),d=c.index(x.activeElement);a.shiftKey&&d<=0?(c.get(c.length-1).focus(),a.preventDefault()):a.shiftKey||d!==c.length-1||(c.get(0).focus(),a.preventDefault())}function q(){b.each(B,function(a,b){b.resize()})}function r(a){1===B.unshift(a)&&(A.addClass("lity-active"),y.on({resize:q,keydown:o})),b("body > *").not(a.element()).addClass("lity-hidden").each(function(){var a=b(this);void 0===a.data(D)&&a.data(D,a.attr(C)||null)}).attr(C,"true")}function s(a){var c;a.element().attr(C,"true"),1===B.length&&(A.removeClass("lity-active"),y.off({resize:q,keydown:o})),B=b.grep(B,function(b){return a!==b}),c=B.length?B[0].element():b(".lity-hidden"),c.removeClass("lity-hidden").each(function(){var a=b(this),c=a.data(D);c?a.attr(C,c):a.removeAttr(C),a.removeData(D)})}function t(){return 0===B.length?null:B[0]}function u(a,c,d,e){var f,g="inline",h=b.extend({},d);return e&&h[e]?(f=h[e](a,c),g=e):(b.each(["inline","iframe"],function(a,b){delete h[b],h[b]=d[b]}),b.each(h,function(b,d){return!d||(!(!d.test||d.test(a,c))||(f=d(a,c),!1!==f?(g=b,!1):void 0))})),{handler:g,content:f||""}}function v(a,e,f,g){function h(a){k=b(a).css("max-height",n()+"px"),j.find(".lity-loader").each(function(){var a=b(this);c(a).always(function(){a.remove()})}),j.removeClass("lity-loading").find(".lity-content").empty().append(k),m=!0,k.trigger("lity:ready",[l])}var i,j,k,l=this,m=!1,o=!1;e=b.extend({},F,e),j=b(e.template),l.element=function(){return j},l.opener=function(){return f},l.options=b.proxy(d,l,e),l.handlers=b.proxy(d,l,e.handlers),l.resize=function(){m&&!o&&k.css("max-height",n()+"px").trigger("lity:resize",[l])},l.close=function(){if(m&&!o){o=!0,s(l);var a=z();return g&&b.contains(j,x.activeElement)&&g.focus(),k.trigger("lity:close",[l]),j.removeClass("lity-opened").addClass("lity-closed"),c(k.add(j)).always(function(){k.trigger("lity:remove",[l]),j.remove(),j=void 0,a.resolve()}),a.promise()}},i=u(a,l,e.handlers,e.handler),j.attr(C,"false").addClass("lity-loading lity-opened lity-"+i.handler).appendTo("body").focus().on("click","[data-lity-close]",function(a){b(a.target).is("[data-lity-close]")&&l.close()}).trigger("lity:open",[l]),r(l),b.when(i.content).always(h)}function w(a,c,d){a.preventDefault?(a.preventDefault(),d=b(this),a=d.data("lity-target")||d.attr("href")||d.attr("src")):d=b(d);var e=new v(a,b.extend({},d.data("lity-options")||d.data("lity"),c),d,x.activeElement);if(!a.preventDefault)return e}var x=a.document,y=b(a),z=b.Deferred,A=b("html"),B=[],C="aria-hidden",D="lity-"+C,E='a[href],area[href],input:not([disabled]),select:not([disabled]),textarea:not([disabled]),button:not([disabled]),iframe,object,embed,[contenteditable],[tabindex]:not([tabindex^="-"])',F={handler:null,handlers:{image:h,inline:i,youtube:j,vimeo:k,googlemaps:l,iframe:m},template:'<div class="lity" role="dialog" aria-label="Dialog Window (Press escape to close)" tabindex="-1"><div class="lity-wrap" data-lity-close role="document"><div class="lity-loader" aria-hidden="true">Loading...</div><div class="lity-container"><div class="lity-content"></div><button class="lity-close" type="button" aria-label="Close (Press escape to close)" data-lity-close>&times;</button></div></div></div>'},G=/(^data:image\/)|(\.(png|jpe?g|gif|svg|webp|bmp|ico|tiff?)(\?\S*)?$)/i,H=/(youtube(-nocookie)?\.com|youtu\.be)\/(watch\?v=|v\/|u\/|embed\/?)?([\w-]{11})(.*)?/i,I=/(vimeo(pro)?.com)\/(?:[^\d]+)?(\d+)\??(.*)?$/,J=/((maps|www)\.)?google\.([^\/\?]+)\/?((maps\/?)?\?)(.*)/i,K=function(){var a=x.createElement("div"),b={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var c in b)if(void 0!==a.style[c])return b[c];return!1}();return h.test=function(a){return G.test(a)},w.version="2.0.0",w.options=b.proxy(d,w,F),w.handlers=b.proxy(d,w,F.handlers),w.current=t,b(x).on("click.lity","[data-lity]",w),w});
;