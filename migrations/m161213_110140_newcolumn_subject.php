<?php

use yii\db\Migration;

class m161213_110140_newcolumn_subject extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%subject}}','filename',$this->string());
        $this->addColumn('{{%subject}}','date_status',$this->integer());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%subject}}','filename');
        $this->dropColumn('{{%subject}}','date_status');
    }

}
