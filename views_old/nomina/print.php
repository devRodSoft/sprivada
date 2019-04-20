<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\custom\GlypIcon;

$this->params['breadcrumbs'][] = 'Nominas';
echo '<div class="container">';

echo '<div class="nomina-view">
        <div style="font-size:11px">
                <span class="faleft romper">FECHA CREACION : '.Yii::$app->formatter->asDatetime($model[0]['created_at']).'</span>
                <span class="fright romper">FECHA IMPRESION : '.Yii::$app->formatter->asDatetime(date('Y-m-d H:i:s')).'</span>
                <span class="romper"></span></div></div>';

echo '<h2 class="acenter">NOMINA FOLIO '.$model[0]['folio'].'</h2><br>';



foreach ($model as $emp) {
	echo "<table><tr class='negrita'>";
	echo "<td class='col-md-5'>Empleado : $emp->nombre</td> ";
	echo "<td class='col-md-3'>Pago Total : $emp->empleado_total</td>";
	echo "<td class='col-md-4'>Promedio de Avance : $emp->porcentaje_total </td></tr></table>";
	echo "<table class='table table-striped'>
      <tr class='negrita'>
        <td class='aleft col-md-3'>Proyecto</td>
        <td class='aright col-md-2'>% Avance</td>
        <td class='aright col-md-2'>% Pago</td>
        <td class='aright col-md-2' >Monto</td>
        <td class='aright col-md-2' >Monto x Avance</td>
        <td class='col-md-1'>&nbsp;</td>
      </tr>";
    $total = 0;
    $odd= 1;

	foreach ($emp->nominaDetalles as $nomdet) {
        $oddtext =($odd%2==1)?"odd":"";
    $total +=$nomdet->monto_total; 
		if($odd%2==1){
            echo "<tr class='odd'>";
        }else{
            echo "<tr>";
        }
        		echo "<td class='aleft col-md-3'>$nomdet->proyecto</td>
                <td class='col-md-2 aright'>$nomdet->avance</td>
                <td class='col-md-2 aright'>$nomdet->porcentaje_pago</td>
        		<td class='col-md-2 aright'>$nomdet->monto</td>
                <td class='col-md-2 aright' >$nomdet->monto_total</td>
        		<td class='col-md-1'>&nbsp;</td>
      		   </tr>";
               $odd++;
		}
		echo "<tr class='negrita'>
        		<td class='aleft col-md-3'>&nbsp;</td>
        		<td>&nbsp;</td>
        		<td>&nbsp;</td>
        		<td class='aright col-md-2 ' >$emp->empleado_total</td>
                <td class='aright col-md-2 '> $total</td>
        		<td>&nbsp;</td>
      		   </tr>";
		echo "</table>";

	
}
echo '</div>';



if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}