<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/26/20
 * Time: 7:41 PM
 */

namespace system;

use Exception;

class Router
{
    public function run()
    {
        $path = explode('/', $_SERVER['REQUEST_URI']);
        try {
            $this->defaultPath($path);
            $className = 'controller\\' . ucfirst($path[1]);
            $methodName = $path[2];
            $param = $this->parsingParam();
            if ((!class_exists($className)) || (!method_exists($className, $methodName))) {
                throw new Exception('Вероятно, страница отсутствует.');
            }
            $inst = new $className();
            $inst->$methodName($param);
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            session_write_close();
            header('location:/error/show/');
        }
    }

    protected function parsingParam()
    {
        $result = [];
        $parsedUrl = parse_url($_SERVER['REQUEST_URI']);
        if (isset($parsedUrl['query'])) {
            $params = explode('&', $parsedUrl['query']);
            foreach ($params as $param) {
                if (strpos($param, '=') !== false) {
                    $explodedParam = explode('=', $param);
                    $result[$explodedParam[0]] = $explodedParam[1];
                }
            }
        }
        return $result;
    }

    protected function defaultPath(&$path)
    {
        if (!isset($path[1]) || $path[1] == '') {
            $path[1] = 'index';
        }
        if (!isset($path[2]) || $path[2] == '') {
            $path[2] = 'show';
        }
    }
}