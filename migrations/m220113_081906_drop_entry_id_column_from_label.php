<?php

use yii\db\Migration;

/**
 * Class m220113_081906_drop_entry_id_column_from_label
 */
class m220113_081906_drop_entry_id_column_from_label extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('label_ibfk_1', '{{%label}}');
        $this->dropColumn('{{%label}}', 'entry_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%label}}', 'entry_id', 'integer');
        $this->addForeignKey('label_ibfk_1', '{{%label}}', 'entry_id', '{{%entry}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220113_081906_drop_entry_id_column_from_label cannot be reverted.\n";

        return false;
    }
    */
}
