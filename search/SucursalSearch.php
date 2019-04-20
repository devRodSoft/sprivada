<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sucursal;

/**
 * SucursalSearch represents the model behind the search form about `app\models\Sucursal`.
 */
class SucursalSearch extends Sucursal
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idsucursal'], 'integer'],
            [['razon', 'nombre', 'rfc', 'direccion', 'nointerior', 'colonia', 'noexterior', 'cp', 'calle', 'calle2', 'telefono', 'celular', 'ciudad', 'fkmunicipio', 'fkestado', 'tipo_sucursal', 'giro', 'noempleados', 'encargado', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
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
        $query = Sucursal::find();

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
            'idsucursal' => $this->idsucursal,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'razon', $this->razon])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'rfc', $this->rfc])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'nointerior', $this->nointerior])
            ->andFilterWhere(['like', 'colonia', $this->colonia])
            ->andFilterWhere(['like', 'noexterior', $this->noexterior])
            ->andFilterWhere(['like', 'cp', $this->cp])
            ->andFilterWhere(['like', 'calle', $this->calle])
            ->andFilterWhere(['like', 'calle2', $this->calle2])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'celular', $this->celular])
            ->andFilterWhere(['like', 'ciudad', $this->ciudad])
            ->andFilterWhere(['like', 'fkmunicipio', $this->fkmunicipio])
            ->andFilterWhere(['like', 'fkestado', $this->fkestado])
            ->andFilterWhere(['like', 'tipo_sucursal', $this->tipo_sucursal])
            ->andFilterWhere(['like', 'giro', $this->giro])
            ->andFilterWhere(['like', 'noempleados', $this->noempleados])
            ->andFilterWhere(['like', 'encargado', $this->encargado])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
