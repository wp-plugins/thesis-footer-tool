<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }
/**
 * options-panel.php - Settings for the Thesis Footer Tool.
 *
 * @package thesis-tools
 * @subpackage thesis-footer-tool
 * @author GrandSlambert
 * @copyright 2009-2010
 * @access public
 */
?>

<div class="wrap">
    <div class="icon32" id="icon-options-general"><br/>
    </div>
    <h2><?php echo $this->pluginName; ?> <?php _e('Settings', 'thesis-footer-tool'); ?></h2>

    <?php if (!defined('THESIS_LIB')) : ?>
    <div class="tft-warning"><?php printf(__('Warning: Your are not currently using the <a href="%1$s" target="_blank">Thesis Theme by DIYthemes</a>. This plugin will not work with your current theme.', 'thesis-footer-tool'), 'http://www.shareasale.com/r.cfm?B=198392&U=448113&M=24570'); ?></div>
    <?php endif; ?>

    <form method="post" action="options.php">
        <?php settings_fields($this->optionsName); ?>

        <div style="width:49%; float:left;">
            <div class="postbox">
                <h3 class="handl" style="margin:0;padding:3px;cursor:default;">
                    <?php _e('Footer Options', 'thesis-footer-tool'); ?>
                </h3>
                <div class="table">
                    <table class="form-table">
                        <tr align="top">
                            <th scope="row"><label for="thesis_footer_tool_affiliate_link"><?php _e('Affiliate Link', 'thesis-footer-tool'); ?></label></th>
                            <td><input class="long-box" type="text" id="thesis_footer_tool_affiliate_link" name="<?php echo $this->optionsName; ?>[affiliate-link]" value="<?php echo $this->options['affiliate-link']; ?>"</td>
                        </tr>
                        <tr align="top">
                            <th scope="row"><label for="thesis_footer_tool_hide_attribution"><?php _e('Hide Attribution Link?', 'thesis-footer-tool'); ?></label></th>
                            <td>
                                <input type="checkbox" id="thesis_footer_tool_hide_attribution" name="<?php echo $this->optionsName; ?>[hide-attribution]" value="1" <?php checked($this->options['hide-attribution'],1); ?>>
                                <?php _e('You should have a developers license to use this feature!', 'thesis-footer-tool'); ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <ul id="tft_tabs">
                <li id="tft_before"><a href="#top" onclick="tftShowTab('before')">Before</a></li>
                <li id="tft_inside"><a href="#top" onclick="tftShowTab('inside')">Inside</a></li>
                <li id="tft_after"><a href="#top" onclick="tftShowTab('after')">After</a></li>
                <li id="tft_css"><a href="#top" onclick="tftShowTab('css')">CSS</a></li>
            </ul>
            <div id="tft_box_before" class="postbox" style="display:">
                <h3 class="handl" style="margin:0;padding:3px;cursor:default;">
                    <?php _e('Before the Footer', 'thesis-footer-tool'); ?>
                </h3>
                <div class="table">
                    <table class="form-table">
                        <tr align="top">
                            <td><textarea class="tft-textarea" rows="10" cols="50" name="<?php echo $this->optionsName; ?>[before]" id="thesis_footer_tool_before"><?php echo $this->options['before']; ?></textarea></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="tft_box_inside" class="postbox" style="display:none">
                <h3 class="handl" style="margin:0;padding:3px;cursor:default;">
                    <?php _e('Inside the Footer', 'thesis-footer-tool'); ?>
                </h3>
                <div class="table">
                    <table class="form-table">
                        <tr align="top">
                            <td><textarea class="tft-textarea" rows="10" cols="50" name="<?php echo $this->optionsName; ?>[inside]" id="thesis_footer_tool_inside"><?php echo $this->options['inside']; ?></textarea></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="tft_box_after" class="postbox" style="display:none">
                <h3 class="handl" style="margin:0;padding:3px;cursor:default;">
                    <?php _e('After the Footer', 'thesis-footer-tool'); ?>
                </h3>
                <div class="table">
                    <table class="form-table">
                        <tr align="top">
                            <td><textarea class="tft-textarea" rows="10" cols="50" name="<?php echo $this->optionsName; ?>[after]" id="thesis_footer_tool_atfter"><?php echo $this->options['after']; ?></textarea></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="tft_box_css" class="postbox" style="display:none">
                <h3 class="handl" style="margin:0;padding:3px;cursor:default;">
                    <?php _e('Custom CSS', 'thesis-footer-tool'); ?>
                </h3>
                <div class="table">
                    <table class="form-table">
                        <tr align="top">
                            <td><textarea class="tft-textarea" rows="10" cols="50" name="<?php echo $this->optionsName; ?>[custom-css]" id="thesis_footer_tool_custom_css"><?php echo $this->options['custom-css']; ?></textarea></td>
                        </tr>
                    </table>
                </div>
            </div>
            <p class="submit" align="center">
                <input type="hidden" name="action" value="update" />
                <?php if (function_exists('wpmu_create_blog')) : ?>
                <input type="hidden" name="option_page" value="<?php echo $this->optionsName; ?>" />
                <?php  else : ?>
                <input type="hidden" name="page_options" value="<?php echo $this->optionsName; ?>" />
                <?php endif; ?>
                <input type="submit" name="Submit" value="<?php _e('Save Changes', 'thesis-footer-tool'); ?>" />
            </p>
        </div>

    </form>
    <div style="width:49%; float:right">
        <div class="postbox">
            <h3 class="handl" style="margin:0; padding:3px;cursor:default;">
                <?php _e('Plugin Information', 'thesis-footer-tool'); ?>
            </h3>
            <div style="padding:5px;">
                <p><?php _e('On this page you can add items before, inside, and after the footer. Whatever is placed in the boxes to the left will be added to every page of your site.', 'thesis-footer-tool'); ?></p>
                <p><span><?php _e('You are using','thesis-footer-tool'); ?> <strong> <a href="http://thesistools.grandslambert.com/the-tools/thesis-footer-tool.html" target="_blank"><?php echo $this->pluginName; ?> <?php echo $this->showVersion(); ?></a></strong> by <a href="http://grandslambert.com" target="_blank">GrandSlambert</a>.</span> </p>
            </div>
        </div>
        <div class="postbox">
            <h3 class="handl" style="margin:0; padding:3px;cursor:default;">
                <?php _e('Usage', 'thesis-footer-tool'); ?>
            </h3>
            <div style="padding:5px;">
                <p><?php _e('Use the boxes to the left to enter text and/or code that you would like added at different parts of the footer. You can also add some custom CSS in the CSS box if you need to style your output.', 'thesis-footer-tool'); ?></p>
                <p><?php _e('You can include your affiliate link in any text box by using the shortcode [link] inside your href tag.', 'thesis-footer-tool'); ?></p>
            </div>
        </div>
        <div class="postbox">
            <h3 class="handl" style="margin:0; padding:3px;cursor:default;">
                <?php _e('Recent Contributors', 'thesis-footer-tool'); ?>
            </h3>
            <div style="padding:5px;">
                <p><?php _e('GrandSlambert would like to thank these wonderful contributors to this plugin!', 'thesis-footer-tool');?></p>
                <?php $this->contributorList(); ?>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
