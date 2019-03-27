<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "produccion_valor".
 *
 * @property integer $iddesarollo_valor
 * @property integer $avance
 * @property integer $avance_ant
 * @property integer $fk_proyecto
 * @property integer $fk_produccion
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property integer $n1
 * @property integer $n2
 * @property integer $n3
 *
 * @property Produccion $fkProduccion
 * @property Proyecto $fkProyecto
 */
class ProduccionValor extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'produccion_valor';
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
            ['avance', 'compare', 'compareValue' => 100, 'operator' => '<=' , 'message'=>"No puede ser mayor a 100"],
            // ['avance', 'compare', 'compareValue' => $this->avance_ant, 'operator' => '>'  , 'on'=>'update'],
            [['fk_proyecto',  'n1','n2','n3' , 'st_hoja' ,'fk_produccion'], 'integer'],
            [['avance', 'avance_ant'] , 'number'],
            [['fk_proyecto', 'fk_produccion'], 'required'],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
            [['fk_produccion'], 'exist', 'skipOnError' => true, 'targetClass' => Produccion::className(), 'targetAttribute' => ['fk_produccion' => 'idproduccion']],
            [['fk_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['fk_proyecto' => 'idproyecto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idproduccion_valor' => 'Idproduccion Valor',
            'avance' => 'Avance',
            'avance_ant' => 'Avance Ant',
            'fk_proyecto' => 'Fk Proyecto',
            'fk_produccion' => 'Fk Produccion',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'n1' => 'N1',
            'n2' => 'N2',
            'st_hoja' => 'HOJA',
            'n3' => 'N3',
        ];
    }

    public function isMayoranterior($attribute, $params)
    {
        // d($params);
        // if($this->avance < $this->avance_ant )
        $this->addError($attribute , "No puede ser menor a avance anterior");
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkProduccion()
    {
        return $this->hasOne(Produccion::className(), ['idproduccion' => 'fk_produccion']);
    }

    public function getSn1()
    {
         if($this->n1 == 0)
            return "NINGUNO";
        $d = Produccion::findOne(['nodo' => $this->n1]);
        return $d->produccion;
    }

    public function getSn2()
    {
         if($this->n2 == 0)
            return "NINGUNO";
         $d = Produccion::findOne(['nodo' => $this->n2]);
        return $d->produccion;
    }

    public function getSn3()
    {
        if($this->n3 == 0)
            return "NINGUNO";
        $d = Produccion::findOne(['nodo' => $this->n3]);
        if($d == null){
            d($this->n3);
            die();
        }
        return $d->produccion;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['idproyecto' => 'fk_proyecto']);
    }
}
