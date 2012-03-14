<?php
/*
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * Default Error View
 * Indiosis's error page.
 * 
 * @package     all
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */

$this->pageTitle= Helpers::buildPageTitle('Oops !');
?>
<h2>Oops... Indiosis generated an error!</h2>
<p>
   Sorry for any inconvinience it may have caused.
   If this is a recurent bug, our team will be working on it and fix the problem.
</p>
<p>
    <b><?php echo CHtml::encode($message); ?></b><br/>
    <?php echo 'Error '.$code.' : '.$type.' in '.$file.' (line '.$line.')'; ?>
</p>
