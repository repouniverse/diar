<?php

namespace frontend\modules\sigi\models;

use Yii;

/**
 * This is the model class for table "{{%sigi_movbanco}}".
 *
 * @property int $id
 * @property int $cuenta_id
 * @property int $edificio_id
 * @property string $fopera
 * @property string $fval
 * @property string $monto
 * @property int $noper
 * @property string $descripcion
 *
 * @property SigiCuentas $cuenta
 * @property SigiEdificios $edificio
 */
class SigiMovbanco extends \common\models\base\modelBase
{
   
    const SCE_IMPORTACION='importacion';
    const SCE_CORTE='corte';
      const TIPO_NORMAL='N';
      const TIPO_CORTE='C'; //MOVIMIENTO PARA HACER UN CORTE
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sigi_movbanco}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cuenta_id', 'edificio_id', 'fopera', 'fval', 'monto'], 'required'],
            [['cuenta_id', 'edificio_id', 'noper'], 'integer'],
            [['monto'], 'number'],
             [['tipomov','cuenta_id','monto'], 'safe'],
            [['fopera', 'fval'], 'string', 'max' => 10],
            [['descripcion'], 'string', 'max' => 30],
            [['cuenta_id'], 'exist', 'skipOnError' => true, 'targetClass' => SigiCuentas::className(), 'targetAttribute' => ['cuenta_id' => 'id']],
            [['edificio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Edificios::className(), 'targetAttribute' => ['edificio_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sigi.labels', 'ID'),
            'cuenta_id' => Yii::t('sigi.labels', 'Cuenta ID'),
            'edificio_id' => Yii::t('sigi.labels', 'Edificio ID'),
            'fopera' => Yii::t('sigi.labels', 'Fopera'),
            'fval' => Yii::t('sigi.labels', 'Fval'),
            'monto' => Yii::t('sigi.labels', 'Monto'),
            'noper' => Yii::t('sigi.labels', 'Noper'),
            'descripcion' => Yii::t('sigi.labels', 'Descripcion'),
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCE_IMPORTACION] = [ 'cuenta_id', 'edificio_id', 'fopera', 'monto', 'noper', 'descripion'];
         $scenarios[self::SCE_CORTE] = [ 'cuenta_id', 'edificio_id', 'fopera','monto',  'descripion'];
        
        return $scenarios;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuenta()
    {
        return $this->hasOne(SigiCuentas::className(), ['id' => 'cuenta_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEdificio()
    {
        return $this->hasOne(Edificios::className(), ['id' => 'edificio_id']);
    }

    /**
     * {@inheritdoc}
     * @return SigiMovbancoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SigiMovbancoQuery(get_called_class());
    }
}
