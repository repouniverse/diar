<?php

namespace frontend\modules\sta\models;

use Yii;

/**
 * This is the model class for table "{{%sta_eventosdet}}".
 *
 * @property int $id
 * @property int $eventos_id
 * @property int $talleresdet_id
 * @property int $talleres_id
 * @property string $codalu
 * @property string $asistio
 * @property string $nombres
 * @property string $detalle
 * @property string $correo
 *
 * @property StaAlu $codalu0
 * @property StaEventos $eventos
 * @property StaTalleres $talleres
 * @property StaTalleresdet $talleresdet
 */
class StaEventosdet extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_eventosdet}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['eventos_id', 'talleresdet_id', 'talleres_id', 'codalu', 'asistio', 'nombres'], 'required'],
            [['eventos_id', 'talleresdet_id', 'talleres_id'], 'integer'],
            [['detalle'], 'string'],
            [['codalu'], 'string', 'max' => 14],
            [['asistio'], 'string', 'max' => 1],
            [['nombres', 'correo'], 'string', 'max' => 60],
            [['codalu'], 'exist', 'skipOnError' => true, 'targetClass' => StaAlu::className(), 'targetAttribute' => ['codalu' => 'codalu']],
            [['eventos_id'], 'exist', 'skipOnError' => true, 'targetClass' => StaEventos::className(), 'targetAttribute' => ['eventos_id' => 'id']],
            [['talleres_id'], 'exist', 'skipOnError' => true, 'targetClass' => StaTalleres::className(), 'targetAttribute' => ['talleres_id' => 'id']],
            [['talleresdet_id'], 'exist', 'skipOnError' => true, 'targetClass' => StaTalleresdet::className(), 'targetAttribute' => ['talleresdet_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sta.labels', 'ID'),
            'eventos_id' => Yii::t('sta.labels', 'Eventos ID'),
            'talleresdet_id' => Yii::t('sta.labels', 'Talleresdet ID'),
            'talleres_id' => Yii::t('sta.labels', 'Talleres ID'),
            'codalu' => Yii::t('sta.labels', 'Codalu'),
            'asistio' => Yii::t('sta.labels', 'Asistio'),
            'nombres' => Yii::t('sta.labels', 'Nombres'),
            'detalle' => Yii::t('sta.labels', 'Detalle'),
            'correo' => Yii::t('sta.labels', 'Correo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodalu0()
    {
        return $this->hasOne(StaAlu::className(), ['codalu' => 'codalu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
        return $this->hasOne(StaEventos::className(), ['id' => 'eventos_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTalleres()
    {
        return $this->hasOne(StaTalleres::className(), ['id' => 'talleres_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTalleresdet()
    {
        return $this->hasOne(StaTalleresdet::className(), ['id' => 'talleresdet_id']);
    }

    /**
     * {@inheritdoc}
     * @return StaEventosdetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaEventosdetQuery(get_called_class());
    }
}
