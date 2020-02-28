<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/27/20
 * Time: 12:05 AM
 */

namespace system;

use ActiveRecord;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class BaseController
{
    protected $twigInstance;

    public function __construct()
    {
        $this->initActiveRecord();
        $this->initTwig();
    }

    protected function initActiveRecord()
    {
        $cfg = ActiveRecord\Config::instance();
        $cfg->set_model_directory(DIR . 'model');
        $cfg->set_connections(
            [
                'test' => MYSQL,
            ]
        );
        ActiveRecord\Config::initialize(function ($cfg) {
            $cfg->set_default_connection(ENV);
        });
    }

    protected function initTwig()
    {
        $loader = new FilesystemLoader(DIR . 'template');
        $this->twigInstance = new Environment($loader);
    }
}