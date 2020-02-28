<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/27/20
 * Time: 12:23 AM
 */

namespace Model;

use ActiveRecord\Model;
use model\Skill;

class Project extends Model
{
    static $table_name = 'project';

    public static function insertData($data, $exchange)
    {
        $countNewRecord = 0;
        if (is_array($data) && !isset($data['status'])) {
            foreach ($data['data'] as $item) {
                $checksum = md5($item['id'] . $item['attributes']['name'] . $item['attributes']['budget']['amount'] . $item['attributes']['status']['id']);
                $project = self::first([
                    'conditions' => [
                        'project_id_hunter=?',
                        $item['id']
                    ]
                ]);
                if (!$project || $project->checksum != $checksum) {
                    if (!$project) {
                        $project = new Project();
                        $countNewRecord++;
                    }
                    //echo($item['id']."<br>");
                    $project->project_id_hunter = $item['id'];
                    $project->name = $item['attributes']['name'];
                    $project->link = $item['links']['self']['web'];
                    $project->amount = $item['attributes']['budget']['amount'];
                    $project->amount_uah = self::exchange(
                        $item['attributes']['budget']['amount'],
                        $item['attributes']['budget']['currency'],
                        $exchange);
                    $project->currency = $item['attributes']['budget']['currency'];
                    $project->user_name = $item['attributes']['employer']['first_name'] . ' ' . $item['attributes']['employer']['last_name'];
                    $project->login = $item['attributes']['employer']['login'];
                    $project->status = $item['attributes']['status']['id'];
                    $project->checksum = $checksum;
                    $project->save();

                }
                $id_project = $project->id;
                Skill::insertData($id_project, $item['attributes']['skills']);
            }
        }
        return $countNewRecord;
    }

    public static function exchange($amount, $currency, $exchange)
    {
        $result = $amount;
        switch ($currency) {
            case 'USD':
                $result = $amount * $exchange['USD']['sale'];
                break;
            case 'EUR':
                $result = $amount * $exchange['EUR']['sale'];
                break;
            case 'RUB':
                $result = $amount * $exchange['RUR']['sale'];
                break;
            default:
                break;
        }
        return $result;
    }
}