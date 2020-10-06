<?php

namespace frontend\modules\sigi\models;

/**
 * This is the ActiveQuery class for [[SigiPropago]].
 *
 * @see SigiPropago
 */
class SigiPropagoQuery extends \frontend\modules\sigi\components\ActiveQueryScope
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SigiPropago[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SigiPropago|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
