<?php

use yii\db\Migration;

/**
 * Class m220113_094251_add_user_relation_in_label
 */
class m220113_094251_add_user_relation_in_label extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%label}}','user_id', $this->integer()->notNull());
        $this->createIndex('user_id', '{{%label}}', 'user_id');
        $this->addForeignKey('label_ibfk_2', '{{%label}}', 'user_id', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('label_ibfk_2', '{{%label}}');
        $this->dropColumn('{{%label}}', 'user_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220113_094251_add_user_relation_in_label cannot be reverted.\n";

        return false;
    }
    */
}
