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

declare(strict_types=1);

namespace TypistTech\WPAdminTabs;

interface AdminTabInterface
{
    /**
     * Whether this tab is active, i.e. current screen is on this tab.
     *
     * @return bool
     */
    public function isActive(): bool;

    /**
     * Returns the URL of this tab.
     *
     * @return string
     */
    public function getUrl(): string;

    /**
     * Returns the menu title of this tab.
     *
     * @return string
     */
    public function getMenuTitle(): string;
}
