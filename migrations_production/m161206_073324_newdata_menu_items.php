<?php

use yii\db\Migration;

class m161206_073324_newdata_menu_items extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('menu_group', ['name','type','URL','position','icon','seq'], [
            ['Subject','0','','backend','fa fa-file-code-o','0'],
            ['Subjects','12','/backend/subject','backend','fa fa-file-code-o','0'],
            ['Subject property','12','/backend/subject-property','backend','fa fa-file-code-o','0'],
            ['Article','0','','backend','fa fa-file-code-o','0'],
            ['Create Article','15','/backend/entity/create?id=1','backend','fa fa-file-code-o','0'],
            ['Articles','15','/backend/entity/index','backend?id=1','fa fa-file-code-o','0'],
            ['Article property','15','/backend/entity-property/index?id=1','backend','fa fa-file-code-o','0'],
            ['Video','0','','backend','fa fa-file-video-o','0'],
            ['Create Video','19','/backend/entity/create?id=2','backend','fa fa-file-video-o','0'],
            ['Videos','19','/backend/entity/index?id=2','backend','fa fa-file-video-o','0'],
            ['Video property','19','/backend/entity-property/index?id=2','backend','fa fa-file-video-o','0'],
            ['Audio','0','','backend','fa fa-file-audio-o','0'],
            ['Create Audio','23','/backend/entity/create?id=3','backend','fa fa-file-audio-o','0'],
            ['Audios','23','/backend/entity/index?id=3','backend','fa fa-file-audio-o','0'],
            ['Audio property','23','/backend/entity-property/index?id=3','backend','fa fa-file-audio-o','0'],
            ['Book','0','','backend','fa fa-file-pdf-o','0'],
            ['Create Book','27','/backend/entity/create?id=4','backend','fa fa-file-pdf-o','0'],
            ['Books','27','/backend/entity/index?id=4','backend','fa fa-file-pdf-o','0'],
            ['Book property','27','/backend/entity-property/index?id=4','backend','fa fa-file-pdf-o','0'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('menu_group', ['name' => 'Subject','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Subjects','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Subject property','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Article','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Create Article','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Articles','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Article property','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Video','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Create Video','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Videos','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Video property','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Audio','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Create Audio','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Audios','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Audio property','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Book','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Create Book','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Books','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Book property','position' => 'backend']);
    }
}
