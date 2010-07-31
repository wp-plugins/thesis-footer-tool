<?php
/*
Plugin Name: Thesis Footer Tool
Plugin URI: http://thesishooks.grandslambert.com/footer-tool.html
Description: Allows you to manage things in and around the footer of the Thesis theme.
Author: GrandSlambert
Version: 0.1
Author: GrandSlambert
Author URI: http://wordpress.grandslambert.com/

**************************************************************************

Copyright (C) 2009-2010 GrandSlambert

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General License for more details.

You should have received a copy of the GNU General License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

**************************************************************************

*/

class thesisFooterTool {

     /* Plugin settings */
    var $menuName = 'thesis-footer-tool';
    var $pluginName = 'Thesis Footer Tool';
    var $version = '0.1';
    var $optionsName	= 'thesis-footer-tool-options';

    function thesisFooterTool() {
        /* Load Langague Files */
        $langDir = dirname( plugin_basename(__FILE__) ) . '/lang';
        load_plugin_textdomain( 'thesis-footer-tool', false, $langDir, $langDir );

        $this->pluginName = __('Thesis Footer Tool', 'thesis-footer-tool');
        $this->pluginPath = WP_CONTENT_DIR . '/plugins/' . plugin_basename(dirname(__FILE__));
        $this->pluginURL = get_option('siteurl') . '/wp-content/plugins/' . plugin_basename(dirname(__FILE__));
        $this->loadSettings();

        /* Wordpress Hooks */
        add_action('admin_menu', array(&$this, 'addAdminPages'));
        add_action('wp_head', array($this, 'add_header') );
        add_action('admin_head', array($this, 'admin_header') );
        add_filter('plugin_action_links', array(&$this, 'addConfigureLink'), 10, 2);
        add_action('admin_init', array(&$this, 'registerOptions'));

        /* Thesis Hooks */
        add_action('thesis_hook_before_footer', array(&$this, 'before_footer'));
        add_action('thesis_hook_footer', array(&$this, 'inside_footer'));
        add_action('thesis_hook_after_footer', array(&$this, 'after_footer'));

    }

    function parse_content($content) {
        $content = preg_replace('/\[link\]/', $this->options['affiliate-link'], $content);

        return $content;
    }

    function before_footer() {
        if ($this->options ['hide-attribution'] or $this->options['affiliate-link']) {
            remove_action('thesis_hook_footer', 'thesis_attribution');
        }
        echo $this->parse_content($this->options['before']);
    }

    function inside_footer() {
        if ($this->options['inside']) {
            echo $this->parse_content($this->options['inside']) . '<br />';
        }
        
        if ($this->options['affiliate-link'] and !$this->options['hide-attribution']) {
            printf(__('Get smart with the <a href="%1$s" target="_blank">Thesis WordPress Theme</a> from DIYthemes.', 'thesis-footer-tool'), $this->options['affiliate-link']);
        }
    }

    function after_footer() {
        print $this->parse_content($this->options['after']);
    }

    function loadSettings() {
        if (!$this->options = get_option($this->optionsName)) {
            $this->options['title']     = __('Thesis Footer Tool', 'thesis-footer-tool');
        }
    }

    /**
     * Add items to the header of the web site.
     */
    function add_header() {
        global $wp_query;

        if ($this->options['custom-css']) {
            echo '<style type="text/css" media="screen">' ."\n" . $this->options['custom-css'] . "\n</style>";
        }
    }

    /**
     * Add necessary code to the head section for the administration pages.
     */
    function admin_header() {
        global $post;
        if (preg_match('/thesis-footer-tool/', $_SERVER['REQUEST_URI'])) {
            print "<link rel='stylesheet' href='" . $this->pluginURL . "/thesis-footer-tool.css' type='text/css' media='all' />";
            print "<script type='text/javascript' src='" .$this->pluginURL . "/thesis-footer-tool.js'></script>";
        }
    }

    /**
     * Add settings vars to the whitelist for forms.
     *
     * @param array $whitelist
     * @return array
     */
    function whitelistOptions($whitelist) {
        if (is_array($whitelist)) {
            $option_array = array($this->pluginName => $this->optionsName);
            $whitelist = array_merge($whitelist, $option_array);
        }

        return $whitelist;
    }

    /**
     * Add the admin page for the settings panel.
     *
     * @global string $wp_version
     */
    function addAdminPages() {
        global $wp_version;

        add_options_page($this->pluginName, $this->pluginName, 8, $this->menuName, array(&$this, 'optionsPanel'));

        // Use the bundled jquery library if we are running WP 2.5 or above
        if (version_compare($wp_version, '2.5', '>=')) {
            wp_enqueue_script('jquery', false, false, '1.2.3');
        }
    }

    /**
     * Add a configuration link to the plugins list.
     *
     * @staticvar object $this_plugin
     * @param array $links
     * @param array $file
     * @return array
     */
    function addConfigureLink($links, $file) {
        static $this_plugin;

        if (!$this_plugin) {
            $this_plugin = plugin_basename(__FILE__);
        }

        if ($file == $this_plugin) {
            $settings_link = '<a href="' . get_option('siteurl') . '/wp-admin/options-general.php?page=' . $this->menuName . '">' . __('Settings') . '</a>';
            array_unshift($links, $settings_link);
        }

        return $links;
    }

    /**
     * Settings management panel.
     */
    function optionsPanel() {
        include($this->pluginPath . '/options-panel.php');
    }

    /**
     * Display the current version number
     * @return string
     */
    function showVersion() {
        return $this->version;
    }

    /**
     * Register the options for Wordpress MU Support
     */
    function registerOptions() {
        register_setting( $this->optionsName, $this->optionsName);
    }

    /**
     * Display the list of contributors.
     * @return boolean
     */
    function contributorList() {
        $this->showFields = array('NAME', 'LOCATION' , 'COUNTRY');
        print '<ul>';

        $xml_parser = xml_parser_create();
        xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, true);
        xml_set_element_handler($xml_parser, array($this,"startElement"), array($this, "endElement") );
        xml_set_character_data_handler($xml_parser, array($this, "characterData") );

        if (!(@$fp = fopen('http://grandslambert.com/xml/thesis-footer-tool/contributors.xml', "r"))) {
            print 'There was an error getting the list. Try again later.';
            return;
        }

        while ($data = fread($fp, 4096)) {
            if (!xml_parse($xml_parser, $data, feof($fp))) {
                die(sprintf("XML error: %s at line %d",
                    xml_error_string(xml_get_error_code($xml_parser)),
                    xml_get_current_line_number($xml_parser)));
            }
        }

        xml_parser_free($xml_parser);
        print '</ul>';
    }

    /**
     * XML Start Element Procedure.
     */
    function startElement($parser, $name, $attrs) {
        if ($name == 'NAME') {
            print '<li class="rp-contributor">';
        }
        elseif ($name == 'ITEM') {
            print '<br><span class="rp_contributor_notes">Contributed: ';
        }

        if ($name == 'URL') {
            $this->makeLink = true;
        }
    }

    /**
     * XML End Element Procedure.
     */
    function endElement($parser, $name) {
        if ($name == 'ITEM') {
            print '</li>';
        }
        elseif ($name == 'ITEM') {
            print '</span>';
        }
        elseif ( in_array($name, $this->showFields)) {
            print ', ';
        }
    }

    /**
     * XML Character Data Procedure.
     */
    function characterData($parser, $data) {
        if ($this->makeLink) {
            print '<a href="http://' . $data . '" target="_blank">' . $data . '</a>';
            $this->makeLink = false;
        } else {
            print $data;
        }
    }
}

/* Instantiate the Widget */
$THESISFOOTERTOOL = new thesisFooterTool;
