<?php

namespace frontend\modules\sigi\models;

use Yii;

/**
 * This is the model class for table "{{%sigi_tipomov}}".
 *
 * @property string $codigo
 * @property string $descripcion
 *
 * @property SigiMovimientos[] $sigiMovimientos
 */
class SigiTipomov extends \common\models\base\modelBase
{
    const TIPOMOV_DEFAULT='100';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sigi_tipomov}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo'], 'required'],
            [['codigo'], 'string', 'max' => 3],
            [['descripcion'], 'string', 'max' => 40],
            [['codigo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigo' => Yii::t('sigi.labels', 'Codigo'),
            'descripcion' => Yii::t('sigi.labels', 'Descripcion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSigiMovimientos()
    {
        return $this->hasMany(SigiMovimientosPre::className(), ['tipomov' => 'codigo']);
    }

    /**
     * {@inheritdoc}
     * @return SigiTipomovQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SigiTipomovQuery(get_called_class());
    }
    
    
}
