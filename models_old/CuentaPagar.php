<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cuenta_pagar".
 *
 * @property integer $idcuenta_pagar
 * @property string $folio_dcto
 * @property string $tipo_dcto
 * @property string $fecha_dcto
 * @property string $deuda
 * @property string $pagado
 * @property integer $st_pagado
 * @property integer $fk_metodo_pago
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property MetodoPago $fkMetodoPago
 */
class CuentaPagar extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuenta_pagar';
    }

        public function behaviors(){
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
            [['fk_metodo_pago'], 'required'],
            [['idcuenta_pagar', 'st_pagado', 'fk_metodo_pago'], 'integer'],
            [['deuda', 'pagado'], 'number'],
            [['created_at', 'observacion'], 'safe'],
             ['pagado', 'compare', 'compareAttribute' =>'deuda', 'operator' => '<=' , 'message' => 'No puede ser mayor que la deuda'],
            [['folio_dcto', 'tipo_dcto', 'fecha_dcto'], 'string', 'max' => 45],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
            [['fk_metodo_pago'], 'exist', 'skipOnError' => true, 'targetClass' => MetodoPago::className(), 'targetAttribute' => ['fk_metodo_pago' => 'idmetodo_pago']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcuenta_pagar' => 'Id',
            'folio_dcto' => 'Folio Dcto',
            'tipo_dcto' => 'Tipo Dcto',
            'fecha_dcto' => 'Fecha Dcto',
            'fecha_vencimiento' => 'F. Vencimiento',
            'cantidad' => 'Cantidad',
            'stpagado'=> 'Pagado',
            'pagado' => 'Pagado',
            'porpagar' => 'X Pagar',
            'st_pagado' => 'Pagado',
            'observacion'=> 'Observaciones',
            'fk_metodo_pago' => 'Metodo Pago',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkMetodoPago()
    {
        return $this->hasOne(MetodoPago::className(), ['idmetodo_pago' => 'fk_metodo_pago']);
    }

     public function getFkProveedor()
    {
        return $this->hasOne(Proveedor::className(), ['idproveedor' => 'fk_proveedor']);    
        
    }

    public function getStpagado(){
        if($this->st_pagado == 2){
            return "SI";
        }else if($this->st_pagado == 3){
            return "PARCIAL";
        }else if($this->st_pagado == 4){
             return "ACLARACION";
        }else{
             return "NO";
        }
    }

    public function getPorpagar(){
        return $this->deuda - $this->pagado;
    }

    // public function getFvencimiento(){
    //     $t  = date($this->fecha_dcto +' 08:00:00');
    //     return $this->add_date($t ,$this->fkProveedor->diacredito );
    // }

    public function getCantidad(){
         return $this->deuda.'/'.$this->pagado;
    }

    

    // function add_date($givendate,$day=0,$mth=0,$yr=0) {
    //   $cd = strtotime($givendate);
    //   $newdate = date('Y-m-d h:i:s', mktime(date('h',$cd),
    // date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
    // date('d',$cd)+$day, date('Y',$cd)+$yr));
    //   return $newdate;
    //           }
}
