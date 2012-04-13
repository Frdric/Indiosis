<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * COMPONENT : Indiosis Base form
 * All Indiosis forms should extend this class.
 * (adds the Unifom plugin to all forms)
 * 
 * @package     base
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

class IndiosisForm extends CActiveForm
{
    public $uniform = array();
 
    public function init()
    {
        $this->widget('ext.uniforms.EUniform', $this->uniform);
        parent::init();
    }
}