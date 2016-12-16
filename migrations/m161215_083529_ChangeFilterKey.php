<?php

use yii\db\Migration;

class m161215_083529_ChangeFilterKey extends Migration
{
    public function up()
    {
        $this -> addColumn('filterkey', 'enable', $this -> boolean());
    }

    public function down()
    {
        echo "m161215_083529_ChangeFilterKey cannot be reverted.\n";

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
