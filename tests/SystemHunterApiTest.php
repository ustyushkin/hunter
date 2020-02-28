<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/28/20
 * Time: 11:46 AM
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use system\HunterApi;

class SystemHunterApiTest extends TestCase
{

    public function testHunterApiGetFirstPage()
    {
        $ha = new HunterApi();
        $data = $ha->getFirstPage();
        $this->assertEquals(true, is_array($data));
    }

    public function testHunterApiGetNextPage()
    {
        $ha = new HunterApi();
        $data = $ha->getNextPage();
        $this->assertEquals(true, is_array($data));
    }

}