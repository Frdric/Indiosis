/* 
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * JS : Home page Interaction Script
 * Handles all UI interaction of the home page.
 * 
 * @package     home
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */


$(document).ready(function() {
    
    // the fancy sign up box
    $("a#signuplink").fancybox({
        'transitionIn'	: 'none',
        'transitionOut'	: 'fade',
        'speedOut'	: 300,
        'width'         : 412,
        'height'        : 430,
        'autoDimensions': false
    });
    
});