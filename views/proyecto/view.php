<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\custom\GlypIcon;
use yii\grid\GridView;
use  yii\bootstrap\Modal;
use app\custom\ProgressBar;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = "Mostrar : ".$model->idproyecto;
$this->params['breadcrumbs'][] = ['label' => 'Proyecto', 'url' => ['proyecto/']];
$this->params['breadcrumbs'][] = "Mostrar : ".$model->idproyecto;
?>
<div class="proyecto-view">

    <h1><?= Html::encode($this->title) ?>
      <?php  if(Yii::$app->user->can('fproyecto') && $model->st_terminado <3)
                echo GlypIcon::aglyp('Finalizar Proyecto','glyphicon glyphicon-fast-forward', null, ['class' => 'btn btn-success' , 'id'=>'finalizar']);?>
    </h1>

    
    <?php if(Yii::$app->user->can('costo')){
             echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'idproyecto',
                'proyecto',
                'escala',
                'fecha_entrega:date',
                'precio:decimal',
                'costo:decimal',
                'moporcentaje',
                'fkCliente.nombre_razon_social',
                [ 'label'=>'N. Complejidad',
                  'value'=> $model->fkNivelComplejidad->cname],
                'fkCestatus.cestatus',
                'fkCtipoMaterial.ctipo_material',
                'fkCtipoColor.ctipo_color',
                'fkCtipoIluminacion.ctipo_iluminacion',
                'fkCcalibreAcrilico.ccalibre_acrilico',
                'created_at:datetime',
                'updated_at:datetime',
                'created_by',
                'updated_by',
            ],
          ]); 
       }else{
            echo DetailView::widget([
          'model' => $model,
          'attributes' => [
              'idproyecto',
              'proyecto',
              'escala',
              'fecha_entrega:date',
              'fkCliente.nombre_razon_social',
              [ 'label'=>'N. Complejidad',
                'value'=> $model->fkNivelComplejidad->cname],
              'fkCestatus.cestatus',
              'fkCtipoMaterial.ctipo_material',
              'fkCtipoColor.ctipo_color',
              'fkCtipoIluminacion.ctipo_iluminacion',
              'fkCcalibreAcrilico.ccalibre_acrilico',
              'created_at:datetime',
              'updated_at:datetime',
              'created_by',
              'updated_by',
               ],
        ]); 
      } ?>

    <div>

<?php 
$template = '';
if(Yii::$app->user->can('pempleado'))
$template = '{update}{delete}';
if(Yii::$app->user->can('costo')): ?>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#costos" aria-controls="costos" role="tab" data-toggle="tab">DESGLOSE DE COSTOS</a></li>
    <li role="presentation"><a href="#empleados" aria-controls="empleados" role="tab" data-toggle="tab">EMPLEADOS ASIGNADOS</a></li>
    <li role="presentation"><a href="#produccion" aria-controls="produccion" role="tab" data-toggle="tab">PRODUCCION</a></li>
  </ul>

  <!-- Tab panes -->
    <div class="tab-content">
  <div role="tabpanel" class="tab-pane fade in active" id="costos"> <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ]],
              'codigo' , 
              'material',
              'familia',
              'costo:decimal',
            'cantidad:decimal',
            ['attribute'=>'total',
            'value'=> 'ttotal',
              'format'=>'decimal']
            
            ,],]); ?>
  </div>
  <div role="tabpanel" class="tab-pane fade" id="empleados">
    <?= GridView::widget([
        'dataProvider' => $dataProviderEmp,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],
            // 'fk_empleado',
             [  'attribute' => 'fk_empleado',
                'value'=> 'fkEmpleado.alias',
                'header'=> 'Empleado',],
            'porcentaje',
            ['class' => 'yii\grid\ActionColumn',
            'template' => $template,
            'buttons' => [
                'update' => function ($url, $model) {
                   $url1 = Url::to(['proemp/update', 'idproyecto_empleado'=> $model->idproyecto_empleado,'fk_proyecto'=>$model->fk_proyecto , 'fk_empleado'=>$model->fk_empleado]);
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>' ,$url1 ,[  'title'=> 'Editar Empleado', 'class'=>'modalwin']); 
                },
                'delete' => function($url,$model){
                   $url1 = 'proemp/delete?idproyecto_empleado='.$model->idproyecto_empleado.'&fk_proyecto='.$model->fk_proyecto.'&fk_empleado='.$model->fk_empleado;
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', [$url1] ,[ 'title'=>'Delete', 'aria-label'=>'Delete' ,'data-confirm'=>'Are you sure you want to delete this item?', 'data-method'=>'post' ,'data-pjax'=>'0' ]);
                }
              ],
                            'header'=> (Yii::$app->user->can('pempleado'))? Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , Url::to(['proemp/create', 'fk_proyecto' => $model->idproyecto])
                               , [ 'title'=> 'Nuevo Empleado', 'class'=>'modalwin']):'' ,
                'contentOptions' => ['width' => '120px;' , 'align' => 'center'],
                ],
        ],
    ]); ?>
  
  </div>
  <div role="tabpanel" class="tab-pane fade" id="produccion">
       <?= ProgressBar::widget(['label'=>'descripcion', 'value'=>'avance' , 'summary' => true, 'items' =>[$general]]) ?>
  </div>
</div>
</div>
<?php endif;?>


    
    <?php  /**<h1>COTIZACIONES</h1>
      echo GridView::widget([
        'dataProvider' => $dataProvider,

    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            // 'idcotizacion',
            'fecha',
            'referencia',
            'elaboracion',
            // 'fkProyecto.proyecto',
            // 'sitio',
            // 'edificio',
            // 'iluminacion',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn',
              'controller'=>'cotizacion',
            'template' => '{view}{print}',
            'buttons' => [
                'view' => function ($url, $model) {
                   
                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>' ,$url ,[  'title'=> 'Ver Cotizacion', 'class'=>'modalwin']); 

                    // '<span class="glyphicon glyphicon-eye-open modalwin linkear" value="'.$url.'" title="Cotizacion" ></span>';
                },
                'print' => function($url,$model){

                    $url1 = "proyecto/print?idcotizacion=".$model->idcotizacion."&fk_proyecto=".$model->fk_proyecto;
                    return Html::a('<span class="glyphicon glyphicon-print"></span>', [$url1] ,[ 'target'=>'_blank']);
                },
              ],

            'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['cotizacion/create?idproyecto='.$model->idproyecto."&proyecto=".$model->proyecto] ) ,
            'contentOptions' => ['width' => '100px;' , 'align' => 'center' ],
            ],
        ],
        ///
        
              //        'urlCreator' => function ($action, $model, $key, $index) {
              //   if ($action === 'updatecot') {
              //       $url ='cotizacion/view?idcotizacion='.$model->id;
              //       return $url;
              //   }
              // }
    ]);
     ?>

     <?php
    Modal::begin([
        'headerOptions' => ['id' => 'modalHeader' ],
        'id' => 'modal',
        'size' => 'modal-lg',
        
         // 'clientOptions' => [ 'keyboard' => true ]
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end(); **/
?>

<?php $form = ActiveForm::begin(['id'=>'finalizar_form' , 'action'=>'finalizar?id='.$model->idproyecto]); ?>
    <?php ActiveForm::end(); ?>

</div>
