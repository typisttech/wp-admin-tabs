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

class AdminTab implements AdminTabInterface
{
    /**
     * The menu title of this tab.
     *
     * @var string
     */
    private $menuTitle;

    /**
     * The url of this tab.
     *
     * @var string
     */
    private $url;

    /**
     * Whether this tab is active, i.e. current screen is on this tab.
     *
     * @var bool
     */
    private $isActive;

    /**
     * AdminTab constructor.
     *
     * @param string $menuTitle The menu title of this tab.
     * @param string $url       The url of this tab.
     */
    public function __construct(string $menuTitle, string $url)
    {
        $this->menuTitle = $menuTitle;
        $this->url = $url;
    }

    /**
     * MenuTitle getter.
     *
     * @return string
     */
    public function getMenuTitle(): string
    {
        return $this->menuTitle;
    }

    /**
     * Url getter.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Whether this tab is active, i.e. current screen is on this tab.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        if (! isset($_SERVER['REQUEST_URI'])) { // Input var okay.
            return false;
        }

        $currentUrl = esc_url_raw(
            wp_unslash($_SERVER['REQUEST_URI'])  // Input var okay.
        );

        $matchUrl = str_replace(
            esc_url_raw(get_site_url()),
            '',
            esc_url_raw($this->getUrl())
        );

        return 0 === strpos($currentUrl, $matchUrl);
    }
}
