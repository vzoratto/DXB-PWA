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
            [['idPersona', 'idSexoPersona', 'idUsuario', 'mailPersonaValidado', 'idPersonaDireccion', 'idFichaMedica', 'idPersonaEmergencia', 'idEstadoPago', 'deshabilitado'], 'integer'],
            [['nombrePersona', 'apellidoPersona', 'fechaNacPersona', 'nacionalidadPersona', 'telefonoPersona', 'mailPersona', 'codigoValidacionMail', 'codigoRecuperarCuenta', 'fechaInscPersona'], 'safe'],
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
        $query = Persona::find();

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
            'idPersona' => $this->idPersona,
            'fechaNacPersona' => $this->fechaNacPersona,
            'idSexoPersona' => $this->idSexoPersona,
            'idUsuario' => $this->idUsuario,
            'mailPersonaValidado' => $this->mailPersonaValidado,
            'idPersonaDireccion' => $this->idPersonaDireccion,
            'idFichaMedica' => $this->idFichaMedica,
            'fechaInscPersona' => $this->fechaInscPersona,
            'idPersonaEmergencia' => $this->idPersonaEmergencia,
            'idEstadoPago' => $this->idEstadoPago,
            'deshabilitado' => $this->deshabilitado,
        ]);

        $query->andFilterWhere(['like', 'nombrePersona', $this->nombrePersona])
            ->andFilterWhere(['like', 'apellidoPersona', $this->apellidoPersona])
            ->andFilterWhere(['like', 'nacionalidadPersona', $this->nacionalidadPersona])
            ->andFilterWhere(['like', 'telefonoPersona', $this->telefonoPersona])
            ->andFilterWhere(['like', 'mailPersona', $this->mailPersona])
            ->andFilterWhere(['like', 'codigoValidacionMail', $this->codigoValidacionMail])
            ->andFilterWhere(['like', 'codigoRecuperarCuenta', $this->codigoRecuperarCuenta]);

        return $dataProvider;
    }
}
