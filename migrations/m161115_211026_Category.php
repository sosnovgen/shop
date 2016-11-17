<?php

use yii\db\Migration;

class m161115_211026_Category extends Migration
{
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'title' => $this->string(36)->notNull(),
            'preview' => $this->string(36),
            'body' => $this->string(36),
            'atribut_id' => $this->integer(),
            'created_at' =>$this->datetime(),
        ]);
    }

    public function down()
    {
        echo "m161115_211026_Category cannot be reverted.\n";

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
