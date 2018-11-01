<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subscribe_email`.
 */
class m181031_114858_create_subscribe_email_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('subscribe_email', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull()->unique()->comment('Комментарий')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('subscribe_email');
    }
}
