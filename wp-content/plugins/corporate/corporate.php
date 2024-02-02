<?php

use CorporateAdmin\CorporatePluginBase;

/**
 * Plugin Name: Corporate Plugin
 * Description: Một plugin WordPress.
 * Version: 1.0
 * Author: Jutly
 */

require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

function initializeCorporatePluginBase() {
    return new CorporatePluginBase();
}

add_action('init', 'initializeCorporatePluginBase');
