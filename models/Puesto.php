<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "puesto".
 *
 * @property integer $idpuesto
 * @property string $descripcion
 * @property integer $b_supervisor
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property Elemento[] $elementos
 */
class Puesto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'puesto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion' , 'b_supervisor' ], 'required'],
            [['b_supervisor'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['descripcion'], 'string', 'max' => 45],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
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
            'idpuesto' => 'Id',
            'descripcion' => 'Descripcion',
            'b_supervisor' => 'Es supervisor',
            'sbsupervisor' => 'Es supervisor',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElementos()
    {
        return $this->hasMany(Elemento::className(), ['fkpuesto' => 'idpuesto']);
    }
    
    public function getSbsupervisor(){
        if($this->b_supervisor == 1){
            return "SI";
        }else{
            return "NO";
        }
    }
}
