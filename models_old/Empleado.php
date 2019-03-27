<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "empleado".
 *
 * @property integer $idempleado
 * @property string $alias
 * @property string $nombre
 * @property string $apellido
 * @property string $imss
 * @property string $domicilio
 * @property string $telefono
 * @property string $foto_ruta
 * @property integer $fk_categoria
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property Categoria $fkCategoria
 * @property EmpleadoEquipo[] $empleadoEquipos
 */
class Empleado extends ActiveRecord
{
    public $archivo;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'empleado';
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
            [['fk_categoria'], 'required'],
            [['fk_categoria'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['alias', 'imss', 'domicilio', 'telefono', 'foto_ruta'], 'string', 'max' => 45],
            [['archivo'] , 'file'],
            [['nombre'], 'string', 'max' => 100],
            [['apellido'], 'string', 'max' => 60],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
            [['fk_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['fk_categoria' => 'idcategoria']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idempleado' => 'Id',
            'alias' => 'Alias',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'imss' => 'Imss',
            'domicilio' => 'Domicilio',
            'telefono' => 'Telefono',
            'foto_ruta' => 'Foto Ruta',
            'fk_categoria' => 'Categoria',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCategoria()
    {
        return $this->hasOne(Categoria::className(), ['idcategoria' => 'fk_categoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleadoEquipos()
    {
        return $this->hasMany(EmpleadoEquipo::className(), ['fk_empleado' => 'idempleado']);
    }
}
