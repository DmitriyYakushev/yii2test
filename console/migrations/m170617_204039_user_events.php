<?php

use yii\db\Migration;

class m170617_204039_user_events extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('user_events', [
            'event_id' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
        ], $tableOptions);

        $this->addForeignKey('FK_user', 'user_events', 'user_id', 'users', 'user_id', 'cascade', 'cascade');
        $this->addForeignKey('FK_event', 'user_events', 'event_id', 'events', 'event_id', 'cascade', 'cascade');
        $this->createIndex('IDX_user_events', 'user_events', ['event_id', 'user_id'], true);
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_user', 'user_events');
        $this->dropForeignKey('FK_event', 'user_events');
        $this->dropIndex('IDX_user_events', 'user_events');
        $this->dropTable('user_events');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170617_204039_user_events cannot be reverted.\n";

        return false;
    }
    */
}
