<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrdenCompra;

/**
 * OrdenCompraSearch represents the model behind the search form about `app\models\OrdenCompra`.
 */
class OrdenCompraSearch extends OrdenCompra
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_orden_compra', 'fk_proveedor'], 'integer'],
            [['folio', 'fecha_compra', 'fecha_recepcion', 'observacion', 'solicitante', 'utilizacion', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
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
        $query = OrdenCompra::find();

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
            'id_orden_compra' => $this->id_orden_compra,
            'fecha_compra' => $this->fecha_compra,
            'fecha_recepción' => $this->fecha_recepcion,
            'fk_proveedor' => $this->fk_proveedor,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'folio', $this->folio])
            ->andFilterWhere(['like', 'observacion', $this->observacion])
            ->andFilterWhere(['like', 'solicitante', $this->solicitante])
            ->andFilterWhere(['like', 'utilizacion', $this->utilizacion]);

        return $dataProvider;
    }
}
