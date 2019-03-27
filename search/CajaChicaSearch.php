<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CajaChica;

/**
 * CajaChicaSearch represents the model behind the search form about `app\models\CajaChica`.
 */
class CajaChicaSearch extends CajaChica
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcaja_chica', 'importe', 'fk_cforma_pago', 'fk_csub_tipo_gasto', 'fk_centro_costo'], 'integer'],
            [['fecha_comprachica', 'observacion', 'created_at', 'updated_at', 'created_by', 'updated_by', 'caja_chica'], 'safe'],
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
        $query = CajaChica::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
          $query->joinWith('fkCformaPago');
          $query->joinWith('fkCsubTipoGasto');
          $query->joinWith('fkCentroCosto');

           // 'idcaja_chica' => 'Folio',
           //  'fecha_comprachica' => 'Fecha Comprachica',
           //  'observacion' => 'Observacion',
           //  'importe' => 'Importe',
           //  'fk_cforma_pago' => 'Forma  de Pago',
           //  'fk_csub_tipo_gasto' => 'Subtipo de Gasto',
           //  'fk_centro_costo' => 'Centro de Costo',
           //  'created_at' => 'Created At',
           //  'updated_at' => 'Updated At',
           //  'created_by' => 'Created By',
           //  'updated_by' => 'Updated By',
           //  'caja_chica' => 'Caja Chica',

        $dataProvider->setSort([
            'defaultOrder' => ['idcaja_chica'=>SORT_DESC],

            'attributes' => [
                'importe',
                'caja_chica',
                'fecha_comprachica',
            'idcaja_chica' => [ 'default' => SORT_DESC],

            'fk_cforma_pago' => [
               'asc' => [ 'cforma_pago.cforma_pago' => SORT_ASC],
                'desc' => ['cforma_pago.cforma_pago' => SORT_DESC],
            ],
            'fk_csub_tipo_gasto' => [
               'asc' => [ 'csub_tipo_gasto.csub_tipo_gasto' => SORT_ASC],
                'desc' => ['csub_tipo_gasto.csub_tipo_gasto' => SORT_DESC],
            ],
            'fk_centro_costo' => [
               'asc' => [ 'centro_costo.nombre_centro' => SORT_ASC],
                'desc' => ['centro_costo.nombre_centro' => SORT_DESC],
            ],
             'fk_tipo_gasto' => [
               'asc' => [ 'centro_costo.nombre_centro' => SORT_ASC],
                'desc' => ['centro_costo.nombre_centro' => SORT_DESC],
            ]
        ],

     
    ]);

          $this->load($params);

           if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        $query->orFilterWhere(['like', 'idcaja_chica', $this->globalSearch])
            ->orFilterWhere(['like', 'caja_chica', $this->globalSearch]);

        return $dataProvider;
    }
}
