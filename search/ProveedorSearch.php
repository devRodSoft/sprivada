<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Proveedor;

/**
 * ProveedorSearch represents the model behind the search form about `app\models\Proveedor`.
 */
class ProveedorSearch extends Proveedor
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idproveedor'], 'integer'],
            [['razon_social', 'nombre_contacto', 'telefono1', 'telefono', 'rfc', 'direccion', 'email', 'ciudad', 'estado', 'pagina_web', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
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
        $query = Proveedor::find();

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

        $query->andFilterWhere(['like', 'razon_social', $this->globalSearch])
            ->orFilterWhere(['like', 'nombre_contacto', $this->globalSearch])
            ->orFilterWhere(['like', 'telefono', $this->globalSearch])
            ->orFilterWhere(['like', 'rfc', $this->globalSearch])
            ->orFilterWhere(['like', 'direccion', $this->globalSearch])
            ->orFilterWhere(['like', 'email', $this->globalSearch])
            ->orFilterWhere(['like', 'ciudad', $this->globalSearch])
            ->orFilterWhere(['like', 'estado', $this->estado]);

        return $dataProvider;
    }
}
