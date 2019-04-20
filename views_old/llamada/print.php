<?php

use app\custom\NumLetra;
use kartik\mpdf\Pdf;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php 

$folio = ucwords(strtolower($cotizaciones->idcotizacion));
$pdfp1 = '
<div class="row calib">
	<div class="col-lg-6 col-lg-offset-3" >';

if($extras['imprimir'] != null){
	$this->title = "Cotizacion No.".$cotizaciones->idcotizacion;
	$pdfp1	.= Html::a('<i class="fa glyphicon glyphicon-print"></i>&nbsp;&nbsp;Generar PDF', ["llamada/pdf?idcotizacion=$folio&prospecto=".$extras['prospecto']], [
    'class'=>'btn btn-danger frigthie mb50', 
    'target'=>'_blank', 
    'data-toggle'=>'tooltip', 
    'title'=>'Imprimira la cotizacion'
]);
	$pdfp1.='<div style="clear:both;"></div><div id="encabezado">';
}
	if($extras['imprimir'] == null){
		$pdfp1	.="<img src='logocot.png' width='173' class='frigthie' >";
	}else{
		$pdfp1	.="<img src='".Url::to('@web/assets/img/menu/logocot.png', true)."' width='173' class='frigthie' >";
	}	
	$pdfp1	.='
		<div class="tmain">PROPUESTA ECONÓMICA</div><br><br>
		<div style="clear:both;"></div>
	</div>
		
		<div id="parte1">
			<div class="grande">
			<span class="boldie">Nombre de la Empresa:</span>
			<span class="capitals"> '. strtolower($cotizaciones->razon) .' </span><br>
			<span class="boldie"> Atención a:</span>
			<span class="capitals">'. strtolower($extras['prospecto']) .' </span><br>
			</div>
		</div><br><br>

		<div id="parte2">
			<span class="boldie">Folio:</span>'. $folio .'<br>
			<span class="boldie">Fecha:</span> '. date("d-m-Y") .' <br>
			<span class="boldie">Vigencia:</span> '. date("d-m-Y", strtotime("+30 days")) .' <br>
			<span class="boldie">Dirección:</span> '. $cotizaciones->direccion .' <br>
			<span class="boldie">Nombre Proyecto:</span> '. $cotizaciones->nombre_proyecto .'<br>
			<span class="boldie">Escala:</span> '. $cotizaciones->escala .'<br>
			<span class="boldie">No. Referencia:</span> '. $cotizaciones->referencia .'<br>
			<span class="boldie">Tipo:</span>'.$cotizaciones->tipo.'<br><br><br>
		</div>

			<div class="tsec">DESCRIPCIÓN GENERAL DE LA MAQUETA:</div><br>
			<span class="boldie">-Dimensiones de la maqueta:</span><br>
			<div class="rightie"><table class="grande">
				<tbody>';
			$pdfp2 = "";
				foreach ($escalas as $cot) {
					 $pdfp2.="<tr><td width='300'>&nbsp; </td><td width='150' class='leftie'>Escala :".$cot->escala."</td><td width='500' class='leftie'>".$cot->dimensiones."</td></tr>";
        //    
				}

			$pdfp3='
			 </tbody></table></div><br><br>
			
			<span class="boldie">-El Área de la Maqueta se describe en el ANEXO “A” (Área de Maqueta)<br><br>
			
			-Para el desarrollo de la PRIMERA ETAPA del proyecto es necesario proporciónar la información descrita en el ANEXO “B” (check list de documentos) en formato CAD o DWG</span><br><br><br>

			<span class="boldie">-Especificaciones del sitio:<br><br> </span> 
			<div class="tb">'. $cotizaciones->sitio .'</div>
			<pagebreak>
			<span class="boldie">-Especificaciones de la maqueta:</span>
			<div class="tb">'.$cotizaciones->edificio.'</div>';
			
			if($cotizaciones->iluminacion!=""){
				$pdfp3.= '<span class="boldie">-Iluminación de la maqueta: <br><br></span>
				<div class="tb">'. $cotizaciones->iluminacion .'</div>';
			}
			$pdfp3.='<span class="boldie">-TIEMPO DE ELABORACIÓN:<br><br> </span>
			<div id="elaboracion">'. $cotizaciones->elaboracion .'</div><br><br>
			Condiciónado a la entrega de información en formato DWG O CAD (plantas y alzados), así como la ejecución de los pago correspondientes.
			<br><br>
			<div class="tsec">VALOR ECONÓMICO</div>
			<span class="boldie">COSTO Y CONDICIONES:<br><br></span>';
			$pdfp4 = "<table id='grande'>
				<tbody>";
				
				$nul = new NumLetra();
				$i=0;
				foreach ($escalas as $i=> $cot) {
					$pdfp4.= "<tr><td width='150'> Propuesta ".($i+1)." </td><td width='200'>Escala ".$cot->escala."</td><td width='500' align='left'>$".number_format(trim($cot->precio))."(".$nul->numtoletras($cot->precio).")+IVA</td></tr>";
				}

		
			$pdfp4.= '</tbody></table>';
			$pdfp5='<br><br><br><br><br><pagebreak>
			<div class="tsec">FORMA DE PAGO:</div>
			<br><br>	
			<table border="1" class="calib" >
				<thead >
					<tr>
						<th width="150" align="center">ETAPA</th>
						<th width="250" align="center">CONCEPTO</th>
						<th width="50" align="center">%</th>';
						$pdfp6 ="";
							for($e=1;$e<=$i+1;$e++)
							$pdfp6.="<th align='center'>MONTO PROPUESTA ".$e."</th>";
					
					$pdfp6.='</tr>
				</thead>
				<tbody>
					<tr>
						<td>1.-ARRANQUE DEL PROYECTO</td>
						<td>ANTICIPO INICIAL</td>
						<td class="centerle">60%</td>';
						
							for($e=0;$e<=$i;$e++)
							$pdfp6.="<td class='centerle'>$".number_format($escalas[$e]->precio*.6)."</td>";
						
							
					$pdfp6.='</tr>
					<tr>
						<td>2.-RECOPILACIÓN Y ESTUDIO DE INFORMACIÓN</td>
						<td>SU ESTIMACIÓN ES DE 15 DÍAS, DEPENDERÁ DEL ENVÍO DE TODA LA INFORMACIÓN POR PARTE DEL CLIENTE</td>
						<td class="centerle">20%</td>';
						
							for($e=0;$e<=$i;$e++)
							$pdfp6.= "<td class='centerle'>$".number_format($escalas[$e]->precio*.2)."</td>";
							
					$pdfp6.='</tr>
					<tr>
						<td>3.-PRODUCCIÓN</td>
						<td>ANTICIPO INICIAL</td>
						<td class="centerle">15%</td>';
							for($e=0;$e<=$i;$e++)
							$pdfp6.= "<td class='centerle'>$".number_format($escalas[$e]->precio*.15)."</td>";
							
					$pdfp6.='</tr>
					<tr>
						<td>4.-ENTREGA Y EMBARQUE</td>
						<td>ACEPTACIÓN VÍA FOTOS Y/O VIDEO, ANTES DE ENVÍO</td>
						<td class="centerle">5%</td>';
						
							for($e=0;$e<=$i;$e++)
							$pdfp6.="<td class='centerle'>$".number_format($escalas[$e]->precio*.05)."</td>";
						
							
					$pdfp6.= '</tr>
				</tbody>
			</table>
			<br><br>
			<div class="tsec">NOTAS IMPORTANTES:</div>
			<br>
			<div class="leftie tb">'.$configuraciones["tb1"].'<br><br>
				'.$configuraciones['tb2'].'
				<br>
			</div>
			<div id="firmas">
				<div id="firma1">
				<div class="subr">
				<span class="boldie">
					Héctor Antonio Nápoles   <br>                                                                                 
					Depto. Presupuestos/ Producción
				</span>
				</div>

				</div>
				<div id="firma2">
				<div class="subr">
				<span class="boldie">
					 C. Cliente/Fecha 
					</span>
					</div>
				</div>
			</div>
		</div>
	</div>';

$pdftotal = $pdfp1.$pdfp2.$pdfp3.$pdfp4.$pdfp5.$pdfp6;
// $pdftotal = $pdfp4;
echo $pdftotal;

if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}