<?php

use yii\db\Migration;

class m161223_132642_newdata_menu_231216 extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('menu_group', ['name','type','URL','position','icon','seq'], [
            ['Article Success','15','/backend/entity/success?id=1','backend','fa fa-book','0'],
            ['Book Success','23','/backend/entity/success?id=4','backend','fa fa-file-pdf-o','0'],
            ['Video Success','19','/backend/entity/success?id=2','backend','fa fa-file-video-o','0'],
            ['All Article','15','/backend/entity/all?id=1','backend','fa fa-book','0'],
            ['All Book','23','/backend/entity/all?id=4','backend','fa fa-file-pdf-o','0'],
            ['All Video','19','/backend/entity/all?id=2','backend','fa fa-file-video-o','0'],
        ]);
    }

    public function safeDown()
    {

    }
}
