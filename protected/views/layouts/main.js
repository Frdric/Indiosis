/* 
 * - - - - - - - - - - - - - - - - - - - *
 * INDIOSIS                              *
 * The resource optimization community.  *
 * - - - - - - - - - - - - - - - - - - - *
 * 
 * Main JS Script
 * JS Script loaded on every pages and run before all other scripts.
 * 
 * @package     layout
 * @author      Frederic Andreae
 * @copyright   Copyright (C) 2011, ROI
 */

$(document).ready(function() {
    
    // Uniform all checkboxes, radio buttons and file upload fields
    $("select, input:checkbox, input:radio, input:file").uniform();
    
});
