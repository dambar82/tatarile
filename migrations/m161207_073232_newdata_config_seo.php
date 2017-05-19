<?php

use yii\db\Migration;

class m161207_073232_newdata_config_seo extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('config_seo', ['title','value'], [
            ['robots','User-agent: *
Disallow:'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('config_seo', ['id' => '1']);
    }
}
