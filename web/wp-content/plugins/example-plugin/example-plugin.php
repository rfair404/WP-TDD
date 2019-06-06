<?php
/**
 * Plugin Name: Example Plugin
 * Version: 0.1
 */

require_once 'inc/loader.php';
add_action('plugins_loaded', function() {
    (new \Example_Plugin\Loader())->init();
});
