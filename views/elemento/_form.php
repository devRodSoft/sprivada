<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\models\Puesto;

/* @var $this yii\web\View */
/* @var $model app\models\Elemento */
/* @var $form yii\widgets\ActiveForm */

$sexos[1] = 'Masculino';
$sexos[2] = 'Femenino';  

$puestos = ArrayHelper::map(Puesto::find()->asArray()->all(), 'idpuesto', 'descripcion');

?>

<div class="elemento-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'iniciales')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-9">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'paterno')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'materno')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'sexo')->dropDownList($sexos, ['id'=>'idsexo']); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'fkpuesto')->dropDownList($puestos, ['id'=>'idpuesto']); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
