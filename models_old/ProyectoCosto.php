<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "proyecto_costo".
 *
 * @property integer $idproyecto_costo
 * @property integer $fk_movimiento
 * @property integer $fk_proyecto
 * @property string $folio
 * @property string $solicitante
 *
 * @property Pcosto[] $pcostos
 * @property Proyecto $fkProyecto
 */
class ProyectoCosto extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_costo';
    }

    public function behaviors(){
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
    public function rules()
    {
        return [
            [['fk_movimiento', 'fk_proyecto'], 'integer'],
            [['fk_proyecto'], 'required'],
            [['folio'], 'string', 'max' => 15],
            [['solicitante'], 'string', 'max' => 100],
            [['fk_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['fk_proyecto' => 'idproyecto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idproyecto_costo' => 'Idproyecto Costo',
            'fk_movimiento' => 'Fk Movimiento',
            'fk_proyecto' => 'Fk Proyecto',
            'folio' => 'Folio',
            'solicitante' => 'Solicitante',
             'created_at' => 'Creado',
            'updated_at' => 'Editado',
            'created_by' => 'Creado por',
            'updated_by' => 'Actualizado por',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPcostos()
    {
        return $this->hasMany(Pcosto::className(), ['fk_proyecto_costo' => 'idproyecto_costo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['idproyecto' => 'fk_proyecto']);
    }
}
