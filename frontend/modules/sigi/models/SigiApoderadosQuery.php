<?php

namespace frontend\modules\sigi\models;

/**
 * This is the ActiveQuery class for [[SigiApoderados]].
 *
 * @see SigiApoderados
 */
class SigiApoderadosQuery extends \frontend\modules\sigi\components\ActiveQueryScope
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SigiApoderados[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SigiApoderados|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
