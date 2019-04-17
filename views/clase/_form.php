<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;

use app\models\Grupo;
/* @var $this yii\web\View */
/* @var $model app\models\Clase */
/* @var $form yii\widgets\ActiveForm */
    $grupos = ArrayHelper::map(Grupo::find()->asArray()->all(), 'idgrupo', 'descripcion')
?>

<div class="clase-form">

    <?php $form = ActiveForm::begin(); ?>

    
    <?=  Html::hiddenInput('selected_id', $model->isNewRecord ? '' : $model->fkgrupo, ['id'=>'selected_id']); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'fkgrupo')->dropDownList($grupos, ['id'=>'fkgrupo']); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'fktipo')->widget(DepDrop::classname(), [
            'options'=>['id'=>'idtipo'],
            // 'type' => DepDrop::TYPE_SELECT2,
            // 'select2Options' => ['pluginOptions' => ['allowClear' => true]],
            'pluginOptions'=>[
                'depends'=>['fkgrupo'],
                'placeholder'=>'Selecciona Tipo...',
                    'initDepends' => ['fkgrupo'],
                    'initialize' => $model->isNewRecord ? false : true,
                'url'=>Url::to(['tipos']),
                'loadingText' => 'Cargando Tipos ...',
                'params'=> ['selected_id'], 
            ]
        ]); ?>
        </div>
        
    </div>
    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
