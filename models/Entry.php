<?php

namespace app\models;

use Yii;

class Entry extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'entry';
    }

    public function rules()
    {
        return [
            [['user_id', 'first_name'], 'required'],
            [['user_id'], 'integer'],
            [['first_name', 'last_name', 'company', 'address', 'phone_number', 'email', 'fax', 'mobile_number', 'note'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'company' => 'Company',
            'address' => 'Address',
            'phone_number' => 'Phone Number',
            'email' => 'Email',
            'fax' => 'Fax',
            'mobile_number' => 'Mobile Number',
            'note' => 'Note',
        ];
    }

    public function getNotes()
    {
        return $this->hasMany(Note::className(), ['entry_id' => 'id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getEntryToLabels() 
    { 
       return $this->hasMany(EntryToLabel::className(), ['entry_id' => 'id']); 
    } 

    public function getLabels()
    {
        $labels = Label::find()
            ->innerJoin('{{%entry_to_label}}', 'label.id = entry_to_label.label_id')
            ->where(['entry_to_label.entry_id' => $this->id])
            ->all();

        return $labels;
    }
}
