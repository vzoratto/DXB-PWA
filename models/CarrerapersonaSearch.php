<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Carrerapersona;
use app\models\Talleremera;
use app\models\Usuario;
use app\models\Equipo;
use app\models\Tipocarrera;

/**
 * Carrerapersonasearch represents the model behind the search form of `app\models\Carrerapersona`.
 */
class Carrerapersonasearch extends Carrerapersona {

    /**
     * {@inheritdoc}
     */
    public $dniUsuario;
	public $talleRemera;
	public $nombreEquipo;
	public $dniCapitan;
	public $categoria;

    public function rules() {
        return [
            [['idTipoCarrera', 'idPersona', 'reglamentoAceptado', 'retiraKit'], 'integer'],
            [['apellidoPersona', 'nombrePersona', 'dniUsuario', 'talleRemera','nombreEquipo','dniCapitan','categoria'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Carrerapersona::find()
                ->joinWith(['persona'])
                ->joinWith(['persona.usuario'])
				->joinWith(['persona.talleRemera'])
				->joinWith(['tipoCarrera'])
				->joinWith(['tipoCarrera.equipo']);
			
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
            'idTipoCarrera' => $this->idTipoCarrera,
            'idPersona' => $this->idPersona,
            'reglamentoAceptado' => $this->reglamentoAceptado,
            'retiraKit' => $this->retiraKit,
        ]);
        $query->andFilterWhere(['like', 'apellidoPersona', $this->apellidoPersona]);
        $query->andFilterWhere(['like', 'nombrePersona', $this->nombrePersona]);
        $query->andFilterWhere(['like', 'usuario.dniUsuario', $this->dniUsuario]);
        $query->andFilterWhere(['like', 'talleRemera.talleRemera', $this->talleRemera]);
		
        $query->andFilterWhere(['like', 'tipoCarrera.descripcionCarrera', $this->categoria]);
		
        $query->andFilterWhere(['like', 'equipo.nombreEquipo', $this->nombreEquipo]);
		
        $query->andFilterWhere(['like', 'equipo.dniCapitan', $this->dniCapitan]);
		

        return $dataProvider;
    }

}
