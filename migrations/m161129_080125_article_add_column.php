<?php

use yii\db\Migration;

class m161129_080125_article_add_column extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%article}}','subcategory_id',$this->integer()->after('category_id')->notNull());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%article}}','subcategory_id');
    }
}
