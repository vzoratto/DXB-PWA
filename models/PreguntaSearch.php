<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pregunta;

/**
 * PreguntaSearch represents the model behind the search form of `app\models\Pregunta`.
 */
class PreguntaSearch extends Pregunta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPregunta'], 'integer'],
            [['pregDescripcion', 'idEncuesta', 'idRespTipo'], 'safe'],
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
        $query = Pregunta::find();
        $query->joinWith(['encuesta']);
        $query->joinWith(['respTipo']);

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
            'idPregunta' => $this->idPregunta,
            // 'idEncuesta' => $this->idEncuesta,
            // 'idRespTipo' => $this->idRespTipo,
        ]);

        $query->andFilterWhere(['like', 'pregDescripcion', $this->pregDescripcion])
              ->andFilterWhere(['like', 'encuesta.encTitulo', $this->idEncuesta])
              ->andFilterWhere(['like', 'respuesta_tipo.respTipoDescripcion', $this->idRespTipo]);

        return $dataProvider;
    }
}
