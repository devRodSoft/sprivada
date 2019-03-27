<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\filters\AccessRule;
use app\models\Mediocontacto;
use yii\helpers\ArrayHelper;
use app\custom\GlypIcon;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Lista de  Clientes";
$this->params['breadcrumbs'][] = "Clientes";
?>
<div class="cliente-index">

    <h1><?=  Html::encode($this->title);?> </h1>
 
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idcliente',
            'nombre_razon_social',
            'rfc',
            // 'lider_proy',
            'vinculador_1',
            'correo_vin_1',

            // 'correo_vin_2',
            // 'telefono',
            // 'direccion',
            // 'ciudad',

//            [ 'attribute' =>'fk_mediocontacto' ,
//                'value' => 'fkMediocontacto.medio'
//            ],
//            [ 'attribute' =>'fk_mediocontacto' ,
//                'value' => 'fkMediocontacto.medio',
//                 'filter'=>ArrayHelper::map(Mediocontacto::find()->asArray()->all(),'medio' , 'medio')
//            ],

            ['class' => 'yii\grid\ActionColumn',
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create'],[ 'title'=> 'Nuevo Cliente', 'class'=>'modalwin']) ,

           
                'buttons' => [
                'view' => function ($url, $model) {
                    
                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>' , $url,[ 'title'=> 'Mostrar Cliente', 'class'=>'modalwin']); 
                 },
                 'update' => function ($url, $model) {
                    
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>' , $url,[ 'title'=> 'Editar Cliente', 'class'=>'modalwin']); 
                 },            
                    
               
              ],
                'contentOptions' => ['width' => '100px;' , 'align' => 'center' , 'class' => 'modalwinup' ],
            ],
        ],
    ]); ?>
    </div>
</div>
