<?php

use yii\db\Migration;

class m161117_100712_ChangeGroupArticles extends Migration
{
    public function up()
    {
        $this->alterColumn('articles','group_id','string(24)');
    }

    public function down()
    {
        echo "m161117_100712_ChangeGroupArticles cannot be reverted.\n";

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
