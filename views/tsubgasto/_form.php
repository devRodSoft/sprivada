<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\CtipoGasto;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\CsubTipoGasto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="csub-tipo-gasto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'csub_tipo_gasto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fk_ctipo_gasto')->dropDownList(ArrayHelper::map(CtipoGasto::find()->all(),'idctipo_gasto' , 'ctipo_gasto') , ['prompt'=>'SELECCIONA TIPO DE GASTO']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
