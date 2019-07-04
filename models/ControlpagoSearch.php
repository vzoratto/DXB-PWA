<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Controlpago;

/**
 * ControlpagoSearch represents the model behind the search form of `app\models\Controlpago`.
 */
class ControlpagoSearch extends Controlpago
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idControlpago', 'idPago', 'chequeado', 'idGestor'], 'integer'],
            [['fechaPago', 'fechachequeado'], 'safe'],
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
        $query = Controlpago::find();

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
            'idControlpago' => $this->idControlpago,
            'idPago' => $this->idPago,
            'fechaPago' => $this->fechaPago,
            'fechachequeado' => $this->fechachequeado,
            'chequeado' => $this->chequeado,
            'idGestor' => $this->idGestor,
        ]);

        return $dataProvider;
    }
}
