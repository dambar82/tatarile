<?php

use yii\db\Migration;

class m161121_132420_article_property_data extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('article_property', ['title','type_id','view'], [
            ['Article title',1,1],
            ['Event Date',1,0],
            ['Annotation',2,0],
            ['Information Source',1,0],
            ['Info',1,0],
        ]);
    }

    public function safeDown()
    {
        $this->delete('article_property', ['title' => 'Article title']);
        $this->delete('article_property', ['title' => 'Event Date']);
        $this->delete('article_property', ['title' => 'Annotation']);
        $this->delete('article_property', ['title' => 'Information Source']);
        $this->delete('article_property', ['title' => 'Info']);
    }
}
