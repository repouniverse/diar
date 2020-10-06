<?php

namespace frontend\modules\sigi\models;

/**
 * This is the ActiveQuery class for [[SigiMovbanco]].
 *
 * @see SigiMovbanco
 */
class SigiMovbancoQuery extends \frontend\modules\sigi\components\ActiveQueryScope
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SigiMovbanco[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SigiMovbanco|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
