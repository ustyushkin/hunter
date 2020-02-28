<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/28/20
 * Time: 11:42 AM
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use model\SkillDesc;

class ModelSkillDescTest extends TestCase
{

    public function testInsertData()
    {
        $count = SkillDesc::insertData(null, null);

        $this->assertEquals(0, $count);
    }
}