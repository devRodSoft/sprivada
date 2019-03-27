<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Cotconfig;
use dosamigos\tinymce\TinyMce;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\switchinput\SwitchInput;
/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */
/* @var $form yii\widgets\ActiveForm */

$js = '
$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
     
    $(".container-items .item").each(function(index) {
        $(this).find(".panel-title").html("Propuesta: " + (index + 1))
    });
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    $(".container-items .item").each(function(index) {
        $(this).find(".panel-title").html("Propuesta: " + (index + 1))
    });
});


';
$this->registerJsFile('/erp/js/cotcreate.js', ['depends' => [\yii\web\JqueryAsset::className()],'position' => \yii\web\View::POS_END]);
// $this->registerJs($js);
?>

<div class="cotizacion-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    
        <?php 
         $form->field($model, 'fecha')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'SELECCIONA FECHA'],
    'type' => DatePicker::TYPE_INPUT,
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true
        ],
      
]); ?>
   

    <?= $form->field($model, 'referencia')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'elaboracion')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'razon')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nombre_proyecto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fk_llamada')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'escala')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'fk_cotconfig')->dropDownList(ArrayHelper::map(Cotconfig::find()->all(),'idcotconfig' , 'cotconfig') , ['prompt'=>'SELECCIONA PIE DE PAGINA']) ?>
      



 <div class="row">
<div class="col-md-3">
      <?= $form->field($model, 'st_sitio')->widget(SwitchInput::classname(),[] );?>
    
    </div>       
    <div class="col-md-12 sitio">
     <?= $form->field($model, 'sitio')->widget(TinyMce::className(), [
    'options' => ['rows' => 6],
    'language' => 'es',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]);?>
    </div>       </div> 



<?= $form->field($model, 'edificio')->widget(TinyMce::className(), [
    'options' => ['rows' => 6],
    'language' => 'es',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]);?>
 <div class="row">
<div class="col-md-3">
      <?= $form->field($model, 'st_iluminacion')->widget(SwitchInput::classname(),[] );?>
    
    </div>       
    <div class="col-md-12 iluminacion">
     <?= $form->field($model, 'iluminacion')->widget(TinyMce::className(), [
    'options' => ['rows' => 6],
    'language' => 'es',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]);?>
    </div>       </div> 
    </br>  


<!-- EMPIEZAN LAS PROPUESTAS -->
     <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-folder-close"></i> Propuestas</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 8, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $escalas[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'escala',
                    'dimensiones',
                    'precio',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($escalas as $i => $esc): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Propuesta: <?= ($i + 1) ?></h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $esc->isNewRecord) {
                                echo Html::activeHiddenInput($esc, "[{$i}]idcotescala");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($esc, "[{$i}]escala")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($esc, "[{$i}]dimensiones")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($esc, "[{$i}]precio")->textInput(['maxlength' => true]) ?>
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
