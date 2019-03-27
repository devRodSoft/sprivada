<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "produccion".
 *
 * @property integer $idproduccion
 * @property integer $nodo
 * @property integer $puente
 * @property string $produccion
 * @property boolean $st_hoja
 * @property integer $nivel
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property ProduccionValor[] $produccionValors
 */
class Produccion extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'produccion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nodo', 'puente', 'nivel'], 'integer'],
            [['st_hoja'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['produccion'], 'string', 'max' => 100],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idproduccion' => 'Idproduccion',
            'nodo' => 'Nodo',
            'puente' => 'Puente',
            'produccion' => 'Produccion',
            'st_hoja' => 'St Hoja',
            'nivel' => 'Nivel',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduccionValors()
    {
        return $this->hasMany(ProduccionValor::className(), ['fk_produccion' => 'idproduccion']);
    }
}
