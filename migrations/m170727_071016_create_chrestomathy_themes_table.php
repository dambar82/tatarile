<?php

use yii\db\Migration;

/**
 * Handles the creation of table `chrestomathy_themes`.
 */
class m170727_071016_create_chrestomathy_themes_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('chrestomathy_themes', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'comment' => $this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('chrestomathy_themes');
    }
}
