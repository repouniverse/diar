<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lh5qd_sigi_temp_lecturas".
 *
 * @property int $id
 * @property int $suministro_id
 * @property int $unidad_id
 * @property int $id_real
 * @property string $codepa
 * @property int $user_id
 * @property string $mes
 * @property string $flectura
 * @property string $hlectura
 * @property string $lectura
 * @property string $lecturaant
 * @property string $anio
 * @property string $codedificio
 * @property string $codtipo
 * @property string $delta
 * @property string $facturable
 * @property int $edificio_id
 * @property int $cuentaspor_id
 *
 * @property SigiSuministros $suministro
 */
class SigiTempLecturas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lh5qd_sigi_temp_lecturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['suministro_id', 'unidad_id', 'id_real', 'mes', 'anio'], 'required'],
            [['suministro_id', 'unidad_id', 'id_real', 'user_id', 'edificio_id', 'cuentaspor_id'], 'integer'],
            [['lectura', 'lecturaant', 'delta'], 'number'],
            [['codepa', 'codedificio'], 'string', 'max' => 12],
            [['mes'], 'string', 'max' => 2],
            [['flectura'], 'string', 'max' => 10],
            [['hlectura'], 'string', 'max' => 5],
            [['anio'], 'string', 'max' => 4],
            [['codtipo'], 'string', 'max' => 3],
            [['facturable'], 'string', 'max' => 1],
            [['suministro_id'], 'exist', 'skipOnError' => true, 'targetClass' => SigiSuministros::className(), 'targetAttribute' => ['suministro_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'suministro_id' => Yii::t('app', 'Suministro ID'),
            'unidad_id' => Yii::t('app', 'Unidad ID'),
            'id_real' => Yii::t('app', 'Id Real'),
            'codepa' => Yii::t('app', 'Codepa'),
            'user_id' => Yii::t('app', 'User ID'),
            'mes' => Yii::t('app', 'Mes'),
            'flectura' => Yii::t('app', 'Flectura'),
            'hlectura' => Yii::t('app', 'Hlectura'),
            'lectura' => Yii::t('app', 'Lectura'),
            'lecturaant' => Yii::t('app', 'Lecturaant'),
            'anio' => Yii::t('app', 'Anio'),
            'codedificio' => Yii::t('app', 'Codedificio'),
            'codtipo' => Yii::t('app', 'Codtipo'),
            'delta' => Yii::t('app', 'Delta'),
            'facturable' => Yii::t('app', 'Facturable'),
            'edificio_id' => Yii::t('app', 'Edificio ID'),
            'cuentaspor_id' => Yii::t('app', 'Cuentaspor ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuministro()
    {
        return $this->hasOne(SigiSuministros::className(), ['id' => 'suministro_id']);
    }

    /**
     * {@inheritdoc}
     * @return SigiTempLecturasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SigiTempLecturasQuery(get_called_class());
    }
}
