<?php
/**
 * WP Admin Tabs
 *
 * Create tabbed navigation for WordPress admin dashboard, the OOP way.
 *
 * @package   TypistTech\WPKsesView
 *
 * @author    Typist Tech <wp-admin-tabs@typist.tech>
 * @copyright 2017-2018 Typist Tech
 * @license   GPL-2.0-or-later
 *
 * @see       https://typist.tech/projects/wp-admin-tabs
 * @see       https://github.com/TypistTech/wp-admin-tabs
 */

declare(strict_types=1);

/* @var \TypistTech\WPAdminTabs\AdminTabCollectionInterface $context Admin tab collection to be rendered. */

echo '<h2 class="nav-tab-wrapper">';

foreach ($context->all() as $tab) {
    $htmlClass = $tab->isActive() ? 'nav-tab-active' : '';

    echo sprintf(
        '<a href="%1$s" class="nav-tab %2$s">%3$s</a>',
        esc_url($tab->getUrl()),
        esc_attr($htmlClass),
        esc_html($tab->getMenuTitle())
    );
}

echo '</h2>';
