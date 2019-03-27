<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "pagos_detalle".
 *
 * @property integer $idpagos_detalle
 * @property integer $fk_pagos
 * @property string $fk_proyecto
 * @property string $proyecto
 * @property string $monto
 * @property string $avance
 * @property integer $porcentaje_pago
 * @property string $monto_total
 *
 * @property Pagos $fkPagos
 */
class NominaDetalle extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nomina_detalle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
             
            [['fk_nomina'], 'required'],
            [['fk_nomina', 'porcentaje_pago','fk_proyecto'], 'integer'],
            [['monto', 'avance', 'monto_total'], 'number'],
            [['proyecto'], 'string', 'max' => 100],
            [['fk_nomina'], 'exist', 'skipOnError' => true, 'targetClass' => Nomina::className(), 'targetAttribute' => ['fk_nomina' => 'idnomina']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idnomina_detalle' => 'Idpagos Detalle',
            'fk_nomina' => 'IdNomina',
            'fk_proyecto' => 'Fk Proyecto',
            'proyecto' => 'Proyecto',
            'monto' => 'Monto',
            'avance' => '% Avance',
            'porcentaje_pago' => 'Porcentaje Pago',
            'monto_total' => 'Monto  x Avance',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkPagos()
    {
        return $this->hasOne(Nomina::className(), ['idnomina' => 'fk_nomina']);
    }
}
