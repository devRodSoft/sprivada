<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "nomina".
 *
 * @property integer $idnomina
 * @property integer $fk_empleado
 * @property string $alias
 * @property string $nombre
 * @property string $empleado_total
 * @property string $porcentaje_total
 * @property integer $folio
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property NominaDetalle[] $nominaDetalles
 */
class Nomina extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nomina';
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
           
            [['fk_empleado', 'folio'], 'integer'],
            [['empleado_total', 'porcentaje_total'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['alias'], 'string', 'max' => 45],
            [['nombre'], 'string', 'max' => 100],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idnomina' => 'Idnomina',
            'fk_empleado' => 'Fk Empleado',
            'alias' => 'Alias',
            'nombre' => 'Nombre',
            'empleado_total' => 'Empleado Total',
            'porcentaje_total' => 'Porcentaje Total',
            'folio' => 'Folio',
            'created_at' => 'Fecha Creacion',
            'updated_at' => 'Updated At',
            'created_by' => 'Creado Por',
            'updated_by' => 'A por',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNominaDetalles()
    {
        return $this->hasMany(NominaDetalle::className(), ['fk_nomina' => 'idnomina']);
    }
}
