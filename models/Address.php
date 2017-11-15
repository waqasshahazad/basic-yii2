<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property string $id
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $street
 * @property string $phone
 * @property string $zip
 *
 * @property ContactPerson[] $contactPeople
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city', 'state', 'country', 'street', 'phone', 'zip'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'city' => Yii::t('app', 'City'),
            'state' => Yii::t('app', 'State'),
            'country' => Yii::t('app', 'Country'),
            'street' => Yii::t('app', 'Street'),
            'phone' => Yii::t('app', 'Phone'),
            'zip' => Yii::t('app', 'Zip'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactPeople()
    {
        return $this->hasMany(ContactPerson::className(), ['address_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AddressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AddressQuery(get_called_class());
    }
}
