<?php

use yii\db\Migration;

class m161116_103233_ChangeBodyCategore extends Migration
{
    public function up()
    {
        $this->alterColumn('category','body','string(264)');
    }

    public function down()
    {
        echo "m161116_103233_ChangeBodyCategore cannot be reverted.\n";

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
