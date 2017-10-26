<?php
/**
 * WP Admin Tabs
 *
 * Create tabbed navigation for WordPress admin dashboard, the OOP way.
 *
 * @package   TypistTech\WPKsesView
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

interface AdminTabCollectionInterface
{
    /**
     * Add admin tabs.
     *
     * @param AdminTab[] ...$adminTabs Admin tabs to be added.
     *
     * @return void
     */
    public function add(AdminTab ...$adminTabs);

    /**
     * Admin tabs getter.
     *
     * @return AdminTab[]
     */
    public function all(): array;

    /**
     * Echo the tab safely.
     *
     * @return void
     */
    public function render();

    /**
     * Convert the tabs to safe HTML.
     *
     * @return string
     */
    public function toHtml(): string;
}
