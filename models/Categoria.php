<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "categoria".
 *
 * @property integer $idcategoria
 * @property string $categoria
 * @property string $puesto
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property Empleado[] $empleados
 */
class Categoria extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria';
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
            [['categoria', 'puesto'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcategoria' => 'Id',
            'categoria' => 'Categoria',
            'puesto' => 'Puesto',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleados()
    {
        return $this->hasMany(Empleado::className(), ['fk_categoria' => 'idcategoria']);
    }
}
