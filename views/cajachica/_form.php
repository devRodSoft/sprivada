<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\CformaPago;
use app\models\CsubTipoGasto;
use app\models\CentroCosto;
use app\models\MetodoPago;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\CajaChica */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('/erp/js/cajachica.js', ['depends' => [\yii\web\JqueryAsset::className()],'position' => \yii\web\View::POS_END]);
?>

<div class="caja-chica-form">
    <?php $form = ActiveForm::begin(['id'=>'formulario']); ?>


    <?= $form->field($model, 'caja_chica')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'importe')->textInput(['readonly'=> !$model->isNewRecord]) ?>
    
    <?=  $form->field($model, 'fk_cforma_pago')->dropDownList(ArrayHelper::map(CformaPago::find()->all(),'idcforma_pago' , 'cforma_pago') , ['prompt'=>'SELECCIONA FORMA DE PAGO']) ?>
    <?php 
        $tipos = CsubTipoGasto::find()->with('fkCtipoGasto')->asArray()->all();
        foreach ($tipos as $key => $tgasto) {
            $tipos[$key]['fullgasto'] = "Gasto :".$tipos[$key]['csub_tipo_gasto']." - Subtipo:". $tipos[$key]['fkCtipoGasto']['ctipo_gasto'];
        }
        $clientes = ArrayHelper::map($tipos,'idcsub_tipo_gasto' , 'fullgasto');
        echo $form->field($model, 'fk_csub_tipo_gasto')->widget(Select2::classname(), [
            'data' => $clientes,
            'options' => ['placeholder' => 'SELECCIONA SUBTIPO DE GASTO'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); 
    ?>  

    <?= $form->field($model, 'fk_centro_costo')->dropDownList(ArrayHelper::map(CentroCosto::find()->all(),'idcentro_costo' , 'nombre_centro') , ['prompt'=>'SELECCIONA CENTRO DE COSTO']) ?>
       <div class="row">
    
    <?php if($model->isNewRecord): ?>
    <div class="col-md-3">
    <?= $form->field($model, 'dias')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-9">
    <?php 
        echo $form->field($model, 'fecha_comprachica')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'SELECT FECHA DE ENTREGA'],
    'type' => DatePicker::TYPE_INPUT,
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true
        ],]);
      

    ?>
    </div>
    </div>
    <?php endif;?>
    
    <?= $form->field($model, 'observacion')->textArea(['rows' => '6' , 'maxlength' => true] ) ?>
    


<?php if($model->isNewRecord): ?>
      <div class="row">
    <div class="col-md-3">
      <?= $form->field($model, 'stpagado')->widget(SwitchInput::classname(),[] );?>
    
    </div>       
    <div class="col-md-10 metodo">
      <?= $form->field($model, 'metodo')->dropDownList(ArrayHelper::map(MetodoPago::find()->all(),'idmetodo_pago' , 'metodo_pago') , ['prompt'=>'SELECCIONA METODO DE PAGO']) ?>
    </div>       
  </div>    
<?php endif;?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Nuevo' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
