<?php

use yii\db\Migration;
use yii\db\Schema;

class m161125_102531_user_info extends Migration
{
  public function safeUp()
  {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%user_info}}', [
          'id' => Schema::TYPE_PK,
          'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
          'last_name' => Schema::TYPE_STRING . ' NOT NULL',
          'first_name' => Schema::TYPE_STRING . ' NOT NULL',
          'middle_name' => Schema::TYPE_STRING,
          'birthday' => Schema::TYPE_STRING . ' NOT NULL',
          'school' => Schema::TYPE_STRING,
          'school_class' => Schema::TYPE_STRING,
          'address' => Schema::TYPE_STRING,
          'file_name' => Schema::TYPE_STRING,
      ], $tableOptions);
  }

  public function safeDown()
  {
      $this->dropTable('{{%user_info}}');
  }
}
