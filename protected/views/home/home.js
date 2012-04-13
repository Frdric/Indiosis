/* 
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * JS : Home page Interaction Script
 * Handles all UI interaction of the home page.
 * 
 * @package     home
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

// Connect with LinkedIn button bind
$("#linkedin_signup").bind('click',function () {IN.User.authorize(); return false;});

// Show the description of a given feature
function showFeatureDescr(featureId) {
    $("#txt_"+featureId).addClass("visible");
    if($("#features_description").hasClass("visible")) {
        $("#features_description").removeClass("visible");
        $("#features_description").stop().fadeOut("fast",function() {
            $("#txt_"+featureId).fadeIn("fast");
        });
    }
}
// Hide the description of a given feature
function hideFeatureDescr(featureId) {
    $("#txt_"+featureId).removeClass("visible");
    $("#txt_"+featureId).stop().fadeOut("fast",function() {
        $("#txt_feature1.visible").fadeIn("fast");
        $("#txt_feature2.visible").fadeIn("fast");
        $("#txt_feature3.visible").fadeIn("fast");
        if(!$("#home_txt div.visible").length) {
            $("#features_description").addClass("visible");
            $("#features_description").fadeIn("fast");
        }
    });
}

// Slide up a feature illustration on mouse-over.
$("div.feature_illu").mouseenter(function() {
    var div = $(this);
    tm = setTimeout(function() {
        div.stop().animate({marginTop: "-3px"}, "fast", "linear");
        showFeatureDescr(div.attr("id"));
    }, 250);
});
// Slide down a feature illustration on mouse-out.
$("div.feature_illu").mouseleave(function() {
    clearTimeout(tm);
    var div = $(this);
    div.stop().animate({marginTop: "0px"}, "fast", "linear");
    tm = setTimeout(function() {
        hideFeatureDescr(div.attr("id"));
    }, 200);
});