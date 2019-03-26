jQuery(document).ready(function ($) {
    function maxZIndex() {
        return Math.max.apply(null,
            $.map($('body *'), function (e, n) {
                if ($(e).css('position') !== 'static')
                    return parseInt($(e).css('z-index')) || 1;
            }));
    }

    function getShadowProperty(e, modifier, prop, def) {
        var v = window.getComputedStyle($(e)[0], modifier)
            .getPropertyValue(prop);
        return typeof v === "undefined" ? def : v;
    }

    var oldTopValue = parseInt(getShadowProperty("body", ":before", "top", 0));
    var oldBottomValue = parseInt(getShadowProperty("body", ":after", "bottom", 0));
    var topContainer = jQuery("#wpautoterms-top-fixed-container");
    var bottomContainer = jQuery("#wpautoterms-bottom-fixed-container");
    var z = maxZIndex();
    topContainer.css('z-index', z - (-1));
    bottomContainer.css('z-index', z - (-2));
    jQuery("#wpautoterms-top-static-container").css("margin-top",
        parseInt(getShadowProperty("body", ":before", "height", 0)) + "px");
    jQuery("#wpautoterms-bottom-static-container").css("margin-bottom",
        parseInt(getShadowProperty("body", ":after", "height", 0)) + "px");

    function recalcContainers() {
        $("#wpautoterms-top-fixed-style,#wpautoterms-bottom-fixed-style").remove();
        var h = $("head");
        var topContainer = jQuery("#wpautoterms-top-fixed-container");
        var bottomContainer = jQuery("#wpautoterms-bottom-fixed-container");
        if (topContainer.length) {
            h.append('<style id="wpautoterms-top-fixed-style">body:before{top:' +
                parseInt(topContainer.height()) + 'px !important;}</style>');
        }
        if (bottomContainer.length) {
            h.append('<style id="wpautoterms-bottom-fixed-style">body:after{bottom:' +
                (oldBottomValue + parseInt(bottomContainer.height())) + 'px !important;}</style>');
        }
    }

    function setCookie(name, value, expire) {
        var d = new Date();
        var names = String(name).split(',');
        var values = String(value).split(',');
        d.setTime(d.getTime() + (expire * 24 * 60 * 60 * 1000));
        for (var idx in names) {
            name = names[idx];
            value = values[idx];
            document.cookie = name + "=" + encodeURIComponent(value) + "; expires=" + d.toUTCString() + "; path=/";
        }
    }

    $(".wpautoterms-notice-close").click(function () {
        var t = jQuery(this);
        setCookie(t.attr("cookie"), t.attr("value"), 365);
        var p1 = jQuery(this).parent();
        var p2 = p1.parent();
        p1.remove();
        if (p2.html().length < 1) {
            p2.remove();
        }
        recalcContainers();
    });

    recalcContainers();
});
