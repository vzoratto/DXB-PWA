<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuario;

/**
 * UsuarioSearch represents the model behind the search form of `app\models\Usuario`.
 */
class UsuarioSearch extends Usuario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUsuario', 'dniUsuario', 'activado', 'idRol'], 'integer'],
            [['claveUsuario', 'dniUsuario','mailUsuario', 'authkey','idRol'], 'safe'],
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
        $query = Usuario::find();

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
            'idUsuario' => $this->idUsuario,
            'dniUsuario' => $this->dniUsuario,
            'activado' => $this->activado,
            'idRol' => $this->idRol,
        ]);

        $query->andFilterWhere(['like', 'claveUsuario', $this->claveUsuario])
            ->andFilterWhere(['like', 'mailUsuario', $this->mailUsuario])
            ->andFilterWhere(['like', 'authkey', $this->authkey]);
            //->andFilterWhere(['like', 'rol.descripcionRol', $this->idRol]);// agregados filtros por roles de las relaciones

        return $dataProvider;
    }
}
