<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/28/20
 * Time: 11:40 AM
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use model\Skill;

class ModelSkillTest extends TestCase
{

    public function testInsertData()
    {
        $count = Skill::insertData(null, null);

        $this->assertEquals(0, $count);
    }
}