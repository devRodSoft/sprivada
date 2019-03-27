<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\custom\GlypIcon;

$this->title = "Lista de Nomina";
$this->params['breadcrumbs'][] = 'Nominas';
    
echo '<div class="container">';
echo Html::a('<i class="fa glyphicon glyphicon-print"></i>&nbsp;&nbsp;Generar PDF', ["pdf?folio=".$model[0]['folio']], [
    'class'=>'btn btn-danger frigthie mb50', 
    'target'=>'_blank', 
    'data-toggle'=>'tooltip', 
    'title'=>'Imprimira la cotizacion'
]);
echo '<div class="nomina-view">
        <div style="font-size:15px">
                <span class="faleft romper">FECHA CREACION : '.Yii::$app->formatter->asDatetime($model[0]['created_at']).'</span>
                <span class="fright romper">FECHA IMPRESION : '.Yii::$app->formatter->asDatetime(date('Y-m-d H:i:s')).'</span>
                <span class="romper"></span></div></div>';
echo '<h1 class="acenter">NOMINA FOLIO '.$model[0]['folio'].'</h1><br>';



foreach ($model as $emp) {
	echo "<div class='row'>";
	echo "<h7><div class='col-md-5'>Empleado : $emp->nombre</div> ";
	echo "<div class='col-md-3'>Pago Total : $emp->empleado_total</div>";
	echo "<div class='col-md-4'>Promedio de Avance : $emp->porcentaje_total </div></h7></div>";
	echo "<table class='table table-striped'>
    <thead>
      <tr>
        <th class='col-xs-3'>Proyecto</th>
        <th class='aright col-xs-2'>% Avance</th>
        <th class='acenter col-xs-2'>% Pago</th>
        <th class='aright col-xs-2' >Monto</th>
        <th class='aright col-xs-2' >Monto x Avance</th>
        <th class='col-xs-1'>&nbsp;</th>
      </tr>
    </thead>
    <tbody>";
    $total = 0;
	foreach ($emp->nominaDetalles as $nomdet) {
    $total +=$nomdet->monto_total; 
		echo "<tr>
        		<td>$nomdet->proyecto</td>
            <td class='aright'>$nomdet->avance</td>
            <td class='acenter'>$nomdet->porcentaje_pago</td>
        		<td class='aright'>$nomdet->monto</td>
            <td class='aright' >$nomdet->monto_total</td>
        		<td >&nbsp;</td>
      		   </tr>";
		}
		echo "<tfoot>
        		<th>&nbsp;</th>
        		<th>&nbsp;</th>
        		<th>&nbsp;</th>
        		<th class='aright' >$emp->empleado_total</th>
            <th class='aright'> $total</th>
        		<th>&nbsp;</th>
      		   </tr>";
		echo "</tfoot>
  	  </table>";
	
}
echo '</div>';



if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}