<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "proyecto".
 *
 * @property integer $idproyecto
 * @property string $proyecto
 * @property string $escala
 * @property string $fecha_entrega
 * @property integer $precio
 * @property integer $costo
 * @property integer $fk_cliente
 * @property integer $fk_cnivel_complejidad
 * @property integer $fk_cestatus
 * @property integer $fk_ctipo_material
 * @property integer $fk_ctipo_color
 * @property integer $fk_ctipo_iluminacion
 * @property integer $fk_ccalibre_acrilico
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property DesarolloValor[] $desarolloValors
 * @property CcalibreAcrilico $fkCcalibreAcrilico
 * @property Cestatus $fkCestatus
 * @property CnivelComplejidad $fkCnivelComplejidad
 * @property CtipoColor $fkCtipoColor
 * @property CtipoIluminacion $fkCtipoIluminacion
 * @property CtipoMaterial $fkCtipoMaterial
 * @property Cliente $fkCliente
 * @property ProyectoCosto[] $proyectoCostos
 * @property ProyectoEquipo[] $proyectoEquipos
 */
class Proyecto extends ActiveRecord
{
    public $idllamada,$st_iluminacion;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto';
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
            [['proyecto', 'escala', 'fecha_entrega', 'precio',  'fk_cliente', 'fk_cnivel_complejidad', 'fk_ctipo_material', 'fk_ctipo_color', 'fk_ctipo_iluminacion', 'fk_ccalibre_acrilico','fk_cestatus','moporcentaje'], 'required','message'=>'Campo Obligatorio'],
            [['fecha_entrega','fk_cotizacion' , 'activo','st_terminado' , 'st_iluminacion'], 'safe'],
            [['precio', 'moporcentaje', 'fase' , 'st_iluminacion'], 'integer'],
            [['proyecto'], 'string', 'max' => 80],
            [['escala'], 'string', 'max' => 20],
            [['created_by', 'updated_by'], 'string', 'max' => 25],
            ['moporcentaje', 'compare', 'compareValue' => 100, 'operator' => '<=' , 'message' => 'Porcentaje menor al 100%'],
            [['fk_ccalibre_acrilico'], 'exist', 'skipOnError' => true, 'targetClass' => CcalibreAcrilico::className(), 'targetAttribute' => ['fk_ccalibre_acrilico' => 'idccalibre_acrilico']],
            [['fk_cestatus'], 'exist', 'skipOnError' => true, 'targetClass' => Cestatus::className(), 'targetAttribute' => ['fk_cestatus' => 'idcestatus']],
            [['fk_cnivel_complejidad'], 'exist', 'skipOnError' => true, 'targetClass' => NivelComplejidad::className(), 'targetAttribute' => ['fk_cnivel_complejidad' => 'idcnivel_complejidad']],
            [['fk_ctipo_color'], 'exist', 'skipOnError' => true, 'targetClass' => CtipoColor::className(), 'targetAttribute' => ['fk_ctipo_color' => 'cidtipo_color']],
            [['fk_ctipo_iluminacion'], 'exist', 'skipOnError' => true, 'targetClass' => Ciluminacion::className(), 'targetAttribute' => ['fk_ctipo_iluminacion' => 'idctipo_iluminacion']],
            [['fk_ctipo_material'], 'exist', 'skipOnError' => true, 'targetClass' => Ctmaterial::className(), 'targetAttribute' => ['fk_ctipo_material' => 'idctipo_material']],
            [['fk_cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['fk_cliente' => 'idcliente']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idproyecto' => 'Id',
            'proyecto' => 'Proyecto',
            'activo' => 'Activo',
            'escala' => 'Escala',
            'moporcentaje' => 'Mano Obra %',
            'fecha_entrega' => 'Fecha Entrega',
            'st_terminado'=>'Terminado',
            'st_iluminacion'=> 'LLeva iluminacion',
            'precio' => 'Precio',
            'costo' => 'Costo',
            'fase' => 'Fase del Proyecto',
            'fk_cliente' => 'Cliente',
            'fk_cotizacion' => 'Cotizacion',
            'fk_cnivel_complejidad' => 'Nivel de Complejidad',
            'fk_cestatus' => 'Estatus',
            'fk_ctipo_material' => 'Tipo Material',
            'fk_ctipo_color' => 'Tipo Color',
            'fk_ctipo_iluminacion' => 'Tipo Iluminacion',
            'fk_ccalibre_acrilico' => 'Calibre Acrilico',
            'created_at' => 'Fecha Creacion',
            'updated_at' => 'Editado',
            'created_by' => 'Creado por',
            'updated_by' => 'Actualizado por',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesarolloValors()
    {
        return $this->hasMany(DesarolloValor::className(), ['fk_proyecto' => 'idproyecto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCcalibreAcrilico()
    {
        return $this->hasOne(CcalibreAcrilico::className(), ['idccalibre_acrilico' => 'fk_ccalibre_acrilico']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCestatus()
    {
        return $this->hasOne(Cestatus::className(), ['idcestatus' => 'fk_cestatus']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkNivelComplejidad()
    {
        return $this->hasOne(NivelComplejidad::className(), ['idcnivel_complejidad' => 'fk_cnivel_complejidad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCtipoColor()
    {
        return $this->hasOne(CtipoColor::className(), ['cidtipo_color' => 'fk_ctipo_color']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCtipoIluminacion()
    {
        return $this->hasOne(Ciluminacion::className(), ['idctipo_iluminacion' => 'fk_ctipo_iluminacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCtipoMaterial()
    {
        return $this->hasOne(Ctmaterial::className(), ['idctipo_material' => 'fk_ctipo_material']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCliente()
    {
        return $this->hasOne(Cliente::className(), ['idcliente' => 'fk_cliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoCostos()
    {
        return $this->hasMany(ProyectoCosto::className(), ['fk_proyecto' => 'idproyecto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoEquipos()
    {
        return $this->hasMany(ProyectoEquipo::className(), ['fk_proyecto' => 'idproyecto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSstterminado()
    {
        if($this->st_terminado==1)
            return "NUEVO";
        if($this->st_terminado==2)
            return "DESARROLLO";
        if($this->st_terminado==3)
            return "TERMINADO";
    }


    public function getProyectoCotizaciones()
    {
        return $this->hasMany(Cotizacion::className(), ['fk_proyecto' => 'idproyecto']);
    }
}
