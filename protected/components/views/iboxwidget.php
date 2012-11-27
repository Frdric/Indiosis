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
    <div class="iboxheader <?php if($closable) echo 'closable'; ?>">
        <?php echo $boxTitle; ?>
        <?php
        if($closable) {
        	echo '<span class="close websymbol-entypo">&#59231;</span>';
        }
        ?>
    </div>
    <div class="iboxcontent <?php echo (($closable) ? 'closed' : 'open' ); ?>" >
        <?php echo $content; ?>
    </div>
</div>