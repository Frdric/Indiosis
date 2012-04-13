<?php

/**
 * Pixelmatrix Uniform Yii extension
 * 
 * Select a cropping area fro an image using the Jcrop jQuery tool and crop
 * it using PHP's GD functions.
 *
 * @copyright © Digitick <www.digitick.net> 2011
 * @license MIT
 * @author Ianaré Sévi
 *
 */
class EUniform extends CWidget
{
	public $selector = 'select, input, textarea';
	public $theme = 'default';
	public $options;

	public function init()
	{
		$assets = Yii::app()->getAssetManager()->publish(dirname(__FILE__) . '/assets');

		Yii::app()->clientScript->registerCoreScript('jquery')
				->registerScriptFile($assets . '/jquery.uniform.js')
				->registerCssFile($assets . "/css/uniform.{$this->theme}.css");

		$id = __CLASS__ . '#' . md5($this->selector);
		$options = CJavaScript::encode($this->options);
		Yii::app()->getClientScript()->registerScript($id, "jQuery('{$this->selector}').uniform({$options});", CClientScript::POS_READY);
	}

}