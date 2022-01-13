<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lable}}`.
 */
class m220112_161942_create_lable_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%label}}', [
            'id' => $this->primaryKey(),
            'entry_id' => $this->integer(),
            'title' => $this->string(),
            'color' => $this->string()->notNull(),
        ]);

        $this->createIndex('entry_id', '{{%label}}', 'entry_id');
        $this->addForeignKey('label_ibfk_1', '{{%label}}', 'entry_id', '{{%entry}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%label}}');
    }
}
