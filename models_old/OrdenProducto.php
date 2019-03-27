<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "orden_producto".
 *
 * @property integer $idcompra_producto
 * @property string $codigo
 * @property string $descripcion
 * @property string $cantidad
 * @property string $um
 * @property integer $fk_orden_compra
 *
 * @property OrdenCompra $fkOrdenCompra
 */
class OrdenProducto extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orden_producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'cantidad', 'um'], 'required'],
            [['fk_orden_compra'], 'safe'],
            [['codigo', 'descripcion', 'cantidad', 'um'], 'string', 'max' => 45],
            [['fk_orden_compra'], 'exist', 'skipOnError' => true, 'targetClass' => OrdenCompra::className(), 'targetAttribute' => ['fk_orden_compra' => 'id_orden_compra']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcompra_producto' => 'Idcompra Producto',
            'codigo' => 'Codigo',
            'descripcion' => 'Descripcion',
            'cantidad' => 'Cantidad',
            'um' => 'Um',
            'fk_orden_compra' => 'Fk Orden Compra',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkOrdenCompra()
    {
        return $this->hasOne(OrdenCompra::className(), ['id_orden_compra' => 'fk_orden_compra']);
    }
}
