<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cforma_pago".
 *
 * @property integer $idcforma_pago
 * @property string $cforma_pago
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property CajaChica[] $cajaChicas
 */
class CformaPago extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cforma_pago';
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
            [['cforma_pago'], 'string', 'max' => 45],
            [['cforma_pago'], 'required', 'message'=>'Campo Obligatorio'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcforma_pago' => 'Id',
            'cforma_pago' => 'Forma de Pago',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCajaChicas()
    {
        return $this->hasMany(CajaChica::className(), ['fk_cforma_pago' => 'idcforma_pago']);
    }
}
