<?php

/**
 * Plugin Name:       Todo
 * Plugin URI:        https://github.com/helsingborg-stad/todo
 * Description:       A simple support ticket system based on ACF fields.
 * Version:           1.0.0
 * Author:            Sebastian Thulin
 * Author URI:        https://github.com/sebastianthulin
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       todo
 * Domain Path:       /languages
 */

 // Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('TODO_PATH', plugin_dir_path(__FILE__));
define('TODO_URL', plugins_url('', __FILE__));
define('TODO_TEMPLATE_PATH', TODO_PATH . 'templates/');

load_plugin_textdomain('todo', false, plugin_basename(dirname(__FILE__)) . '/languages');

require_once TODO_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once TODO_PATH . 'Public.php';

// Instantiate and register the autoloader
$loader = new TODO\Vendor\Psr4ClassLoader();
$loader->addPrefix('TODO', TODO_PATH);
$loader->addPrefix('TODO', TODO_PATH . 'source/php/');
$loader->register();

// Start application
new TODO\App();
