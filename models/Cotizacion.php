<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;
use app\models\Llamada;


/**
 * This is the model class for table "cotizacion".
 *
 * @property integer $idcotizacion
 * @property string $fecha
 * @property string $referencia
 * @property string $elaboracion
 * @property string $sitio
 * @property string $edificio
 * @property string $iluminacion
 * @property string $tipo
 * @property string $direccion
 * @property string $razon
 * @property string $nombre_proyecto
 * @property string $escala
 * @property integer $fk_cotestatus
 * @property integer $fk_cotconfig
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property Cotescala[] $cotescalas
 * @property Cotconfig $fkCotconfig
 * @property Cotstatus $fkCotestatus
 * @property Llamada[] $llamadas
 * @property Proyecto[] $proyectos
 */
class Cotizacion extends ActiveRecord
{   
    public $st_iluminacion, $st_sitio;

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
    public static function tableName()
    {
        return 'cotizacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_cotestatus', 'fk_cotconfig' , 'fk_llamada'], 'required'],
            [['fk_cotestatus', 'fk_cotconfig','st_iluminacion', 'st_sitio'], 'integer'],
            [['created_at', 'updated_at','fk_llamada','observacion'], 'safe' ],
            [['fecha', 'referencia', 'elaboracion', 'tipo', 'direccion', 'razon', 'nombre_proyecto', 'escala'], 'string', 'max' => 45],
            [['sitio','iluminacion'], 'string', 'max' => 2000],
			[[ 'edificio'], 'string', 'max' => 6000],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
            [['fk_cotconfig'], 'exist', 'skipOnError' => true, 'targetClass' => Cotconfig::className(), 'targetAttribute' => ['fk_cotconfig' => 'idcotconfig']],
            [['fk_cotestatus'], 'exist', 'skipOnError' => true, 'targetClass' => Cotstatus::className(), 'targetAttribute' => ['fk_cotestatus' => 'idcestatus']],
            [['fk_llamada'], 'exist', 'skipOnError' => true, 'targetClass' => Llamada::className(), 'targetAttribute' => ['fk_llamada' => 'idllamada']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcotizacion' => 'Folio',
            'fecha' => 'Fecha',
            'referencia' => 'Referencia',
            'elaboracion' => 'Tiempo de Elaboracion',
            'sitio' => 'Sitio',
            'edificio' => 'Edificio',
            'iluminacion' => 'Iluminacion',
            'tipo' => 'Tipo',
            'direccion' => 'Direccion',
            'razon' => 'Razon Social',
            'nombre_proyecto' => 'Nombre Proyecto',
            'escala' => 'Escala',
            'observacion' => 'Razon',
            'fk_cotestatus' => 'Status',
            'fk_cotconfig' => 'Pie de Pagina',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'st_iluminacion'=>"Mostrar Iluminacion",
            'st_sitio'=>"Mostrar Sitio",
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCotescalas()
    {
        return $this->hasMany(Cotescala::className(), ['fk_cotizacion' => 'idcotizacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCotconfig()
    {
        return $this->hasOne(Cotconfig::className(), ['idcotconfig' => 'fk_cotconfig']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCotestatus()
    {
        return $this->hasOne(Cotstatus::className(), ['idcestatus' => 'fk_cotestatus']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLlamadas()
    {
        return $this->hasMany(Llamada::className(), ['fk_cotizacion' => 'idcotizacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyecto::className(), ['fk_cotizacion' => 'idcotizacion', 'fk_cotizacion1' => 'fk_cotestatus']);
    }

    public function getCotestatusfull()
    {
        $hoy = date("Y-m-d");
        $fec = date_create($this->fecha);
        //$fec = date_create("2013-05-20");
        $futuro = date_add($fec ,date_interval_create_from_date_string("30 days"));
        $fut = $futuro->format("Y-m-d H:i:s");

        if($this->fk_cotestatus<2 ){
            return $this->fkCotestatus->cotestatus;
        }else{
        return  ($fut < $hoy)?"NO VIGENTE":$this->fkCotestatus->cotestatus;

        }
    }

    public function getSize()
    {
        $count = Cotizacion::find()
    ->where(['fk_llamada' => $this->fk_llamada , 'fk_cotestatus' => 2 ])
    ->count();
    return $count; 
    }

    // public function getFechast()
    // {
    //     return $this->fecha.":".$this->getCotestatusfull();
    // }
}
