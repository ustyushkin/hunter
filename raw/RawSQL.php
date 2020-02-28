<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/26/20
 * Time: 9:04 PM
 */
namespace raw;

class RawSQL
{
    const SQL_COUNT_PROJECT_WITH_FILTER = "
            SELECT COUNT(*) AS count FROM
            (
                SELECT project.id FROM `project` 
                JOIN skill AS s ON (project.id = s.project_id) 
                WHERE s.skill_id_hunter IN (1,86,99) AND project.status=11
                GROUP BY project.id
            ) a
        ";

    const SQL_GRAPH = "
            SELECT COUNT(*) AS count, 'менее 500' AS text 
                FROM project 
                WHERE amount_uah<500    
            UNION
            SELECT COUNT(*) AS count, 'от 500 до 1000' AS text 
                FROM project 
                WHERE amount_uah>=500 AND amount_uah<1000
            UNION
            SELECT COUNT(*) AS count, 'от 1000 до 5000' AS text 
                FROM project 
                WHERE amount_uah>=1000 AND amount_uah<5000
            UNION
            SELECT COUNT(*) AS count, 'от 5000 до 10000' AS text 
                FROM project 
                WHERE amount_uah>=5000 AND amount_uah<10000
            UNION
            SELECT COUNT(*) AS count, 'более 10000' AS text 
                FROM project 
                WHERE amount_uah>=10000
        ";
}