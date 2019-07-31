<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Listadeespera;
use app\models\Persona;
use app\models\Equipo;
use app\models\Carrerapersona;
use app\models\Tipocarrera;

/**
 * ListadeesperaSearch represents the model behind the search form of `app\models\Listadeespera`.
 */
class ListadeesperaSearch extends Listadeespera
{
    public $nombreEquipo;
    public $categoria;
    public $dniCapitan;
    public $dniUsuario;
    public $nombre_completo;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idListaDeEspera', 'idPersona'], 'integer'],
            [['nombreEquipo','categoria','dniCapitan','dniUsuario','nombre_completo'],'safe'],
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
        $query = Listadeespera::find()
            ->joinWith(['persona'])
            ->joinWith(['persona.usuario'])
            ->joinWith(['persona.grupo.equipo'])
            ->joinWith(['tipoCarrera']);

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
            'idListaDeEspera' => $this->idListaDeEspera,
            'idPersona' => $this->idPersona,
        ]);
        $query->andFilterWhere(['like', 'CONCAT(apellidoPersona, " ", nombrePersona)', $this->nombre_completo]);
        $query->andFilterWhere(['like', 'equipo.nombreEquipo', $this->nombreEquipo]);
        $query->andFilterWhere(['like', 'tipocarrera.idTipoCarrera', $this->categoria]);
        $query->andFilterWhere(['like', 'equipo.dniCapitan', $this->dniCapitan]);
        $query->andFilterWhere(['like', 'usuario.dniUsuario', $this->dniUsuario]);


        return $dataProvider;
    }
}
