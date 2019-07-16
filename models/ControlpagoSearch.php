<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Controlpago;
use app\models\Pago;
use app\models\Persona;
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
            [['fechaPago', 'fechachequeado','imagenComprobante','dniUsu','nombre','equipo','tipocarrera'], 'safe'],
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
        $query = Controlpago::find()->joinWith('pago.persona.usuario')
                                    ->joinWith('pago.equipo.tipoCarrera');
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
        $query->andFilterWhere(['like', 'persona.nombreCompleto', $this->nombre]) 
		      ->andFilterWhere(['like', 'imagenComprobante', $this->imagenComprobante])
              ->andFilterWhere(['like', 'usuario.dniUsuario', $this->dniUsu])
              ->andFilterWhere(['like', 'equipo.nombreEquipo', $this->equipo])
              ->andFilterWhere(['like', 'tipocarrera.descripcionCarrera', $this->tipocarrera]);

        return $dataProvider;
    }
}
