<?php

namespace frontend\modules\sigi\models;

/**
 * This is the ActiveQuery class for [[SigiTipomov]].
 *
 * @see SigiTipomov
 */
class SigiTipomovQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SigiTipomov[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SigiTipomov|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
