<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\custom\GlypIcon;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\search\NominaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerJsFile('/erp/js/nomina.js');

$this->title = "Lista de Nomina";
$this->params['breadcrumbs'][] = 'Nominas';
$gridColumns1 = [  'fkPagos.folio', 'fkPagos.created_at', 'fkPagos.nombre', 'proyecto', 'avance', 'porcentaje_pago', 'monto', 'monto_total', 'fkPagos.created_by', ]; 
?>
<div class="nomina-index">
<?php if($dataProvider->getTotalCount() ==0){ ?>
        <h1><?php echo Html::encode($this->title); 

      echo "<div class='fright'>".ExportMenu::widget([
    'dataProvider' => $dataExport,
    'columns' => $gridColumns1,
    'fontAwesome' => true,
    'filename'=>'nomina',
    'target'=> ExportMenu::TARGET_BLANK,
    'dropdownOptions' => [
        'label' => 'Exportar',
        'class' => 'btn btn-default'
    ]
]) . "</div><div class='romper'></div>\n";
?>
</h1>

 <?php  if(Yii::$app->user->can('nomina')&& count($proyectos)> 0)
                echo GlypIcon::aglyp('Crear Nomina','glyphicon-plus', null, ['class' => 'btn btn-success' , 'id'=>'nomina']); ?>

   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            'folio',
            'created_at:datetime',
            'created_by',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            'buttons' => [
                   'view' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>' ,Url::to(['nomina/view' , 'folio'=>$model->folio])); 
                 },    
                  'print' => function ($url, $model) {

                    return Html::a('<i class="glyphicon glyphicon-print"></i>' ,Url::to(['nomina/print' , 'folio'=>$model->folio]) ,[  'title'=> 'Costo Proyecto']); 
                 },],          
                'contentOptions' => ['width' => '100px;' , 'align' => 'center'],
                ],
        ],
    ]); ?>



<?php 
//SI HAY ERROR EN LOS EMPLEADOS
} else { ?>

    <H1><?=Html::img("@web/assets/img/menu/sign-warning.png" ,['style'=>["width"=>"40px;float:left;"]]); ?>Error en los porcentajes de empleados por proyecto </H1>
    <h3>**Por favor actualize los siguientes proyectos para crear la nomina</h3>


<?= GridView::widget([
        'dataProvider' => $empleados,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],
            'fk_proyecto',
            'proyecto',
            'porcentaje',
        ],
    ]); ?>
<?php } ?>

</div>

 <?php $form = ActiveForm::begin(['id'=>'nomina_form' , 'action'=>'/erp/nomina/create']); ?>
    <div class="form-group">
        <?= Html::submitButton('Nuevo' , ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

