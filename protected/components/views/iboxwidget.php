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



?>

<div id="<?php echo $boxId; ?>" class="ibox">
    <div class="iboxheader">
        <?php echo $boxTitle; ?>
    </div>
    <div class="iboxcontent">
        <?php echo $content; ?>
    </div>
</div>