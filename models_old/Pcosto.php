<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "Pcosto".
 *
 * @property integer $idpcosto
 * @property string $codigo
 * @property string $familia
 * @property string $material
 * @property string $costo
 * @property string $cantidad
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property integer $fk_proyecto_costo
 *
 * @property ProyectoCosto $fkProyectoCosto
 */
class Pcosto extends ActiveRecord
{
    public $total=0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcosto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['costo', 'cantidad'], 'number'],
            [['fk_proyecto_costo'], 'safe'],
            [['fk_proyecto_costo'], 'integer'],
            [['codigo', 'familia', 'material'], 'string', 'max' => 45],
            [['fk_proyecto_costo'], 'exist', 'skipOnError' => true, 'targetClass' => ProyectoCosto::className(), 'targetAttribute' => ['fk_proyecto_costo' => 'idproyecto_costo']],
        ];
    }

/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idpcosto' => 'Idpcosto',
            'codigo' => 'Codigo',
            'familia' => 'Familia',
            'material' => 'Material',
            'costo' => 'Costo',
            'cantidad' => 'Cantidad',
            'fk_proyecto_costo' => 'Fk Proyecto Costo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkProyectoCosto()
    {
        return $this->hasOne(ProyectoCosto::className(), ['idproyecto_costo' => 'fk_proyecto_costo']);
    }

    public function getTtotal(){
        return $this->costo*$this->cantidad;
    }
}
