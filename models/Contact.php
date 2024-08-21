<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string|null $phone
 *
 * @property Deal[] $deals
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name'], 'required'],
            [['first_name', 'last_name', 'email', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'email' => 'Электронная почта',
            'phone' => 'Телефон',
        ];
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Убираем скобочки и пробелы из номера телефона
            $this->phone = preg_replace('/[^0-9]/', '', $this->phone);
            return true;
        }
        return false;
    }

    public function afterDelete()
    {
        parent::afterDelete();

        // Удаление всех связанных записей в связующей таблице
        DealContact::deleteAll(['contact_id' => $this->id]);
    }


    /**
     * Gets query for [[Deals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeals()
    {
        return $this->hasMany(Deal::class, ['id' => 'deal_id'])
            ->viaTable('deal_contact', ['contact_id' => 'id']);
    }
}

