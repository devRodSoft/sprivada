<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "empresa".
 *
 * @property integer $idempresa
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
 * @property integer $fkestado
 * @property integer $fkmunicipio
 * @property string $ciudad
 * @property string $tipo_empresa
 * @property string $giro
 * @property string $noempleados
 * @property string $encargado_pago
 * @property string $dias_pago
 * @property string $contrato
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property Estado $fkestado0
 * @property Municipio $fkmunicipio0
 * @property Fgeneral[] $fgenerals
 * @property Flaboral[] $flaborals
 * @property Oficina[] $oficinas
 */
class Cliente extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
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
            [['razon', 'nombre', 'fkestado', 'fkmunicipio'], 'required'],
            [['fkestado', 'fkmunicipio'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['razon', 'nombre', 'direccion', 'colonia', 'calle', 'calle2', 'tipo_cliente'], 'string', 'max' => 100],
            [['rfc', 'nointerior', 'noexterior', 'cp', 'contrato'], 'string', 'max' => 15],
            [['telefono', 'celular', 'created_by', 'updated_by'], 'string', 'max' => 30],
            [['ciudad', 'giro', 'encargado_pago'], 'string', 'max' => 45],
            [['noempleados', 'dias_pago'], 'string', 'max' => 10],
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
            'idcliente' => 'Id',
            'razon' => 'Razon',
            'nombre' => 'Nombre',
            'rfc' => 'RFC',
            'direccion' => 'Direccion',
            'nointerior' => 'No. Interior',
            'colonia' => 'Colonia',
            'noexterior' => 'No. Exterior',
            'cp' => 'Codigo postal',
            'calle' => 'Entre Calle',
            'calle2' => 'y Calle',
            'telefono' => 'Telefono',
            'celular' => 'Celular',
            'fkestado' => 'Estado',
            'fkmunicipio' => 'Municipio',
            'ciudad' => 'Ciudad',
            'tipo_cliente' => 'Tipo Empresa',
            'giro' => 'Giro',
            'noempleados' => 'No. Empleados',
            'encargado_pago' => 'Encargado Pago',
            'dias_pago' => 'Dias Pago',
            'contrato' => 'Contrato',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
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
    public function getFgenerals()
    {
        return $this->hasMany(Fgeneral::className(), ['fkempresa' => 'idempresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlaborals()
    {
        return $this->hasMany(Flaboral::className(), ['fkempresa' => 'idempresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOficinas()
    {
        return $this->hasMany(Oficina::className(), ['fkempresa' => 'idempresa']);
    }
}
