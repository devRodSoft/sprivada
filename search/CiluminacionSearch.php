<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ciluminacion;

/**
 * CiluminacionSearch represents the model behind the search form about `app\models\CiluminacionModel`.
 */
class CiluminacionSearch extends Ciluminacion
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['idctipo_iluminacion'], 'integer'],
            [['globalSearch'], 'safe'],
//            [['searchstring'] , 'safe'],
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
        $query = Ciluminacion::find();

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
//        $query->andFilterWhere([
//            'idctipo_iluminacion' => $this->idctipo_iluminacion,
//        ]);
//
        $query->andFilterWhere(['like', 'ctipo_iluminacion', $this->globalSearch]);

//        $query->andFilterWhere(['like', 'ctipo_iluminacion', $this->searchstring]);
        return $dataProvider;
    }
}
