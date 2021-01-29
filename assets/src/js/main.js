/**
 * ==========================================================================
 * Main file
 * ==========================================================================
 */



// Images
import '../img/favicon.ico';
import '../img/logo.svg';
import '../img/logo-min.svg';
import '../img/logo-min-dark.svg';
import '../img/patterns/cover.jpg';
import '../img/icons/icon-arrow-prev.png';
import '../img/icons/icon-arrow-next.png';

// Bootstrap
import 'bootstrap';

// Font Awesome
import '@fortawesome/fontawesome-free/js/fontawesome'
import '@fortawesome/fontawesome-free/js/solid'
import '@fortawesome/fontawesome-free/js/regular'
import '@fortawesome/fontawesome-free/js/brands'

// Abbrivio Lazyload
import lazyLoadInit from "./lazyload";
// Lazyload init
lazyLoadInit();

// Clock
import AbbrivioClock from './clock';

// Sliders
import AbbrivioSlickSliders from './sliders';

// Miscellaneous
import AbbrivioMisc from './misc';

// Styles
import '../sass/main.scss';



/**
 * Init
 * ==========================================================================
 */

window.addEventListener('load', () => {

    // Clock
    new AbbrivioClock();

    // Sliders
    new AbbrivioSlickSliders();

    // Miscellaneous
    new AbbrivioMisc();

});
