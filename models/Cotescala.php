<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cotescala".
 *
 * @property integer $idcotescala
 * @property string $escala
 * @property string $dimensiones
 * @property string $precio
 * @property integer $fk_cotizacion
 *
 * @property Cotizacion $fkCotizacion
 */
class Cotescala extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cotescala';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_cotizacion'], 'safe'],
            [['fk_cotizacion'], 'integer'],
            [['escala', 'dimensiones'], 'string', 'max' => 200],
            [['precio'], 'string', 'max' => 300],
            [['fk_cotizacion'], 'exist', 'skipOnError' => true, 'targetClass' => Cotizacion::className(), 'targetAttribute' => ['fk_cotizacion' => 'idcotizacion']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcotescala' => 'Idcotescala',
            'escala' => 'Escala',
            'dimensiones' => 'Dimensiones',
            'precio' => 'Precio',
            'fk_cotizacion' => 'Fk Cotizacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCotizacion()
    {
        return $this->hasOne(Cotizacion::className(), ['idcotizacion' => 'fk_cotizacion']);
    }
}
