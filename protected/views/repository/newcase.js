/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * JS : New IS case
 * Handles all UI interaction for the IS case form.
 *
 * @package     repository
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

$(".addcompbutton").click(function() {
    var nextcompid = $(this).attr('id').substr(-1);
    $(this).hide();
    $("#companyline"+nextcompid).removeClass("hidden").show("slow");
});

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