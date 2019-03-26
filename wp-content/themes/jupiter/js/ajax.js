jQuery(document).ready(function() {


    /** feature-image-# **/
    jQuery(".feature-image-1").on('click', function() {
        alert('test');
    });

    /** menu **/
    jQuery("#menu-menu").on('click', function() {
        jQuery('.menu-container').toggle('fast');
    });

    /** custom menu css **/
    jQuery("#menu-item-252").hover(function() {
        jQuery('.sub-menu').css({
            // 'display': 'block',
            'position': 'position',
            'background': '#f1f1f1',
            'padding': '0px',
            'margin-left': '-19px',
            'text-align': 'center',
            'padding-right': '13px',
            'border-radius': '3px',
            'border-bottom': '2px solid orange',
            'text-transform': 'uppercase',
            'padding-bottom': '10px',
            'width': '200px',

        }).toggle('fast');
    });



    /** variable declaration */
    var last_scroll = 0;

    /** init function */
    revealPost();

    /** ajax function */
    jQuery('.load_more_post_width_ajax:not(.loading)').on('click', function() {

        var that = jQuery(this);
        var page = that.data('page');
        var nextpage = page + 1;
        var ajaxurl = that.data('url');
        that.addClass('loading');
        // that.find('loading-icon').addClass('spin');
        jQuery.ajax({
            type: 'post',
            url: ajaxurl,
            data: {
                page: page,
                action: 'load_more_ajax_post',
            },

            error: function(response) {
                console.log(response);
            },

            beforeSend: function(response) {
                jQuery('.loading-icon').css({ "display": "block" });
            },

            success: function(response) {
                if (response == 0) {
                    jQuery('.post_container_with_ajax').append('<h3>NO more post to load</h3>');
                    jQuery('.loading-icon').css({ "display": "none" });
                    jQuery('.text').css({ "display": "none" });
                } else {
                    that.data('page', nextpage);
                    jQuery('.post_container_with_ajax').append(response);
                    jQuery('.loading-icon').css({ "display": "none" });
                    jQuery('article').find('.nopost').removeClass('text');;
                    that.removeClass('loading');
                    revealPost();

                }

            }

        });

    });


    /** scroll function */

    jQuery(window).scroll(function() {

        that = jQuery(this);
        page = that.data('page');
        nextpage = page + 1;
        ajaxurl = that.data('url');
        that.addClass('loading');

        var scroll = jQuery(window).scrollTop();
        var window_height = jQuery(window).height();
        var document_height = jQuery(document).height();
        var Doc_win = (document_height - window_height) * 0.8;

        // console.log('scroll ' + scroll + '= ' + Doc_win);

        if (scroll == Doc_win) {

            jQuery.ajax({
                type: 'post',
                url: ajaxurl,
                data: {
                    page: page,
                    action: 'load_more_ajax_post',
                },

                error: function(response) {
                    console.log(response);
                },

                beforeSend: function(response) {
                    jQuery('.loading-icon').css({ "display": "block" });
                },

                success: function(response) {
                    if (response == 0) {
                        jQuery('.post_container_with_ajax').append('<h3>NO more post to load</h3>');
                        jQuery('.loading-icon').css({ "display": "none" });
                        jQuery('.text').css({ "display": "none" });
                    } else {
                        that.data('page', nextpage);
                        jQuery('.post_container_with_ajax').append(response);
                        jQuery('.loading-icon').css({ "display": "none" });
                        jQuery('article').find('.nopost').removeClass('text');;
                        that.removeClass('loading');
                        revealPost();

                    }

                }

            });
        }

    }); // end of scroll function 

    //     var scroll = jQuery(window).scrollTop();
    //     if (scroll < 300) {
    //         jQuery('#mk-page-introduce').css({ 'opacity': '0' });
    //         jQuery('.mk-header-holder').css({ 'opacity': '0' });
    //         // console.log(scroll);
    //     } else {
    //         jQuery('#mk-page-introduce').css({ 'opacity': '1' });
    //         jQuery('.mk-header-holder').css({ 'opacity': '1' });
    //     }

    // });



    // jQuery(window).scroll(function() {
    //     var scroll = jQuery(window).scrollTop();
    //     if (Math.abs(scroll - last_scroll) > jQuery(window).height() * 0.1) {
    //         last_scroll = scroll;
    //         //    console.log(last_scroll);
    //         jQuery('.page-limit').each(function() {
    //             if (isVisible(jQuery(this))) {
    //                 //  console.log('visible');
    //                 // history.replaceState(null, null, jQuery(this).attr("data-page"));
    //                 return (false);
    //             }
    //         });

    //     }
    // });


    /** helper function */
    function revealPost() {
        var post = jQuery('article:not(.reveal)');
        var i = 0;

        setInterval(function() {
            if (i >= post.length) return false;
            var el = post[i];
            jQuery(el).addClass('reveal');
            i++;
        }, 200);
    }

    function isVisible(element) {
        var scroll_pos = jQuery(window).scrollTop();
        var window_height = jQuery(window).height();
        var el_top = jQuery(element).offset().top;
        var el_height = jQuery(element).height();
        var el_bottom = el_top + el_height;
        return ((el_bottom - el_height * 0.25 > scroll_pos) && (el_top < (scroll_pos + 0.5 * window_height)));
    }



    // When the user scrolls down 20px from the top of the document, slide down the navbar
    //window.onscroll = function() {scrollFunction()};

    // function scrollFunction() {
    //   if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    //     document.getElementById("navbar").style.top = "0";
    //   } else {
    //     document.getElementById("navbar").style.top = "-50px";
    //   }
    // }



});