<?php
/*
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * VIEW : Verify Account page
 * Display the account verification response.
 * 
 * @package     account
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */


if($verified) {
    echo '<div class="info_txt">Welcome <em class="indiosis_blue">'.$user->firstName.' '.$user->lastName.'</em><br/>Your account has been successfully verified, you can now sign in.</div>';
}
else {
    echo 'Sorry your confirmation code is not valid.';
}

?>