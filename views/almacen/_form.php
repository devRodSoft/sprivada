<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Tipo;

$tipos = ArrayHelper::map(Tipo::find()->where(['fkgrupo'=> 5])->asArray()->all(), 'idtipo', 'descripcion');

$tiposf[0] = "Seleccione un Tipo";
foreach ($tipos as $key => $value) {
    $tiposf[$key] = $value;
}

/* @var $this yii\web\View */
/* @var $model app\models\Almacen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="almacen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>


    <?=  Html::hiddenInput('selected_id', $model->isNewRecord ? '' : $model->fktipo, ['id'=>'selected_id']); ?>

    <?= $form->field($model,'fkgrupo',['inputOptions'=>['value'=>'5']])->hiddenInput()->label(false); ?>
    

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'fktipo')->dropDownList($tiposf, ['id'=>'idtipo']); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'fkclase')->widget(DepDrop::classname(), [
            'options'=>['id'=>'idclase'],
            // 'type' => DepDrop::TYPE_SELECT2,
            // 'select2Options' => ['pluginOptions' => ['allowClear' => true]],
            'pluginOptions'=>[
                'depends'=>['idtipo'],
                'placeholder'=>'Selecciona Clase...',
                    'initDepends' => ['idtipo'],
                    'initialize' => $model->isNewRecord ? false : true,
                'url'=>Url::to(['clases']),
                'loadingText' => 'Cargando Clases ...',
                'params'=> ['selected_id'], 
            ]
        ]); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
