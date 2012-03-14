<?php
/*
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * Indiosis Customized Base Controller
 * All controller classes of Indiosis should extend from this base class.
 * 
 * @package     base
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */

class IndiosisController extends CController
{
    // The default layout (none for indiosis)
    //public $layout='//layouts/to_create';
    
    // Context menu items. This property will be assigned to {@link CMenu::items}.
    public $menu=array();
    
    
    /**
     * The error action called each time a bug occurs.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error) {
            $this->render('error', $error);
        }
    }
}