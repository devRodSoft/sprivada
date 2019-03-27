<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NivelComplejidad;

/**
 * NivelComplejidadSearch represents the model behind the search form about `app\models\NivelComplejidad`.
 */
class NivelComplejidadSearch extends NivelComplejidad
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['globalSearch'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
        $query = NivelComplejidad::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }


        $query->orFilterWhere(['like', 'gasto', $this->globalSearch])
            ->orFilterWhere(['like', 'tiempo', $this->globalSearch]);

        return $dataProvider;
    }
}
