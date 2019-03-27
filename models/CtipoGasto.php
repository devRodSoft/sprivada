<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ctipo_gasto".
 *
 * @property integer $idctipo_gasto
 * @property string $ctipo_gasto
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property CsubTipoGasto[] $csubTipoGastos
 */
class CtipoGasto extends ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctipo_gasto';
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
            [['created_at', 'updated_at'], 'safe'],
            [['ctipo_gasto'], 'string', 'max' => 45],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idctipo_gasto' => 'Id',
            'ctipo_gasto' => 'Tipo de Gasto',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsubTipoGastos()
    {
        return $this->hasMany(CsubTipoGasto::className(), ['fk_ctipo_gasto' => 'idctipo_gasto']);
    }
}
