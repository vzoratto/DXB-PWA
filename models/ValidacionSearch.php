<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Validacion;

/**
 * ValidacionSearch represents the model behind the search form of `app\models\Validacion`.
 */
class ValidacionSearch extends Validacion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idValidacion', 'idUsuario', 'mailUsuarioValidado'], 'integer'],
            [['codigoValidacionMail', 'codigoRecuperarCuenta'], 'safe'],
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
        $query = Validacion::find();

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
            'idValidacion' => $this->idValidacion,
            'idUsuario' => $this->idUsuario,
            'mailUsuarioValidado' => $this->mailUsuarioValidado,
        ]);

        $query->andFilterWhere(['like', 'codigoValidacionMail', $this->codigoValidacionMail])
            ->andFilterWhere(['like', 'codigoRecuperarCuenta', $this->codigoRecuperarCuenta]);

        return $dataProvider;
    }
}
