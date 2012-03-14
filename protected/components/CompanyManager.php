<?php
/* 
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * Company Manager
 * Component handling company related operations.
 * 
 * @package     company
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */


class UserManager extends CComponent {
    
    
    /**
     * Sends a synergy request to another company concerning particular resources (usualy one resource from each company).
     * @param type $sender
     * @param type $receiver 
     */
    public static function sendSynergyRequest($sender,$receiver,$resources)
    {
        
    }
    
    
    public static function askForPractitionerHelp()
    {
        //TODO : Implement this feature.
    }
    
}
?>
