<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "movimiento".
 *
 * @property integer $idmovimiento
 * @property string $monto
 * @property string $fecha_movimienra
 * @property integer $fk_tipo_doto
 * @property integer $fk_orden_compcumento
 * @property string $folio_dcto
 * @property string $folio_oc
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property integer $fk_proveedor
 * @property string $total_mvto
 *
 * @property Proveedor $fkProveedor
 * @property TipoDocumento $fkTipoDocumento
 * @property MovimientoDetalle[] $movimientoDetalles
 */
class Movimiento extends ActiveRecord
{
    public $stpagado = 0;
    public $metodo = 0 ;
    public $proyecto = 0;
    public $stproyecto = 0;
    public $solicitante = "";
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'movimiento';
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
            [['total_mvto'], 'number'],
            [[ 'fk_tipo_documento', 'fk_proveedor','fecha_movimiento','folio_dcto'], 'required' , 'message'=>'Campo Requerido'],
            [['stpagado' , 'metodo' , 'proyecto' , 'stproyecto' , 'fk_proyecto','folio_oc' ,'solicitante'] , 'safe'],
            [['fecha_movimiento', 'folio_dcto'], 'string', 'max' => 45],
            [['folio_oc', 'created_by', 'updated_by'], 'string', 'max' => 30],
            [['fk_proveedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::className(), 'targetAttribute' => ['fk_proveedor' => 'idproveedor']],
            [['fk_tipo_documento'], 'exist', 'skipOnError' => true, 'targetClass' => TipoDocumento::className(), 'targetAttribute' => ['fk_tipo_documento' => 'idtipo_documento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idmovimiento' => 'Id',
            'fk_proyecto' => 'Proyecto',
            'fecha_movimiento' => 'Fecha Documento',
            'fk_tipo_documento' => 'Tipo Documento',
            'folio_dcto' => 'Folio',
            'folio_oc' => 'Orden Compra',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'fk_proveedor' => 'Proveedor',
            'total_mvto' => 'Total',
            'stpagado' => 'Pagado',
            'stproyecto' => 'Asignar a Proyecto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkProveedor()
    {
        return $this->hasOne(Proveedor::className(), ['idproveedor' => 'fk_proveedor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkTipoDocumento()
    {
        return $this->hasOne(TipoDocumento::className(), ['idtipo_documento' => 'fk_tipo_documento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientoDetalles()
    {
        return $this->hasMany(MovimientoDetalle::className(), ['fk_movimiento' => 'idmovimiento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['idproyecto' => 'fk_proyecto']);
    }


   
}
