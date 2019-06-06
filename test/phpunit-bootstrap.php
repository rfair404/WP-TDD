<?php
define( 'WP_CONTENT_DIR', dirname( dirname ( __FILE__ ) ) . '/html/wp-content/' );
define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . 'plugins/' );
define( 'WP_MU_PLUGIN_DIR', WP_CONTENT_DIR . 'mu-plugins/' );

$_tests_dir = getenv( 'WP_TESTS_DIR' );

if ( ! $_tests_dir ) {
    $_tests_dir = rtrim( sys_get_temp_dir(), '/\\' ) . '/wordpress-tests-lib';
}

// Relative path to Core tests directory.
if ( ! file_exists( $_tests_dir . '/includes/' ) ) {
    $_tests_dir = '../../../../tests/phpunit';
}

if ( ! file_exists( $_tests_dir . '/includes/' ) ) {
    trigger_error( 'Unable to locate wordpress-tests-lib', E_USER_ERROR );
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

// Require the composer installed files.
require_once dirname( dirname( __FILE__) ) . '/vendor/autoload.php';

// Manually Load each plugin to be tested.
function _manually_load_plugin() {

}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// Set up the entire test directory.
require_once $_tests_dir . '/includes/bootstrap.php';








