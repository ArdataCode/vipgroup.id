(function ($, elementor) {

    'use strict';

    var widgetwoohotspot = function ($scope, $) {

        var $woohotspot = $scope.find('.bdt-prime-slider-woohotspot');
        if (!$woohotspot.length) {
            return;
        }

        var $woohotspotContainer = $woohotspot.find('.swiper'),
            $settings = $woohotspot.data('settings');


        const Swiper = elementorFrontend.utils.swiper;
        initSwiper();
        async function initSwiper() {
            var swiper = await new Swiper($woohotspotContainer, $settings);

            if ($settings.pauseOnHover) {
                $($woohotspotContainer).hover(function () {
                    (this).swiper.autoplay.stop();
                }, function () {
                    (this).swiper.autoplay.start();
                });
            }
        }

    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/prime-slider-woohotspot.default', widgetwoohotspot);
    });

}(jQuery, window.elementorFrontend));