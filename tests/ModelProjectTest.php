<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/28/20
 * Time: 11:23 AM
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use model\Project;
use system\PrivatBankApi;

class ModelProjectTest extends TestCase
{
    /*public function setUp()
    {
        $environment = new Environment();
    }*/

    public function testInsertData()
    {
        $count = Project::insertData(null, null);

        $this->assertEquals(0, $count);
    }

    public function testExchange()
    {

        $pba = new PrivatBankApi();
        $exchangeRates = $pba->getData();
        $count = Project::exchange(15, 'RUB', $exchangeRates);
        $this->assertNotEquals(0, $count);
        $this->assertGreaterThan(3, $count);
        $this->assertLessThan(10, $count);

        $count = Project::exchange(15, 'UAH', $exchangeRates);
        $this->assertEquals(15, $count);

        $count = Project::exchange(10, 'USD', $exchangeRates);
        $this->assertNotEquals(0, $count);
        $this->assertGreaterThan(100, $count);
        $this->assertLessThan(600, $count);

        $count = Project::exchange(10, 'EUR', $exchangeRates);
        $this->assertNotEquals(0, $count);
        $this->assertGreaterThan(100, $count);
        $this->assertLessThan(600, $count);
    }
}