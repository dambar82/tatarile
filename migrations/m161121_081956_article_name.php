<?php

use yii\db\Migration;

class m161121_081956_article_name extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%article}}','title',$this->string()->notNull());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%article}}','title');
    }
}
