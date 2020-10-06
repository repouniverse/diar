<?php

namespace frontend\modules\sta\models;

use Yii;

/**
 * This is the model class for table "{{%sta_resumenasistencias}}".
 *
 * @property int $id
 * @property string $codalu
 * @property string $codfac
 * @property string $nombres
 * @property string $c_1
 * @property string $c_2
 * @property string $c_3
 * @property string $c_4
 * @property string $c_5
 * @property string $c_6
 * @property string $c_7
 * @property string $c_8
 * @property string $c_9
 * @property string $c_10
 * @property string $c_11
 * @property string $c_12
 * @property string $c_13
 * @property string $c_14
 */
class StaResumenasistencias extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sta_resumenasistencias}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codalu'], 'string', 'max' => 14],
            [['codfac'], 'string', 'max' => 8],
            [['nombres'], 'string', 'max' => 40],
             [['status','n_informe','tallerdet_id','codperiodo','codcar'], 'safe'],
            [['c_1', 'c_2', 'c_3', 'c_4', 'c_5', 'c_6', 'c_7', 'c_8', 'c_9', 'c_10', 'c_11', 'c_12', 'c_13', 'c_14'], 'string', 'max' => 19],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('sta.labels', 'ID'),
            'codalu' => Yii::t('sta.labels', 'Código'),
             'codperiodo' => Yii::t('sta.labels', 'Period'),
            'codfac' => Yii::t('sta.labels', 'Fac'),
            'nombres' => Yii::t('sta.labels', 'Nombres'),
            'c_1' => Yii::t('sta.labels', 'Eval Inic'),
            'c_2' => Yii::t('sta.labels', 'Entrevista'),
            'c_3' => Yii::t('sta.labels', 'Act.3'),
            'c_4' => Yii::t('sta.labels', 'Act.4'),
            'c_5' => Yii::t('sta.labels', 'Act.5'),
            'c_6' => Yii::t('sta.labels', 'Act.6'),
            'c_7' => Yii::t('sta.labels', 'Act.7'),
            'c_8' => Yii::t('sta.labels', 'Act.8'),
            'c_9' => Yii::t('sta.labels', 'Act.9'),
            'c_10' => Yii::t('sta.labels', 'Act.10'),
            'c_11' => Yii::t('sta.labels', 'Act.11'),
            'c_12' => Yii::t('sta.labels', 'Act.12'),
            'c_13' => Yii::t('sta.labels', 'Act.13'),
            'c_14' => Yii::t('sta.labels', 'Act.14'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return StaResumenasistenciasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaResumenasistenciasQuery(get_called_class());
    }
    
    public function cleanAttributes(){
        $attr=['n_informe'=>null,
            'c_1'=>null,
            'c_2'=>null,
            'c_3'=>null,
            'c_4'=>null,
            'c_5'=>null,
            'c_6'=>null,
            'c_7'=>null,
            'c_8'=>null,
            'c_9'=>null,
            'c_10'=>null,
            'c_11'=>null,
            'c_12'=>null,
            'c_13'=>null,
            'c_14'=>null];
        $this->setAttributes($attr);
        return true;
    }
}
