<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RespuestaOpcion;

/**
 * RespuestaOpcionSearch represents the model behind the search form of `app\models\RespuestaOpcion`.
 */
class RespuestaOpcionSearch extends RespuestaOpcion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idRespuestaOpcion', 'idPregunta'], 'integer'],
            [['opRespvalor'], 'safe'],
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
        $query = RespuestaOpcion::find();

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
            'idRespuestaOpcion' => $this->idRespuestaOpcion,
            'idPregunta' => $this->idPregunta,
        ]);

        $query->andFilterWhere(['like', 'opRespvalor', $this->opRespvalor]);

        return $dataProvider;
    }
}
