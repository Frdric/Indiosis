/* 
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * JS : Sign Up Box interaction
 * Handles all UI interaction with the Sign Box and button.
 * 
 * @package     signup
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */


$(document).ready(function()
{
    // re-parse the LinkedIn elements
    IN.parse();
   
});

// Enables the submit button to be hit if the form is valid.
function enableSubmitButton(form, attribute, data, hasError)
{
    console.debug(hasError);
    if(!hasError) {
       $("#signUpButton").removeAttr('disabled');
    }
}

// Called after sign up registration.
function afterRegistration(srvResponse)
{
    if(srvResponse=='OK') {
        $("#indiosisPart , #linkedInPart").fadeOut(100, function() {
            $('#thankYouTxt').parent().parent().parent().css('height', '130px');
            $('#thankYouTxt').fadeIn(400);
        })();
    }
}

// Called after LinkedIn auth-registration
function registerLinkedInUser()
{
    // retrieve the currently logged in LinkedIn User
    IN.API.Profile("me").result(
        function(linkedInProfile) {
            // submit the LinkedIn User for registration in Indiosis DB
            $.ajax({
                url: BASE_URL + '/account/linkedinregister',
                dataType: 'json',
                type: 'POST',
                data : $.param(linkedInProfile.values[0]),
                success: function(data, textStatus, XMLHttpRequest)
                {
                    $('#thankYouTxtLinkedIn span.name').text(data.firstName +" "+data.lastName);
                    
                    $("#indiosisPart , #linkedInPart").fadeOut(100, function() {
                        $('#thankYouTxtLinkedIn').fadeIn(400);
                    })();
                }
            });
        }
    );
}