<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\switchinput\SwitchInput;
?>
 <h1><?= "Proyecto:".Html::encode($model->proyecto) ?></h1>
<div class="sigfase-form">
    <?php $form = ActiveForm::begin(); ?>

	 <?= $form->field($model, 'st_iluminacion')->widget(SwitchInput::classname(),[] );?>

    <div class="form-group">
        <?= Html::submitButton('Siguiente Fase' ,['class' =>  'btn btn-success' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

