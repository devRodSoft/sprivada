<?php

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\CcalibreAcrilico;
use app\models\CtipoColor;
use app\models\Ctmaterial;
use app\models\Ciluminacion;
use app\models\NivelComplejidad;
use app\models\Cliente;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class='proyecto-form'>

    <?php $form = ActiveForm::begin(['id'=>'formulario']); ?>
   
    <?= $form->field($model, 'proyecto')->textInput(['maxlength' => true, 'class'=>'form-control uc']) ?>
    <div class='row'>
    <div class='col-md-4'> 
    <?= $form->field($model, 'escala')->textInput(['maxlength' => true, 'class'=>'form-control uc']) ?>
    </div>
     <div class='col-md-4'> 
    <?= $form->field($model, 'precio')->textInput(['class'=>'form-control uc']) ?>
     </div>
    <div class='col-md-4'> 
    <?= $form->field($model, 'moporcentaje')->textInput(['class'=>'form-control uc']) ?>
     </div>
     
    
     </div>
    <?php if($model->fk_cotizacion!=0)
            echo $form->field($model, 'fk_cotizacion')->hiddenInput()->label(false); 

    ?>
    <?php 
        $clientes = ArrayHelper::map(Cliente::find()->all(),'idcliente' , 'nombre_razon_social');

        // var_dump($clientes);
        echo $form->field($model, 'fk_cliente')->widget(Select2::classname(), [
            'data' => $clientes,
            'options' => ['placeholder' => 'SELECCIONA CLIENTE'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            'addon'=>[ 
            'append' => [ 
                "content"=> ($model->fk_cotizacion!=0)? Html::button(Html::icon('glyphicon glyphicon-plus'), ['class' => 'btn btn-success modalwin' , 'id'=>'openup', 'href'=>"/erp/cliente/createret?fk_cotizacion=$model->fk_cotizacion&idllamada=$model->idllamada",'title' => 'Nuevo Cliente']) :"", 'asButton' => true
                ]
                 // "content"=> ($model->fk_cotizacion!=0)? Html::button(Html::icon('glyphicon glyphicon-plus'), ['class' => 'btn btn-success modalwin' , 'id'=>'openup', 'href'=>'/cliente/createret?fk_cotizacion=$model->fk_cotizacion&idllamada=$model->idllamada','title' => 'Nuevo Cliente']) :"", 'asButton' => true
                
            ],
        ]);
    ?>
    
    <div class='row'>
    <div class='col-md-6'> 
    <?php 
        echo $form->field($model, 'fecha_entrega')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'SELECT FECHA DE ENTREGA'],
    'type' => DatePicker::TYPE_INPUT,
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true
        ],]);
      

    ?>
    </div>
    <div class='col-md-6'> 
     <?= $form->field($model, 'fk_cnivel_complejidad')->dropDownList(ArrayHelper::map(NivelComplejidad::find()->all(),'idcnivel_complejidad' , 'Cnamedrop') , ['prompt'=>'SELECCIONA NIVEL DE COMPLEJIDAD']) ?>
    </div>
    </div>
    <div class='row'>
        <h1>Caracteristicas:</h1><?= Html::activeHint($model, 'attribute', ['option' => 'value']); ?>
        <div class='col-md-6'> 
              <?= $form->field($model, 'fk_ccalibre_acrilico')->dropDownList(ArrayHelper::map(CcalibreAcrilico::find()->all(),'idccalibre_acrilico' , 'ccalibre_acrilico') , ['prompt'=>'SELECCIONA ACRILICO']) ?>
    <?= $form->field($model, 'fk_ctipo_color')->dropDownList(ArrayHelper::map(CtipoColor::find()->all(),'cidtipo_color' , 'ctipo_color') , ['prompt'=>'SELECCIONA COLOR']) ?>
    
        </div>
        <div class='col-md-6'> 
            
    <?= $form->field($model, 'fk_ctipo_material')->dropDownList(ArrayHelper::map(Ctmaterial::find()->all(),'idctipo_material' , 'ctipo_material') , ['prompt'=>'SELECCIONA MATERIAL']) ?>
    
    <?= $form->field($model, 'fk_ctipo_iluminacion')->dropDownList(ArrayHelper::map(Ciluminacion::find()->all(),'idctipo_iluminacion' , 'ctipo_iluminacion') , ['prompt'=>'SELECCIONA ILUMINACION']) ?>
        </div>
    </div>

    <div class='form-group'>
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
