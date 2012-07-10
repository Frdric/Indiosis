<?php
/* 
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * HELPER Functions
 * Class including all the various small helping functions used throughout the application.
 * 
 * @package     all
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
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
            $pageTitle = $titlePart.' | Indiosis';
        }
        else {
            $pageTitle = 'Indiosis';
        }
        
        return $pageTitle;
    }
    
    /**
     * Output an array of variables into the client's JS script.
     * @param array $phpVar An array of variables.
     */
    public static function varToJS($phpVar)
    {
        $jsVarScript = "// Set specific variables \r\n";
        
        if(is_array($phpVar)) {
            // transform each value into a JS variable
            $jsVarScript .= 'var specificVar = '.json_encode($phpVar);
            
            Yii::app()->clientScript->registerScript('specificVar',$jsVarScript,CClientScript::POS_HEAD);
        }
    }
    
}