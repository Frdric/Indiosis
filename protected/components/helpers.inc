<?php
/* 
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * Helper Functions
 * Class including all the various small helping functions used throughout the application.
 * 
 * @package     all
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */

class Helpers {
    
    /**
     * Build and returns the page title for any page.
     * @param string $titlePart If the title should include a special indication.
     * @return string The final page title. 
     */
    public static function buildPageTitle($titlePart=null)
    {
        if($titlePart!=null) {
            $pageTitle = 'Indiosis - '.$titlePart;
        }
        else {
            $pageTitle = 'Indiosis';
        }
        
        return $pageTitle;
    }
    
}