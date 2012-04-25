<?php
/* 
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 * 
 * WIDGET : Indiosis Top Notification message
 * Creates a standard notification message.
 * 
 * @package     all
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */
?>

<div id="<?php echo $notId; ?>" class="inotification <?php echo $colorTheme; ?> <?php echo (($init_display)? 'show' : ''); ?>">
    <?php
    switch ($icon) {
        case INotificationWidget::ICON_IOK:
            echo '<span class="inot_icon">&#10004;</span>';
            break;
        case INotificationWidget::ICON_IERROR:
            echo '<span class="inot_icon">&#10008</span>';
            break;
        default:
            break;
    }
    if(isset($title)) {
        echo '<span class="inot_title">'.$title.'</span>';
    }
    // print content if provided
    if($content!="") {
        echo '<br/><br/>'.$content;
    }
    ?>
</div>