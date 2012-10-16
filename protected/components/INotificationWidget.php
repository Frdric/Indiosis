<?php
/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * WIDGET : Indiosis Notification Message
 * Creates a standard customizable Indiosis top notification message.
 *
 * @package     all
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

class INotificationWidget extends CWidget
{
    // Standard colors
    const BLUE_INOT = "inotification_blue";
    const GREEN_INOT = "inotification_green";
    const YELLOW_INOT = "inotification_yellow";
    const RED_INOT = "inotification_red";
    // Possible icons
    const ICON_IOK = "IOK";
    const ICON_IERROR = "IERROR";
    const ICON_ISAVED = "ISAVED";
    const ICON_NONE = "INOICON";

    public $notId;
    // the header title of the box
    public $title = null;
    // the color class of the box
    public $color = '';
    // the icon to be displayed (default none)
    public $icon = self::ICON_NONE;
    // hidden by default
    public $init_display = false;


    public function init()
    {
        ob_start();
    }

    public function run()
    {
        // retrieve boc body content
        $content = ob_get_clean();
        // render the widget
        $this->render('inotificationwidget',array(
            "notId" => $this->notId,
            "icon" => $this->icon,
            "title" => $this->title,
            "colorTheme" => $this->color,
            "content" => $content,
            "init_display" => $this->init_display
            )
         );
    }
}