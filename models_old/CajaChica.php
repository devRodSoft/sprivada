<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;
use app\models\CuentaPagar;

/**
 * This is the model class for table "caja_chica".
 *
 * @property integer $idcaja_chica
 * @property string $fecha_comprachica
 * @property string $observacion
 * @property integer $importe
 * @property integer $fk_cforma_pago
 * @property integer $fk_csub_tipo_gasto
 * @property integer $fk_centro_costo
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property string $caja_chica
 *
 * @property CentroCosto $fkCentroCosto
 * @property CformaPago $fkCformaPago
 * @property CsubTipoGasto $fkCsubTipoGasto
 */
class CajaChica extends ActiveRecord
{
    public $stpagado = 0;
    public $metodo = 0 ;
    public $fecha = "";
    public $dias ;

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'caja_chica';
    }

     public function behaviors()
    {
        return [
            'blame' =>       [
                'class' => CulpableBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_by','updated_by'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_by'],

                ],


            ],
            'timestamp' => [
                'class' => TiempoBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                    //'value' => new Expression('date(\'Y-m-d H:i:s\');'),
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_comprachica', 'importe', 'fk_cforma_pago', 'fk_csub_tipo_gasto', 'fk_centro_costo' ], 'required'],
            [['dias'] , 'required' , 'on' => self::SCENARIO_CREATE],
            [['fecha_comprachica', 'metodo', 'stpagado','fecha'], 'safe'],
            [[ 'fk_cforma_pago', 'fk_csub_tipo_gasto', 'fk_centro_costo','dias'], 'integer'],
            [[ 'importe'], 'number'],
			[['observacion'], 'string', 'max' => 200],
            [['caja_chica'], 'string', 'max' => 45],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
            [['fk_centro_costo'], 'exist', 'skipOnError' => true, 'targetClass' => CentroCosto::className(), 'targetAttribute' => ['fk_centro_costo' => 'idcentro_costo']],
            [['fk_cforma_pago'], 'exist', 'skipOnError' => true, 'targetClass' => CformaPago::className(), 'targetAttribute' => ['fk_cforma_pago' => 'idcforma_pago']],
            [['fk_csub_tipo_gasto'], 'exist', 'skipOnError' => true, 'targetClass' => CsubTipoGasto::className(), 'targetAttribute' => ['fk_csub_tipo_gasto' => 'idcsub_tipo_gasto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcaja_chica' => 'Folio',
            'fecha_comprachica' => 'Fecha Compra',
            'observacion' => 'Observacion',
            'importe' => 'Importe',
            'fk_cforma_pago' => 'Forma de Pago',
            'fk_csub_tipo_gasto' => 'Sub Tipo Gasto',
            'fk_centro_costo' => 'Centro Costo',
            'created_at' => 'Fecha Creacion',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'caja_chica' => 'Caja Chica',
            'fk_tipo_gasto' => 'Tipo de Gasto',
            'stpagado'=>'Pagado',
            'dias'=>'Dias Vencimiento',
            'fecha'=>'Fecha Vencimiento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCentroCosto()
    {
        return $this->hasOne(CentroCosto::className(), ['idcentro_costo' => 'fk_centro_costo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCformaPago()
    {
        return $this->hasOne(CformaPago::className(), ['idcforma_pago' => 'fk_cforma_pago']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCsubTipoGasto()
    {
        return $this->hasOne(CsubTipoGasto::className(), ['idcsub_tipo_gasto' => 'fk_csub_tipo_gasto']);
    }

    public function getfkCuentapagar()
    {
        $id = "I".sprintf("%06d", $this->idcaja_chica);
        return $this->hasOne(CuentaPagar::className(), ['folio_dcto' => 'folio']);

        // $pagar = CuentaPagar::findOne(['folio_dcto'=> $id  ]);
        // d($pagar);
        // die();
        // if($pagar->st_pagado==2){
            // return 1;
        // }else{
            // return 0;
        // }
    }

    public function getFolio(){
         return  "I".sprintf("%06d", $this->idcaja_chica);
    }
}
