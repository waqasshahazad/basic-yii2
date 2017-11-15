<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $default_contact_person
 *
 * @property ContactPerson[] $contactPeople
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    public static function ChildtableName()
    {
        return 'contact_person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['default_contact_person'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 200],
        ];
    }

    public function relations()
    {
      return array(
        'default_contact_person'=>array(self::HAS_ONE, 'contact_person', 'id')
        );
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'default_contact_person' => Yii::t('app', 'Default Contact Person'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactPeople()
    {
        return $this->hasMany(ContactPerson::className(), ['company_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CompanyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanyQuery(get_called_class());
    }

    public function afterSave()
    {
      if($this->default_contact_person)
      {
        Yii::$app->db->createCommand('UPDATE '.self::ChildtableName().' SET is_default=1 WHERE id = '.$this->default_contact_person)->execute();
        Yii::$app->db->createCommand('UPDATE '.self::ChildtableName().' SET is_default=0 WHERE company_id = '.$this->id .' AND id !='.$this->default_contact_person )->execute();
      }
    }
}
