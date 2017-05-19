<?php

use yii\db\Migration;
use yii\db\Schema;

class m161130_104228_drop_column_images extends Migration
{
  public function safeUp()
  {
      $this->dropColumn('{{%images}}', 'article_id');
  }
}
