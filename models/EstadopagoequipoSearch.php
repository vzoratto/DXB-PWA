<?php

namespace app\models;
//estado del equipo
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Estadopagoequipo;

/**
 * EstadopagoequipoSearch represents the model behind the search form of `app\models\Estadopagoequipo`.
 */
class EstadopagoequipoSearch extends Estadopagoequipo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEstadoPago', 'idEquipo'], 'integer'],
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
        $query = Estadopagoequipo::find();

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
            'idEstadoPago' => $this->idEstadoPago,
            'idEquipo' => $this->idEquipo,
        ]);

        return $dataProvider;
    }
}
