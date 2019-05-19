<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Respuesta;

/**
 * RespuestaSearch represents the model behind the search form of `app\models\Respuesta`.
 */
class RespuestaSearch extends Respuesta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idRespuesta', 'idPregunta', 'idUsuario'], 'integer'],
            [['respValor'], 'safe'],
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
        $query = Respuesta::find();

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
            'idRespuesta' => $this->idRespuesta,
            'idPregunta' => $this->idPregunta,
            'idUsuario' => $this->idUsuario,
        ]);

        $query->andFilterWhere(['like', 'respValor', $this->respValor]);

        return $dataProvider;
    }
}
