<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CtipoGasto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ctipo-gasto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ctipo_gasto')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
