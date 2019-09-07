<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Result;

/**
 * ResultSearch represents the model behind the search form of `app\models\Result`.
 */
class ResultSearch extends Result
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idResultado', 'numEquipo', 'tiempoLlegada', 'respuestasCorrectas', 'bolsasCompletas', 'penalizacionBolsa', 'trivia', 'total', 'categoria', 'cantPersonas'], 'integer'],
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
        $query = Result::find();

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
            'idResultado' => $this->idResultado,
            'numEquipo' => $this->numEquipo,
            'tiempoLlegada' => $this->tiempoLlegada,
            'respuestasCorrectas' => $this->respuestasCorrectas,
            'bolsasCompletas' => $this->bolsasCompletas,
            'penalizacionBolsa' => $this->penalizacionBolsa,
            'trivia' => $this->trivia,
            'total' => $this->total,
            'categoria' => $this->categoria,
            'cantPersonas' => $this->cantPersonas,
        ]);

        return $dataProvider;
    }
}
