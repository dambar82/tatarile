<?php

use yii\db\Migration;

class m161121_112836_article_keywords extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%article}}','keywords',$this->string());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%article}}','keywords');
    }
}
