<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Personaemergencia;

/**
 * PersonaemergenciaSearch represents the model behind the search form of `app\models\Personaemergencia`.
 */
class PersonaemergenciaSearch extends Personaemergencia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPersonaEmergencia', 'idVinculoPersonaEmergencia'], 'integer'],
            [['nombrePersonaEmergencia', 'apellidoPersonaEmergencia', 'telefonoPersonaEmergencia'], 'safe'],
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
        $query = Personaemergencia::find();

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
            'idPersonaEmergencia' => $this->idPersonaEmergencia,
            'idVinculoPersonaEmergencia' => $this->idVinculoPersonaEmergencia,
        ]);

        $query->andFilterWhere(['like', 'nombrePersonaEmergencia', $this->nombrePersonaEmergencia])
            ->andFilterWhere(['like', 'apellidoPersonaEmergencia', $this->apellidoPersonaEmergencia])
            ->andFilterWhere(['like', 'telefonoPersonaEmergencia', $this->telefonoPersonaEmergencia]);

        return $dataProvider;
    }
}
