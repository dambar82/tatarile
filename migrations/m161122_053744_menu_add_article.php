<?php

use yii\db\Migration;

class m161122_053744_menu_add_article extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('menu_group', ['name','type','URL','position','icon','seq'], [
            ['Article','0','','backend','fa fa-file-code-o','0'],
            ['Create Article','15','/backend/article/create','backend','fa fa-file-code-o','0'],
            ['Articles','15','/backend/article/index','backend','fa fa-file-code-o','0'],
            ['Article property','15','/backend/article-property/index','backend','fa fa-file-code-o','0'],
        ]);

    }

    public function safeDown()
    {
        $this->delete('menu_group', ['name' => 'Article','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Create Article','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Articles','position' => 'backend']);
        $this->delete('menu_group', ['name' => 'Article property','position' => 'backend']);
    }
}
