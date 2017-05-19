<?php

use yii\db\Migration;

class m161128_061117_article_property_drop_data extends Migration
{
    public function safeUp()
    {
        $this->delete('article_property', ['title' => 'Event Date']);
        $this->delete('article_property', ['title' => 'Info']);
    }

    public function safeDown()
    {
    }
}
