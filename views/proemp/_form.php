<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoEmpleado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-empleado-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation'=>true , 'id'=>'testa']); ?>

    <?= $form->field($model, 'porcentaje')->textInput() ?>
    <?php   
		if($model->isNewRecord){
        echo $form->field($model, 'fk_empleado')->widget(Select2::classname(), [
            'data' => $empleados,
            'options' => ['placeholder' => 'SELECCIONA UN EMPLEADO'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); 

	}?>  
	<?= $form->field($model, 'fk_proyecto')->hiddenInput()->label(false); ?>
	

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
