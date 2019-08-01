<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Fechacarrera;

/**
 * FechacarreraSearch represents the model behind the search form of `app\models\Fechacarrera`.
 */
class FechacarreraSearch extends Fechacarrera
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idFechaCarrera', 'deshabilitado', 'idTipoCarrera'], 'integer'],
            [['fechaCarrera', 'fechaLimiteUno', 'fechaLimiteDos'], 'safe'],
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
        $query = Fechacarrera::find();

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
            'idFechaCarrera' => $this->idFechaCarrera,
            'fechaCarrera' => $this->fechaCarrera,
            'fechaLimiteUno' => $this->fechaLimiteUno,
            'fechaLimiteDos' => $this->fechaLimiteDos,
            'deshabilitado' => $this->deshabilitado,
            'idTipoCarrera' => $this->idTipoCarrera,
        ]);

        return $dataProvider;
    }
}
