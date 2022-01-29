<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%custom_fields}}`.
 */
class m220126_190701_create_custom_fields_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%custom_fields}}', [
            'id' => $this->primaryKey(),
            'label' => $this->string()->notNull(),
            'content' => $this->string()->notNUll(),
            'entry_id' => $this->integer()
        ]);

        $this->createIndex('entry_id', '{{%custom_fields}}', 'entry_id');
        $this->addForeignKey('custom_firelds_ibfk_1', '{{%custom_fields}}', 'entry_id', '{{%entry}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%custom_fields}}');
    }
}
