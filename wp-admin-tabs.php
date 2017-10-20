<?php
/**
 * WP Admin Tabs
 *
 * Create tabbed navigation for WordPress admin dashboard, the OOP way.
 *
 * @package   TypistTech\WPAdminTabs
 *
 * @author    Typist Tech <wp-admin-tabs@typist.tech>
 * @copyright 2017 Typist Tech
 * @license   GPL-2.0+
 *
 * @see       https://www.typist.tech/projects/wp-admin-tabs
 * @see       https://github.com/TypistTech/wp-admin-tabs
 */

/**
 * Plugin Name: WP Admin Tabs
 * Plugin URI:  https://github.com/TypistTech/wp-admin-tabs
 * Description: Example Plugin for WP Admin Tabs
 * Version:     0.1.0
 * Author:      Tang Rufus
 * Author URI:  https://www.typist.tech/
 * Text Domain: wp-admin-tabs
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

declare(strict_types=1);

namespace TypistTech\WPAdminTabs;

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

require_once __DIR__ . '/vendor/autoload.php';

add_action(
    'pre_current_active_plugins',
    function () {
        $adminTabCollection = new AdminTabCollection();
        $adminTabCollection->addAdminTab(
            new AdminTab('GitHub', 'https://github.com/TypistTech'),
            new AdminTab('Twitter', 'https://twitter.com/tangrufus'),
            new AdminTab('Blog', 'https://www.typist.tech'),
            new AdminTab('Plugins', admin_url('plugins.php')),
            new AdminTab('Users', admin_url('users.php'))
        );
        $adminTabCollection->render();
    }
);
