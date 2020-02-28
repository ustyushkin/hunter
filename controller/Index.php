<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/26/20
 * Time: 9:04 PM
 */

namespace controller;

use system\BaseController;
use model\Project;
use model\Skill;
use raw\RawSQL;

class Index extends BaseController
{
    public function show($param = null)
    {

        $countProjects = Project::find_by_sql(RawSQL::SQL_COUNT_PROJECT_WITH_FILTER)[0]->count;

        $limit = isset($param['quantity']) && $param['quantity'] > 0 && $param['quantity'] < 100 ? $param['quantity'] : 10;
        $offset = isset($param['offset']) && $param['offset'] > 0 && $param['offset'] <= $countProjects ? $param['offset'] : 0;

        $projects = Project::all(
            [
                'conditions' => 's.skill_id_hunter IN (1,86,99) AND project.status=11',
                'joins' => 'join skill AS s ON (project.id = s.project_id)',
                'group' => 'project.id',
                'limit' => $limit,
                'offset' => $offset
            ]
        );
        //print_r($projects);
        echo $this->twigInstance->render('indexShow.twig',
            ['projects' => $projects, 'count' => $countProjects, 'limit' => $limit, 'offset' => $offset]);
    }


    public function statistics($param = null)
    {
        $skills = Skill::all(
            [
                'select' => 'sd.desc,count(*) AS count',
                'conditions' => 'p.status=11',
                'joins' => 'JOIN project AS p ON (skill.project_id=p.id) 
                            JOIN skill_desc AS sd ON (skill.skill_id_hunter = sd.skill_id_hunter)',
                'group' => 'sd.skill_id_hunter',
                'order' => 'count DESC'
            ]
        );
        echo $this->twigInstance->render('indexStatistics.twig',
            ['skills' => $skills]);
    }

    public function graph($param = null)
    {
        $projects = Project::find_by_sql(RawSQL::SQL_GRAPH);
        echo $this->twigInstance->render('indexGraph.twig',
            ['projects' => $projects]);
    }

}