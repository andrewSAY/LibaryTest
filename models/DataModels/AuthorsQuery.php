<?php

namespace app\models\DataModels;

/**
 * This is the ActiveQuery class for [[Authors]].
 *
 * @see Authors
 */
class AuthorsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Authors[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Authors|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}