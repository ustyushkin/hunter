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

class SystemRouterTest extends TestCase
{
    public function setUp()
    {
        $environment = new Environment();
    }

    //the local server must be running
    public function testDefaultPath()
    {
        $this->headers = $query = '';
        $this->response = Request::get('http://localhost:8000', $this->headers, $query);
        $this->assertGreaterThan(1,strpos($this->response->body ,"Проекты"));
    }

    //the local server must be running
    public function testIndexShowPath()
    {
        $this->headers = $query = '';
        $this->response = Request::get('http://localhost:8000/index/show/', $this->headers, $query);
        $this->assertGreaterThan(1,strpos($this->response->body ,"Проекты"));
    }

    //the local server must be running
    public function testIndexStatisticsPath()
    {
        $this->headers = $query = '';
        $this->response = Request::get('http://localhost:8000/index/statistics/', $this->headers, $query);
        $this->assertGreaterThan(1,strpos($this->response->body ,"Статистика"));
    }

    //the local server must be running
    public function testIndexGraphPath()
    {
        $this->headers = $query = '';
        $this->response = Request::get('http://localhost:8000/index/graph/', $this->headers, $query);
        $this->assertGreaterThan(1,strpos($this->response->body ,"График"));
    }

    //the local server must be running
    public function testErrorPath()
    {
        $this->headers = $query = '';
        $this->response = Request::get('http://localhost:8000/indearbaernhaerhaph/', $this->headers, $query);
        $this->assertGreaterThan(1,strpos($this->response->body ,"Вероятно, страница отсутствует."));
    }

    //the local server must be running
    public function testErrorPathWithWrongParam()
    {
        $this->headers = $query = '';
        $this->response = Request::get('http://localhost:8000/indearbaernhaerhaph/?aerg=45yvw4&eargeagv=45yvw45yv45y&ervgegersgsreg=000000000000000000000', $this->headers, $query);
        $this->assertGreaterThan(1,strpos($this->response->body ,"Вероятно, страница отсутствует."));
    }

    //the local server must be running
    public function testIndexPathWithWrongMethodAndParam()
    {
        $this->headers = $query = '';
        $this->response = Request::get('http://localhost:8000/index//?aerg=45yvw4&eargeagv=45yvw45yv45y&ervgegersgsreg=000000000000000000000', $this->headers, $query);
        $this->assertGreaterThan(1,strpos($this->response->body ,"Проекты"));
    }
}