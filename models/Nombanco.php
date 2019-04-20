<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nombanco".
 *
 * @property integer $idnombanco
 * @property string $descripcion
 *
 * @property Fnomina[] $fnominas
 */
class Nombanco extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nombanco';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['descripcion'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idnombanco' => 'Idnombanco',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFnominas()
    {
        return $this->hasMany(Fnomina::className(), ['fknombanco' => 'idnombanco']);
    }
}
