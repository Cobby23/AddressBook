<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entry_to_label".
 *
 * @property int $id
 * @property int $entry_id
 * @property int $label_id
 *
 * @property Entry $entry
 * @property Label $label
 */
class EntryToLabel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entry_to_label';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entry_id', 'label_id'], 'required'],
            [['entry_id', 'label_id'], 'integer'],
            [['entry_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entry::className(), 'targetAttribute' => ['entry_id' => 'id']],
            [['label_id'], 'exist', 'skipOnError' => true, 'targetClass' => Label::className(), 'targetAttribute' => ['label_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entry_id' => 'Entry ID',
            'label_id' => 'Label ID',
        ];
    }

    /**
     * Gets query for [[Entry]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntry()
    {
        return $this->hasOne(Entry::className(), ['id' => 'entry_id']);
    }

    /**
     * Gets query for [[Label]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLabel()
    {
        return $this->hasOne(Label::className(), ['id' => 'label_id']);
    }
}
