<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;
use app\models\Cotconfig;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel app\search\LlamadaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Lista de Llamadas";
$this->params['breadcrumbs'][] = 'Llamadas';
//LISTA DE COLUMNAS
$gridColumns1 = ['idllamada', 'created_at', 'prospecto', 'telefono', 'email:email', 'asunto', 
['attribute'=> 'fk_lstatus', 'value' => 'fkLstatus.lstatus', ],];
?>
<div class="llamada-index">

    <h1><?php  echo Html::encode($this->title); 
    echo "<div class='fright'>".ExportMenu::widget([
    'dataProvider' => $dataExport,
    'columns' => $gridColumns1,
    'fontAwesome' => true,
    'filename'=>'llamada',
    'target'=> ExportMenu::TARGET_BLANK,
    'dropdownOptions' => [
        'label' => 'Exportar',
        'class' => 'btn btn-default'
    ]
]) . "</div><div class='romper'></div>\n";  ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); 

       
?>


    <div class="btn-group filtrar" role="group" aria-label="Filtrar por" data-search="LlamadaSearch" data-column="fk_lstatus" data-page="llamada">
 
  <button type="button" class="btn <?= ($searchModel->fk_lstatus==null)?'btn-primary':'btn-default' ?>" data-value="0">Todos</button>
  <button type="button" class="btn <?= ($searchModel->fk_lstatus==1)?'btn-primary':'btn-default' ?>" data-value="1">Nuevo</button>
  <button type="button" class="btn <?= ($searchModel->fk_lstatus==2)?'btn-primary':'btn-default' ?>" data-value="2">Cotizado</button>
  <button type="button" class="btn <?= ($searchModel->fk_lstatus==3)?'btn-primary':'btn-default' ?>" data-value="3">Enviado</button>
  <button type="button" class="btn <?= ($searchModel->fk_lstatus==4)?'btn-primary':'btn-default' ?>" data-value="4">Recibido</button>
  <button type="button" class="btn <?= ($searchModel->fk_lstatus==5)?'btn-primary':'btn-default' ?>" data-value="5">Resuelto</button>
</div>
   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            'idllamada',
            'prospecto',
            'telefono',
            'email:email',
            'asunto',
            [ 
               'attribute'=> 'fk_lstatus',
               'value' => 'fkLstatus.lstatus',
            ],
            // [
            //    'attribute'=> 'fk_cotizacion',
            //    'value' => 'fkCotizacion.cotestatusfull',
            // ],
            // 'fk_cotizacion',

            ['class' => 'yii\grid\ActionColumn',
            // 'template' => '{update}{delete}',
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create']) ,
                'contentOptions' => ['width' => '100px;' , 'align' => 'center'],
                ],
        ],
    ]); ?>
</div>
