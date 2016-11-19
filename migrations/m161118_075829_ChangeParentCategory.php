<?php

use yii\db\Migration;

class m161118_075829_ChangeParentCategory extends Migration
{
    public function up()
    {
        $this -> addColumn('category', 'parent_id', $this -> integer());
    }

    public function down()
    {
        echo "m161118_075829_ChangeParentCategory cannot be reverted.\n";

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
