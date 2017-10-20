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

use TypistTech\WPKsesView\Factory;
use TypistTech\WPKsesView\ViewAwareTrait;
use TypistTech\WPKsesView\ViewAwareTraitInterface;

class AdminTabCollection implements AdminTabCollectionInterface, ViewAwareTraitInterface
{
    use ViewAwareTrait;

    /**
     * Admin tabs.
     *
     * @var AdminTab[]
     */
    private $adminTabs = [];

    /**
     * Add admin tabs.
     *
     * @param AdminTab[] ...$adminTabs Admin tabs to be added.
     *
     * @return void
     */
    public function add(AdminTab ...$adminTabs)
    {
        $this->adminTabs = array_unique(
            array_merge($this->adminTabs, $adminTabs),
            SORT_REGULAR
        );
    }

    /**
     * Admin tabs getter.
     *
     * @return AdminTab[]
     */
    public function all(): array
    {
        return $this->adminTabs;
    }

    /**
     * Render the tabs.
     *
     * @return void
     */
    public function render()
    {
        if (null === $this->view) {
            $this->setView(
                Factory::build(__DIR__ . '/partials/admin-tabs.php')
            );
        }

        $closure = $this->getRenderClosure();
        $closure();
    }
}
