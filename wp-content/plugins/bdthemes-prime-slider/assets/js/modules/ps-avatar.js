(function ($, elementor) {
  "use strict";

  var widgetAvatar = function ($scope, $) {
    var $avatar = $scope.find(".bdt-prime-slider-avatar"),
      $settings = $avatar.data('settings');

    if (!$avatar.length) {
      return;
    }

    const heroEl = $($avatar)[0];
    const fullSizeWrapEl = heroEl.querySelector(".bdt-fullsize");
    const contentEls = heroEl.querySelectorAll(".swiper .content");
    const contentFullsizeEls = Array.from(contentEls, (el) => {
      const clone = el.cloneNode(true);
      new Splitting({
        target: clone,
        by: "words"
      });
      clone.classList.add(
        "hero__content",
        "hero__content--hidden",
        "content--hero"
      );
      clone.classList.remove("bdt-item-box");
      return clone;
    });

    contentFullsizeEls.forEach((el) => fullSizeWrapEl.appendChild(el));

    const state = {
      topContent: null,
      bottomContent: null,
    };

    function slideChange() {

      const swiper = $($avatar).find('.bdt-hero-swiper')[0].swiper;

      const total = swiper.slides.length - swiper.loopedSlides * 2;
      const contentIndex = (swiper.activeIndex - swiper.loopedSlides) % total;

      const content = contentFullsizeEls[contentIndex];
      if (!content) return;

      if (state.bottomContent) {
        state.bottomContent.classList.remove("hero__content--bottom");
        state.bottomContent.classList.add("hero__content--hidden");
      }

      if (state.topContent) {
        state.topContent.classList.remove("hero__content--top");
        state.topContent.classList.add("hero__content--bottom");
      }

      state.bottomContent = state.topContent;
      state.topContent = content;

      const slidetRect =
        swiper.slides[swiper.activeIndex].getBoundingClientRect();
      const parentRect = heroEl.getBoundingClientRect();

      content.style.transition = "none";
      content.style.left = slidetRect.left - parentRect.left + "px";
      content.style.top = slidetRect.top - parentRect.top + "px";
      content.style.width = slidetRect.width + "px";
      content.style.height = slidetRect.height + "px";
      content.style.borderRadius = "const(--border-radius, 0)";

      content.getBoundingClientRect();

      content.classList.remove("hero__content--hidden");
      content.classList.add("hero__content--top", "hero__content--grow");

      content.style.transition = "";
      content.style.left = "";
      content.style.top = "";
      content.style.width = "";
      content.style.height = "";
      content.style.borderRadius = "";

      const onShowTextEnd = (event) => {
        if (event.target !== event.currentTarget) {
          event.currentTarget.classList.remove("hero__content--show-text");
          event.currentTarget.removeEventListener(
            "transitionend",
            onShowTextEnd
          );
        }
      };

      const onGrowEnd = (event) => {
        event.currentTarget.classList.remove("hero__content--grow");
        event.currentTarget.classList.add("hero__content--show-text");
        event.currentTarget.addEventListener("transitionend", onShowTextEnd);
      };

      content.addEventListener("transitionend", onGrowEnd, {
        once: true
      });

      // const.log(slideIndex, total);
    }

    function swiperInit() {

      const swiper = $($avatar).find('.bdt-hero-swiper')[0].swiper;

      const total = swiper.slides.length - swiper.loopedSlides * 2;
      const contentIndex = (swiper.activeIndex - swiper.loopedSlides) % total;

      const content = contentFullsizeEls[contentIndex];
      if (!content) return;

      content.classList.remove("hero__content--hidden");
      content.classList.add("hero__content--top");
      state.topContent = content;
    }

    const Swiper = elementorFrontend.utils.swiper;
    initSwiper();
    async function initSwiper() {
      const swiper = await new Swiper($($avatar).find('.bdt-hero-swiper'), {
        slidesPerView: 1.5,
        spaceBetween: 25,
        autoplay: ($settings.autoplay) ? $settings.autoplay : false,
        loop: ($settings.loop) ? $settings.loop : false,
        speed: ($settings.speed) ? $settings.speed : 1000,
        simulateTouch: false,

        breakpoints: {
          768: {
            slidesPerView: 2.5,
          },
          1024: {
            slidesPerView: 3.5,
          },
        },
        navigation: {
          nextEl: ".bdt-button-next",
          prevEl: ".bdt-button-prev",
        },
        // on: {
        //   realIndexChange: slideChange,
        //   init: swiperInit
        // },
      });

      swiperInit();


      swiper.on('initialSlide', function (e) {});

      swiper.on('slideChange', function (e) {
        slideChange();
      });

    }
  };

  jQuery(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/prime-slider-avatar.default",
      widgetAvatar
    );
  });
})(jQuery, window.elementorFrontend);