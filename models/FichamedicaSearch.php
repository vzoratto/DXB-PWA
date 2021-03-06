<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Fichamedica;
use app\models\Persona;
use app\models\Gruposanguineo;
/**
 * FichamedicaSearch represents the model behind the search form of `app\models\Fichamedica`.
 */
class FichamedicaSearch extends Fichamedica
{
    /**
     * {@inheritdoc}
     */
	public $grupoSanguineo;
	public $donador;
	
    public function rules()
    {
        return [
            [['idFichaMedica', 'frecuenciaCardiaca', 'idGrupoSanguineo', 'evaluacionMedica', 'intervencionQuirurgica', 'tomaMedicamentos', 'suplementos'], 'integer'],
            [['obraSocial', 'observaciones','apellidoPersona','grupoSanguineo','donador'], 'safe'],
            [['peso', 'altura'], 'number'],
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
        $query = Fichamedica::find()
		        ->joinWith(['persona'])
				->joinWith(['grupoSanguineo']);

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
            'idFichaMedica' => $this->idFichaMedica,
            'peso' => $this->peso,
            'altura' => $this->altura,
            'frecuenciaCardiaca' => $this->frecuenciaCardiaca,
            'idGrupoSanguineo' => $this->idGrupoSanguineo,
            'evaluacionMedica' => $this->evaluacionMedica,
            'intervencionQuirurgica' => $this->intervencionQuirurgica,
            'tomaMedicamentos' => $this->tomaMedicamentos,
            'suplementos' => $this->suplementos,
        ]);

        $query->andFilterWhere(['like', 'obraSocial', $this->obraSocial])
              ->andFilterWhere(['like', 'observaciones', $this->observaciones]);
			  
        $query->andFilterWhere(['like', 'apellidoPersona', $this->apellidoPersona]);
        $query->andFilterWhere(['like', 'tipoGrupoSanguineo', $this->grupoSanguineo]);
		
        $query->andFilterWhere(['like', 'donador', $this->donador]);
		
		
        return $dataProvider;
    }
}
