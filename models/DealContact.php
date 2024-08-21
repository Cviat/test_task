<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "deal_contact".
 *
 * @property int $deal_id
 * @property int $contact_id
 */
class DealContact extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deal_contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deal_id', 'contact_id'], 'required'],
            [['deal_id', 'contact_id'], 'integer'],
        ];
    }
}

