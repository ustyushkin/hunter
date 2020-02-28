<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/27/20
 * Time: 12:23 AM
 */

namespace Model;

use ActiveRecord\Model;

class SkillDesc extends Model
{
    static $table_name = 'skill_desc';

    public static function insertData($id, $desc)
    {
        if (isset($id, $desc)) {
            $skill = self::first([
                'conditions' => [
                    'skill_id_hunter=?',
                    $id
                ]
            ]);
            if (!$skill) {
                $skill = new SkillDesc();
                $skill->skill_id_hunter = $id;
                $skill->desc = $desc;
                $skill->save();
            }
        }
    }
}