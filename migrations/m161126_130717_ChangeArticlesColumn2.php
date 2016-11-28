<?php

use yii\db\Migration;

class m161126_130717_ChangeArticlesColumn2 extends Migration
{
    public function up()
    {
        $this->alterColumn('articles','title','string(128) NOT NULL');
    }

    public function down()
    {
        echo "m161126_130717_ChangeArticlesColumn2 cannot be reverted.\n";

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
