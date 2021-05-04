(function ($) {
    /*-- Single product with Thumbnail Horizental -- */
    const galleryThumbs = new Swiper('.single-product-thumb', {
        spaceBetween: 10,
        slidesPerView: 4,
        // loop: false,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        // Responsive breakpoints
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 2,
            },
            // when window width is >= 575px
            575: {
                slidesPerView: 3,
            },
            // when window width is >= 767px
            767: {
                slidesPerView: 4,
            },
            // when window width is >= 991px
            991: {
                slidesPerView: 3,
            },
            // when window width is >= 1200px
            1200: {
                slidesPerView: 4,
            },
        }
    });

    const galleryTop = new Swiper('.single-product-img', {
        spaceBetween: 10,
        loop: true,
        navigation: {
            nextEl: '.single-product-thumb, .swiper-button-horizental-next',
            prevEl: '.single-product-thumb, .swiper-button-horizental-prev',
        },
        thumbs: {
            swiper: galleryThumbs,
        },
    });

})(jQuery);

