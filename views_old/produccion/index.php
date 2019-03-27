<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Produccion Proyectos";

$this->params['breadcrumbs'][] = 'Produccion';
$gridColumns1 = [ 'folio_nomina' , 'fkproyecto','proyecto','empleado','porproyecto','monto_proyecto','porparticipacion','monto_participacion','porgeneral','porpreliminares','porplaneacion','porfabricacion','porpintura','poriluminacion','pormontaje','porentrega','created_at'];?>
<div class="proyecto-index">

            <h1><?php echo Html::encode($this->title); 

      echo "<div class='fright'>".ExportMenu::widget([
    'dataProvider' => $dataExport,
    'columns' => $gridColumns1,
    'fontAwesome' => true,
    'filename'=>'produccion',
    'target'=> ExportMenu::TARGET_BLANK,
    'dropdownOptions' => [
        'label' => 'Exportar',
        'class' => 'btn btn-default'
    ]
]) . "</div><div class='romper'></div>\n"; ?>
</h1>
    

       <?php echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="btn-group filtrar" role="group" aria-label="Filtrar por" data-search="ProyectoSearch" data-column="st_terminado" data-page="produccion">
  <button type="button" class="btn <?= ($searchModel->st_terminado==null)?'btn-primary':'btn-default' ?>" data-value="0">Todos</button>
  <button type="button" class="btn <?= ($searchModel->st_terminado==1)?'btn-primary':'btn-default' ?>" data-value="1">Nuevo</button>
  <button type="button" class="btn <?= ($searchModel->st_terminado==2)?'btn-primary':'btn-default' ?>" data-value="2">Desarrollo</button>
</div>
   
   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            'idproyecto',
            'proyecto',
            'escala',
            'fecha_entrega:date',
            // 'precio:decimal',
             // 'costo:decimal',
             
             [  
                 'attribute' => 'fk_cliente',
                'value'=> 'fkCliente.nombre_razon_social',
                'header'=> 'Cliente',
           ],
           
             [  
                 'attribute' => 'complejidad',
                'value'=>'fkNivelComplejidad.cname',
                'header'=> 'N. Complejidad',
           ],
                [
                'attribute'=>'st_terminado',
                'value'=>'sstterminado',
                'header'=>'Estatus',
           ],
            // 'fk_ctipo_material',
            // 'fk_ctipo_color',
            // 'fk_ctipo_iluminacion',
            // 'fk_ccalibre_acrilico',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}{update}',
            'buttons' => [
                  'update' => function ($url, $model) {
                    return ($model->st_terminado==3)?"":Html::a('<i class="glyphicon glyphicon-check"></i>' ,$url ,[  'title'=> 'Produccion Proyecto']); 
                 },           
                    
               
              ],
                //             'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create'] , [ 'title'=> 'Nuevo Proyecto', 'class'=>'modalwin']) ,
                // 'contentOptions' => ['width' => '120px;' , 'align' => 'center'],
                ],
        ],
    ]); ?>
</div>
