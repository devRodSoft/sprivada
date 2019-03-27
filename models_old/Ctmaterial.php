<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "ctipo_material".
 *
 * @property integer $idctipo_material
 * @property string $ctipo_material
 *
 * @property Material[] $materials
 */
class Ctmaterial extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctipo_material';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ctipo_material'], 'required','message'=>'Campo Obligatorio'],
            [['ctipo_material'], 'string', 'max' => 45],
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
            'idctipo_material' => 'Id',
            'ctipo_material' => 'Tipo Material',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::className(), ['fk_ctipo_material' => 'idctipo_material']);
    }
}
