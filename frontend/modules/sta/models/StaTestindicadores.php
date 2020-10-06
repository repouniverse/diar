<?php

namespace frontend\modules\sta\models;

use Yii;

/**
 * This is the model class for table "{{%sta_testindicadores}}".
 *
 * @property int $id
 * @property string $codtest
 * @property string $grupo
 * @property string $nombre
 * @property string $texto_bajo
 * @property string $texto_medio
 * @property string $texto_alto
 *
 * @property StaTest $codtest0
 */
class StaTestindicadores extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_testindicadores}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codtest', 'grupo', 'nombre'], 'required'],
            [['texto_bajo', 'texto_medio', 'texto_alto'], 'string'],
            [['codtest'], 'string', 'max' => 8],
            [['grupo'], 'string', 'max' => 2],
            [['nombre'], 'string', 'max' => 60],
            [['codtest'], 'exist', 'skipOnError' => true, 'targetClass' => StaTest::className(), 'targetAttribute' => ['codtest' => 'codtest']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.labels', 'ID'),
            'codtest' => Yii::t('base.labels', 'Codtest'),
            'grupo' => Yii::t('base.labels', 'Grupo'),
            'nombre' => Yii::t('base.labels', 'Nombre'),
            'texto_bajo' => Yii::t('base.labels', 'Texto Bajo'),
            'texto_medio' => Yii::t('base.labels', 'Texto Medio'),
            'texto_alto' => Yii::t('base.labels', 'Texto Alto'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(StaTest::className(), ['codtest' => 'codtest']);
    }

    /**
     * {@inheritdoc}
     * @return StaTestindicadoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaTestindicadoresQuery(get_called_class());
    }
}
