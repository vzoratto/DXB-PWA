<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pago;
use yii\db\Query;

/**
 * PagoSearch represents the model behind the search form of `app\models\Pago`.
 */
class PagoSearch extends Pago
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPago', 'importePagado', 'idPersona', 'idImporte', 'idEquipo'], 'integer'],
            [['entidadPago', 'imagenComprobante','dniUsu','chequeado','nombre','nombreEquipo','estadoPago'], 'safe'],
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
        $query = Pago::find()->joinWith('controlpagos')
                             ->joinWith('persona.usuario');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ],
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
            'importePagado' => $this->importePagado,
            'controlpago.chequeado'=> $this->chequeado,
            'idPersona' => $this->idPersona,
            'idImporte' => $this->idImporte,
            'idEquipo' => $this->idEquipo,
        ]);

        $query->andFilterWhere(['like', 'entidadPago', $this->entidadPago])
            ->andFilterWhere(['like', 'imagenComprobante', $this->imagenComprobante])
            ->andFilterWhere(['like','CONCAT(persona.apellidoPersona, " ", persona.nombrePersona)', $this->nombre])
            ->andFilterWhere(['like', 'usuario.dniUsuario', $this->dniUsu]);
          

        return $dataProvider;
    }
    
    /**
     * Consulta a la tabla pago
     *
     * @param 
     *
     * @return ActiveDataProvider
     */
	 public function check(){
        $query = new Query;
        $query 
           ->select(['*'])
           ->from('pago p')
           ->join('inner join','controlpago c','c.idPago=p.idPago')
           ->where(['c.chequeado'=>1]) 
           ->all();
    
        $dataProvider = new ActiveDataProvider([
              'query' => $query,
        ]);

    return $dataProvider;
  
    }

    /**
     * Consulta a la tabla pago
     *
     * @param 
     *
     * @return ActiveDataProvider
     */
	 public function nocheck(){
        $query = new Query;
        $query 
           ->select(['*'])
           ->from('pago p')
           ->join('inner join','controlpago c','c.idPago=p.idPago')
           ->where(['c.chequeado'=>0]) 
           ->all();
    
        $dataProvider = new ActiveDataProvider([
              'query' => $query,
        ]);

    return $dataProvider;
  
    }
}
