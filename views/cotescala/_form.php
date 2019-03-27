<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Cotescala */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cotescala-form">
	
	<div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i> Address Book
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Nueva propuesta</button>
            <div class="clearfix"></div>
        </div>
    
    <?php $form = ActiveForm::begin(['id'=>'formulario']); 
	
     $form->field($model, 'escala')->textInput(['maxlength' => true]);

     $form->field($model, 'dimensiones')->textInput(['maxlength' => true]);

     $form->field($model, 'precio')->textInput(['maxlength' => true]);

     $form->field($model, 'fk_cotizacion')->textInput(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); 
        F
    ?>
</div>
