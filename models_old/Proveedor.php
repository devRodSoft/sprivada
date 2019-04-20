<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "proveedor".
 *
 * @property integer $idproveedor
 * @property string $razon_social
 * @property string $nombre_contacto
 * @property string $telefono1
 * @property string $telefono
 * @property string $rfc
 * @property string $direccion
 * @property string $email
 * @property string $ciudad
 * @property string $estado
 * @property string $pagina_web
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property Compra[] $compras
 */
class Proveedor extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proveedor';
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
            [['razon_social', 'nombre_contacto', 'telefono' , 'diacredito'], 'required' , 'message'=>'Campo requerido'],
            [['created_at', 'updated_at'], 'safe'],
            [['razon_social', 'nombre_contacto', 'telefono1', 'telefono', 'rfc', 'direccion', 'email', 'ciudad', 'estado', 'pagina_web'], 'string', 'max' => 45],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idproveedor' => 'Idproveedor',
            'razon_social' => 'Razon Social',
            'nombre_contacto' => 'Nombre Contacto',
            'telefono1' => 'Telefono1',
            'telefono' => 'Telefono',
            'rfc' => 'RFC',
            'direccion' => 'Direccion',
            'email' => 'Email',
			'diacredito' => 'Dias de Credito',
            'ciudad' => 'Ciudad',
            'estado' => 'Estado',
            'pagina_web' => 'Pagina Web',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompras()
    {
        return $this->hasMany(Compra::className(), ['fk_proveedor' => 'idproveedor']);
    }
}
