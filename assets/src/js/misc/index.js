/**
 * ==========================================================================
 * Miscellaneous Class
 * ==========================================================================
 */

class AbbrivioMisc {

    /**
     * Constructor
     */
    constructor() {
        
        /**
         * Vars
         */
        this.testVar = 'Test';
        
        /**
         * Init
         */
    }



    /**
     * Check if is iOS
     */
    isIOS() {
        return [
            'iPad Simulator',
            'iPhone Simulator',
            'iPod Simulator',
            'iPad',
            'iPhone',
            'iPod'
        ].includes(navigator.platform)
        // iPad on iOS 13 detection
        || (navigator.userAgent.includes("Mac") && "ontouchend" in document)
    }


    
}

export default AbbrivioMisc;
