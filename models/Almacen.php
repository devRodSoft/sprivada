<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "material_almacen".
 *
 * @property integer $idmaterial_almacen
 * @property string $codigo
 * @property string $material_almacen
 * @property string $familia
 * @property string $existencia
 * @property string $costo
 * @property string $costo_iva
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property integer $fk_um
 *
 * @property Um $fkUm
 * @property MovimientoDetalle[] $movimientoDetalles
 */
class Almacen extends ActiveRecord
{
    public $error = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'material_almacen';
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
            [['existencia', 'costo', 'costo_iva' , 'fk_um'], 'number'],
            [['fk_um' , 'codigo' , 'material_almacen', 'familia'], 'required' , 'message'=>'Campo obligatorio' ],
            [['codigo'], 'string', 'max' => 10],
            [['material_almacen', 'familia'], 'string', 'max' => 45],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
            [['codigo'], 'unique' , 'message'=> 'El codigo ya existe'],
            [['fk_um'], 'exist', 'skipOnError' => true, 'targetClass' => Um::className(), 'targetAttribute' => ['fk_um' => 'idum']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idmaterial_almacen' => 'Idmaterial Almacen',
            'codigo' => 'Codigo',
            'material_almacen' => 'Material Almacen',
            'familia' => 'Familia',
            'existencia' => 'Existencia',
            'costo' => 'Costo',
            'costo_iva' => 'Costo Iva',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'fk_um' => 'Um',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkUm()
    {
        return $this->hasOne(Um::className(), ['idum' => 'fk_um']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientoDetalles()
    {
        return $this->hasMany(MovimientoDetalle::className(), ['fk_material_almacen' => 'codigo']);
    }
}
