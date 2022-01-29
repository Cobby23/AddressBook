<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "custom_fields".
 *
 * @property int $id
 * @property string $label
 * @property string $content
 * @property int|null $entry_id
 *
 * @property Entry $entry
 */
class CustomFields extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'custom_fields';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label', 'content'], 'required'],
            [['entry_id'], 'integer'],
            [['label', 'content'], 'string', 'max' => 255],
            [['entry_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entry::className(), 'targetAttribute' => ['entry_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
            'content' => 'Content',
            'entry_id' => 'Entry ID',
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

    public static function getFieldsByEntryQuery($entry_id){
        return CustomFields::find()->where(['entry_id' => $entry_id]);
    }
}
