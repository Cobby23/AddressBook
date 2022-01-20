<?php

namespace app\models;

use Yii;

class Label extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'label';
    }

    public function rules()
    {
        return [
            [['color', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['title', 'color'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'color' => 'Color',
            'user_id' => 'User ID',
        ];
    }

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

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
