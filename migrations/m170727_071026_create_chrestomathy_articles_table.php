<?php

use yii\db\Migration;

/**
 * Handles the creation of table `chrestomathy_articles`.
 */
class m170727_071026_create_chrestomathy_articles_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('chrestomathy_articles', [
            'id' => $this->primaryKey(),
            'theme_id' => $this->integer(),
            'image' => $this->string(),
            'title' => $this->string()->notNull(),
            'author' => $this->string(),
            'content' => $this->text()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('chrestomathy_articles');
    }
}
