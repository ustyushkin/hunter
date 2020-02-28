<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/28/20
 * Time: 11:46 AM
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use system\BaseController;
use system\Environment;
use Twig\Environment as TwigEnv;

class SystemBaseControllerTest extends TestCase
{
    public function setUp()
    {
        $environment = new Environment();
    }

    public function testInitTwig()
    {
        $object = new BaseController();

        $reflected_data = $this->_getInnerPropertyValueByReflection($object, 'twigInstance');
        $this->assertInstanceOf(TwigEnv::class, $reflected_data);

    }

    private function _getInnerPropertyValueByReflection(BaseController $instance, $property = 'twigInstance')
    {
        $reflector = new ReflectionClass($instance);
        $reflector_property = $reflector->getProperty($property);
        $reflector_property->setAccessible(true);
        return $reflector_property->getValue($instance);
    }
}