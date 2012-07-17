/*
 * - -- - - - - - - - - - - - *
 * INDIOSIS                   *
 * Synergize your resources.  *
 * - -- - - - - - - - - - - - *
 *
 * JS : Profile overview Script
 * Handles all UI interaction of the profile page.
 *
 * @package     profile
 * @author      Frederic Andreae
 * @copyright   UNIL/ROI
 */

$('#org_vmap').vectorMap({
    map: 'world_en',
    color: '#BBBBBB',
    scaleColors: ['#C8EEFF', '#0071A4'],
    normalizeFunction: 'polynomial',
    hoverOpacity: 0.7,
    hoverColor: false,
    backgroundColor: 'transparent',
    markers: [specificVar]
});