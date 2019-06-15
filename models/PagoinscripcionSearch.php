<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pagoinscripcion;

/**
 * PagoinscripcionSearch represents the model behind the search form of `app\models\Pagoinscripcion`.
 */
class PagoinscripcionSearch extends Pagoinscripcion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPago', 'importe', 'pagado', 'idPersona'], 'integer'],
            [['entidadpago', 'imagencomprobante', 'fechapago','idPersona'], 'safe'],
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
        $query = Pagoinscripcion::find();

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
            'idPago' => $this->idPago,
            'importe' => $this->importe,
            'fechapago' => $this->fechapago,
            'pagado' => $this->pagado,
            'idPersona' => $this->idPersona,
        ]);

        $query->andFilterWhere(['like', 'entidadpago', $this->entidadpago])
            ->andFilterWhere(['like', 'imagencomprobante', $this->imagencomprobante]);

        return $dataProvider;
    }
}
