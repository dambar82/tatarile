<?php

use yii\db\Migration;

class m161207_103849_newdata_menu extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('menu_group', ['name','type','URL','position','icon','seq'], [
            ['Video','0','','backend','fa fa-file-video-o','0'],
            ['Create Video','19','/backend/entity/create?id=2','backend','fa fa-file-video-o','0'],
            ['Videos','19','/backend/entity/index?id=2','backend','fa fa-file-video-o','0'],
            ['Video property','19','/backend/entity-property/index?id=2','backend','fa fa-file-video-o','0'],
            ['Book','0','','backend','fa fa-file-pdf-o','0'],
            ['Create Book','23','/backend/entity/create?id=4','backend','fa fa-file-pdf-o','0'],
            ['Books','23','/backend/entity/index?id=4','backend','fa fa-file-pdf-o','0'],
            ['Book property','23','/backend/entity-property/index?id=4','backend','fa fa-file-pdf-o','0'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('menu_group', ['name' => 'Video','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Create Video','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Videos','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Video property','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Book','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Create Book','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Books','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Book property','position' => 'backend']);
    }
}
