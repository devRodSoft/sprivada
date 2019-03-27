<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NominaDetalle;

/**
 * NominaDetSearch represents the model behind the search form about `app\models\NominaDetalle`.
 */
class NominaDetSearch extends NominaDetalle
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idnomina_detalle', 'fk_nomina', 'fk_proyecto', 'porcentaje_pago'], 'integer'],
            [['proyecto'], 'safe'],
            [['monto', 'avance', 'monto_total'], 'number'],
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
        $query = NominaDetalle::find();

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
            'idnomina_detalle' => $this->idnomina_detalle,
            'fk_nomina' => $this->fk_nomina,
            'fk_proyecto' => $this->fk_proyecto,
            'monto' => $this->monto,
            'avance' => $this->avance,
            'porcentaje_pago' => $this->porcentaje_pago,
            'monto_total' => $this->monto_total,
        ]);

        $query->andFilterWhere(['like', 'proyecto', $this->proyecto]);

        return $dataProvider;
    }
}
