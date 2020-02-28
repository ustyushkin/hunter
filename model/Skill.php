<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/27/20
 * Time: 12:23 AM
 */

namespace Model;

use ActiveRecord\Model;
use model\SkillDesc;

class Skill extends Model
{
    static $table_name = 'skill';

    public static function insertData($project_id, $data)
    {
        if (is_array($data)&&isset($project_id)) {
            foreach ($data as $item) {
                $skill = self::first([
                    'conditions' => [
                        'project_id=? AND skill_id_hunter=?',
                        $project_id,
                        $item['id']
                    ]
                ]);
                if (!$skill) {
                    $skill = new Skill();
                    $skill->skill_id_hunter = $item['id'];
                    $skill->project_id = $project_id;
                    $skill->save();
                }

                SkillDesc::insertData($item['id'], $item['name']);
            }
        }
    }
}