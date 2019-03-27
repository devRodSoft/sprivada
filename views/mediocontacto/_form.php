<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Mediocontacto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mediocontacto-model-form">

    <?php $form = ActiveForm::begin(['id'=>'formulario']); ?>

<!--  //= $form->field($model, 'idmediocontacto')->textInput() ?>-->

    <?= $form->field($model, 'medio')->textInput(['maxlength' => true,  'class'=>'form-control uc']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
