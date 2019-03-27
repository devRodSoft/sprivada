<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "proyecto_material".
 *
 * @property integer $idproyecto_material
 * @property integer $fk_proyecto
 *
 * @property Material[] $materials
 * @property Proyecto $fkProyecto
 */
class ProyectoMaterial extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_material';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_proyecto'], 'required'],
            [['fk_proyecto'], 'integer'],
            [['fk_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['fk_proyecto' => 'idproyecto']],
        ];
    }

    public function behaviors()
    {
        return [
            'blame' =>       [
                'class' => CulpableBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_by','updated_by'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_by'],

                ],


            ],
            'timestamp' => [
                'class' => TiempoBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                    //'value' => new Expression('date(\'Y-m-d H:i:s\');'),
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idproyecto_material' => 'Idproyecto Material',
            'fk_proyecto' => 'Fk Proyecto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::className(), ['fk_proyecto_material' => 'idproyecto_material', 'fk_proyecto_material1' => 'fk_proyecto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['idproyecto' => 'fk_proyecto']);
    }
}
