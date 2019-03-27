<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrdenProducto;

/**
 * OrdenProductoSearch represents the model behind the search form about `app\models\OrdenProducto`.
 */
class OrdenProductoSearch extends OrdenProducto
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcompra_producto', 'fk_orden_compra'], 'integer'],
            [['codigo', 'descripcion', 'cantidad', 'um'], 'safe'],
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
        $query = OrdenProducto::find();

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
            'idcompra_producto' => $this->idcompra_producto,
            'fk_orden_compra' => $this->fk_orden_compra,
        ]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'cantidad', $this->cantidad])
            ->andFilterWhere(['like', 'um', $this->um]);

        return $dataProvider;
    }
}
