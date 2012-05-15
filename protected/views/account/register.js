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

// Show the loader while validating
function beforeSignupValidate(form) {
    showLoader(".signuploader");
    return true;
}

// Called if the sign up validation process succeded.
function afterSignupValidate(form, data, hasError) {
    hideLoader(".signuploader");
    if(!hasError) {
        // submit the form if everything is ok
        $.ajax({type:'POST',url: form.attr("action"),data: form.serialize()});
        // Show the notification message
        $("#signupbox").slideUp("slow",function() {
            $("#registeredMsg").fadeIn("slow");
        });
    }
    return false;
}