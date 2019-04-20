<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TipoDocumento;
use app\models\MetodoPago;
use app\models\Proveedor;
use app\models\Proyecto;
use app\models\Empleado;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap\Modal;
// use kartik\checkbox\CheckboxX;
use kartik\switchinput\SwitchInput;
use app\models\Multiple;


/* @var $this yii\web\View */
/* @var $model app\models\Movimiento */
/* @var $form yii\widgets\ActiveForm */



$this->registerJsFile('/erp/js/movimiento.js', ['depends' => [\yii\web\JqueryAsset::className()],'position' => \yii\web\View::POS_END]);
$this->registerJsFile('/erp/assets/fancygrid/fancy.full.min.js', ['depends' => [\yii\web\JqueryAsset::className()],'position' => \yii\web\View::POS_END]);
$this->registerCssFile('/erp/assets/fancygrid/fancy.min.css');
// <link href="https://code.fancygrid.com/fancy.min.css" rel="stylesheet">
// <script src="https://code.fancygrid.com/fancy.min.js"></script>
// $this->registerJs($js);
?>
 

<div class="movimiento-form">

    <?php $form = ActiveForm::begin(['id'=>'dynamic-form']); ?>

   <div class="row">
        <div class="col-md-4">
             
            <?php  echo 
         $form->field($model, 'fecha_movimiento')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'SELECCIONA FECHA'],
    'type' => DatePicker::TYPE_INPUT,
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true
        ],
      
]); ?>
        </div>
        <div class="col-md-4">
            
      <?= $form->field($model, 'fk_tipo_documento')->dropDownList(ArrayHelper::map(TipoDocumento::find()->all(),'idtipo_documento' , 'tipo_documento') , ['prompt'=>'SELECCIONA TIPO DE DOCUMENTO']) ?>

        </div>
        <div class="col-md-4">
            
         <?= $form->field($model, 'folio_dcto')->textInput(['maxlength' => true]) ?>

        </div>
    </div>

      <div class="row">
         <div class="col-md-8">
             <?php 



        $clientes = ArrayHelper::map(Proveedor::find()->all(),'idproveedor' , 'razon_social');

        // var_dump($clientes);
        echo $form->field($model, 'fk_proveedor')->widget(Select2::classname(), [
            'data' => $clientes,
            'options' => ['placeholder' => 'SELECCIONA PROVEEDOR'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            // 'addon'=>[ 
            // 'append' => [ 
            //     "content"=> ($model->fk_cotizacion!=0)? Html::button(Html::icon('glyphicon glyphicon-plus'), ['class' => 'btn btn-success modalwin' , 'id'=>'openup', 'href'=>"/dash/catcliente/createret?fk_cotizacion=$model->fk_cotizacion&idllamada=$model->idllamada",'title' => 'Nuevo Cliente']) :"", 'asButton' => true
            //     ]
                 // "content"=> ($model->fk_cotizacion!=0)? Html::button(Html::icon('glyphicon glyphicon-plus'), ['class' => 'btn btn-success modalwin' , 'id'=>'openup', 'href'=>'/cliente/createret?fk_cotizacion=$model->fk_cotizacion&idllamada=$model->idllamada','title' => 'Nuevo Cliente']) :"", 'asButton' => true
                
            // ],
        ]);
    ?>
            </div>
          <div class="col-md-4">
             <?= $form->field($model, 'folio_oc')->textInput(['maxlength' => true]) ?>

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
                'model' => $almacenes[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'codigo',
                    'material_almacen',
                    'cantidad',
                    'costo',
                ],
            ]); ?>
     <div class="panel panel-default">
        <div class="panel-heading"><i class="glyphicon glyphicon-folder-close"></i> <span id="enc" class="bf">almacenes (1) - Total : 0.00 </span><button type="button" class="pull-right add-item btn btn-success "><i class="fa fa-plus"></i> Nuevo Material</button></div>
        <div class="panel-body">
          

            <div class="container-items"><!-- widgetContainer -->
           <table class="table table-bordered table-striped margin-b-none">
        <thead>
            <tr>
                <th style="width: 180px; text-align: center">Código</th>
                <th>Descripcion</th>
                <th style="width: 130px;">Cantidad</th>
                <th style="width: 130px;">Costo</th>
                <th style="width: 130px;">Total</th>
                <th style="width: 70px; text-align: center">Actions</th>
            </tr>
        </thead>
        <tbody class="form-options-body">
            <?php foreach ($almacenes as $i => $mat): ?>
             <tr  class="form-options-item">
                <td><?= $form->field($mat, "[{$i}]fk_material_almacen")->label(false)->textInput(['maxlength' => true , 'class' => 'codigo form-control']) ?></td>
                 <td><?= $form->field($mat, "[{$i}]descripcion")->label(false)->textInput(['maxlength' => true , 'class'=> 'descripcion form-control' , 'readonly'=>'true']) ?></td>
                 <td><?= $form->field($mat, "[{$i}]cantidad")->label(false)->textInput(['maxlength' => true , 'class'=> 'cantidad onlynumber descripcion form-control' ]) ?></td>
                 <td><?= $form->field($mat, "[{$i}]costo")->label(false)->textInput(['maxlength' => true , 'class'=>'costo onlynumber form-control']) ?></td>
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
    



 

    <?= $form->field($model, 'total_mvto')->textInput(['maxlength' => true , 'readonly'=>true ]) ?>




  <div class="row">
    <div class="col-md-2">
      <?= $form->field($model, 'stpagado')->widget(SwitchInput::classname(),[] );?>
    
    </div>       
    <div class="col-md-10">
      <?= $form->field($model, 'metodo')->dropDownList(ArrayHelper::map(MetodoPago::find()->all(),'idmetodo_pago' , 'metodo_pago') , ['prompt'=>'SELECCIONA METODO DE PAGO']) ?>
    </div>       
  </div>    

  <div class="row">
    <div class="col-md-2">
      <?= $form->field($model, 'stproyecto')->widget(SwitchInput::classname(),[] );?>
    </div>       
    <div class="col-md-10 proy">
      <?=  $form->field($model, 'proyecto')->dropDownList(ArrayHelper::map(Proyecto::find()->where(['activo' => '0'])->all(),'idproyecto' , 'proyecto') , ['prompt'=>'SELECCIONA PROYECTO']) ?>
    </div>       
  </div>    
    
    <div class="proy">
       <?php   
        $empleados = ArrayHelper::map(Empleado::find()->all(),'alias' , 'alias');
        echo $form->field($model, 'solicitante')->widget(Select2::classname(), [
            'data' => $empleados,
            'options' => ['placeholder' => 'SELECCIONA UN EMPLEADO'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); 

    ?>  
    </div>
   <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
   </div>

    <?php ActiveForm::end(); ?>

  

</div>

 <?php Modal::begin([
        'headerOptions' => ['id' => 'modalHeaderMat' ],
        'id' => 'modalMat',
        'size' => 'modal-lg',
        'header' => ''
    ]);
    echo "<div id='modalContent'><div id='lista'></div></div>";
    Modal::end();
?>

<div id="matfinder" class="modales">
  <div class="modales-content">
    <span class="close">×</span>
    <div id='lista'></div>
  </div>

</div>