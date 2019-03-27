<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel app\search\MaterialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Lista de Materiales";
$this->params['breadcrumbs'][] = 'Materiales';
?>
<div class="material-almacen-index">
<div class="material-almacen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['search'],
        'method' => 'get',
        // 'enableAjaxValidation'=>true,
          // 'enableClientValidation'=>false,
        'id'=>'searcher',
        'fieldConfig' => [
            'template' => "{input}",
            'options' => [
                'tag'=>'span'
            ]
        ],
    ]); ?>

<div id="custom-search-input">
        <div class="input-group col-md-12">

           <?=  $form->field($searchModel, 'globalSearch')->textInput(['class'=> 'form-control' , 'id'=>'search', 'placeholder' => "Buscar..."])->label(false); ?>
           
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-lg" id="reset" >
                            <i class="glyphicon glyphicon-erase"></i>
                        </button>
                        <button type="submit" class="btn btn-info btn-lg" >
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
        </div>

    </div>
    
    <?php  ActiveForm::end(); ?>
</div>





    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'contentOptions' => ['width' => '50px;' ],],

            // 'idmaterial_almacen',
            'codigo',
            'material_almacen',
            'familia',
            // 'existencia',
            // 'costo',
            'costo_iva',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{ok}',
                'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp; Nuevo' , ['create']) ,
                'contentOptions' => ['width' => '100px;' , 'align' => 'center'],
                ],
        ],
    ]);    ?>
</div>
