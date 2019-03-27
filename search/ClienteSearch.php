<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cliente;


/**
 * ClienteSearch represents the model behind the search form about `app\models\Cliente`.
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
            [['idcliente',], 'integer'],
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
        $query->joinWith('fkMediocontacto');
        $query->joinWith('fkEstado');
        $query->andFilterWhere([
            'idcliente' => $this->globalSearch,
        ]);


        $query->orFilterWhere(['like', 'nombre_razon_social', $this->globalSearch])
            ->orFilterWhere(['like', 'lider_proy', $this->globalSearch])
            ->orFilterWhere(['like', 'vinculador_1', $this->globalSearch])
            ->orFilterWhere(['like', 'correo_vin_1', $this->globalSearch])
            ->orFilterWhere([ '=', 'rfc', $this->globalSearch]);

        return $dataProvider;
    }
}
