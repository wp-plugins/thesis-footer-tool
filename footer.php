<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }
/**
 * footer.php - Footer for common pages.
 *
 * @package thesis-tools
 * @subpackage thesis-footer-tool
 * @author GrandSlambert
 * @copyright 2009-2010
 * @access public
 */
?>

<div style="clear:both; margin-top:10px;">
    <div class="postbox" style="width:49%; height: 175px; float:left;">
        <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Credits', 'thesis-footer-tool'); ?></h3>
        <div style="padding:8px;">
                <p>
                    <?php printf(__('Thank you for trying the %1$s plugin - I hope you find it useful. For the latest updates on this plugin, vist the %2$s. If you have problems with this plugin, please use our %3$s', 'thesis-footer-tool'),
                        $this->pluginName,
                        '<a href="http://thesistools.grandslambert.com/the-tools/thesis-footer-tool.html" target="_blank">' . __('official site', 'thesis-footer-tool') . '</a>',
                        '<a href="http://support.grandslambert.com/forum/thesis-tools-plugins" target="_blank">' . __('Support Forum', 'thesis-footer-tool') . '</a>'
                    ); ?>
                </p>
                <p>
                    <?php printf(__('This plugin is &copy; %1$s by %2$s and is released under the %3$s', 'thesis-footer-tool'),
                        '2009-' . date("Y"),
                        '<a href="http://grandslambert.com" target="_blank">GrandSlambert, Inc.</a>',
                        '<a href="http://www.gnu.org/licenses/gpl.html" target="_blank">' . __('GNU General Public License', 'thesis-footer-tool') . '</a>'
                    ); ?>
                </p>
        </div>
    </div>
    <div class="postbox" style="width:49%; height: 175px; float:right;">
        <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Donate', 'thesis-footer-tool'); ?></h3>
        <div style="padding:8px">
            <p>
                <?php printf(__('If you find this plugin useful, please consider supporting this and our other great %1$s.', 'thesis-footer-tool'), '<a href="http://wordpress.grandslambert.com/plugins.html" target="_blank">' . __('plugins', 'thesis-footer-tool') . '</a>'); ?>
                <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=CNYKSS547GZBS" target="_blank"><?php _e('Donate a few bucks!', 'thesis-footer-tool'); ?></a>
            </p>
            <p style="text-align: center;"><a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=CNYKSS547GZBS"><img width="122" height="47" alt="paypal_btn_donateCC_LG" src="http://grandslambert.com/paypal.gif" title="paypal_btn_donateCC_LG" class="aligncenter size-full wp-image-174"/></a></p>
        </div>
    </div>
</div>