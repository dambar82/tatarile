<?php

use yii\db\Migration;

class m161201_102154_edit_backend_menu extends Migration
{
    public function safeUp()
    {
        $this->update('menu_group',array('URL' => '/backend/entity/create'),array('name'=>'Create Article'));
        $this->update('menu_group',array('URL' => '/backend/entity/index'),array('name'=>'Articles'));
        $this->update('menu_group',array('URL' => '/backend/entity-property/index'),array('name'=>'Article property'));
    }

    public function safeDown()
    {
    }
}
