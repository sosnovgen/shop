<?php

use yii\db\Migration;

class m161213_095946_FilterKey extends Migration
{
    public function up()
    {
        $this->createTable('filterkey', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'key' => $this->string(36),
            'priznak' => $this->string(36),
            'created_at' =>$this->datetime(),
        ]);
    }

    public function down()
    {
        echo "m161213_095946_FilterKey cannot be reverted.\n";

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
