<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CformaPago */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cforma-pago-form">

    <?php $form = ActiveForm::begin(['id'=>'formulario']); ?>

    <?= $form->field($model, 'cforma_pago')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
