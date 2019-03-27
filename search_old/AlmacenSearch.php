<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Almacen;

/**
 * AlmacenSearch represents the model behind the search form about `app\models\Almacen`.
 */
class AlmacenSearch extends Almacen
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idmaterial_almacen'], 'integer'],
            [['material_almacen', 'familia', 'codigo', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['costo', 'costo_iva', 'existencia'], 'number'],
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
        $query = Almacen::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'material_almacen' => SORT_ASC,
                ]],
        ]);



        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }




        $query->orFilterWhere(['like', 'material_almacen', $this->globalSearch])
            ->orFilterWhere(['like', 'familia', $this->globalSearch])
            ->orFilterWhere(['like', 'codigo', $this->globalSearch]);

        return $dataProvider;
    }
}