<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Estado;
use yii\helpers\ArrayHelper
/* @var $this yii\web\View */
/* @var $model app\models\Proveedor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedor-form">

    <?php $form = ActiveForm::begin(['id'=>'provedores' ,'enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'razon_social')->textInput(['maxlength' => true]) ?>

  
    
    
     
    <div class="row">
        <div class="col-md-6">
              <?= $form->field($model, 'nombre_contacto')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'rfc')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

     <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ciudad')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
         <?= $form->field($model, 'estado')->dropDownList(ArrayHelper::map(Estado::find()->all(),'estado' , 'estado') , ['prompt'=>'SELECCIONA ESTADO']) ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'telefono1')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

 

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'diacredito')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'pagina_web')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
