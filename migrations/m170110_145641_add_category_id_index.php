<?php

use yii\db\Migration;

class m170110_145641_add_category_id_index extends Migration
{
    public function safeUp()
    {
        $this->createIndex("category_id","entity",[
            "category_id"
        ]);
    }

    public function safeDown()
    {
    }
}
