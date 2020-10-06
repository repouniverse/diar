<?php

namespace frontend\modules\sigi\models;

/**
 * This is the ActiveQuery class for [[SigiCuentaspor]].
 *
 * @see SigiCuentaspor
 */
class SigiCuentasporQuery extends \frontend\modules\sigi\components\ActiveQueryScope
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SigiCuentaspor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SigiCuentaspor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
