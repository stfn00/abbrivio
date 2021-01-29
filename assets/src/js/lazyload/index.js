/**
 * ==========================================================================
 * Lazy loading
 * ==========================================================================
 */



 // Lazyload
import LazyLoad from 'vanilla-lazyload';



/**
 * Lazyloading
 */
const logEvent = (eventName, element) => {
	console.log(
		Date.now(),
        eventName,
        element.getAttribute("data-src"),
        element.getAttribute("data-bg"),
	);
};

const lazyLoadOptions = {
    elements_selector: ".lazy",

	callback_enter: element => {
		logEvent("🔑 ENTERED", element);
    },
    callback_exit(element) {
        logEvent("🚪 EXITED", element);
    },
    callback_loading(element) {
        logEvent("⌚ LOADING", element);
    },
	callback_loaded: element => {
		logEvent("👍 LOADED", element);
	},
	callback_error: element => {
		logEvent("💀 ERROR", element);
		element.src = "https://placehold.it/220x280?text=Placeholder";
    },
    callback_finish() {
        logEvent("✔️ FINISHED", document.documentElement);
    }
};

const createLazyLoadInstance = () => {
	return new LazyLoad(lazyLoadOptions);
};

export default () => {
	document.addEventListener("DOMContentLoaded", createLazyLoadInstance);
};
