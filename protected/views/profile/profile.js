/* 
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * JS : Profile Interaction Script
 * Handles all of the UI interactions for the profile package.
 * 
 * @package     profile
 * @author      Arjun Shankars
 * @copyright   Copyright (C) 2011, ROI
 */


$(function() {
        $( "#progressbar" ).progressbar({
                value: 87
        });
        $( "#progressbarWrapper" ).resizable();
});
        
        
$(function(){
$(".currentlyviewing").tipTip({maxWidth: "auto", edgeOffset: 10});
});

$(function(){
    $(".feedaction").tipTip({maxWidth: "auto", edgeOffset: 10});
});

