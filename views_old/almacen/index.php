<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel app\search\MaterialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Lista de Materiales";
$this->params['breadcrumbs'][] = 'Inventario';
$gridColumns1 = ['codigo', 'material_almacen', 'familia', 'existencia', 'costo', 'costo_iva', 'fkUm.um', ];

?>
<div class="Almacen-almacen-index">

     <h1><?php echo Html::encode($this->title); 
  if(Yii::$app->user->can('calmacen')){
      echo "<div class='fright'>".ExportMenu::widget([
    'dataProvider' => $dataExport,
    'columns' => $gridColumns1,
    'fontAwesome' => true,
    'filename'=>'almacen',
    'target'=> ExportMenu::TARGET_BLANK,
    'dropdownOptions' => [
        'label' => 'Exportar',
        'class' => 'btn btn-default'
    ]
]) . "</div><div class='romper'></div>\n"; 
} ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>


   
    <?php
    //Solo ve almacen
          if(Yii::$app->user->can('valmacen')){
     echo  GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            // 'idmaterial_almacen',
            'codigo',
            'material_almacen',
            'familia',
            'existencia',
            'fkUm.um',

        ],
    ]);
        }
            //Exporta , edita , elimina 
          if(Yii::$app->user->can('calmacen')){
                echo  GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            // 'idmaterial_almacen',
            'codigo',
            'material_almacen',
            'familia',
            'existencia',
            'costo',
            'costo_iva',
            'fkUm.um',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{update}{delete}',
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create']) ,
                'contentOptions' => ['width' => '100px;' , 'align' => 'center'],
                ],
        ],
    ]);         


          }

     ?>
</div>
