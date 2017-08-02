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

/**
 * Common paths
 */

define('TODO_PATH', plugin_dir_path(__FILE__));
define('TODO_URL', plugins_url('', __FILE__));
define('TODO_TEMPLATE_PATH', TODO_PATH . 'templates/');

/**
 * Defines the plugin text domain
 */

load_plugin_textdomain('todo', false, plugin_basename(dirname(__FILE__)) . '/languages');

/**
 * Composer autoloader from municipio
 */
if (file_exists(TODO_PATH . 'vendor/autoload.php')) {
    require_once TODO_PATH . 'vendor/autoload.php';
}

/**
 * Composer autoloader from abspath
 */
if (file_exists(dirname(ABSPATH) . '/vendor/autoload.php')) {
    require_once dirname(ABSPATH) . '/vendor/autoload.php';
}

/**
 * PSR 4 Autloader (& public functions)
 */

require_once TODO_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once TODO_PATH . 'Public.php';

$loader = new TODO\Vendor\Psr4ClassLoader();
$loader->addPrefix('TODO', TODO_PATH);
$loader->addPrefix('TODO', TODO_PATH . 'source/php/');
$loader->register();

/**
 * Acf auto import and export
 */
add_action('plugins_loaded', function () {
    $acfExportManager = new \AcfExportManager\AcfExportManager();
    $acfExportManager->setTextdomain('todo');
    $acfExportManager->setExportFolder(TODO_PATH . 'source/php/AcfFields/');
    $acfExportManager->autoExport(array(
        'ticketPriority'          => 'group_59802f5e1d297',
        'ticketContact'           => 'group_598032ea68406',
        'ticketStatus'            => 'group_59808ae3b4d31',
        'ticketComment'           => 'group_598181c6ea020',
        'ticketNotification'      => 'group_5981c75a143dc',
    ));
    $acfExportManager->import();
});


new TODO\App();
