<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "ctipo_color".
 *
 * @property integer $cidtipo_color
 * @property string $ctipo_color
 *
 * @property Material[] $materials
 */
class CtipoColor extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctipo_color';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ctipo_color'], 'required','message'=>'Campo Obligatorio'],
            [['ctipo_color'], 'string', 'max' => 45],
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
            'cidtipo_color' => 'Id',
            'ctipo_color' => 'Tipo Color',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::className(), ['fk_ctipo_color' => 'cidtipo_color']);
    }
}
