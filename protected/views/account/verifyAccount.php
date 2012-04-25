<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * VIEW : Account verification page
 * Show wether or not a new account has been validated.
 * 
 * @package     all
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */


if($verified) {
    echo '<div class="info_txt">Welcome <em class="indiosis_blue">'.$user->firstName.' '.$user->lastName.'</em><br/>Your account has been successfully verified, you can now sign in.</div>';
}
else {
    echo 'Sorry your confirmation code is not valid.';
}

?>