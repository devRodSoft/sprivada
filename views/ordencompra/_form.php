<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Proveedor;
use app\models\Empleado;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\OrdenCompra */
/* @var $form yii\widgets\ActiveForm */

$js = '
$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
     
    $(".container-items .item").each(function(index) {
        $(this).find(".panel-title").html("Producto: " + (index + 1))
    });
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    $(".container-items .item").each(function(index) {
        $(this).find(".panel-title").html("Producto: " + (index + 1))
    });
});
';

$this->registerJs($js);


?>

<div class="orden-compra-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    
    <div class="row">
        <div class="col-md-4">
    <?= $form->field($model, 'folio')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-md-offset-4">
     <?php echo 
         $form->field($model, 'fecha_recepcion')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'SELECCIONA FECHA'],
    'type' => DatePicker::TYPE_INPUT,
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true
        ],
      
]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php 
        $empleados = ArrayHelper::map(Empleado::find()->all(),'alias' , 'alias');
        echo $form->field($model, 'solicitante')->widget(Select2::classname(), [
            'data' => $empleados,
            'options' => ['placeholder' => 'SELECCIONA EMPLEADO'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            
        ]);
    ?>
        </div>
        <div class="col-md-6">
            
    <?php 
        $provedores = ArrayHelper::map(Proveedor::find()->all(),'idproveedor' , 'razon_social');
        echo $form->field($model, 'fk_proveedor')->widget(Select2::classname(), [
            'data' => $provedores,
            'options' => ['placeholder' => 'SELECCIONA PROVEEDOR'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
        </div>
    </div>
    


   


     <?= $form->field($model, 'utilizacion')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'observacion')->textInput(['maxlength' => true]) ?>
    

    <!-- EMPIEZAN LAS PROPUESTAS -->
     <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-folder-close"></i> Productos</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $productos[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'codigo',
                    'descripcion',
                    'cantidad',
                    'um',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php $w=0; foreach ($productos as $i => $pro): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Producto: <?= $i+1 ?></h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $pro->isNewRecord) {
                                echo Html::activeHiddenInput($pro, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($pro, "[{$i}]codigo")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($pro, "[{$i}]descripcion")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($pro, "[{$i}]cantidad")->textInput() ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($pro, "[{$i}]um")->textInput() ?>
                            </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
