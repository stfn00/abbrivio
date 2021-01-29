/**
 * ==========================================================================
 * Slick slider Class
 * ==========================================================================
 */

class AbbrivioSlickSliders {

    /**
	 * Constructor
	 */
    constructor() {

        /**
         * Vars
         */
        this.slickBaseOptions = {
            infinite: true,
            speed: 300,
            dots: true,
            arrows: true,
            autoplay: true,
            autoplaySpeed: 2000,
        };

        /**
         * Init
         */
        this.initSlider();
    }



    /**
	 * Init Carousel
	 */
    initSlider() {

        jQuery('.abbrivio-slider').slick({
            ...this.slickBaseOptions,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow: '<button type="button" class="slick-prev"></button>',
            nextArrow: '<button type="button" class="slick-next"></button>',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 600,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                }
            ],
        });
    }



}

export default AbbrivioSlickSliders;
