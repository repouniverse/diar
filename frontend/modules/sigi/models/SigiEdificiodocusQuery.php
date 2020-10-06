<?php

namespace frontend\modules\sigi\models;

/**
 * This is the ActiveQuery class for [[SigiEdificiodocus]].
 *
 * @see SigiEdificiodocus
 */
class SigiEdificiodocusQuery extends \frontend\modules\sigi\components\ActiveQueryScope
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SigiEdificiodocus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SigiEdificiodocus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
