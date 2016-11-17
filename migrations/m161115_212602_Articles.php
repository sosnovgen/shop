<?php

use yii\db\Migration;

class m161115_212602_Articles extends Migration
{
    public function up()
    {
        $this->createTable('articles', [
            'id' => $this->primaryKey(),
            'title' => $this->string(36)->notNull(),
            'preview' => $this->string(36),
            'body' => $this->text(),
            'category_id' => $this->integer(),
            'attr_id' => $this->integer(),
            'cena' => $this->float(),
            'created_at' =>$this->datetime(),
        ]);
    }

    public function down()
    {
        echo "m161115_212602_Articles cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
