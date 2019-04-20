<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "sucursal".
 *
 * @property integer $idsucursal
 * @property string $razon
 * @property string $nombre
 * @property string $rfc
 * @property string $direccion
 * @property string $nointerior
 * @property string $colonia
 * @property string $noexterior
 * @property string $cp
 * @property string $calle
 * @property string $calle2
 * @property string $telefono
 * @property string $celular
 * @property string $ciudad
 * @property integer $fkmunicipio
 * @property integer $fkestado
 * @property string $tipo_sucursal
 * @property string $giro
 * @property string $noempleados
 * @property string $encargado
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property Equipo[] $equipos
 * @property Flaboral[] $flaborals
 * @property Estado $fkestado0
 * @property Municipio $fkmunicipio0
 * @property Vehiculo[] $vehiculos
 */
class Sucursal extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sucursal';
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
            [['razon', 'nombre', 'rfc', 'direccion', 'colonia', 'noexterior', 'cp', 'ciudad', 'fkmunicipio', 'fkestado'], 'required'],
            [['fkmunicipio', 'fkestado'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['razon', 'nombre', 'direccion', 'colonia', 'calle', 'calle2', 'tipo_sucursal'], 'string', 'max' => 100],
            [['rfc', 'nointerior', 'noexterior', 'cp'], 'string', 'max' => 15],
            [['telefono', 'celular', 'created_by', 'updated_by'], 'string', 'max' => 30],
            [['ciudad', 'giro', 'encargado'], 'string', 'max' => 45],
            [['noempleados'], 'string', 'max' => 10],
            [['fkestado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['fkestado' => 'idestado']],
            [['fkmunicipio'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['fkmunicipio' => 'idmunicipio']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idsucursal' => 'Id',
            'razon' => 'Razon',
            'nombre' => 'Nombre',
            'rfc' => 'Rfc',
            'direccion' => 'Direccion',
            'nointerior' => 'No. interior',
            'colonia' => 'Colonia',
            'noexterior' => 'No. exterior',
            'cp' => 'Codigo Postal',
            'calle' => 'Entre calle',
            'calle2' => 'Y calle',
            'telefono' => 'Telefono',
            'celular' => 'Celular',
            'ciudad' => 'Ciudad',
            'fkmunicipio' => 'Municipio',
            'fkestado' => 'Estado',
            'tipo_sucursal' => 'Tipo Sucursal',
            'giro' => 'Giro',
            'noempleados' => 'No. de empleados',
            'encargado' => 'Encargado',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipo::className(), ['fksucursal' => 'idsucursal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlaborals()
    {
        return $this->hasMany(Flaboral::className(), ['fksucursal' => 'idsucursal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkestado0()
    {
        return $this->hasOne(Estado::className(), ['idestado' => 'fkestado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkmunicipio0()
    {
        return $this->hasOne(Municipio::className(), ['idmunicipio' => 'fkmunicipio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehiculos()
    {
        return $this->hasMany(Vehiculo::className(), ['fksucursal' => 'idsucursal']);
    }
}
