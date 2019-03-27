<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MovimientoDetalle;

/**
 * MovimientoDetalleSearch represents the model behind the search form about `app\models\MovimientoDetalle`.
 */
class MovimientoDetalleSearch extends MovimientoDetalle
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idmovimiento_detalle', 'fk_movimiento'], 'integer'],
            [['fk_material_almacen', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['costo', 'iva', 'total', 'cantidad'], 'number'],
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
        $query = MovimientoDetalle::find();

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
            'idmovimiento_detalle' => $this->idmovimiento_detalle,
            'costo' => $this->costo,
            'iva' => $this->iva,
            'total' => $this->total,
            'cantidad' => $this->cantidad,
            'fk_movimiento' => $this->fk_movimiento,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'fk_material_almacen', $this->fk_material_almacen])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
