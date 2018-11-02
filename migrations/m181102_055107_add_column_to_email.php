<?php

use yii\db\Migration;

class m181102_055107_add_column_to_email extends Migration
{
    public function safeUp()
    {
        $this->addColumn('subscribe_email', 'hash', $this->string(13));

        $emails = \app\models\SubscribeEmail::find()->all();

        foreach ($emails as $email) {
            $email->hash = Yii::$app->security->generateRandomString(20);
            $email->save();
        }
    }

    public function safeDown()
    {
        echo "m181102_055107_add_column_to_email cannot be reverted.\n";

        return false;
    }

}
