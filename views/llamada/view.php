<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Llamada */

$this->title = "Mostrar : ".$model->idllamada;
$this->params['breadcrumbs'][] = ['label' => 'Llamadas', 'url' => ['/llamada']];
global $prospecto,$status;
 $prospecto = $model->prospecto;
 $status = $model->fk_lstatus;
$this->params['breadcrumbs'][] = "Mostrar : ".$model->idllamada;
$COTIZADO =2;
$ENVIADO = 3;
$RECIBIDO =4; 
?>
<div class="llamada-view">

    <h1><?= Html::encode($this->title) ?>

      <?php  
       //FKSTATUS =4 TODAVIA NO RECIBIDO
       if($model->fk_lstatus < $RECIBIDO): ?>
        <?php $form = ActiveForm::begin([
          'action'=> 'sendcot',
          "options" => ["class"=>"confirmar"],


          ]); ?>
        <input type="hidden" name="idllamada" value="<?= $model->idllamada ?>">
        <input type="hidden" name="fk_lstatus" value="<?= $model->fk_lstatus ?>">
        <?php 
            if($model->fk_lstatus ==$COTIZADO)
          echo '<button type="button" class="btn btn-default" data-value="0">ENVIADO</button>';
            if($model->fk_lstatus ==$ENVIADO)
          echo '<button type="button" class="btn btn-default" data-titulo="Cotizacion Recibida" data-message="La cotizacion fue recibida por el cliente?" data-value="0">RECIBIDO</button>'; ?>
    <?php ActiveForm::end(); ?>
      <?php endif ?>
      </h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idllamada',
            'prospecto',
            'telefono',
            'email:email',
            'asunto',
            'observacion',
            [   'label'=> 'Cotizacion Status','value'=> $model->fkLstatus->lstatus,]
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            
            // 'fk_cotizacion',
        ],
    ]) ?>

    
     <h1>COTIZACIONES</h1>
    <?php 
      echo GridView::widget([
        'dataProvider' => $dataProvider,

    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            'idcotizacion',
            'fecha',
            'referencia',
            'elaboracion',
            ['attribute'=>'fk_cotestatus', 'value'=>'cotestatusfull',],
            ['label'=>'Razon Rechazo','attribute'=>'observacion', 'value'=>'observacion',],
            

            ['class' => 'yii\grid\ActionColumn',
              'controller'=>'cotizacion',
            'template' => '{view}{duplicate}{print}{delete}',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>' ,$url ,[  'title'=> 'Ver Cotizacion', 'class'=>'modalwin']); 
                },
                'duplicate' => function ($url, $model) {
                    if($GLOBALS["status"]<4){
                      return '';                             
                    }else{
                      if($GLOBALS["status"]==4 && $model->fk_cotestatus == 2){
                        $url = str_replace("duplicate", "status", $url);
                      return Html::a('<i class="glyphicon glyphicon-ok"></i>' ,$url  , ['title'=> 'Cambiar Status :'.$model->idcotizacion, 'class'=>'modalwin']); 

                      }else{
                        if($model->size == 0){
                          return Html::a('<i class="glyphicon glyphicon-file"></i>' ,$url  , ['title'=> 'Duplicar Cotizacion']); 
                        }else{
                          return '';
                        }
                      }
                    }
                },
                'print' => function($url,$model1){

                    $url1 = "llamada/print?idcotizacion=$model1->idcotizacion&prospecto=".$GLOBALS["prospecto"];
                    return Html::a('<span class="glyphicon glyphicon-print"></span>', [$url1] ,[ 'target'=>'_blank' , 'title'=> 'Imprimir']);
                },
              ],
              'header'=> ($model->fk_lstatus==5 || $dataProvider->getTotalCount() == 0 )? Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['cotizacion/create?fk_llamada='.$model->idllamada] ):'',
            'contentOptions' => ['width' => '100px;' , 'align' => 'center' ],
            ],
        ],
       
    ]);
    
     ?>
    

</div>
