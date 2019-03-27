<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use \yii\db\ActiveRecord;
/**
 * This is the model class for table "cnivel_complejidad".
 *
 * @property integer $idcnivel_complejidad
 * @property integer $gasto
 * @property integer $tiempo
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property Proyecto[] $proyectos
 */
class NivelComplejidad extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cnivel_complejidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gasto', 'tiempo'], 'required','message'=>'Campo Obligatorio'],
            [['gasto', 'tiempo'], 'integer' , 'message'=>'Campo Numerico'],
        ];
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
    public function attributeLabels()
    {
        return [
            'idcnivel_complejidad' => 'Id',
            'gasto' => 'Gasto',
            'tiempo' => 'Tiempo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    public function getCnamedrop(){
         $prep = ($this->tiempo<2 ? " Semana" : " Semanas");
            return $this->gasto.' Tiempo:'.$this->tiempo.$prep;
    }

    public function getCname(){
         $prep = ($this->tiempo<2 ? " Semana" : " Semanas");
            return $this->tiempo.$prep;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyecto::className(), ['fk_cnivel_complejidad' => 'idcnivel_complejidad']);
    }
}
