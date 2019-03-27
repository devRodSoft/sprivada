<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cotizacion;

/**
 * CotizacionSearch represents the model behind the search form about `app\models\Cotizacion`.
 */
class CotizacionSearch extends Cotizacion
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcotizacion', 'fk_cotestatus'], 'integer'],
            [['fecha', 'referencia', 'elaboracion', 'sitio', 'edificio', 'iluminacion', 'tipo', 'direccion', 'razon', 'nombre_proyecto', 'escala', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
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
        $query = Cotizacion::find();

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
            'idcotizacion' => $this->idcotizacion,
            'fk_cotestatus' => $this->fk_cotestatus,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'fk_llamada'=> $this->fk_llamada,
        ]);

        $query->andFilterWhere(['like', 'fecha', $this->fecha])
            ->andFilterWhere(['like', 'referencia', $this->referencia])
            ->andFilterWhere(['like', 'elaboracion', $this->elaboracion])
            ->andFilterWhere(['like', 'sitio', $this->sitio])
            ->andFilterWhere(['like', 'edificio', $this->edificio])
            ->andFilterWhere(['like', 'iluminacion', $this->iluminacion])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'razon', $this->razon])
            ->andFilterWhere(['like', 'nombre_proyecto', $this->nombre_proyecto])
            ->andFilterWhere(['like', 'escala', $this->escala])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        $query->andFilterWhere(['>','idcotizacion',1]);


        return $dataProvider;
    }
}
