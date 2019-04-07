<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "municipio".
 *
 * @property integer $idmunicipio
 * @property integer $fkestado
 * @property string $nro_municipio
 * @property string $descripcion
 *
 * @property Estado $fkestado0
 */
class Municipio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'municipio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idmunicipio', 'fkestado'], 'required'],
            [['idmunicipio', 'fkestado'], 'integer'],
            [['nro_municipio'], 'string', 'max' => 5],
            [['descripcion'], 'string', 'max' => 45],
            [['fkestado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['fkestado' => 'idestado']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idmunicipio' => 'Idmunicipio',
            'fkestado' => 'Fkestado',
            'nro_municipio' => 'Nro Municipio',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkestado0()
    {
        return $this->hasOne(Estado::className(), ['idestado' => 'fkestado']);
    }
}
