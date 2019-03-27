<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "rptnomina".
 *
 * @property integer $idrptnomina
 * @property integer $fkproyecto
 * @property string $proyecto
 * @property string $empleado
 * @property string $porproyecto
 * @property string $monto_proyecto
 * @property string $porparticipacion
 * @property string $monto_participacion
 * @property string $porgeneral
 * @property string $porpreliminares
 * @property string $porplaneacion
 * @property string $porfabricacion
 * @property string $porpintura
 * @property string $poriluminacion
 * @property string $pormontaje
 * @property string $porentrega
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 */
class Rptnomina extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rptnomina';
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
            [['fkproyecto','folio_nomina'], 'integer'],
            [['porproyecto', 'monto_proyecto', 'porparticipacion', 'monto_participacion', 'porgeneral', 'porpreliminares', 'porplaneacion', 'porfabricacion', 'porpintura', 'poriluminacion', 'pormontaje', 'porentrega'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['proyecto', 'empleado'], 'string', 'max' => 100],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idrptnomina' => 'Idrptnomina',
            'folio_nomina' => 'folio',
            'fkproyecto' => 'IdProyecto',
            'proyecto' => 'Proyecto',
            'empleado' => 'Empleado',
            'porproyecto' => '% Proyecto',
            'monto_proyecto' => 'Monto Proyecto',
            'porparticipacion' => '% Participacion',
            'monto_participacion' => 'Monto Participacion',
            'porgeneral' => '% General',
            'porpreliminares' => '% Preliminares',
            'porplaneacion' => '% Planeacion',
            'porfabricacion' => '% Fabricacion',
            'porpintura' => '% Pintura',
            'poriluminacion' => '% Iluminacion',
            'pormontaje' => '% Montaje',
            'porentrega' => '% Entrega',
            'created_at' => 'Fecha Creacion',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
