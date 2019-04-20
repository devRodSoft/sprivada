<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "equipo".
 *
 * @property integer $idequipo
 * @property string $codigo
 * @property integer $fkgrupo
 * @property integer $fkclase
 * @property integer $fktipo
 * @property string $o_estatus
 * @property string $updated_by
 * @property string $descripcion
 * @property integer $fkalmacen
 * @property string $calibre
 * @property string $marca
 * @property string $costo
 * @property string $licencia
 * @property string $hechoen
 * @property string $precio
 * @property string $talla
 * @property string $color
 * @property string $placa
 * @property string $matricula
 * @property integer $existencia
 * @property integer $entrada
 * @property integer $salida
 * @property integer $traspaso
 * @property integer $asginados
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $cartuchos
 * @property string $oficina_origen
 * @property integer $oficina_actual
 * @property integer $fksucursal
 *
 * @property Almacen $fkalmacen0
 * @property Clase $fkclase0
 * @property Grupo $fkgrupo0
 * @property Sucursal $fksucursal0
 * @property Tipo $fktipo0
 * @property EquipoAsignado[] $equipoAsignados
 */
class Equipo extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fkgrupo', 'fkclase', 'fktipo', 'updated_by', 'descripcion', 'fkalmacen', 'created_at', 'updated_at', 'created_by', 'fksucursal'], 'required'],
            [['fkgrupo', 'fkclase', 'fktipo', 'fkalmacen', 'existencia', 'entrada', 'salida', 'traspaso', 'asginados', 'oficina_actual', 'fksucursal'], 'integer'],
            [['costo', 'precio'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['codigo'], 'string', 'max' => 10],
            [['o_estatus', 'updated_by', 'created_by'], 'string', 'max' => 30],
            [['descripcion'], 'string', 'max' => 100],
            [['calibre', 'marca', 'licencia', 'hechoen', 'placa', 'matricula', 'cartuchos', 'oficina_origen'], 'string', 'max' => 45],
            [['talla', 'color'], 'string', 'max' => 15],
            [['codigo'], 'unique'],
            [['fkalmacen'], 'exist', 'skipOnError' => true, 'targetClass' => Almacen::className(), 'targetAttribute' => ['fkalmacen' => 'idalmacen']],
            [['fkclase'], 'exist', 'skipOnError' => true, 'targetClass' => Clase::className(), 'targetAttribute' => ['fkclase' => 'idclase']],
            [['fkgrupo'], 'exist', 'skipOnError' => true, 'targetClass' => Grupo::className(), 'targetAttribute' => ['fkgrupo' => 'idgrupo']],
            [['fksucursal'], 'exist', 'skipOnError' => true, 'targetClass' => Sucursal::className(), 'targetAttribute' => ['fksucursal' => 'idsucursal']],
            [['fktipo'], 'exist', 'skipOnError' => true, 'targetClass' => Tipo::className(), 'targetAttribute' => ['fktipo' => 'idtipo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idequipo' => 'Idequipo',
            'codigo' => 'Codigo',
            'fkgrupo' => 'Fkgrupo',
            'fkclase' => 'Fkclase',
            'fktipo' => 'Fktipo',
            'o_estatus' => 'O Estatus',
            'updated_by' => 'Updated By',
            'descripcion' => 'Descripcion',
            'fkalmacen' => 'Fkalmacen',
            'calibre' => 'Calibre',
            'marca' => 'Marca',
            'costo' => 'Costo',
            'licencia' => 'Licencia',
            'hechoen' => 'Hechoen',
            'precio' => 'Precio',
            'talla' => 'Talla',
            'color' => 'Color',
            'placa' => 'Placa',
            'matricula' => 'Matricula',
            'existencia' => 'Existencia',
            'entrada' => 'Entrada',
            'salida' => 'Salida',
            'traspaso' => 'Traspaso',
            'asginados' => 'Asginados',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'cartuchos' => 'Cartuchos',
            'oficina_origen' => 'Oficina Origen',
            'oficina_actual' => 'Oficina Actual',
            'fksucursal' => 'Fksucursal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkalmacen0()
    {
        return $this->hasOne(Almacen::className(), ['idalmacen' => 'fkalmacen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkclase0()
    {
        return $this->hasOne(Clase::className(), ['idclase' => 'fkclase']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkgrupo0()
    {
        return $this->hasOne(Grupo::className(), ['idgrupo' => 'fkgrupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFksucursal0()
    {
        return $this->hasOne(Sucursal::className(), ['idsucursal' => 'fksucursal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFktipo0()
    {
        return $this->hasOne(Tipo::className(), ['idtipo' => 'fktipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoAsignados()
    {
        return $this->hasMany(EquipoAsignado::className(), ['fkequipo' => 'idequipo']);
    }
}
