<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Gestores;

/**
 * GestoresSearch represents the model behind the search form of `app\models\Gestores`.
 */
class GestoresSearch extends Gestores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idGestor', 'idUsuario'], 'integer'],
            [['nombreGestor', 'apellidoGestor', 'telefonoGestor','idUsuario'], 'safe'],
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
        $query = Gestores::find();

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
            'idGestor' => $this->idGestor,
            'idUsuario' => $this->idUsuario,
        ]);

        $query->andFilterWhere(['like', 'nombreGestor', $this->nombreGestor])
            ->andFilterWhere(['like', 'apellidoGestor', $this->apellidoGestor])
            ->andFilterWhere(['like', 'telefonoGestor', $this->telefonoGestor]);

        return $dataProvider;
    }
}
