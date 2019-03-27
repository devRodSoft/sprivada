<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Llamada;

/**
 * LlamadaSearch represents the model behind the search form about `app\models\Llamada`.
 */
class LlamadaSearch extends Llamada
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idllamada', 'fk_lstatus'], 'integer'],
            [['prospecto', 'telefono', 'email', 'asunto', 'observacion', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
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
        $query = Llamada::find();

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
            'fk_lstatus' => $this->fk_lstatus,
            'idllamada' => $this->globalSearch,

        ]);

        $query->orFilterWhere(['like', 'prospecto', $this->globalSearch])
            ->orFilterWhere(['=', 'telefono', $this->globalSearch])
            ->orFilterWhere(['like', 'email', $this->globalSearch])
            ->orFilterWhere(['like', 'asunto', $this->globalSearch])
            ->orFilterWhere(['like', 'observacion', $this->globalSearch]);

        return $dataProvider;
    }
}
