<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Lista de  Proyectos";

$this->params['breadcrumbs'][] = 'Proyecto';
$options = (Yii::$app->user->can('proyecto'))?'{view}{update}{delete}':'{view}';
//LISTA DE COLUMNA
$gridColumns1 = ['idproyecto', 'proyecto', 'escala', 'created_at', 'fecha_entrega', 'precio', 
['attribute'=> 'fk_cliente', 'value' => 'fkCliente.nombre_razon_social', ], 
['attribute' => 'complejidad', 'value'=>'fkNivelComplejidad.cname', 'header'=> 'N. Complejidad', ],
 ['header'=>'Estatus', 'attribute'=> 'st_terminado', 'value' => 'sstterminado', ],];

$gridColumns2 = [[   'header'=>'idproyecto', 'attribute'=> 'fk_proyecto_costo', 
'value' => 'fkProyectoCosto.fk_proyecto', ], 
['header'=>'movimiento', 'attribute'=> 'fk_proyecto_costo', 'value' => 'fkProyectoCosto.fk_movimiento', ], 
'codigo' , 'material', 'familia', 'costo:decimal', 'cantidad:decimal', 
['attribute'=>'total', 'value'=> 'ttotal', 'format'=>'decimal'] ]; ?>
<div class="proyecto-index">

    <h1><?php echo Html::encode($this->title); 

      echo "<div class='fright'>".ExportMenu::widget([
    'dataProvider' => $dataExport,
    'columns' => $gridColumns1,
    'fontAwesome' => true,
    'filename'=>'proyecto',
    'target'=> ExportMenu::TARGET_BLANK,
    'dropdownOptions' => [
        'label' => 'Exportar',
        'class' => 'btn btn-default'
    ]
]) . "</div>";
      
      echo "<div class='fright'>".ExportMenu::widget([
    'dataProvider' => $dataExportCosto,
    'columns' => $gridColumns2,
    'fontAwesome' => true,
    'filename'=>'proyectoCosto',
    'target'=> ExportMenu::TARGET_BLANK,
    'dropdownOptions' => [
        'label' => 'Exportar Costos',
        'class' => 'btn btn-default'
    ]
]) . "</div><div class='romper'></div>\n";  ?></h1>
    
<?php echo $this->render('_search', ['model' => $searchModel]); ?>
 <div class="btn-group filtrar" role="group" aria-label="Filtrar por" data-search="ProyectoSearch" data-column="st_terminado" data-page="proyecto">
  <button type="button" class="btn <?= ($searchModel->st_terminado==null)?'btn-primary':'btn-default' ?>" data-value="0">Todos</button>
  <button type="button" class="btn <?= ($searchModel->st_terminado==1)?'btn-primary':'btn-default' ?>" data-value="1">Nuevo</button>
  <button type="button" class="btn <?= ($searchModel->st_terminado==2)?'btn-primary':'btn-default' ?>" data-value="2">Desarrollo</button>
  <button type="button" class="btn <?= ($searchModel->st_terminado==3)?'btn-primary':'btn-default' ?>" data-value="3">Terminado</button>
</div>
   
    <?php 
        if(Yii::$app->user->can('proyecto')){

        echo  GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            'idproyecto',
            'proyecto',
            'escala',
            'fecha_entrega:date',
            'precio:decimal',
             'costo',
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
            //'template' => '{view}{update}{delete}{wallet}', ANTIGUO
			'template' => '{view}{update}{delete}',
            'buttons' => [
                   'update' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>' ,$url ,[  'title'=> 'Editar Proyecto', 'class'=>'modalwin']); 
                 },    
                  'wallet' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-credit-card"></i>' ,$url ,[  'title'=> 'Costo Proyecto']); 
                 },           
                    
               
              ],
                            'header'=>  (Yii::$app->user->can('proyecto'))? 
                                Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create'] , [ 'title'=> 'Nuevo Proyecto', 'class'=>'modalwin']):''  ,
                'contentOptions' => ['width' => '120px;' , 'align' => 'center'],
                ],
        ],
    ]);}else{
             echo  GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            'idproyecto',
            'proyecto',
            'escala',
            'fecha_entrega:date',
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
                'fkCestatus.cestatus',
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            'buttons' => [
                   'update' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>' ,$url ,[  'title'=> 'Editar Proyecto', 'class'=>'modalwin']); 
                 },    
                  'wallet' => function ($url, $model) {
                    return Html::a('<i class="glyphicon glyphicon-credit-card"></i>' ,$url ,[  'title'=> 'Costo Proyecto']); 
                 },           
                    
               
              ],
                            'header'=>  '',
                ],
        ],]);
        } ?>
</div>
