<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/28/20
 * Time: 11:46 AM
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use system\Environment;

class SystemEnvironmentTest extends TestCase
{

    public function testInitTwig()
    {
        $environment = new Environment();

        $this->assertEquals(true, defined('ENV'));
        $this->assertEquals(true, defined('DIR'));
        $this->assertEquals(true, defined('MYSQL'));
        $this->assertEquals(true, defined('HUNTER_API_TOKEN'));
        $this->assertEquals(true, defined('HUNTER_API_URL'));
        $this->assertEquals(true, defined('PRIVAT_BANK_API_URL'));

    }

}