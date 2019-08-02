<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Grupocopia;

/**
 * GrupocopiaSearch represents the model behind the search form of `app\models\Grupocopia`.
 */
class GrupocopiaSearch extends Grupocopia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEquipo', 'idPersona'], 'integer'],
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
        $query = Grupocopia::find();

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
            'idEquipo' => $this->idEquipo,
            'idPersona' => $this->idPersona,
        ]);

        return $dataProvider;
    }
}
