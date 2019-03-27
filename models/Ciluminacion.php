<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "ctipo_iluminacion".
 *
 * @property integer $idctipo_iluminacion
 * @property string $ctipo_iluminacion
 *
 * @property Material[] $materials
 */
class Ciluminacion extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctipo_iluminacion';
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
            [['ctipo_iluminacion'], 'required', 'message' => 'Campo Obligatorio'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idctipo_iluminacion' => 'Id',
            'ctipo_iluminacion' => 'Tipo Iluminacion',
        ];
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::className(), ['fk_ctipo_iluminacion' => 'idctipo_iluminacion']);
    }
}
