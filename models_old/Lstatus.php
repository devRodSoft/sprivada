<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lstatus".
 *
 * @property integer $idlstatus
 * @property string $lstatus
 *
 * @property Llamada[] $llamadas
 */
class Lstatus extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lstatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idlstatus'], 'required'],
            [['idlstatus'], 'integer'],
            [['lstatus'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idlstatus' => 'Idlstatus',
            'lstatus' => 'Lstatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLlamadas()
    {
        return $this->hasMany(Llamada::className(), ['fk_lstatus' => 'idlstatus']);
    }
}
