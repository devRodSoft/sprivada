<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use app\models\Estado;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$estados = ArrayHelper::map(Estado::find()->asArray()->all(), 'idestado', 'descripcion');



/* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">Datos Generales</div>
                <div class="panel-body">
    <?= $form->field($model, 'razon')->textInput(['maxlength' => true]) ?>

    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'rfc')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
</div>
</div>

    <div class="row">
                        <div class="col-md-8">
                            <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($model, 'noexterior')->textInput(['maxlength' => true])  ?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($model, 'nointerior')->textInput(['maxlength' => true])  ?>
                        </div>
                    </div>
                    <?=  Html::hiddenInput('selected_id', $model->isNewRecord ? '' : $model->fkmunicipio, ['id'=>'selected_id']); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'fkestado')->dropDownList($estadosf, ['id'=>'idestado']); ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'fkmunicipio')->widget(DepDrop::classname(), [
                            'options'=>['id'=>'idmunicipio'],
                            // 'type' => DepDrop::TYPE_SELECT2,
                            // 'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                            'pluginOptions'=>[
                                'depends'=>['idestado'],
                                'placeholder'=>'Selecciona Municipio...',
                                 'initDepends' => ['idestado'],
                                  'initialize' => $model->isNewRecord ? false : true,
                                'url'=>Url::to(['/municipio']),
                                'loadingText' => 'Cargando Municipios ...',
                                'params'=> ['selected_id'], 
                            ]
                        ]); ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'ciudad')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <?= $form->field($model, 'colonia')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($model, 'cp')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($model, 'celular')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'calle')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'calle2')->textInput(['maxlength' => true]) ?>
                        </div>
                       
                    </div>
                </div>
            </div>
            <br />
            <br />
            <div class="panel panel-default">
                <div class="panel-heading">Información Empresa</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5">
                            <?= $form->field($model, 'tipo_cliente')->textInput(['maxlength' => true])  ?>
                        </div>
                        <div class="col-md-5">
                            <?= $form->field($model, 'giro')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($model, 'noempleados')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'encargado_pago')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'dias_pago')->textInput(['maxlength' => true]) ?>
                        </div>
                        
                        <div class="col-md-4">
                            <?= $form->field($model, 'contrato')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
