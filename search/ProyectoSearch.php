<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Proyecto;

/**
 * ProyectoSearch represents the model behind the search form about `app\models\Proyecto`.
 */
class ProyectoSearch extends Proyecto
{
     public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'globalSearch'], 'safe'],
            [[ 'st_terminado'], 'safe'],
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
        $query = Proyecto::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        $query->joinWith('fkNivelComplejidad');
        $query->joinWith('fkCliente');
        $query->joinWith('fkCestatus');

    //     $dataProvider->sort->attributes['fk_cliente'] = [
       
    //     'asc' => ['fkCliente.nombre_razon_social' => SORT_ASC],
    //     'desc' => ['fkCliente.nombre_razon_social' => SORT_DESC],
    // ];

   
        if (!$this->validate()) {
          
            return $dataProvider;
        }

       
        // grid filtering conditions
        $query->andFilterWhere([
            'idproyecto' => $this->globalSearch,
            'st_terminado' => $this->st_terminado,
        //     'fecha_entrega' => $this->fecha_entrega,
        //     'precio' => $this->precio,
        //     'costo' => $this->costo,
        //     'fk_cliente' => $this->fk_cliente,
        //     'fk_cnivel_complejidad' => $this->fk_cnivel_complejidad,
        //     'fk_cestatus' => $this->fk_cestatus,
        //     'fk_ctipo_material' => $this->fk_ctipo_material,
        //     'fk_ctipo_color' => $this->fk_ctipo_color,
        //     'fk_ctipo_iluminacion' => $this->fk_ctipo_iluminacion,
        //     'fk_ccalibre_acrilico' => $this->fk_ccalibre_acrilico,
        //     'created_at' => $this->created_at,
        //     'updated_at' => $this->updated_at,
        ]);

        $query->orFilterWhere(['like', 'proyecto', $this->globalSearch])
            // ->orFilterWhere(['like', 'escala', $this->globalSearch])
            ->orFilterWhere(['like', 'cliente.nombre_razon_social', $this->globalSearch])
            ->orFilterWhere(['like', 'cestatus.cestatus', $this->globalSearch]);
           

        return $dataProvider;
    }
}
