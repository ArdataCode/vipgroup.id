(function ($, elementor) {

    'use strict';

    var widgetFortune = function ($scope, $) {

        var $fortune = $scope.find('.bdt-fortune-slider');
        if (!$fortune.length) {
            return;
        }
        var $fortuneContainer = $fortune.find('.swiper-container.bdt-main-slider'),
            $settings = $fortune.data('settings');

        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        async function initSwiper() {
            var swiper = await new Swiper($fortuneContainer, $settings);
            if ($settings.pauseOnHover) {
                $($fortuneContainer).hover(function () {
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
                spaceBetween: 0,
                slideToClickedSlide: true,
                loopedSlides: 4,
                centeredSlides: true,
                slidesPerView: 1,
                initialSlide: 0,
                keyboardControl: true,
                mousewheel: true,
                lazyLoading: true,
                preventClicks: false,
                preventClicksPropagation: false,
                lazyLoadingInPrevNext: true,

            });

            swiper.controller.control = sliderThumbs;
            sliderThumbs.controller.control = swiper;
        }

    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-fortune.default', widgetFortune);
    });

}(jQuery, window.elementorFrontend));