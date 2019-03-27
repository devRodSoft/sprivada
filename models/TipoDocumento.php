<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tipo_documento".
 *
 * @property integer $idtipo_documento
 * @property string $tipo_documento
 *
 * @property Movimiento[] $movimientos
 */
class TipoDocumento extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_documento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_documento'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtipo_documento' => 'Idtipo Documento',
            'tipo_documento' => 'Tipo Documento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientos()
    {
        return $this->hasMany(Movimiento::className(), ['fk_tipo_documento' => 'idtipo_documento']);
    }
}
