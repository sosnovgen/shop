<?php

use yii\db\Migration;

class m161215_083111_FilterValue extends Migration
{
    public function up()
    {
        $this->createTable('filtervalue', [
            'id' => $this->primaryKey(),
            'filterkey_id' => $this->integer(),
            'value' => $this->string(36),
            'created_at' =>$this->datetime(),
        ]);
    }

    public function down()
    {
        echo "m161215_083111_FilterValue cannot be reverted.\n";

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
