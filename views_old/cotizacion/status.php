<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\custom\GlypIcon;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */

$this->title = "Cambio Status : ".$model->idcotizacion;
$this->registerJsFile('/erp/js/cotizacion.js', ['depends' => [\yii\web\JqueryAsset::className()],'position' => \yii\web\View::POS_END]);
?>
<div class="cotizacion-view">
 <div class="btn-group" role="group" >
<button type="button" class="btn btn-default "><a   href="/erp/proyecto/create?fk_cotizacion=<?= $model->idcotizacion ?>&fk_llamada=<?= $model->fk_llamada ?>" >ACEPTADA</a></button>
    <button type="button" class="btn btn-default" id="rechazar"><a  href="#" title="Rechazar Cotizacion"   >RECHAZADA</a></button>
  <button type="button" class="btn btn-default" id="vencer"><a  href="#"  title="Rechazar Cotizacion" >PRÓRROGA</a></button>
   </div>
<div id="rechazada" style="display:none">
<?php $form = ActiveForm::begin(['action'=>Url::to(['cotizacion/rechazada', 'idcotizacion' => $model->idcotizacion  , 'fk_llamada' => $model->fk_llamada])]); 
     echo $form->field($model, 'observacion')->textInput(['maxlength' => true]) ;

      echo '<div class="form-group">';
     echo  Html::submitButton('Guardar', ['class' => 'btn btn-primary']); 
   echo '</div>';
  ActiveForm::end(); ?>
</div>

<div id="vencida" style="display:none">

<?php $form = ActiveForm::begin(['action'=>Url::to(['cotizacion/vencida', 'idcotizacion' => $model->idcotizacion  , 'fk_llamada' => $model->fk_llamada])]); 
       echo        $form->field($model, 'fecha')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'SELECCIONA FECHA'],
    'type' => DatePicker::TYPE_INPUT,
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true
        ],
      
]);

      echo '<div class="form-group">';
        echo  Html::submitButton('Guardar', ['class' => 'btn btn-primary']); 
   echo '</div>';
  ActiveForm::end(); ?>
</div>

</div>
