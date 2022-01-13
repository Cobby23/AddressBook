<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "label".
 *
 * @property int $id
 * @property string|null $title
 * @property string $color
 * @property int $user_id
 *
 * @property EntryToLabel[] $entryToLabels
 * @property User $user
 */
class Label extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'label';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['title', 'color'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'color' => 'Color',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[EntryToLabels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntryToLabels()
    {
        return $this->hasMany(EntryToLabel::className(), ['label_id' => 'id']);
    }

    public static function getUserLabels(){
        return Label::find()->where(['user_id' => Yii::$app->user->id])->all();
    }

    public static function getLabelDropdown(){
        $labels = Label::getUserLabels();
        $return = array();

        foreach($labels as $label){
            $return[$label['id']] = $label->title;
        }

        return $return;
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
