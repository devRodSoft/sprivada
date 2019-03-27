<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DesarrolloValor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="desarrollo-valor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'avance')->textInput() ?>

    <?= $form->field($model, 'avance_ant')->textInput() ?>

    <?= $form->field($model, 'fk_proyecto')->textInput() ?>

    <?= $form->field($model, 'fk_desarrollo')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
