<?php

use yii\db\Migration;

class m161116_060736_menu_items extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('menu_group', ['name','type','URL','position','icon','seq'], [
            ['Subject','0','','backend','fa fa-file-code-o','0'],
            ['Subjects','12','/backend/subject','backend','fa fa-file-code-o','0'],
            ['Subject property','12','/backend/subject-property','backend','fa fa-file-code-o','0'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('menu_group', ['name' => 'Subject','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Subjects','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Subject property','position' => 'backend']);
    }
}
