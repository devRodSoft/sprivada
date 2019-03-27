<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "vw_proyecto_empleado".
 *
 * @property string $porcentaje
 * @property integer $fk_proyecto
 * @property string $proyecto
 */
class VwProyectoEmpleado extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_proyecto_empleado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['porcentaje'], 'number'],
            [['fk_proyecto', 'proyecto'], 'required'],
            [['fk_proyecto'], 'integer'],
            [['proyecto'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'porcentaje' => 'Porcentaje',
            'fk_proyecto' => 'IdProyecto',
            'proyecto' => 'Proyecto',
        ];
    }
}
