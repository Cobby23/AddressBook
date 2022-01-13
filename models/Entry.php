<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entry".
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string|null $last_name
 * @property string|null $company
 * @property string|null $address
 * @property string|null $phone_number
 * @property string|null $email
 * @property string|null $fax
 * @property string|null $mobile_number
 * @property string|null $note
 *
 * @property Note[] $notes
 * @property User $user
 */
class Entry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entry';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name'], 'required'],
            [['user_id'], 'integer'],
            [['first_name', 'last_name', 'company', 'address', 'phone_number', 'email', 'fax', 'mobile_number', 'note'], 'string', 'max' => 255],
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

    /**
     * Gets query for [[Notes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasMany(Note::className(), ['entry_id' => 'id']);
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

    public function getLabels()
    {
        $labels = Label::find()
            ->innerJoin('{{%entry_to_label}}', 'label.id = entry_to_label.label_id')
            ->where(['entry_to_label.entry_id' => $this->id])
            ->all();

        return $labels;
    }
}
