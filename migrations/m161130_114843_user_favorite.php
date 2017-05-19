<?php

use yii\db\Migration;
use yii\db\Schema;

class m161130_114843_user_favorite extends Migration
{
  public function safeUp()
  {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%user_favorite}}', [
          'id' => Schema::TYPE_PK,
          'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
          'entity_id' => Schema::TYPE_INTEGER . ' NOT NULL',
      ], $tableOptions);
  }

  public function safeDown()
  {
      $this->dropTable('{{%user_favorite}}');
  }
}
