
window.addEventListener("load", function(){
        
    jQuery(document).ready(function($){
        "use strict";

        $("body").addClass("page-loaded");

        var myCursor = jQuery('.theme-custom-cursor');
        if (myCursor.length) {
            if ($('body')) {
                const e = document.querySelector('.theme-cursor-secondary'),
                    t = document.querySelector('.theme-cursor-primary');
                let n, i = 0,
                    o = !1;
                window.onmousemove = function (s) {
                    o || (t.style.transform = "translate(" + s.clientX + "px, " + s.clientY + "px)"), e.style.transform = "translate(" + s.clientX + "px, " + s.clientY + "px)", n = s.clientY, i = s.clientX
                }, $('body').on("mouseenter", "a, button, .twp-carousel-prev, .twp-carousel-next, input[type=\"submit\"], .cursor-pointer", function () {
                    e.classList.add('cursor-hover'), t.classList.add('cursor-hover')
                }), $('body').on("mouseleave", "a, button, .twp-carousel-prev, .twp-carousel-next, input[type=\"submit\"], .cursor-pointer", function () {
                    $(this).is("a") && $(this).closest(".cursor-pointer").length || (e.classList.remove('cursor-hover'), t.classList.remove('cursor-hover'))
                }), e.style.visibility = "visible", t.style.visibility = "visible"
            }
        }

    });

});


// Set Cookie
function Snappy_SetCookie(cname, cvalue, exdays) {

    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";

}

// Get Cookie
function Snappy_GetCookie(cname) {

    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');

    for(var i = 0; i <ca.length; i++) {

        var c = ca[i];

        while (c.charAt(0) == ' ') {

            c = c.substring(1);

        }

        if (c.indexOf(name) == 0) {

            return c.substring(name.length, c.length);

        }

    }

    return "";
}

jQuery(document).ready(function ($) {
    "use strict";

    var isMobile = false;

    if( /Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $('html').addClass('touch');
        isMobile = true;
    }
    else{
        $('html').addClass('no-touch');
        isMobile = false;
    }

    // Day Night Mode Start

    $('.navbar-day-night').on("click", function() {

        if( $(this).hasClass('navbar-day-on') ){

            $('html').removeClass('day-mode');
            $('html').addClass('night-mode');
            $('.navbar-day-night').addClass('navbar-night-on');
            $('.navbar-day-night').removeClass('navbar-day-on');
            $('.jl_en_day_night').addClass('options_dark_skin');
            $('.mobile_nav_class').addClass('wp-night-mode-on');

            Snappy_SetCookie('SnappyNightDayMode', 'true',365);

        }else if( $(this).hasClass('navbar-night-on') ){

            $('html').removeClass('night-mode');
            $('html').addClass('day-mode');
            $('.navbar-day-night').addClass('navbar-day-on');
            $('.navbar-day-night').removeClass('navbar-night-on');
            $('.jl_en_day_night').removeClass('options_dark_skin');
            $('.mobile_nav_class').removeClass('wp-night-mode-on');

            Snappy_SetCookie('SnappyNightDayMode', 'false',365);

        }

    });
    // alert(Snappy_GetCookie('SnappyNightDayMode'));    
    // Add class and remove on element regarding mode
    if ( ( snappy_custom.snappy_color_schema == 'dark' && !Snappy_GetCookie('SnappyNightDayMode') ) || ( snappy_custom.snappy_color_schema == 'dark' && Snappy_GetCookie('SnappyNightDayMode') == 'true' ) || ( Snappy_GetCookie('SnappyNightDayMode') && Snappy_GetCookie('SnappyNightDayMode') != 'false' ) ) {

        $('html').removeClass('day-mode');
        $('html').addClass('night-mode');
        $('.navbar-day-night ').removeClass('navbar-day-on');
        $('.navbar-day-night ').addClass('navbar-night-on');


    }else{

        $('html').removeClass('night-mode');
        $('html').addClass('day-mode');
        $('.navbar-day-night ').removeClass('navbar-night-on');
        $('.navbar-day-night ').addClass('navbar-day-on');

    }

    // Day Night Mode End

    // Slide Left Right Start
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
        }, {
            offset: '100%'
        });
    }

    // Slide Left Right End

    // Banner Slider
    var swiper = new Swiper('.theme-main-slider', {
        slidesPerView: 1,
        loop: true,
        effect: 'fade',
        pagination: {
            el: '.swiper-pagination',
            type: 'fraction',
        },
        autoplay: {
            disableOnInteraction: false,
            delay: 6000
        },
        speed: 1000,
        simulateTouch: false,
        roundLengths: true,
        keyboard: true,
        mousewheel: false,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }
    });

    // Carousel Slider
    var swiper = new Swiper('.twp-carousel-slider', {
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        loop: true,
        spaceBetween: 50,

        navigation: {
            nextEl: '.twp-carousel-next',
            prevEl: '.twp-carousel-prev',
        },

        breakpoints: {
            480: {
              slidesPerView: 1,
            },
            640: {
              slidesPerView: 2,
            },
            768: {
              slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
            1200: {
                slidesPerView: 'auto',
            },
        }

    });

    // Hide Comments
    $('.snappy-no-comment .booster-block.booster-ratings-block, .snappy-no-comment .comment-form-ratings, .snappy-no-comment .twp-star-rating').hide();

    // Scroll To
    $(".scroll-content").click(function () {
        $('html, body').animate({
            scrollTop: $("#site-content").offset().top
        }, 500);
    });

    // Rating disable
    if (snappy_custom.single_post == 1 && snappy_custom.snappy_ed_post_reaction) {

        $('.tpk-single-rating').remove();
        $('.tpk-comment-rating-label').remove();
        $('.comments-rating').remove();
        $('.tpk-star-rating').remove();

    }

    // Add Class on article
    $('.theme-article-post.post').each(function () {
        $(this).addClass('twp-article-loded');
    });

    // Aub Menu Toggle
    $('.submenu-toggle').click(function () {
        $(this).toggleClass('button-toggle-active');
        var currentClass = $(this).attr('data-toggle-target');
        $(currentClass).toggleClass('submenu-toggle-active');
    });

    // Toggle Search
    $('.navbar-control-search').click(function () {

        $('.header-searchbar').toggleClass('header-searchbar-active');
        $('#search-closer').focus();

    });

    $('.header-searchbar').click(function () {

        $('.header-searchbar').removeClass('header-searchbar-active');

    });

    $(".header-searchbar-inner").click(function (e) {

        e.stopPropagation(); //stops click event from reaching document

    });

    // Header Search hide
    $('#search-closer').click(function () {
        $('.header-searchbar').removeClass('header-searchbar-active');
        setTimeout(function () {
            $('.navbar-control-search').focus();
        }, 300);
    });

    // Focus on search input on search icon expand
    $('.navbar-control-search').click(function(){

        setTimeout(function () {
            $('.header-searchbar .search-field').focus();
        }, 300);

    });

    $( 'input, a, button' ).on( 'focus', function() {

        if ( $( '.header-searchbar' ).hasClass( 'header-searchbar-active' ) ) {

            if (  ! $( this ).parents( '.header-searchbar' ).length ) {
                $('.header-searchbar .search-field').focus();
                $('.header-searchbar-area .search-field-default').focus();
            }
        }

    } );

    $('.skip-link-search-start').focus(function(){

        $('#search-closer').focus();

    });

    $('.skip-link-search-end').focus(function(){

        $('.header-searchbar .search-field').focus();

    });

    $('.skip-link-menu-start').focus(function(){

        if( !$("#offcanvas-menu #primary-nav-offcanvas").length == 0 ){
            $("#offcanvas-menu #primary-nav-offcanvas ul li:last-child a").focus();
        }

        if( !$("#offcanvas-menu #social-nav-offcanvas").length == 0 ){
            $("#offcanvas-menu #social-nav-offcanvas ul li:last-child a").focus();
        }

    });

    // Close Action on ESC button
    $(document).keyup(function(j) {
        if (j.key === "Escape") { // escape key maps to keycode `27`

            if ( $( '.header-searchbar' ).hasClass( 'header-searchbar-active' ) ) {
                $('.header-searchbar').removeClass('header-searchbar-active');

                setTimeout(function () {
                    $('.navbar-control-search').focus();
                }, 300);

                setTimeout(function () {
                    $('.aside-search-js').focus();
                }, 300);

            }

            if( $('#offcanvas-menu').hasClass('offcanvas-menu-active') ){

                $('.header-searchbar').removeClass('header-searchbar-active');
                $('#offcanvas-menu').removeClass('offcanvas-menu-active');
                $('.navbar-control-offcanvas').removeClass('active');
                 $('body').removeClass('body-scroll-locked');
                $('html').removeAttr('style');

                setTimeout(function () {
                    $('.navbar-control-offcanvas').focus();
                }, 300);

            }
        }
    });

    // Widget Tab
    $('.twp-nav-tabs .tab').on('click', function (event) {

        var tabid = $(this).attr('id');
        $(this).closest('.tabbed-container').find('.tab').removeClass('active');
        $(this).addClass('active');
        $(this).closest('.tabbed-container').find('.tab-pane').removeClass('active');
        $('#content-' + tabid).addClass('active');

    });

    // Toggle Menu
    $('.navbar-control-offcanvas').click(function () {
        $(this).addClass('active');
        $('body').addClass('body-scroll-locked');
        $('#offcanvas-menu').toggleClass('offcanvas-menu-active');
        $('.button-offcanvas-close').focus();
    });

    $('.offcanvas-close .button-offcanvas-close').click(function () {

        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');

        setTimeout(function () {
            $('.navbar-control-offcanvas').focus();
        }, 300);

    });

    $('#offcanvas-menu').click(function () {

        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');

    });

    $(".offcanvas-wraper").click(function (e) {

        e.stopPropagation(); //stops click event from reaching document

    });

    $('.skip-link-menu-end').on('focus', function () {

        $('.button-offcanvas-close').focus();

    });

    // Data Background
    var pageSection = $(".data-bg");
    pageSection.each(function (indx) {
        if ($(this).attr("data-background")) {
            $(this).css("background-image", "url(" + $(this).data("background") + ")");
        }
    });

    // Scroll to Top on Click
    $('.to-the-top').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 700);
        return false;
    });

});