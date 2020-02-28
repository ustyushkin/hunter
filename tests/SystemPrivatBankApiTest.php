<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/28/20
 * Time: 11:46 AM
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use system\PrivatBankApi;

class SystemPrivatBankApiTest extends TestCase
{

    public function testGetData()
    {
        $ha = new PrivatBankApi();
        $data = $ha->getData();
        $this->assertEquals(true, is_array($data));
    }

}