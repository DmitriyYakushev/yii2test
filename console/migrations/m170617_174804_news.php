<?php

use yii\db\Migration;

class m170617_174804_news extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('news', [
            'news_id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'title' => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
            'text' => $this->text(),
            'img_url' => $this->string(255)->notNull(),
            'news_date' => $this->integer(),
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropPrimaryKey('news_id', 'news');
        $this->dropTable('news');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170617_174804_news cannot be reverted.\n";

        return false;
    }
    */
}
