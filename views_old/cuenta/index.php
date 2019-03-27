<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;
use yii\helpers\Url;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel app\search\CuentaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Lista de Cuentas Pendientes";
$this->params['breadcrumbs'][] = 'Cuenta Pendientes';
$gridColumns1 = ['idcuenta_pagar', 'folio_dcto', 'tipo_dcto', 'fecha_vencimiento:date',
 ['header'=>'Cantidad', 'attribute' =>'deuda', 'value'=>'deuda', ], 
 ['header'=>'X pagar', 'attribute' =>'deuda', 
 'value'=> function($model){return ($model->deuda - $model->pagado);}, ]
 , 'pagado', 'fkMetodoPago.metodo_pago', 'fkProveedor.razon_social', 'observacion', 'stpagado', ];

?>
<div class="cuenta-pagar-index">

     <h1><?php echo Html::encode($this->title); 

      echo "<div class='fright'>".ExportMenu::widget([
    'dataProvider' => $dataExport,
    'columns' => $gridColumns1,
    'fontAwesome' => true,
    'filename'=>'cuentaxpagar',
    'target'=> ExportMenu::TARGET_BLANK,
    'dropdownOptions' => [
        'label' => 'Exportar',
        'class' => 'btn btn-default'
    ]
]) . "</div><div class='romper'></div>\n";  ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

       <div class="btn-group filtrar" role="group" aria-label="Filtrar por" data-search="CuentaSearch" data-column="st_pagado" data-page="cuenta">
 
  <button type="button" class="btn <?= ($searchModel->st_pagado==0)?'btn-primary':'btn-default' ?>" data-value="null">Todos</button>
  <button type="button" class="btn <?= ($searchModel->st_pagado==1)?'btn-primary':'btn-default' ?>" data-value="1">No Pagado</button>
  <button type="button" class="btn <?= ($searchModel->st_pagado==2)?'btn-primary':'btn-default' ?>" data-value="2">Pagado</button>
  <button type="button" class="btn <?= ($searchModel->st_pagado==3)?'btn-primary':'btn-default' ?>" data-value="3">Pagado Parcial</button>
  <button type="button" class="btn <?= ($searchModel->st_pagado==4)?'btn-primary':'btn-default' ?>" data-value="4">Aclaracion</button>
</div>
   
   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            'idcuenta_pagar',
            'folio_dcto',
            'tipo_dcto',
            'fecha_vencimiento:date',
            'cantidad',
            array(
            'attribute' => 'porpagar',
            'format' => 'decimal',
            ),
            // 'porpagar:number',
            'stpagado',
            'fkMetodoPago.metodo_pago',
            'fkProveedor.razon_social',
            'observacion',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}{update}{aclaracion}',
               
                // 'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create']) ,
                'contentOptions' => ['width' => '100px;' , 'align' => 'center'],
                'buttons'=>[
                    'update' => function ($url, $model, $key) {
                        return $model->st_pagado !=2 ? Html::a('<i class="glyphicon glyphicon-pencil"></i>' , Url::to($url, true))  : '';
                    },
                    'aclaracion' => function ($url, $model, $key) {
                        return $model->st_pagado !=2 ? Html::a('<i class="glyphicon glyphicon-briefcase"></i>' , Url::to($url,  true  ), ['class'=>'modalwin' , 'title'=>'Crear Aclaracion'])  : '';
                    },
                ],
                ],

        ],
    ]); ?>
</div>
