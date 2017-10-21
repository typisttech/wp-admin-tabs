<?php

declare(strict_types=1);

namespace TypistTech\WPAdminTabs;

use AspectMock\Test;
use Codeception\TestCase\WPTestCase;

/**
 * @covers \TypistTech\WPAdminTabs\AdminTabCollection
 */
class AdminTabCollectionTest extends WPTestCase
{
    public function setUp()
    {
        parent::setUp();

        Test::func(__NAMESPACE__, 'get_site_url', 'https://example.com');

        $this->adminTabCollection = new AdminTabCollection();
    }

    public function tearDown()
    {
        unset($_SERVER['REQUEST_URI']);

        parent::tearDown();
    }

    /** @test */
    public function it_is_an_instance_of_admin_tabs_interface()
    {
        $this->assertInstanceOf(AdminTabCollectionInterface::class, $this->adminTabCollection);
    }

    /** @test */
    public function it_adds_admin_tabs()
    {
        $adminTabs = [
            new AdminTab('Tab 1', 'https://example.com/wp-admin/admin.php?page=tab1'),
            new AdminTab('Tab 2', 'https://example.com/wp-admin/admin.php?page=tab2'),
        ];

        $this->adminTabCollection->add(...$adminTabs);

        $this->assertAttributeSame($adminTabs, 'adminTabs', $this->adminTabCollection);
    }

    /** @test */
    public function it_has_admin_tabs_getter()
    {
        $adminTabs = [
            new AdminTab('Tab 1', 'https://example.com/wp-admin/admin.php?page=tab1'),
            new AdminTab('Tab 2', 'https://example.com/wp-admin/admin.php?page=tab2'),
        ];
        $this->adminTabCollection->add(...$adminTabs);

        $actual = $this->adminTabCollection->all();

        $this->assertSame($adminTabs, $actual);
    }

    /** @test */
    public function it_renders_the_admin_tabs()
    {
        $adminTabs = [
            new AdminTab('Tab 1', 'https://example.com/wp-admin/admin.php?page=tab1'),
            new AdminTab('Tab 2', 'https://example.com/wp-admin/admin.php?page=tab2'),
        ];
        $this->adminTabCollection->add(...$adminTabs);

        ob_start();
        $this->adminTabCollection->render();
        $actual = ob_get_clean();

        $expected = '<h2 class="nav-tab-wrapper"><a href="https://example.com/wp-admin/admin.php?page=tab1" ';
        $expected .= 'class="nav-tab ">Tab 1</a><a href="https://example.com/wp-admin/admin.php?page=tab2" ';
        $expected .= 'class="nav-tab ">Tab 2</a></h2>';

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_highlights_active_tab()
    {
        $adminTabs = [
            new AdminTab('Tab 1', 'https://example.com/wp-admin/admin.php?page=tab1'),
            new AdminTab('Tab 2', 'https://example.com/wp-admin/admin.php?page=tab2'),
        ];
        $this->adminTabCollection->add(...$adminTabs);
        $_SERVER['REQUEST_URI'] = '/wp-admin/admin.php?page=tab2';

        ob_start();
        $this->adminTabCollection->render();
        $actual = ob_get_clean();

        $expected = '<h2 class="nav-tab-wrapper"><a href="https://example.com/wp-admin/admin.php?page=tab1" ';
        $expected .= 'class="nav-tab ">Tab 1</a><a href="https://example.com/wp-admin/admin.php?page=tab2" ';
        $expected .= 'class="nav-tab nav-tab-active">Tab 2</a></h2>';

        $this->assertSame($expected, $actual);
    }
}
