<?php

namespace app\models;

use Yii;

class EntryToLabel extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'entry_to_label';
    }

    public function rules()
    {
        return [
            [['entry_id'], 'validateUnique'],
            [['entry_id', 'label_id'], 'required'],
            [['entry_id', 'label_id'], 'integer'],
            [['entry_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entry::className(), 'targetAttribute' => ['entry_id' => 'id']],
            [['label_id'], 'exist', 'skipOnError' => true, 'targetClass' => Label::className(), 'targetAttribute' => ['label_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entry_id' => 'Entry ID',
            'label_id' => 'Label ID',
        ];
    }

    public function getEntry()
    {
        return $this->hasOne(Entry::className(), ['id' => 'entry_id']);
    }

    public function getLabel()
    {
        return $this->hasOne(Label::className(), ['id' => 'label_id']);
    }

    public function validateUnique($attribute)
    {
        if (EntryToLabel::find()->where(['entry_id' => $this->entry_id])->andWhere(['label_id' => $this->label_id])->one()) {
            $this->addError('label_id', 'This tag already exists for this entry');
        }
    }
}
