<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Persona;

/**
 * PersonaSearch represents the model behind the search form of `app\models\Persona`.
 */
class PersonaSearch extends Persona
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPersona', 'idTalleRemera', 'idUsuario', 'idPersonaDireccion', 'idFichaMedica', 'idResultado', 'donador', 'deshabilitado'], 'integer'],
            [['nombrePersona', 'apellidoPersona', 'fechaNacPersona', 'sexoPersona', 'nacionalidadPersona', 'telefonoPersona', 'mailPersona', 'fechaInscPersona','idPersonaDireccion','tipoCarrera','dniUsuario'], 'safe'],
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
        $query = Persona::find()->joinWith('usuario');

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
            'idPersona' => $this->idPersona,
            'idTalleRemera' => $this->idTalleRemera,
            'fechaNacPersona' => $this->fechaNacPersona,
            //'idUsuario' => $this->idUsuario,
            'idPersonaDireccion' => $this->idPersonaDireccion,
            'idFichaMedica' => $this->idFichaMedica,
            'fechaInscPersona' => $this->fechaInscPersona,
            'idPersonaEmergencia' => $this->idPersonaEmergencia,
            'idResultado' => $this->idResultado,
            'donador' => $this->donador,
            'deshabilitado' => $this->deshabilitado,
			
        ]);

        $query->andFilterWhere(['like', 'nombrePersona', $this->nombrePersona])
            ->andFilterWhere(['like', 'apellidoPersona', $this->apellidoPersona])
            ->andFilterWhere(['like', 'sexoPersona', $this->sexoPersona])
            ->andFilterWhere(['like', 'nacionalidadPersona', $this->nacionalidadPersona])
            ->andFilterWhere(['like', 'personadireccion.direccionUsuario', $this->idPersonaDireccion])
            ->andFilterWhere(['like', 'personaemergencia.telefonoPersonaEmergencia', $this->idPersonaEmergencia])
            ->andFilterWhere(['like', 'telefonoPersona', $this->telefonoPersona])
            ->andFilterWhere(['like', 'dniUsuario', $this->dniUsuario])
			->andFilterWhere(['like', 'tipoCarrera', $this->tipoCarrera]);

        return $dataProvider;
    }
}
