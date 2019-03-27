<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CtipoColor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ctipo-color-model-form">

    <?php $form = ActiveForm::begin(['id'=>'formularaio']); ?>

    <?= $form->field($model, 'ctipo_color')->textInput(['maxlength' => true ,'class'=>'form-control uc']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
