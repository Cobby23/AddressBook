<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%entry_to_label}}`.
 */
class m220113_082311_create_entry_to_label_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%entry_to_label}}', [
            'id' => $this->primaryKey(),
            'entry_id' => $this->integer()->notNull(),
            'label_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('entry_id', '{{%entry_to_label}}', 'entry_id');
        $this->createIndex('label_id', '{{%entry_to_label}}', 'label_id');
        $this->addForeignKey('entry_to_label_ibfk_1', '{{%entry_to_label}}', 'entry_id', '{{%entry}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('entry_to_label_ibfk_2', '{{%entry_to_label}}', 'label_id', '{{%label}}', 'id', 'RESTRICT', 'RESTRICT');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%entry_to_label}}');
    }
}
