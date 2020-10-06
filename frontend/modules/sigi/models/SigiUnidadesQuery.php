<?php

namespace frontend\modules\sigi\models;

/**
 * This is the ActiveQuery class for [[SigiUnidades]].
 *
 * @see SigiUnidades
 */
class SigiUnidadesQuery extends \frontend\modules\sigi\components\ActiveQueryScope
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SigiUnidades[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SigiUnidades|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
