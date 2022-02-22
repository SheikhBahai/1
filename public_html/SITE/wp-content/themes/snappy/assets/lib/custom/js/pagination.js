jQuery(document).ready(function ($) {

    var ajaxurl = snappy_pagination.ajax_url;

    function snappy_is_on_screen(elem) {

        if ($(elem)[0]) {

            var tmtwindow = jQuery(window);
            var viewport_top = tmtwindow.scrollTop();
            var viewport_height = tmtwindow.height();
            var viewport_bottom = viewport_top + viewport_height;
            var tmtelem = jQuery(elem);
            var top = tmtelem.offset().top;
            var height = tmtelem.height();
            var bottom = top + height;
            return (top >= viewport_top && top < viewport_bottom) ||
                (bottom > viewport_top && bottom <= viewport_bottom) ||
                (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom);
        }
    }

    var n = window.TWP_JS || {};
    var paged = parseInt(snappy_pagination.paged) + 1;
    var maxpage = snappy_pagination.maxpage;
    var nextLink = snappy_pagination.nextLink;
    var loadmore = snappy_pagination.loadmore;
    var loading = snappy_pagination.loading;
    var nomore = snappy_pagination.nomore;
    var pagination_layout = snappy_pagination.pagination_layout;

    function snappy_load_content_ajax(){

        if ((!$('.theme-no-posts').hasClass('theme-no-posts'))) {

            $('.theme-loading-button .loading-text').text(loading);
            $('.theme-loading-status').addClass('theme-ajax-loading');
            $('.theme-loaded-content').load(nextLink + ' .post', function () {
                if (paged < 10) {
                    var newlink = nextLink.substring(0, nextLink.length - 2);
                } else {

                    var newlink = nextLink.substring(0, nextLink.length - 3);
                }
                paged++;
                nextLink = newlink + paged + '/';
                if (paged > maxpage) {
                    $('.theme-loading-button').addClass('theme-no-posts');
                    $('.theme-loading-button .loading-text').text(nomore);
                } else {
                    $('.theme-loading-button .loading-text').text(loadmore);
                }
                var lodedContent = $('.theme-loaded-content').html();
                $('.theme-loaded-content').html('');

                $('.content-area .article-wraper').append(lodedContent);

                $('.theme-loading-status').removeClass('theme-ajax-loading');

                $('.theme-article.post').each(function () {

                    if (!$(this).hasClass('theme-article-loaded')) {

                        $(this).addClass(paged + '-theme-article-ajax');
                        $(this).addClass('theme-article-loaded');
                    }

                });

                var isMobile = false;

                if( /Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                    $('html').addClass('touch');
                    isMobile = true;
                }
                else{
                    $('html').addClass('no-touch');
                    isMobile = false;
                }

                // Slide Left Right
                $('.twp-ani-control').waypoint(function() {

                    $(this.element).addClass('animated');

                }, {
                    offset: '80%'
                });

                //down up
                if (!isMobile) {
                    $('.animate-theme-reveal-up').waypoint(function (direction) {
                        if (direction === 'down') {
                            $(this.element).addClass('animated');
                        }
                        /*else {
                            $(this.element).removeClass('animated');
                        }*/
                    }, {
                        offset: '100%'
                    });
                }


                //os
                if (!isMobile) {
                    $('.theme-article-animate').waypoint(function(direction) {
                        if (direction ==='down') {
                            $(this.element).addClass('animated');
                        }
                        /*else {
                            $(this.element).removeClass('animated');
                        }*/
                    }, {
                        offset: '100%'
                    });
                }
        
                // Background
                var pageSection = $(".data-bg");
                pageSection.each(function (indx) {
                    if ($(this).attr("data-background")) {
                        $(this).css("background-image", "url(" + $(this).data("background") + ")");
                    }
                });

            });

        }
    }

    $('.theme-loading-button').click(function () {

        snappy_load_content_ajax();
        
    });

    if (pagination_layout == 'auto-load') {
        $(window).scroll(function () {

            if (!$('.theme-loading-status').hasClass('theme-ajax-loading') && !$('.theme-loading-button').hasClass('theme-no-posts') && maxpage > 1 && snappy_is_on_screen('.theme-loading-button')) {
                
                snappy_load_content_ajax();
                
            }

        });
    }

    $(window).scroll(function () {

        if (!$('.twp-single-infinity').hasClass('twp-single-loading') && $('.twp-single-infinity').attr('loop-count') <= 3 && snappy_is_on_screen('.twp-single-infinity')) {

            $('.twp-single-infinity').addClass('twp-single-loading');
            var loopcount = $('.twp-single-infinity').attr('loop-count');
            var postid = $('.twp-single-infinity').attr('next-post');

            var data = {
                'action': 'snappy_single_infinity',
                '_wpnonce': snappy_pagination.ajax_nonce,
                'postid': postid,
            };

            $.post(ajaxurl, data, function (response) {

                if (response) {
                    var content = response.data.content.join('');
                    var content = $(content);
                    $('.twp-single-infinity').before(content);
                    var newpostid = response.data.postid.join('');
                    var newpostid = $(newpostid);
                    $('.twp-single-infinity').attr('next-post', newpostid['selector']);

                    $('article#post-' + postid + ' ul.wp-block-gallery.columns-1, article#post-' + postid + ' .wp-block-gallery.columns-1 .blocks-gallery-grid, article#post-' + postid + ' .gallery-columns-1').each(function () {
                        $(this).slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            fade: true,
                            autoplay: true,
                            autoplaySpeed: 8000,
                            infinite: true,
                            nextArrow: '<button type="button" class="slide-btn slide-next-icon">'+snappy_custom.next_svg+'</button>',
                            prevArrow: '<button type="button" class="slide-btn slide-prev-icon">'+snappy_custom.prev_svg+'</button>',
                            dots: false
                        });
                    });

                    var i = 1;
                    $('article#post-' + postid + ' .entry-content .wp-block-gallery ').each(function () {

                        $(this).attr('gallery-data', 'gallery-num-' + i);
                        $(this).addClass('gallery-data-slick');
                        $(this).addClass('gallery-data-gallery-num-' + i);
                        i++;

                        var k = 0;
                        $(this).find('.blocks-gallery-item').each(function () {
                            $(this).attr('gallery-index', k);
                            k++;
                        });
                    });

                    var j = 1;
                    $('article#post-' + postid + ' .footer-galleries .wp-block-gallery ').each(function () {

                        $(this).append('<div class="gallery-popup">'+snappy_custom.plus+'</div>');
                        $(this).append('<div class="gallery-popup-close">'+snappy_custom.close+'</div>');

                        $(this).addClass('gallery-num-' + j);
                        j++;

                        $(this).addClass('snappy-slick-dactivated');
                    });

                    $('article#post-' + postid + ' .gallery-data-slick .blocks-gallery-item a').click(function (event) {

                        event.preventDefault();

                    });
                    $('article#post-' + postid + ' .gallery-data-slick .blocks-gallery-item').click(function () {

                        if (!$(this).closest('article#post-' + postid + ' .gallery-data-slick').hasClass('columns-1')) {

                            $('html').attr('style', 'margin: 0; height: 100%; overflow: hidden');

                            var galid = $(this).closest('.gallery-data-slick').attr('gallery-data');
                            $('article#post-' + postid + ' .' + galid).addClass('gallery-show fullscreen');

                            if ($('article#post-' + postid + ' .' + galid).hasClass('snappy-slick-dactivated')) {

                                $('article#post-' + postid + ' .' + galid + ' .blocks-gallery-grid').slick({
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    fade: true,
                                    autoplay: false,
                                    autoplaySpeed: 8000,
                                    infinite: true,
                                    nextArrow: '<button type="button" class="slide-btn slide-next-icon">'+snappy_custom.next_svg+'</button>',
                                    prevArrow: '<button type="button" class="slide-btn slide-prev-icon">'+snappy_custom.prev_svg+'</button>',
                                    dots: false,
                                });
                            }
                            var galindex = $(this).attr('gallery-index');
                            $('article#post-' + postid + ' .' + galid + ' .blocks-gallery-grid').slick('slickGoTo', galindex);
                            $('article#post-' + postid + ' .' + galid).removeClass('snappy-slick-dactivated');

                        }

                    });

                    $('article#post-' + postid + ' .wp-block-gallery.columns-1').append('<div class="gallery-popup">'+snappy_custom.plus+'</div>');
                    $('article#post-' + postid + ' .wp-block-gallery.columns-1').append('<div class="gallery-popup-close">'+snappy_custom.close+'</div>');
                    $('article#post-' + postid + ' .gallery-popup').click(function () {
                        $(this).closest('article#post-' + postid + ' .wp-block-gallery').addClass('fullscreen');
                        $('html').attr('style', 'margin: 0; height: 100%; overflow: hidden');
                        $('article#post-' + postid + ' .wp-block-gallery.columns-1 .blocks-gallery-grid').slick("slickSetOption", "speed", 500, !0);

                    });

                    $('article#post-' + postid + ' .gallery-popup-close').click(function () {

                        $(this).closest('article#post-' + postid + ' .wp-block-gallery').removeClass('fullscreen gallery-show');
                        $('html').attr('style', '');
                        $('article#post-' + postid + ' .wp-block-gallery.columns-1 .blocks-gallery-grid').slick("slickSetOption", "speed", 500, !0);

                    });

                    $('article').each(function () {

                        $('article').each(function () {

                             if ($('body').hasClass('booster-extension') && $(this).hasClass('after-load-ajax') ) {

                                    var cid = $(this).attr('id');
                                    $(this).addClass( cid );
                                       
                                    likedislike(cid);
                                    booster_extension_post_reaction(cid);

                            }

                            $(this).removeClass('after-load-ajax');

                        });

                        $(this).removeClass('after-load-ajax');
                    });

                }

                $('.twp-single-infinity').removeClass('twp-single-loading');
                loopcount++;
                $('.twp-single-infinity').attr('loop-count', loopcount);

            });

        }

    });

});