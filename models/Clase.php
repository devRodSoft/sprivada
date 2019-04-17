<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "clase".
 *
 * @property integer $idclase
 * @property string $descripcion
 * @property integer $fktipo
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property Tipo $fktipo0
 * @property Equipo[] $equipos
 * @property Servicio[] $servicios
 */
class Clase extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public $fkgrupo = "";
    public static function tableName()
    {
        return 'clase';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fktipo','fkgrupo' , 'descripcion'], 'required'],
            [['fktipo','fkgrupo'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['descripcion'], 'string', 'max' => 45],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
            [['fktipo'], 'exist', 'skipOnError' => true, 'targetClass' => Tipo::className(), 'targetAttribute' => ['fktipo' => 'idtipo']],
        ];
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
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idclase' => 'Id',
            'descripcion' => 'Descripcion',
            'fktipo' => 'Tipo',
            'fkgrupo' => 'Grupo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
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
    public function getEquipos()
    {
        return $this->hasMany(Equipo::className(), ['fkclase' => 'idclase']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicios()
    {
        return $this->hasMany(Servicio::className(), ['fkclase' => 'idclase']);
    }
}
