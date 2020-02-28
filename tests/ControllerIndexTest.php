<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/28/20
 * Time: 10:58 AM
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use system\BaseController;
use controller\Index;
use system\Environment;

class ControllerIndexTest extends TestCase
{
    public function setUp()
    {
        $environment = new Environment();
    }

    public function testShow()
    {
        $controllerShow = new Index();

        ob_start();
        $controllerShow->show();
        $actualOutput = ob_get_clean();

        $this->assertInstanceOf(BaseController::class,$controllerShow);
        $this->assertGreaterThan(1,strpos($actualOutput,"Проекты"));
    }

    public function testParamInShow()
    {
        $controllerShow = new Index();

        $param = [
            'quantity'=>10,
            'offset'=>20
        ];

        ob_start();
        $controllerShow->show($param);
        $actualOutput = ob_get_clean();

        $this->assertInstanceOf(BaseController::class,$controllerShow);
        $this->assertGreaterThan(1,strpos($actualOutput,"Проекты"));
    }

    public function testStatistics()
    {
        $controllerShow = new Index();

        ob_start();
        $controllerShow->statistics();
        $actualOutput = ob_get_clean();

        $this->assertInstanceOf(BaseController::class,$controllerShow);
        $this->assertGreaterThan(1,strpos($actualOutput,"Статистика"));

    }

    public function testGraph()
    {
        $controllerShow = new Index();

        ob_start();
        $controllerShow->graph();
        $actualOutput = ob_get_clean();

        $this->assertInstanceOf(BaseController::class,$controllerShow);
        $this->assertGreaterThan(1,strpos($actualOutput,"График"));

    }
}