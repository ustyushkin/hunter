<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/27/20
 * Time: 7:18 PM
 */

namespace console;

include __DIR__ . '/../vendor/autoload.php';

use system\HunterApi;
use model\Project;
use system\PrivatBankApi;
use ActiveRecord;
use system\Environment;

ini_set('max_execution_time', 900);

$environment = new Environment();
$countNewRecord = 0;

$cfg = ActiveRecord\Config::instance();
$cfg->set_model_directory(DIR . 'model');
$cfg->set_connections(
    [
        'test' => MYSQL,
    ]
);

ActiveRecord\Config::initialize(function ($cfg) {
    $cfg->set_default_connection('test');
});

echo "start receiving data...\n";

$exchange = (new PrivatBankApi())->getData();

$ha = new HunterApi();
$data = $ha->getFirstPage();

if (!isset($data['error'])) {
    while ($data) {
        if (!isset($data['error'])) {
            $countNewRecord = Project::insertData($data, $exchange);
            echo "getted $countNewRecord new record from page\n";
            $data = $ha->getNextPage();
            $countNewRecord = 0;
        } else {
            break;
        }
    }
} else {
    echo "Error: " . $data['error']['detail'] . "\n";
}
echo "done.\n";