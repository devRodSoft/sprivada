<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CuentaPagar;

/**
 * CuentaSearch represents the model behind the search form about `app\models\CuentaPagar`.
 */
class CuentaSearch extends CuentaPagar
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcuenta_pagar', 'st_pagado', 'fk_metodo_pago', 'fk_proveedor'], 'integer'],
            [['folio_dcto', 'tipo_dcto', 'fecha_dcto', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['deuda', 'pagado'], 'number'],
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
        $query = CuentaPagar::find();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->joinWith('fkProveedor');
        
        $dataProvider->setSort([
            'defaultOrder' => ['fecha_vencimiento'=>SORT_ASC],
            ]);

        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'st_pagado' => $this->st_pagado,
        ]);

        $query->orFilterWhere(['like', 'folio_dcto', $this->globalSearch])
            ->orFilterWhere(['like', 'fecha_dcto', $this->globalSearch]);

        return $dataProvider;
    }
}
