<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\MetodoPago;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\CuentaPagar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuenta-pagar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idcuenta_pagar')->textInput([  'readonly'=> true]) ?>

    <?= $form->field($model, 'folio_dcto')->textInput(['maxlength' => true , 'readonly'=> true]) ?>

    <?= $form->field($model, 'tipo_dcto')->textInput(['maxlength' => true , 'readonly'=> true]) ?>

    <?= $form->field($model, 'fecha_dcto')->textInput(['maxlength' => true , 'readonly'=> true]) ?>

    <?= $form->field($model, 'deuda')->textInput(['maxlength' => true,  'readonly'=> true]) ?>

    <?= $form->field($model, 'pagado')->textInput(['maxlength' => true ,'readonly' => ( $model->st_pagado ==2 ? true : false) ]) ?>

   <?= $form->field($model, 'fk_metodo_pago')->dropDownList(ArrayHelper::map(MetodoPago::find()->all(),'idmetodo_pago' , 'metodo_pago') , ['prompt'=>'SELECCIONA METODO DE PAGO']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
