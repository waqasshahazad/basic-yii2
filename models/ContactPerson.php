<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact_person".
 *
 * @property string $id
 * @property string $name
 * @property string $address_id
 * @property string $company_id
 * @property integer $is_default
 *
 * @property Address $address
 * @property Company $company
 */
class ContactPerson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_person';
    }

    public static function parentTableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['address_id', 'company_id', 'is_default'], 'integer'],
            [['name'], 'string', 'max' => 30],
            //[['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['address_id' => 'id']],
            //[['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'address_id' => Yii::t('app', 'Address ID'),
            'company_id' => Yii::t('app', 'Company ID'),
            'is_default' => Yii::t('app', 'Is Default'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * @inheritdoc
     * @return ContactPersonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactPersonQuery(get_called_class());
    }

    public static function findByCompany($companyId)
    {
        return parent::find()->where(['company_id' => $companyId]);
    }

    public function afterSave()
    {
      if($this->is_default)
      {
        if($this->company_id)
        {
          Yii::$app->db->createCommand('UPDATE '.self::tableName().' SET is_default=0 WHERE company_id = '.$this->company_id.' AND id !='.$this->id)->execute();
          Yii::$app->db->createCommand('UPDATE '.self::parentTableName().' SET default_contact_person= '.$this->id.' WHERE id = '.$this->company_id)->execute();
        }

      }
    }
}
