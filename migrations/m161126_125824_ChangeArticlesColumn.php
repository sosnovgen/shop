<?php

use yii\db\Migration;

class m161126_125824_ChangeArticlesColumn extends Migration
{
    public function up()
    {
        $this->alterColumn('articles','title','string(128)');
    }

    public function down()
    {
        echo "m161126_125824_ChangeArticlesColumn cannot be reverted.\n";

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
