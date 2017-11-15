<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ContactPerson]].
 *
 * @see ContactPerson
 */
class ContactPersonQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ContactPerson[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ContactPerson|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
