<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cotestatus".
 *
 * @property integer $idcestatus
 * @property string $cotestatus
 *
 * @property Cotizacion[] $cotizacions
 */
class Cotstatus extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cotstatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcestatus'], 'required'],
            [['idcestatus'], 'integer'],
            [['cotestatus'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcestatus' => 'Idcestatus',
            'cotestatus' => 'Cotestatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCotizacions()
    {
        return $this->hasMany(Cotizacion::className(), ['fk_cotestatus' => 'idcestatus']);
    }
}
