<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "metodo_pago".
 *
 * @property integer $idmetodo_pago
 * @property string $metodo_pago
 *
 * @property CuentaPagar[] $cuentaPagars
 */
class MetodoPago extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'metodo_pago';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['metodo_pago'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idmetodo_pago' => 'Idmetodo Pago',
            'metodo_pago' => 'Metodo Pago',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentaPagars()
    {
        return $this->hasMany(CuentaPagar::className(), ['fk_metodo_pago' => 'idmetodo_pago']);
    }
}
