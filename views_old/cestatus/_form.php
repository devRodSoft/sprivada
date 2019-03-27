<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cestatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cestatus-form">

    <?php $form = ActiveForm::begin(['id'=>'test']); ?>

    <?= $form->field($model, 'cestatus')->textInput(['maxlength' => true, 'class'=>'form-control uc']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary ', ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
