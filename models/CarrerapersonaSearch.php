<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Carrerapersona;
use app\models\Talleremera;
use app\models\Usuario;
use app\models\Equipo;
use app\models\Grupo;
use app\models\Tipocarrera;
use app\models\Persona;

/**
 * Carrerapersonasearch represents the model behind the search form of `app\models\Carrerapersona`.
 */
class Carrerapersonasearch extends Carrerapersona {

    /**
     * {@inheritdoc}
     */
	 //creamos atributos virtuales,que son campos en otras tablas
    public $dniUsuario;
	public $talleRemera;
	public $nombreEquipo;
	public $dniCapitan;
	public $categoria;
    public $sexoPersona;
    public $espera;

    public function rules() {
        return [
            [['idTipoCarrera', 'idPersona', 'reglamentoAceptado', 'retiraKit'], 'integer'],
            [['apellidoPersona', 'nombrePersona', 'dniUsuario', 'talleRemera','nombreEquipo','dniCapitan','sexoPersona','categoria','nombre_completo','edad','espera'], 'safe'],
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
	 
	 // conectamos la tabla Carrerapersona con Persona luego con la tabla Usuario.
	 // conectamos la tabla Carrerapersona con Persona luego con la tabla Talleremera.
	 // conectamos la tabla Carrerapersona con Tipocarrera luego con la tabla Equipo.
    public function search($params) {
        $query = Carrerapersona::find()
                ->joinWith(['persona'])
                ->joinWith(['persona.usuario'])
				->joinWith(['persona.talleRemera'])
				->joinWith(['tipoCarrera'])
                ->joinWith(['persona.grupo.equipo'])
                ->joinWith(['persona.listadeespera']);
                
			
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
           // 'idPersona' => $this->idPersona,
            'reglamentoAceptado' => $this->reglamentoAceptado,
            'retiraKit' => $this->retiraKit,
        ]);
		
		//agregamos los campos de las tablas Tipocarrera,Persona,Equipo para traer sus campos y los asignamos
		//a las variables virtuales,asi trae y filtra por esos valores.
		
        $query->andFilterWhere(['like', 'apellidoPersona', $this->apellidoPersona]);
        $query->andFilterWhere(['like', 'nombrePersona', $this->nombrePersona]);
        $query->andFilterWhere(['like', 'sexoPersona', $this->sexoPersona]);
        $query->andFilterWhere(['like', 'usuario.dniUsuario', $this->dniUsuario]);
        $query->andFilterWhere(['like', 'talleRemera.talleRemera', $this->talleRemera]);
        $query->andFilterWhere(['like', 'tipoCarrera.idTipoCarrera', $this->categoria]);
        $query->andFilterWhere(['like', 'equipo.nombreEquipo', $this->nombreEquipo]);
        $query->andFilterWhere(['like', 'equipo.dniCapitan', $this->dniCapitan]);
        $query->andFilterWhere(['like', 'CONCAT(apellidoPersona, " ", nombrePersona)', $this->nombre_completo]);
        
        $query->andFilterWhere(['like', 'listadeespera.idPersona', $this->espera]);

        $query->andFilterWhere(['like', 'carrerapersona.idPersona', $this->idPersona]);

        return $dataProvider;
    }

}
