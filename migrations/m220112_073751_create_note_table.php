<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%note}}`.
 */
class m220112_073751_create_note_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%note}}', [
            'id' => $this->primaryKey(),
            'entry_id' => $this->integer()->notNull(),
            'note' => $this->text(),
        ]);

        $this->createIndex('entry_id', '{{%note}}', 'entry_id');
        $this->addForeignKey('note_ibfk_1', '{{%note}}', 'entry_id', '{{%entry}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%note}}');
    }
}
