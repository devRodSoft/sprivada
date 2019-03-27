<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "csub_tipo_gasto".
 *
 * @property integer $idcsub_tipo_gasto
 * @property string $csub_tipo_gasto
 * @property integer $fk_ctipo_gasto
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property CajaChica[] $cajaChicas
 * @property CtipoGasto $fkCtipoGasto
 */
class CsubTipoGasto extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'csub_tipo_gasto';
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
    public function rules()
    {
        return [
            [['fk_ctipo_gasto'], 'required'],
            [['fk_ctipo_gasto'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['csub_tipo_gasto'], 'string', 'max' => 45],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
            [['fk_ctipo_gasto'], 'exist', 'skipOnError' => true, 'targetClass' => CtipoGasto::className(), 'targetAttribute' => ['fk_ctipo_gasto' => 'idctipo_gasto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcsub_tipo_gasto' => 'Id',
            'csub_tipo_gasto' => 'Subtipo de Gasto',
            'fk_ctipo_gasto' => 'Tipo de Gasto',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

      public function getTsubgasto(){
        $obj = $this->getFkCtipoGasto();
        var_dump($obj);
        $prep = $this->csub_tipo_gasto." - ".$obj->ctipo_gasto;
                    return $prep;
        
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCajaChicas()
    {
        return $this->hasMany(CajaChica::className(), ['fk_csub_tipo_gasto' => 'idcsub_tipo_gasto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCtipoGasto()
    {
        return $this->hasOne(CtipoGasto::className(), ['idctipo_gasto' => 'fk_ctipo_gasto']);
    }
}
