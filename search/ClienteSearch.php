<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cliente;

/**
 * ClienteSearch represents the model behind the search form about `app\models\Empresa`.
 */
class ClienteSearch extends Cliente
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcliente'], 'integer'],
            [['razon', 'nombre', 'rfc', 'direccion', 'nointerior', 'colonia', 'noexterior', 'cp', 'calle', 'calle2', 'telefono', 'celular', 'ciudad', 'fkmunicipio', 'fkestado', 'tipo_cliente', 'giro', 'noempleados', 'encargado_pago', 'dias_pago', 'contrato', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
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
        $query = Cliente::find();

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

        

        $query->andFilterWhere(['like', 'razon', $this->globalSearch])
            ->orFilterWhere(['like', 'nombre', $this->globalSearch])
            ->orFilterWhere(['like', 'rfc', $this->globalSearch])
            ->orFilterWhere(['like', 'direccion', $this->globalSearch]);

        return $dataProvider;
    }
}
