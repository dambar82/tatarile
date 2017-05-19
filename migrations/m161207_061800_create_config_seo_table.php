<?php

use yii\db\Migration;

/**
 * Handles the creation of table `config_seo`.
 */
class m161207_061800_create_config_seo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('config_seo', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'value' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('config_seo');
    }
}
