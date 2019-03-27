<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mediocontacto;

/**
 * MediocontactoSearch represents the model behind the search form about `app\models\MediocontactoModel`.
 */
class MediocontactoSearch extends Mediocontacto
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {

        return [
            [['idmediocontacto'], 'integer'],
            [['globalSearch'], 'safe'],
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
        $query = Mediocontacto::find();

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
//            'idmediocontacto' => $this->idmediocontacto,
//        ]);

        $query->andFilterWhere(['like', 'medio', $this->globalSearch]);

        return $dataProvider;
    }
}
