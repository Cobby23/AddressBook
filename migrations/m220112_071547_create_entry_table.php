<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%entry}}`.
 */
class m220112_071547_create_entry_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%entry}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string(),
            'company' => $this->string(),
            'address' => $this->string(),
            'phone_number' => $this->string(),
            'email' => $this->string(),
            'fax' => $this->string(),
            'mobile_number' => $this->string(),
            'note' => $this->string(),
        ]);

        $this->createIndex('user_id', '{{%entry}}', 'user_id');
        $this->addForeignKey('entry_ibfk_1', '{{%entry}}', 'user_id', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%entry}}');
    }
}
