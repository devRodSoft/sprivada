<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "proyecto_empleado".
 *
 * @property integer $idproyecto_empleado
 * @property integer $porcentaje
 * @property integer $fk_proyecto
* @property integer $fk_empleado
 *
 * @property Empleado $fkEmpleado
 * @property Proyecto $fkProyecto
 */
class ProyectoEmpleado extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_empleado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['porcentaje', 'fk_proyecto'], 'integer'],
            [['fk_proyecto', 'fk_empleado'], 'required'],
            [['porcentaje'], 'checkTotalU',  'on'=>'update'],
            [['porcentaje'], 'checkTotalCr' , 'on'=>'create'],
          
            [['fk_empleado'], 'exist', 'skipOnError' => true, 'targetClass' => Empleado::className(), 'targetAttribute' => ['fk_empleado' => 'idempleado']],
            [['fk_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['fk_proyecto' => 'idproyecto']],
        ];
    }

     public function checkTotalU($attribute, $params)
    {
        $tmp = 0;
        $resta = 0;
        $tmp = ProyectoEmpleado::find()->where(['fk_proyecto'=>$this->fk_proyecto ])->
                andWhere(['!=', 'idproyecto_empleado', $this->idproyecto_empleado])->sum('porcentaje');
        $resta = 100 - $tmp;
        if($tmp + $this->porcentaje > 100){
            $this->addError($attribute, "El porcentaje no puede ser mayor a ". $resta);
        }
    }


     public function checkTotalCr($attribute, $params)
    {
        $tmp = 0;
        $resta = 0;
        $tmp = ProyectoEmpleado::find()->where(['fk_proyecto'=>$this->fk_proyecto ])->sum('porcentaje');
        $resta = 100 - $tmp;
         
        if(($tmp + $this->porcentaje) > 100){
            $this->addError($attribute, "El porcentaje no puede ser mayor a ". $resta);
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idproyecto_empleado' => 'Empleado',
            'porcentaje' => 'Porcentaje',
            'fk_proyecto' => 'Proyecto',
            'fk_empleado' => 'Empleado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkEmpleado()
    {
        return $this->hasOne(Empleado::className(), ['idempleado' => 'fk_empleado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['idproyecto' => 'fk_proyecto']);
    }
}
