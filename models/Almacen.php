<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "almacen".
 *
 * @property integer $idalmacen
 * @property string $descripcion
 * @property integer $fkgrupo
 * @property integer $fktipo
 * @property integer $fkclase
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property Clase $fkclase0
 * @property Grupo $fkgrupo0
 * @property Tipo $fktipo0
 * @property Equipo[] $equipos
 */
class Almacen extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'almacen';
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
            [['descripcion', 'fkgrupo', 'fktipo', 'fkclase'], 'required'],
            [['fkgrupo', 'fktipo', 'fkclase'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['descripcion'], 'string', 'max' => 45],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
            [['fkclase'], 'exist', 'skipOnError' => true, 'targetClass' => Clase::className(), 'targetAttribute' => ['fkclase' => 'idclase']],
            [['fkgrupo'], 'exist', 'skipOnError' => true, 'targetClass' => Grupo::className(), 'targetAttribute' => ['fkgrupo' => 'idgrupo']],
            [['fktipo'], 'exist', 'skipOnError' => true, 'targetClass' => Tipo::className(), 'targetAttribute' => ['fktipo' => 'idtipo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idalmacen' => 'Id',
            'descripcion' => 'Descripcion',
            'fkgrupo' => 'Grupo',
            'fktipo' => 'Tipo',
            'fkclase' => 'Clase',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
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
    public function getFktipo0()
    {
        return $this->hasOne(Tipo::className(), ['idtipo' => 'fktipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipo::className(), ['fkalmacen' => 'idalmacen']);
    }
}
