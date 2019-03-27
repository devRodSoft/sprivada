<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cotconfig".
 *
 * @property integer $idcotconfig
 * @property string $tb1
 * @property string $tb2
 */
class Cotconfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cotconfig';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tb1', 'tb2'], 'string', 'max' => 2000],
            [['cotconfig'], 'required', 'message'=>'Campo Obligatorio'],
            [['cotconfig'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcotconfig' => 'Id',
            'cotconfig'=>'Alias',
            'tb1' => 'Notas',
            'tb2' => 'Banco',
        ];
    }
}
