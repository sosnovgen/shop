<?php

use yii\db\Migration;

class m161126_135013_ChangeKeyAutribute extends Migration
{
    public function up()
    {
        $this->alterColumn('atribute','key','string(128)');
        $this->alterColumn('atribute','value','string(128)');
    }

    public function down()
    {
        echo "m161126_135013_ChangeKeyAutribute cannot be reverted.\n";

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
