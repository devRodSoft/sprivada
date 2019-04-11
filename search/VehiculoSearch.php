<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vehiculo;

/**
 * VehiculoSearch represents the model behind the search form about `app\models\Vehiculo`.
 */
class VehiculoSearch extends Vehiculo
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idvehiculo', 'fkelemento'], 'integer'],
            [['numero', 'tipo', 'marca', 'modelo', 'motor', 'serie', 'kilometraje', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
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
        $query = Vehiculo::find();

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


        $query->andFilterWhere(['like', 'numero', $this->globalSearch])
            ->orFilterWhere(['like', 'tipo', $this->globalSearch])
            ->orFilterWhere(['like', 'marca', $this->globalSearch])
            ->orFilterWhere(['like', 'modelo', $this->globalSearch]);

        return $dataProvider;
    }
}
