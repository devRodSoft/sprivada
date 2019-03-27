<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CentroCosto;

/**
 * CentroCostoSearch represents the model behind the search form about `app\models\CentroCosto`.
 */
class CentroCostoSearch extends CentroCosto
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcentro_costo'], 'integer'],
            [['nombre_centro', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [[ 'globalSearch'], 'safe'],
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
        $query = CentroCosto::find();

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

        // // grid filtering conditions
        // $query->andFilterWhere([
        //     'idcentro_costo' => $this->idcentro_costo,
        //     'created_at' => $this->created_at,
        //     'updated_at' => $this->updated_at,
        // ]);

        $query->andFilterWhere(['like', 'nombre_centro', $this->globalSearch]);


        return $dataProvider;
    }
}
