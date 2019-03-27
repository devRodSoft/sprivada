<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "orden_compra".
 *
 * @property integer $id_orden_compra
 * @property string $folio
 * @property string $fecha_compra
 * @property string $fecha_recepción
 * @property string $observacion
 * @property string $solicitante
 * @property string $utilizacion
 * @property integer $fk_proveedor
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property Proveedor $fkProveedor
 * @property OrdenProducto[] $ordenProductos
 */
class OrdenCompra extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orden_compra';
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
            [['fecha_compra', 'fecha_recepcion', 'created_at', 'updated_at'], 'safe'],
            [['fk_proveedor'], 'required'],
            [['fk_proveedor'], 'integer'],
            [['folio'], 'string', 'max' => 30],
            [['observacion', 'solicitante', 'utilizacion'], 'string', 'max' => 45],
            [['created_by', 'updated_by'], 'string', 'max' => 25],
            [['fk_proveedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::className(), 'targetAttribute' => ['fk_proveedor' => 'idproveedor']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_orden_compra' => 'Id Orden Compra',
            'folio' => 'Folio',
            'fecha_compra' => 'Fecha Compra',
            'fecha_recepcion' => 'Fecha Recepción',
            'observacion' => 'Observacion',
            'solicitante' => 'Solicitante',
            'utilizacion' => 'Utilizacion',
            'fk_proveedor' => 'Proveedor',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
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
    public function getOrdenProductos()
    {
        return $this->hasMany(OrdenProducto::className(), ['fk_orden_compra' => 'id_orden_compra']);
    }
}
