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


// IBox close button
$("div.closable").click(function() {
	var ibox = $(this).parent();
	if(ibox.find(".iboxcontent").height()=="0") {
		$(this).find("span.close").html('&#59228;');
		//ibox.find(".iboxcontent").animate({ height: 'auto' },"slow",function() { $(this).removeClass("closed"); });
		ibox.find(".iboxcontent").height("auto");
		ibox.find(".iboxcontent").removeClass("closed");
	}
	else {
		$(this).find("span.close").html('&#59231;');
		ibox.find(".iboxcontent").height("0px");
		ibox.find(".iboxcontent").addClass("closed");
	}
});

// Show and hide loading image.
function showLoader(loader_id) {
    $(loader_id).fadeIn("fast");
}
function hideLoader(loader_id) {
    $(loader_id).fadeOut("fast");
}