(function ($, elementor) {

    'use strict';

    var widgetEscape = function ($scope, $) {

        var $escape = $scope.find('.bdt-escape-slider');
        if (!$escape.length) {
            return;
        }
        var $escapeContainer = $escape.find('.swiper-container.bdt-main-slider'),
            $settings = $escape.data('settings');

        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        async function initSwiper() {
            var swiper = await new Swiper($escapeContainer, $settings);
            if ($settings.pauseOnHover) {
                $($escapeContainer).hover(function () {
                    (this).swiper.autoplay.stop();
                }, function () {
                    (this).swiper.autoplay.start();
                });
            }

            var $thumbs = $scope.find('.bdt-thumbs-slider');

            var sliderThumbs = await new Swiper($thumbs, {
                loop: ($settings.loop) ? $settings.loop : false,
                speed: ($settings.speed) ? $settings.speed : 500,
                freemood: true,
                parallax: true,
                spaceBetween: 20,
                slidesPerView: 1.25,
                slideToClickedSlide: true,
                loopedSlides: 4,
                // direction: "vertical",
                // centeredSlides: true,
                // initialSlide: 0,
                // keyboardControl: true,
                // mousewheel: true,
                // lazyLoading: true,
                // preventClicks: false,
                // preventClicksPropagation: false,
                // lazyLoadingInPrevNext: true,

                // breakpoints: {
                //     // "768": {
                //     //     slidesPerView: 1.5,
                //     // },
                //     "1024": {
                //         slidesPerView: 2.5,
                //     },
                //   },

            });

            swiper.controller.control = sliderThumbs;
            sliderThumbs.controller.control = swiper;
        }

    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-escape.default', widgetEscape);
    });

}(jQuery, window.elementorFrontend));