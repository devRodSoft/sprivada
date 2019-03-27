<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CcalibreAcrilico;

/**
 * CcalibreAcrilicoSearch represents the model behind the search form about `app\models\CcalibreAcrilicoModel`.
 */
class CcalibreAcrilicoSearch extends CcalibreAcrilico
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idccalibre_acrilico'], 'integer'],
            [['ccalibre_acrilico' , 'globalSearch'], 'safe'],
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
        $query = CcalibreAcrilico::find();

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
//            'idccalibre_acrilico' => $this->idccalibre_acrilico,
//        ]);

//        $query->andFilterWhere(['like', 'ccalibre_acrilico', $this->ccalibre_acrilico]);
        $query->andFilterWhere(['like', 'ccalibre_acrilico', $this->globalSearch]);

        return $dataProvider;
    }
}
