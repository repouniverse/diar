<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AccesDocu;

/**
 * AccesDocuSearch represents the model behind the search form of `common\models\AccesDocu`.
 */
class AccesDocuSearch extends AccesDocu
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['modelo', 'codocu', 'rol', 'campo', 'campo_profile', 'upload', 'download'], 'safe'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AccesDocu::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'modelo', $this->modelo])
            ->andFilterWhere(['like', 'codocu', $this->codocu])
            ->andFilterWhere(['like', 'rol', $this->rol])
            ->andFilterWhere(['like', 'campo', $this->campo])
            ->andFilterWhere(['like', 'campo_profile', $this->campo_profile])
            ->andFilterWhere(['like', 'upload', $this->upload])
            ->andFilterWhere(['like', 'download', $this->download]);

        return $dataProvider;
    }
}
