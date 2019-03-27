<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CsubTipoGasto;

/**
 * CsubTipoGastoSearch represents the model behind the search form about `app\models\CsubTipoGasto`.
 */
class CsubTipoGastoSearch extends CsubTipoGasto
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcsub_tipo_gasto', 'fk_ctipo_gasto'], 'integer'],
            [['csub_tipo_gasto', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
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
        $query = CsubTipoGasto::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $dataProvider->sort->attributes['fkCtipoGasto'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['fkCtipoGasto.ctipo_gasto' => SORT_ASC],
        'desc' => ['fkCtipoGasto.ctipo_gasto' => SORT_DESC],
    ];


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('fkCtipoGasto');

        $query->orFilterWhere(['like', 'csub_tipo_gasto', $this->globalSearch]);
        $query->orFilterWhere(['like', 'ctipo_gasto', $this->globalSearch]);
        return $dataProvider;
    }
}
