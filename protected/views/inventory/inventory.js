/* 
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * JS : Inventory Interaction Script
 * Handles all UI interaction of the resource inventory page.
 * 
 * @package     inventory
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */


$(document).ready(function() {
    
    $("#progressbar").progressbar({ value: 87 });
    $("#progressbarWrapper").resizable();
    
    $("input:submit").button();
    
});