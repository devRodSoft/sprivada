<?php

namespace app\models;

use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ccalibre_acrilico".
 *
 * @property integer $idccalibre_acrilico
 * @property string $ccalibre_acrilico
 *
 * @property Material[] $materials
 */
class CcalibreAcrilico extends ActiveRecord
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
        return 'ccalibre_acrilico';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ccalibre_acrilico'], 'required', 'message'=>'Campo Obligatorio'],
            [['ccalibre_acrilico'], 'string', 'max' => 45],
            //[['usuario,fcreacion,fmodificacion'] , 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idccalibre_acrilico' => 'Id',
            'ccalibre_acrilico' => 'Calibre Acrilico',
            'fcreacion' => 'Fecha Creacion',
            'fmodificacion' => 'Fecha Modificacion',
            'usuario' => 'Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::className(), ['fk_ccalibre_acrilico' => 'idccalibre_acrilico']);
    }
}
