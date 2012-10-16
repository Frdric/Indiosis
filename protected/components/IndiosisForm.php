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

    public $uniformConfig = array(
        'selector' => 'select:not(.no-uniform):not(.chzn-select), input:not(:button,:submit,.no-uniform), textarea:not(.no-uniform)',
        'theme' => 'indiosis',
        'options' => array() // Uniform options, see the documentation
    );

    public function init()
    {
        $this->widget('ext.uniforms.EUniform', $this->uniformConfig);
        $this->widget('ext.echosen.EChosen'); // applies to .chzn-select class select list.
        $this->enableClientValidation = true;
        parent::init();
    }
}