<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "mediocontacto".
 *
 * @property integer $idmediocontacto
 * @property string $medio
 *
 * @property Cliente[] $clientes
 */
class Mediocontacto extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mediocontacto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['medio'], 'string', 'max' => 60],
            [['medio'], 'required' , 'message'=>'Campo Obligatorio'],
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
            'idmediocontacto' => 'Id',
            'medio' => 'Medio de Contacto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::className(), ['fk_mediocontacto' => 'idmediocontacto']);
    }
}
