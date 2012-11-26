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

// Toggle Alt HS code input method
$("span.alt-HS-button").toggle(
    function() {
        $(this).parent().find(".chzn-container").hide();
        $(this).parent().find("input.alt-HS").show();
        $(this).html("&#57349;");
    },
    function() {
        $(this).parent().find(".chzn-container").show();
        $(this).parent().find("input.alt-HS").hide();
        $(this).html("&#9998;");
    }
);
// Propagate the alt HS input to the select list
$("input.alt-HS").blur(function() {
    $(this).parent().find("select").val($(this).val()).trigger("liszt:updated");
});


// Toggle Custom-class classification label
$("#CustomCategory_classification_0").click(function() {
    $('[for="CustomCategory_MatchingCode_number"]').text("HS Equivalent");
});

$("#CustomCategory_classification_1").click(function() {
    $('[for="CustomCategory_MatchingCode_number"]').text("ISIC Equivalent");
});