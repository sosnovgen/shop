<?php

use yii\db\Migration;

class m161116_073500_AddColumnArticles extends Migration
{
    public function up()
    {
        $this -> addColumn('articles', 'group_id', $this -> integer());
        $this -> addColumn('articles', 'meta_description', $this -> string());
        $this -> addColumn('articles', 'meta_keywords', $this -> string());
    }

    public function down()
    {
        echo "m161116_073500_AddColumnArticles cannot be reverted.\n";

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
