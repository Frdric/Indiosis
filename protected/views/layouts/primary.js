/* 
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * JS : Site-wide JS scripts
 * JS Script loaded on every pages and run before all other scripts.
 * 
 * @package     layout
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

// Empty the header search field when clicked.
$("#searchfield input").focus(function() {
    if($(this).hasClass("empty")) {
        $(this).val(" ");
        $(this).removeClass("empty");
    }
});

// Reparse the LinkedIn button
function reparseLinkedIn() {
    IN.parse();
}

// Show and hide loading image.
function showLoader(loader_id) {
    $(loader_id).fadeIn("fast");
}
function hideLoader(loader_id) {
    $(loader_id).fadeOut("fast");
}