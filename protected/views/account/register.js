/* 
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * JS : Account registration Script
 * Handles all UI interaction of the sign up page.
 * 
 * @package     account
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

function beforeSignupValidate(form) {
    showLoader(".signuploader");
    return true;
}
// called if the sign up validation process succeded.
function afterSignupValidate(form, data, hasError) {
    hideLoader(".signuploader");
    if(!hasError) {
        $("#signupbox").slideUp("slow",function() {
            $("#registeredMsg").fadeIn("slow");
        });
    }
    return false;
}