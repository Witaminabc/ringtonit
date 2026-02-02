(function ($) {

    if ($('.reviews-slider').length > 0) {
        $(".reviews-slider").owlCarousel({
            items: 1,
            margin: 10,
            lazyLoad: true,
            autoplay: false,
            loop: true,
            dots: false,
            nav: false,
            responsiveClass: true,
            autoHeight: true,
            responsive: {
                0: {
                    items: 1,
                    lazyLoad: true,
                    autoplay: true,
                    loop: true,
                    dots: false,
                    nav: false,
                    responsiveClass: true,
                    autoHeight: true
                }
            }
        });
        $("a.reviews-next").click(function () {
            $(".reviews-slider").trigger('next.owl.carousel');
        });
        $("a.reviews-prev").click(function () {
            $(".reviews-slider").trigger('prev.owl.carousel');
        });
    }
})