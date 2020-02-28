<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/28/20
 * Time: 1:13 AM
 */

namespace system;

class Environment
{
    public function __construct()
    {
        if (!defined('DIR')) {
            define('DIR', dirname(__FILE__) . '/../');
        }
        $param = parse_ini_file(DIR . 'env.test');
        foreach ($param as $key => $value) {
            if (!defined($key)) {
                define($key, $value);
            }
        }
    }
}