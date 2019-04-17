<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Grupo;

/* @var $this yii\web\View */
/* @var $model app\models\Tipo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'fkgrupo')->dropDownList(ArrayHelper::map(Grupo::find()->all(),'idgrupo' , 'descripcion') , ['prompt'=>'SELECCIONA GRUPO']) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
