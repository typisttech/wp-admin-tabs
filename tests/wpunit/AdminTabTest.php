<?php

declare(strict_types=1);

namespace TypistTech\WPAdminTabs;

use AspectMock\Test;
use Codeception\TestCase\WPTestCase;

/**
 * @covers \TypistTech\WPAdminTabs\AdminTab
 */
class AdminTabTest extends WPTestCase
{
    public function setUp()
    {
        parent::setUp();

        Test::func(__NAMESPACE__, 'get_site_url', 'https://example.com');
    }

    public function tearDown()
    {
        unset($_SERVER['REQUEST_URI']);

        parent::tearDown();
    }

    /** @test */
    public function it_is_an_instance_of_admin_tab_interface()
    {
        $adminTab = new AdminTab('My tab title', 'https://example.com/wp-admin/admin.php?page=abc');

        $this->assertInstanceOf(AdminTabInterface::class, $adminTab);
    }

    /** @test */
    public function it_has_menu_title_getter()
    {
        $adminTab = new AdminTab('My tab title', 'https://example.com/wp-admin/admin.php?page=abc');

        $this->assertSame('My tab title', $adminTab->getMenuTitle());
    }

    /** @test */
    public function it_has_url_getter()
    {
        $adminTab = new AdminTab('My tab title', 'https://example.com/wp-admin/admin.php?page=abc');

        $this->assertSame('https://example.com/wp-admin/admin.php?page=abc', $adminTab->getUrl());
    }

    /** @test */
    public function it_is_active_when_current_url_matches()
    {
        $url = 'https://example.com/wp-admin/admin.php?page=abc';
        $adminTab = new AdminTab('My tab title', $url);

        $_SERVER['REQUEST_URI'] = '/wp-admin/admin.php?page=abc';

        $this->assertTrue($adminTab->isActive());
    }

    /** @test */
    public function it_is_active_even_current_url_has_query_strings()
    {
        $url = 'https://example.com/wp-admin/admin.php?page=abc';
        $adminTab = new AdminTab('My tab title', $url);

        $_SERVER['REQUEST_URI'] = '/wp-admin/admin.php?page=abc&yyy[]=zzz';

        $this->assertTrue($adminTab->isActive());
    }

    /** @test */
    public function it_is_not_active_when_current_url_not_matches()
    {
        $url = 'https://example.com/wp-admin/admin.php?page=abc';
        $adminTab = new AdminTab('My tab title', $url);

        $_SERVER['REQUEST_URI'] = '/xxx/wp-admin/admin.php?page=abc';

        $this->assertFalse($adminTab->isActive());
    }

    /** @test */
    public function it_is_not_active_when_current_url_not_matches_2()
    {
        $url = 'https://example.com/wp-admin/admin.php?page=abc';
        $adminTab = new AdminTab('My tab title', $url);

        $_SERVER['REQUEST_URI'] = '/wp-admin/admin.php?page=zyx';

        $this->assertFalse($adminTab->isActive());
    }

    /** @test */
    public function it_is_not_active_when_current_url_not_matches_3()
    {
        $url = 'https://example.com/wp-admin/admin.php?page=abc';
        $adminTab = new AdminTab('My tab title', $url);

        $_SERVER['REQUEST_URI'] = '/wp-admin/abc.php?page=abc';

        $this->assertFalse($adminTab->isActive());
    }
}
