<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "cliente".
 *
 * @property integer $idcliente
 * @property string $nombre_razon_social
 * @property string $lider_proy
 * @property string $viinculador_1
 * @property string $correo_viin_1
 * @property string $vinculador_2
 * @property string $correo_vin_2
 * @property integer $telefono
 * @property string $direccion
 * @property string $ciudad
 * @property integer $fk_mediocontacto
 * @property integer $fk_estado
 *
 * @property Estado $fkEstado
 * @property Mediocontacto $fkMediocontacto
 * @property Proyecto[] $proyectos
 */
class Cliente extends ActiveRecord
{
    public $fk_cotizacion,$idllamada;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
    }

    public function behaviors()
    {
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
            [['lider_proy', 'vinculador_1', 'correo_vin_1', 'nombre_razon_social', 'fk_estado' , 'fk_mediocontacto' , 'telefono'], 'required' , 'message'=>'Campo Obligatorio'],
            [['correo_vin_1', 'correo_vin_2'], 'email' , 'message'=>'Campo Obligatorio correo'],
            [['fk_cotizacion', 'idllamada'], 'safe' ], //RETORNO AL PROYECTO
            [['lider_proy', 'vinculador_1', 'correo_vin_1', 'vinculador_2', 'correo_vin_2', 'ciudad','direccion' ,'nombre_razon_social' ], 'string', 'max' => 45],
            [['rfc'], 'string', 'max' => 14],
            [['telefono'], 'string', 'max' => 20],
            [['fk_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['fk_estado' => 'idestado']],
            [['fk_mediocontacto'], 'exist', 'skipOnError' => true, 'targetClass' => Mediocontacto::className(), 'targetAttribute' => ['fk_mediocontacto' => 'idmediocontacto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcliente' => 'Id',
            'nombre_razon_social' => 'Razon Social',
            'lider_proy' => 'Lider Proyecto',
            'vinculador_1' => 'Viculador 1',
            'correo_vin_1' => 'Correo Viculador 1',
            'vinculador_2' => 'Vinculador 2',
            'correo_vin_2' => 'Correo Viculador 2',
            'telefono' => 'Telefono',
            'direccion' => 'Direccion',
            'ciudad' => 'Ciudad',
            'rfc'=>'RFC',
            'fk_mediocontacto' => 'Medio Contacto',
            'fk_estado' => 'Estado',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkEstado()
    {
        return $this->hasOne(Estado::className(), ['idestado' => 'fk_estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkMediocontacto()
    {
        return $this->hasOne(Mediocontacto::className(), ['idmediocontacto' => 'fk_mediocontacto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyecto::className(), ['fk_cliente' => 'idcliente']);
    }
}
