/**
 * thesis-footer-tool.js - Javascript for the Thesis Footer Tool.
 *
 * @package thesis-tools
 * @subpackage thesis-footer-tool
 * @author GrandSlambert
 * @copyright 2009-2010
 * @access public
 */

function tftShowTab(tab) {
    document.getElementById('tft_box_before').style.display = 'none';
    document.getElementById('tft_box_inside').style.display = 'none';
    document.getElementById('tft_box_after').style.display = 'none';
    document.getElementById('tft_box_css').style.display = 'none';
    document.getElementById('tft_box_' + tab).style.display = 'block';
}