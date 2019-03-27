<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cotconfig;

/**
 * CotconfigSearch represents the model behind the search form about `app\models\Cotconfig`.
 */
class CotconfigSearch extends Cotconfig
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcotconfig'], 'integer'],
            [['tb1', 'tb2'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Cotconfig::find();

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
            'idcotconfig' => $this->idcotconfig,
        ]);

        $query->andFilterWhere(['like', 'tb1', $this->tb1])
            ->andFilterWhere(['like', 'tb2', $this->tb2]);

        return $dataProvider;
    }
}
