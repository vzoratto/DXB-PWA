<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RespuestaTrivia;

/**
 * RespuestaTriviaSearch represents the model behind the search form of `app\models\RespuestaTrivia`.
 */
class RespuestaTriviaSearch extends RespuestaTrivia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idRespTrivia'], 'integer'],
            [['respTriviaValor', 'idPregunta'], 'safe'],
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
        $query = RespuestaTrivia::find();
        $query->joinWith(['pregunta']);

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
            'idRespTrivia' => $this->idRespTrivia,
            // 'idPregunta' => $this->idPregunta,
        ]);

        $query->andFilterWhere(['like', 'respTriviaValor', $this->respTriviaValor])
                ->andFilterWhere(['like', 'pregunta.pregDescripcion', $this->idPregunta]);

        return $dataProvider;
    }
}
