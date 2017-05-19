<?php
namespace app\commands;

use yii\console\Controller;

class HelloController extends Controller
{
    public function actionIndex()
    {$entity='audio';
        exec('yii migrate/create create_entity_eav_'.$entity.'_table --fields=entity_id:integer,lang_id:integer,property_id:integer,value:text --interactive=0');
        exec('yii migrate/up --interactive=0');
    }
}