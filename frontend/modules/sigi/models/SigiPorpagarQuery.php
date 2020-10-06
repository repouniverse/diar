<?php

namespace frontend\modules\sigi\models;

/**
 * This is the ActiveQuery class for [[SigiPorpagar]].
 *
 * @see SigiPorpagar
 */
class SigiPorpagarQuery extends \frontend\modules\sigi\components\ActiveQueryScope
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SigiPorpagar[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SigiPorpagar|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
