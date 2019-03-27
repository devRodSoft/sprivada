<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cotescala;

/**
 * CotescalaSearch represents the model behind the search form about `app\models\Cotescala`.
 */
class CotescalaSearch extends Cotescala
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcotescala', 'fk_cotizacion'], 'integer'],
            [['escala', 'dimensiones', 'precio'], 'safe'],
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
        $query = Cotescala::find();

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
            'idcotescala' => $this->idcotescala,
            'fk_cotizacion' => $this->fk_cotizacion,
        ]);

        $query->andFilterWhere(['like', 'escala', $this->escala])
            ->andFilterWhere(['like', 'dimensiones', $this->dimensiones])
            ->andFilterWhere(['like', 'precio', $this->precio]);

        return $dataProvider;
    }
}
