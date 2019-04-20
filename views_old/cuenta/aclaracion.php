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
    <?= $form->field($model, 'observacion')->textArea(['rows' => '6']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
