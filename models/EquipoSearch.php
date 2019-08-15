<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Equipo;
use app\models\Grupo;
use app\models\Persona;

use app\models\Personasearch;

use app\models\Gruposearch;

/**
 * EquipoSearch represents the model behind the search form of `app\models\Equipo`.
 */
class EquipoSearch extends Equipo
{
    /**
     * {@inheritdoc}
     */
	 public $nombrePersona;
	 
    public function rules()
    {
        return [
            [['idEquipo', 'cantidadPersonas', 'idTipoCarrera', 'dniCapitan', 'deshabilitado'], 'integer'],
            [['nombreEquipo','nombrePersona','estadopago'], 'safe'],
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
        $query = Equipo::find()
		       ->joinWith(['grupo']);
              // ->joinWith(['grupo.persona']);

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
            'idEquipo' => $this->idEquipo,
            'cantidadPersonas' => $this->cantidadPersonas,
            'idTipoCarrera' => $this->idTipoCarrera,
            'dniCapitan' => $this->dniCapitan,
            'deshabilitado' => $this->deshabilitado,
        ]);

        $query->andFilterWhere(['like', 'nombreEquipo', $this->nombreEquipo]);
		$query->andFilterWhere(['like', 'persona.nombrePersona', $this->nombrePersona]);

        return $dataProvider;
    }
}
