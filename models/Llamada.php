<?php

namespace app\models;

use Yii;
use app\custom\CulpableBehavior;
use app\custom\TiempoBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "llamada".
 *
 * @property integer $idllamada
 * @property string $prospecto
 * @property string $telefono
 * @property string $email
 * @property string $asunto
 * @property string $observacion
 * @property integer $fk_lstatus
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property Cotizacion[] $cotizacions
 * @property Lstatus $fkLstatus
 */
class Llamada extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'llamada';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_lstatus'], 'required'],
            [['fk_lstatus'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['prospecto', 'asunto'], 'string', 'max' => 255],
            [['telefono'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 45],
            [['observacion'], 'string', 'max' => 1000],
            [['created_by', 'updated_by'], 'string', 'max' => 30],
            [['fk_lstatus'], 'exist', 'skipOnError' => true, 'targetClass' => Lstatus::className(), 'targetAttribute' => ['fk_lstatus' => 'idlstatus']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idllamada' => 'Folio',
            'prospecto' => 'Prospecto',
            'telefono' => 'Telefono',
            'email' => 'Email',
            'asunto' => 'Asunto',
            'observacion' => 'Observacion',
            'fk_lstatus' => 'Estatus',
            'created_at' => 'Fecha Creacion',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCotizacions()
    {
        return $this->hasMany(Cotizacion::className(), ['fk_llamada' => 'idllamada']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkLstatus()
    {
        return $this->hasOne(Lstatus::className(), ['idlstatus' => 'fk_lstatus']);
    }
}
