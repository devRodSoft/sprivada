<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "vehiculo".
 *
 * @property integer $idvehiculo
 * @property string $numero
 * @property string $tipo
 * @property string $marca
 * @property string $modelo
 * @property string $motor
 * @property string $serie
 * @property integer $fkelemento
 * @property string $kilometraje
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 */
class Vehiculo extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vehiculo';
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
            [['numero', 'tipo', 'marca', 'modelo', 'motor', 'serie', 'kilometraje'], 'required'],
            [['fkelemento'], 'integer'],
            [['created_at', 'updated_at','fkelemento'], 'safe'],
            [['numero', 'tipo', 'marca', 'modelo', 'serie', 'created_by', 'updated_by'], 'string', 'max' => 30],
            [['motor', 'kilometraje'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idvehiculo' => 'Id',
            'numero' => '# Economico',
            'tipo' => 'Tipo',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'motor' => 'Motor',
            'serie' => 'Serie',
            'fkelemento' => 'Fkelemento',
            'kilometraje' => 'Kilometraje',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
