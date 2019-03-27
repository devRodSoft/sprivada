<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
/**
 * This is the model class for table "cestatus".
 *
 * @property integer $idcestatus
 * @property string $cestatus
 *
 * @property Proyecto[] $proyectos
 */
class Cestatus extends ActiveRecord
{

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
    public static function tableName()
    {
        return 'cestatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cestatus'], 'required','message'=>'Campo Obligatorio'],
            [['cestatus'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcestatus' => 'Id',
            'cestatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyecto::className(), ['fk_cestatus' => 'idcestatus']);
    }
}
