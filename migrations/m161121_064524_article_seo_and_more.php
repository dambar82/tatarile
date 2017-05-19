<?php

use yii\db\Migration;

class m161121_064524_article_seo_and_more extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%article}}','category_id',$this->integer()->after('id')->notNull());
        $this->addColumn('{{%article}}','description',$this->text());
        $this->addColumn('{{%article}}','slug',$this->string());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%article}}','description');
        $this->dropColumn('{{%article}}','slug');
        $this->dropColumn('{{%article}}','category_id');
    }
}
