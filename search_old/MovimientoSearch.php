<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Movimiento;

/**
 * MovimientoSearch represents the model behind the search form about `app\models\Movimiento`.
 */
class MovimientoSearch extends Movimiento
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idmovimiento', 'fk_tipo_documento', 'fk_proveedor'], 'integer'],
            [[ 'total_mvto'], 'number'],
            [['fecha_movimiento', 'folio_dcto', 'folio_oc', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
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
        $query = Movimiento::find();

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
            'idmovimiento' => $this->idmovimiento,
            'fk_tipo_documento' => $this->fk_tipo_documento,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'fk_proveedor' => $this->fk_proveedor,
            'total_mvto' => $this->total_mvto,
        ]);

        $query->andFilterWhere(['like', 'fecha_movimiento', $this->fecha_movimiento])
            ->andFilterWhere(['like', 'folio_dcto', $this->folio_dcto])
            ->andFilterWhere(['like', 'folio_oc', $this->folio_oc])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
