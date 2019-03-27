<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Estado;
use app\models\Mediocontacto;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-form">

    <?php $form = ActiveForm::begin(['id'=>'formulariocli']); ?>

    <?= $form->field($model, 'nombre_razon_social')->textInput(['maxlength' => true, 'class'=>'form-control uc']) ?>

    <?= $form->field($model, 'rfc')->textInput(['maxlength' => true, 'class'=>'form-control uc']) ?>

    <?= $form->field($model, 'lider_proy')->textInput(['maxlength' => true, 'class'=>'form-control uc']) ?>
    
    <div class="row">
        <div class="col-md-8">
        <?= $form->field($model, 'vinculador_1')->textInput(['maxlength' => true, 'class'=>'form-control uc']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'correo_vin_1')->textInput(['maxlength' => true, 'class'=>'form-control uc']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'vinculador_2')->textInput(['maxlength' => true, 'class'=>'form-control uc']) ?>
        </div>
        <div class="col-md-4">
             <?= $form->field($model, 'correo_vin_2')->textInput(['maxlength' => true, 'class'=>'form-control uc']) ?>
        </div>
    </div>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true, 'class'=>'form-control uc']) ?>
    
     <div class="row">
        <div class="col-md-6">
             <?= $form->field($model, 'telefono')->textInput([ 'class'=>'form-control uc']) ?>
        </div>
        <div class="col-md-6">
             <?= $form->field($model, 'ciudad')->textInput(['maxlength' => true, 'class'=>'form-control uc']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
               <?= $form->field($model, 'fk_estado')->dropDownList(ArrayHelper::map(Estado::find()->all(),'idestado' , 'estado') , ['prompt'=>'SELECCIONA ESTADO']) ?>

        </div>
        <div class="col-md-6">
             <?= $form->field($model, 'fk_mediocontacto')->dropDownList(ArrayHelper::map(Mediocontacto::find()->all(),'idmediocontacto' , 'medio') , ['prompt'=>'SELECCIONA MEDIO']) ?>

        </div>


    </div>


 

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
