<?php
/* 
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * WIDGET : Indiosis Standard Box
 * Creates a standard customizable Indiosis box.
 * 
 * @package     all
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

class IBoxWidget extends CWidget
{   
    const GRAY_IBOX = "GRAY";
    const BLUE_IBOX = "BLUE";
    const CLOSABLE = "CLOSABLE";
    const FIXED = "FIXED";
    
    public $boxId;
    // the kind of box (CLOSABLE or FIXED)
    public $closable = false;
    // the header title of the box
    public $title = "(title not set)";
    // the header title of the box
    public $color = self::GRAY_IBOX;
    
    
    public function init()
    {
        ob_start();
    }
    
    public function run()
    {
        // retrieve boc body content
        $content = ob_get_clean();
        // render the widget
        $this->render('iboxwidget',array(
            "boxId" => $this->boxId,
            "closable" => $this->closable,
            "colorTheme" => $this->color,
            "boxTitle" => $this->title,
            "content" => $content
            )
         );
    }
}