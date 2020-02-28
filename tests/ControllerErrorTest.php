<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/28/20
 * Time: 10:17 AM
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use system\BaseController;
use Unirest\Request;
use controller\Error;
use system\Environment;

class ControllerErrorTest extends TestCase
{
    public function setUp()
    {
        $environment = new Environment();
    }

    public function testshow()
    {
        $controllerShow = new Error();

        ob_start();
        $controllerShow->show(0);
        $actualOutput = ob_get_clean();

        $this->assertInstanceOf(BaseController::class, $controllerShow);
        $this->assertGreaterThan(1, strpos($actualOutput, "<html"));
    }
}