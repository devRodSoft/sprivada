<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "movimiento_detalle".
 *
 * @property integer $idmovimiento_detalle
 * @property integer $fk_material_almacen
 * @property string $costo
 * @property string $iva
 * @property string $total
 * @property string $cantidad
 * @property integer $fk_movimiento
 * @property integer $fk_um
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property Material $fkMaterialAlmacen
 * @property Movimiento $fkMovimiento
 * @property Um $fkUm
 */
class MovimientoDetalle extends ActiveRecord
{
    public $descripcion;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'movimiento_detalle';
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
            [['fk_material_almacen'], 'required'],
            [['fk_material_almacen'], 'safe'],
            [[ 'total', 'cantidad'], 'number'],
            [['iva', 'costo','fk_movimiento'], 'safe'],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
            [['fk_material_almacen'], 'exist', 'skipOnError' => true, 'targetClass' => Almacen::className(), 'targetAttribute' => ['fk_material_almacen' => 'codigo']],
            [['fk_movimiento'], 'exist', 'skipOnError' => true, 'targetClass' => Movimiento::className(), 'targetAttribute' => ['fk_movimiento' => 'idmovimiento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idmovimiento_detalle' => 'Folio',
            'fk_material_almacen' => 'Código',
            'costo' => 'Costo',
            'iva' => 'Iva',
            'total' => 'Total',
            'cantidad' => 'Cantidad',
            'fk_movimiento' => 'Fk Movimiento',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkMaterialAlmacen()
    {
        return $this->hasOne(Almacen::className(), ['codigo' => 'fk_material_almacen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkMovimiento()
    {
        return $this->hasOne(Movimiento::className(), ['idmovimiento' => 'fk_movimiento']);
    }

  
}
