<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Um;

/* @var $this yii\web\View */
/* @var $model app\models\Material */
/* @var $form yii\widgets\ActiveForm */
[/*'enableAjaxValidation' => $model->isNewRecord ,
     // 'validationUrl' => Url::toRoute('validation'),*/
      ]
?>

<div class="material-almacen-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => $model->isNewRecord] ); ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true, 'readonly'=>!$model->isNewRecord]  ) ?>

    <?= $form->field($model, 'material_almacen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'familia')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'costo')->textInput(['maxlength' => true,'readonly'=>true]) ?>
    <?= $form->field($model, 'costo_iva')->textInput(['maxlength' => true,'readonly'=>true]) ?>
    <?= $form->field($model, 'existencia')->textInput(['maxlength' => true,'readonly'=>true]) ?>
     <?= $form->field($model, 'fk_um')->dropDownList(ArrayHelper::map(UM::find()->all(),'idum' , 'um') , ['prompt'=>'SELECCIONA UNIDAD DE MEDIDA']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


