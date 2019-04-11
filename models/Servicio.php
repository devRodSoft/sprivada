<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "servicio".
 *
 * @property integer $idservicio
 * @property string $grupo
 * @property string $clase
 * @property string $tipo
 * @property string $descripcion
 * @property string $costo
 * @property string $precio1
 * @property string $precio2
 * @property string $precio3
 * @property string $precio4
 * @property string $precio5
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 */
class Servicio extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicio';
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
            [['grupo', 'clase', 'tipo', 'descripcion'], 'required'],
            [['costo', 'precio1', 'precio2', 'precio3', 'precio4', 'precio5'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['grupo', 'clase', 'tipo'], 'string', 'max' => 15],
            [['descripcion'], 'string', 'max' => 100],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idservicio' => 'Id',
            'grupo' => 'Grupo',
            'clase' => 'Clase',
            'tipo' => 'Tipo',
            'descripcion' => 'Descripcion',
            'costo' => 'Costo',
            'precio1' => 'Precio 1',
            'precio2' => 'Precio 2',
            'precio3' => 'Precio 3',
            'precio4' => 'Precio 4',
            'precio5' => 'Precio 5',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
