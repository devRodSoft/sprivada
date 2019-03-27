<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Proyecto;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap\Modal;
use app\models\Multiple;
use kartik\select2\Select2;
use app\models\Empleado;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Movimiento */
/* @var $form yii\widgets\ActiveForm */



$this->registerJsFile('/erp/js/salida.js', ['depends' => [\yii\web\JqueryAsset::className()],'position' => \yii\web\View::POS_END]);
$this->registerJsFile('/erp/assets/fancygrid/fancy.full.min.js', ['depends' => [\yii\web\JqueryAsset::className()],'position' => \yii\web\View::POS_END]);
$this->registerCssFile('/erp/assets/fancygrid/fancy.min.css');
?>
 

<div class="movimiento-form">

    <?php $form = ActiveForm::begin(['id'=>'dynamic-form']); ?>
    
    <?= $form->field($proycos, 'fk_movimiento')->hiddenInput()->label(false); ?>
    <?= $form->field($proycos, 'fk_proyecto')->hiddenInput()->label(false); ?>
    
    <div class='row'>
    <div class='col-md-8'> 
         <?php   
        $empleados = ArrayHelper::map(Empleado::find()->all(),'alias' , 'alias');
        echo $form->field($proycos, 'solicitante')->widget(Select2::classname(), [
            'data' => $empleados,
            'options' => ['placeholder' => 'SELECCIONA UN EMPLEADO'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); 

    ?>  
    </div>
     <div class='col-md-4'> 
         <?= $form->field($proycos, 'folio')->textInput()->label(); ?>
     </div>
     </div>

   


   
    


    <!-- EMPIEZAN LAS PROPUESTAS -->
       <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
              'widgetBody' => '.form-options-body',
                 'widgetItem' => '.form-options-item',
                'limit' => 15, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.delete-item', // css class
                'model' => $costos[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'codigo',
                    'material',
                    'familia',
                    'costo',
                    'cantidad',
                    'total',
                ],
            ]); ?>
     <div class="panel panel-default">
        <div class="panel-heading"><i class="glyphicon glyphicon-folder-close"></i> <span id="enc" class="bf">costos (1) - Total : 0.00 </span><button type="button" class="pull-right add-item btn btn-success "><i class="fa fa-plus"></i> Nuevo Material</button></div>
        <div class="panel-body">
          

            <div class="container-items"><!-- widgetContainer -->
           <table class="table table-bordered table-striped margin-b-none">
        <thead>
            <tr>
                <th style="width: 180px; text-align: center">Código</th>
                <th>Descripcion</th>
                <th style="width: 130px;">Familia</th>
                <th style="width: 130px;">Costo</th>
                <th style="width: 130px;">Cantidad</th>
                <th style="width: 130px;">Total</th>
                <th style="width: 70px; text-align: center">Actions</th>
            </tr>
        </thead>
        <tbody class="form-options-body">
            <?php foreach ($costos as $i => $mat): ?>
             <tr  class="form-options-item">
                <td><?= $form->field($mat, "[{$i}]codigo")->label(false)->textInput(['maxlength' => true , 'class' => 'codigo form-control']) ?></td>
                 <td><?= $form->field($mat, "[{$i}]material")->label(false)->textInput(['maxlength' => true , 'class'=> 'descripcion form-control' , 'readonly'=>'true']) ?></td>
                 <td><?= $form->field($mat, "[{$i}]familia")->label(false)->textInput(['maxlength' => true , 'class'=> 'familia form-control' , 'readonly'=>'true' ]) ?></td>
                 <td><?= $form->field($mat, "[{$i}]costo")->label(false)->textInput(['maxlength' => true , 'class'=>'costo form-control' , 'readonly'=>'true']) ?></td>
                 <td><?= $form->field($mat, "[{$i}]cantidad")->label(false)->textInput(['maxlength' => true , 'class'=>'cantidad onlynumber form-control']) ?></td>
                 <td><?= $form->field($mat, "[{$i}]total")->label(false)->textInput(['maxlength' => true , 'class'=>'form-control total' , 'readonly'=>'true']) ?></td>
                  <td><button type="button" class="delete-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button></td>
             </tr>

            <?php endforeach; ?>
             </tbody>
    </table>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton( 'Guardar' , ['class' => 'btn btn-success' ]) ?>
   </div>







    <?php ActiveForm::end(); ?>

  

</div>
