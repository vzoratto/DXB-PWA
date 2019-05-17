<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Talleremera;

/**
 * TalleremeraSearch represents the model behind the search form of `app\models\Talleremera`.
 */
class TalleremeraSearch extends Talleremera
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idTalleRemera', 'deshabilitado'], 'integer'],
            [['talleRemera'], 'safe'],
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
        $query = Talleremera::find();

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
            'idTalleRemera' => $this->idTalleRemera,
            'deshabilitado' => $this->deshabilitado,
        ]);

        $query->andFilterWhere(['like', 'talleRemera', $this->talleRemera]);

        return $dataProvider;
    }
}
