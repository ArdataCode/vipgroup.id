(function ($, elementor) {

    'use strict';

    var widgetCoddle = function ($scope, $) {

        var $coddle = $scope.find('.bdt-coddle-slider');
        if (!$coddle.length) {
            return;
        }
        var $coddleContainer = $coddle.find('.swiper-container.bdt-main-slider'),
            $settings = $coddle.data('settings');

        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        async function initSwiper() {
            var swiper = await new Swiper($coddleContainer, $settings);
            if ($settings.pauseOnHover) {
                $($coddleContainer).hover(function () {
                    (this).swiper.autoplay.stop();
                }, function () {
                    (this).swiper.autoplay.start();
                });
            }

            var $thumbs = $scope.find('.bdt-thumbs-slider');

            var sliderThumbs = await new Swiper($thumbs, {
                loop: ($settings.loop) ? $settings.loop : false,
                speed: ($settings.speed) ? $settings.speed : 500,
                effect: 'fade',
                freemood: true,
                parallax: true,
                spaceBetween: 0,
                slideToClickedSlide: true,
                loopedSlides: 4,
                centeredSlides: true,
                slidesPerView: 1,
                initialSlide: 0,
                keyboardControl: true,
                 // mousewheel: true,
                lazyLoading: true,
                preventClicks: false,
                preventClicksPropagation: false,
                lazyLoadingInPrevNext: true,

            });

            swiper.controller.control = sliderThumbs;
            sliderThumbs.controller.control = swiper;
            // sliderThumbs.controller.control = swiper;
        }

    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-coddle.default', widgetCoddle);
    });

}(jQuery, window.elementorFrontend));