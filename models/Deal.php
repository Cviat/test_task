<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "deal".
 *
 * @property int $id
 * @property string $title
 * @property string|null $amount
 * @property int|null $contact_id
 *
 * @property Contact $contact
 */
class Deal extends \yii\db\ActiveRecord
{
    public $contact_ids = [];// Виртуальное свойство для выбора нескольких контактов

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['amount'], 'number'],
            [['title'], 'string', 'max' => 255],
            [['contact_ids'], 'safe'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название сделки',
            'amount' => 'Цена',
        ];
    }

    /**
     * Gets query for [[Contact]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::class, ['id' => 'contact_id'])
            ->viaTable('deal_contact', ['deal_id' => 'id']);
    }


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        // Удаление старых связей
        if (!$insert) {
            DealContact::deleteAll(['deal_id' => $this->id]);
        }

        // Создание новых связей
        if ($this->contact_ids) {
            foreach ($this->contact_ids as $contactId) {
                $dealContact = new DealContact();
                $dealContact->deal_id = $this->id;
                $dealContact->contact_id = $contactId;
                $dealContact->save();
            }
        }
    }
    public function afterDelete()
    {
        parent::afterDelete();

        // Удаление всех связанных записей в связующей таблице
        DealContact::deleteAll(['deal_id' => $this->id]);
    }

}
