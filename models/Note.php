<?php

namespace app\models;

use Yii;

class Note extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'note';
    }

    public function rules()
    {
        return [
            [['entry_id'], 'required'],
            [['entry_id'], 'integer'],
            [['note'], 'string'],
            [['entry_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entry::className(), 'targetAttribute' => ['entry_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entry_id' => 'Entry ID',
            'note' => 'Note',
        ];
    }

    public function getEntry()
    {
        return $this->hasOne(Entry::className(), ['id' => 'entry_id']);
    }
}
