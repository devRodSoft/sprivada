<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "elemento".
 *
 * @property integer $idelemento
 * @property string $paterno
 * @property string $materno
 * @property string $nombre
 * @property string $iniciales
 * @property integer $sexo
 * @property integer $fkservicio
 * @property integer $fkpuesto
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property Ausencia[] $ausencias
 * @property Puesto $fkpuesto0
 * @property Servicio $fkservicio0
 * @property EquipoAsignado[] $equipoAsignados
 * @property Fdocumento[] $fdocumentos
 * @property Fgeneral[] $fgenerals
 * @property Flaboral[] $flaborals
 * @property Fnomina[] $fnominas
 * @property Incidencia[] $incidencias
 * @property Vehiculo[] $vehiculos
 */
class Elemento extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'elemento';
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
            [['paterno', 'materno', 'nombre', 'iniciales', 'sexo', 'fkpuesto'], 'required'],
            [['sexo',  'fkpuesto'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['paterno', 'materno'], 'string', 'max' => 45],
            [['nombre'], 'string', 'max' => 100],
            [['iniciales'], 'string', 'max' => 6],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
            [['fkpuesto'], 'exist', 'skipOnError' => true, 'targetClass' => Puesto::className(), 'targetAttribute' => ['fkpuesto' => 'idpuesto']],
            [['fkservicio'], 'exist', 'skipOnError' => true, 'targetClass' => Servicio::className(), 'targetAttribute' => ['fkservicio' => 'idservicio']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idelemento' => 'Id',
            'paterno' => 'Apellido Paterno',
            'materno' => 'Apellido Materno',
            'nombre' => 'Nombre',
            'iniciales' => 'Iniciales',
            'sexo' => 'Sexo',
            'fkservicio' => 'Servicio',
            'fkpuesto' => 'Puesto',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAusencias()
    {
        return $this->hasMany(Ausencia::className(), ['fkelemento' => 'idelemento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkpuesto0()
    {
        return $this->hasOne(Puesto::className(), ['idpuesto' => 'fkpuesto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkservicio0()
    {
        return $this->hasOne(Servicio::className(), ['idservicio' => 'fkservicio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoAsignados()
    {
        return $this->hasMany(EquipoAsignado::className(), ['fkelemento' => 'idelemento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFdocumentos()
    {
        return $this->hasMany(Fdocumento::className(), ['fkelemento' => 'idelemento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFgenerals()
    {
        return $this->hasMany(Fgeneral::className(), ['fkelemento' => 'idelemento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlaborals()
    {
        return $this->hasMany(Flaboral::className(), ['fkelemento' => 'idelemento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFnominas()
    {
        return $this->hasMany(Fnomina::className(), ['fkelemento' => 'idelemento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncidencias()
    {
        return $this->hasMany(Incidencia::className(), ['fkelemento' => 'idelemento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehiculos()
    {
        return $this->hasMany(Vehiculo::className(), ['fkelemento' => 'idelemento']);
    }
}
