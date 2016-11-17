<?php

use yii\db\Migration;

class m161116_074117_Atribute extends Migration
{
    public function up()
    {
        $this->createTable('atribute', [
            'id' => $this->primaryKey(),
            'articles_id' => $this->integer(),
            'category_id' => $this->integer(),
            'key' => $this->string(36),
            'value' => $this->string(36),
            'created_at' =>$this->datetime(),
        ]);
    }

    public function down()
    {
        echo "m161116_074117_Atribute cannot be reverted.\n";

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
