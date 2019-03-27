<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CentroCosto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="centro-costo-form">

    <?php $form = ActiveForm::begin(['id'=>'formulario']); ?>

    <?= $form->field($model, 'nombre_centro')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
