<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProduccionValor;

/**
 * ProduccionSearch represents the model behind the search form about `app\models\ProduccionValor`.
 */
class ProduccionSearch extends ProduccionValor
{
    public $globalSearch;
    public $nsec;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idproduccion_valor', 'avance', 'avance_ant', 'fk_proyecto',  'n1', 'n2', 'n3', 'st_hoja'], 'integer'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [[ 'globalSearch','fk_produccion','nsec'], 'safe'],
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
        $query = ProduccionValor::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
         $query->joinWith('fkProduccion');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'fk_proyecto' => $this->fk_proyecto,
            'n1' => $this->n1,
            'n2' => $this->n2,
            'n3' => $this->n3,
            'produccion_valor.st_hoja' => $this->st_hoja,
        ]);

        


        $query->andFilterWhere(['like', 'produccion.produccion', $this->fk_produccion]);


        return $dataProvider;
    }
}
