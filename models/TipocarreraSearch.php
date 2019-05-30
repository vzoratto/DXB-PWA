<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tipocarrera;

/**
 * TipocarreraSearch represents the model behind the search form of `app\models\Tipocarrera`.
 */
class TipocarreraSearch extends Tipocarrera
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idTipoCarrera', 'deshabilitado'], 'integer'],
            [['descripcionCarrera'], 'safe'],
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
        $query = Tipocarrera::find();

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
            'idTipoCarrera' => $this->idTipoCarrera,
            'deshabilitado' => $this->deshabilitado,
        ]);

        $query->andFilterWhere(['like', 'descripcionCarrera', $this->descripcionCarrera]);

        return $dataProvider;
    }
}
