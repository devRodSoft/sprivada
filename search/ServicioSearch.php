<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Servicio;

/**
 * ServicioSearch represents the model behind the search form about `app\models\Servicio`.
 */
class ServicioSearch extends Servicio
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idservicio'], 'integer'],
            [['grupo', 'clase', 'tipo', 'descripcion', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['costo', 'precio1', 'precio2', 'precio3', 'precio4', 'precio5'], 'number'],
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
        $query = Servicio::find();

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

        $query->andFilterWhere(['like', 'grupo', $this->globalSearch])
            ->orFilterWhere(['like', 'tipo', $this->globalSearch])
            ->orFilterWhere(['like', 'clase', $this->globalSearch])
            ->orFilterWhere(['like', 'descripcion', $this->globalSearch]);

        return $dataProvider;
    }
}
