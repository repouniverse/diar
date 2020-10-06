<?php

namespace frontend\modules\sta\models;
use yii\data\ActiveDataProvider;
use frontend\modules\sta\models\StaResumenasistencias;
//use common\models\masters\Trabajadores;
use yii\base\Model;
/**
 * This is the ActiveQuery class for [[StaVwCitas]].
 *
 * @see StaVwCitas
 */
class StaResumenasistenciasSearch extends StaResumenasistencias
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           [
               ['nombres','codfac','codperiodo','c_1', 'c_2', 'c_3', 'c_4', 'c_5', 'c_6', 'c_7', 'c_8', 'c_9', 'c_10', 'c_11', 'c_12', 'c_13', 'c_14'],
               'safe'
               ],
     
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

 public function search($params)
    {
        $query =  StaResumenasistencias::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        

        $query->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'codalu', $this->codalu])
                  ->andFilterWhere([ 'codfac'=> $this->codfac])
            ->andFilterWhere(['codperiodo'=> $this->codperiodo])
                 ->andFilterWhere(['n_informe'=>$this->n_informe]);

        return $dataProvider;
    }
    
    
}
