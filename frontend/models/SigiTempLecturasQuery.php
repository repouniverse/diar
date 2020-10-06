<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SigiTempLecturas]].
 *
 * @see SigiTempLecturas
 */
class SigiTempLecturasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SigiTempLecturas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SigiTempLecturas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
