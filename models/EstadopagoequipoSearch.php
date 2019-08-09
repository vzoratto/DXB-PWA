<?php

namespace app\models;
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
            [['dniCapitan','mailUsuario','totalpagado','importe','nombreEquipo','nombrePersona'],'safe'],
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
        $query = Estadopagoequipo::find()->joinWith('equipo.persona')
                                        ->joinWith('equipo.usuario')
                                        ->joinWith('equipo.tipoCarrera.importeinscripcion');
                                       
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
            'idEstadoPago' => $this->idEstadoPago,
            'idEquipo' => $this->idEquipo,
        ]);
        
        $query->andFilterWhere(['like', 'equipo.dniCapitan', $this->dniCapitan])
              ->andFilterWhere(['like', 'equipo.usuario.mailUsuario', $this->mailUsuario])
              ->andFilterWhere(['like', 'persona.CONCAT(nombrePersona." ".apellidoPersona)', $this->nombrePersona])
              ->andFilterWhere(['like','importeinscripcion.importe', $this->importe])
              ->andFilterWhere(['like','nombreEquipo', $this->nombreEquipo]);
        return $dataProvider;
    }
}
