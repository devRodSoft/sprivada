<?php

use app\custom\NumLetra;
$razo = strtolower($proyectos->fkCliente->nombre_razon_social);
$str = "
<span class='capitals'>".strtolower($proyectos->fkCliente->nombre_razon_social)."  </span><br>";
echo $str;
?> 


<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
	<div id="encabezado">
		<div class="tmain">PROPUESTA ECONOMICA</div>
		<h3>IMAGEN</h3>
		
	</div>

		
		<div id="parte1">
			<div class="grande">
			<span class="boldie">Nombre de la Empresa:</span>
			<span class="capitals"> <?= strtolower($proyectos->fkCliente->nombre_razon_social) ?> </span><br>
			<span class="boldie"> Atencion a:</span>
			<span class="capitals"><?= strtolower($proyectos->fkCliente->lider_proy) ?> </span><br>
			</div>
		</div><br><br>

		<div id="parte2">
			<span class="boldie">Folio:</span><?= ucwords(strtolower($cotizaciones->idcotizacion)) ?><br>
			<span class="boldie">Fecha:</span> <?= date("d-m-Y") ?> <br>
			<span class="boldie">Vigencia:</span> <?= date("d-m-Y", strtotime("+30 days")) ?> <br>
			<span class="boldie">Direccion:</span> <?= $proyectos->fkCliente->direccion ?> <br>
			<span class="boldie">Nombre Proyecto:</span> <?= $proyectos->proyecto ?><br>
			<span class="boldie">Escala:</span> <?= $proyectos->escala ?><br>
			<span class="boldie">No. Referencia:</span> <?= $cotizaciones->referencia ?><br>
			<span class="boldie">Tipo:</span> <br><br><br>
		</div>

			<div class="tsec">DESCRIPCION GENERAL DE LA MAQUETA:</div><br>
			<span class="boldie">-Dimensiones de la maqueta:</span><br>
			<div class="rightie">
			 <?php 
				foreach ($escalas as $cot) {
					 echo  "Escala ".$cot->escala."              dimensiones".$cot->dimensiones."</br>";
        //    
				}


			 ?>
			 </div><br><br>

			<span class="boldie">-El Área de la Maqueta se describe en el ANEXO “A” (Área de Maqueta)<br><br>
			
			-Para el Desarrollo de la PRIMERA ETAPA del proyecto es necesario proporcionar la información descrita en el ANEXO “B” (check list de documentos) en formato CAD o DWG</span><br><br><br>

			<span class="boldie">-Especificaciones del sitio:<br><br> </span> 
			<?= $cotizaciones->sitio ?>
			<span class="boldie">-Especificaciones del edificio: <br>
			CONSIDERAMOS LA ELABORACIÓN DE UN EDIFICIO.<br> <br></span>
			<?= $cotizaciones->edificio ?>

			<span class="boldie">-ILUMINACIÓN DE LA MAQUETA: <br><br></span>
			<?= $cotizaciones->iluminacion ?>

			<span class="boldie">-TIEMPO DE ELABORACIÓN:<br><br> </span>
			<span style="margin-left:130px"><?= $cotizaciones->elaboracion ?></span><br><br>
			Condicionado a la entrega de información en formato DWG O CAD (plantas y alzados), así como la ejecución de los pago correspondientes.
			<br><br><br><br>
			<div class="tsec">VALOR ECONÓMICO</</div>
			<span class="boldie">COSTO Y CONDICIONES:<br><br></span> 
			<table>
			<tbody>
			<tr>
				<td width="200">&nbsp;</td>
				<td width="300">&nbsp;</td>
				<td width="700" align="left">&nbsp;</td>
			</tr>
	

			<?php 
				$texto = "";
				$nul = new NumLetra();
				$i=0;
				foreach ($escalas as $i=> $cot) {
					$texto = "<tr><td> Propuesta ".($i+1)." </td><td>Escala ".$cot->escala."</td><td align='left'>$".number_format($cot->precio)."(".$nul->numtoletras($cot->precio).")+IVA</td></tr>";
       				echo $texto;
				}?>
			</tbody>
			</table>
			<br><br><br>
			<div class="tsec">FORMA DE PAGO:</div>
			<br><br>	
			<table border="1" >
				<thead >
					<tr>
						<th width="200" class="centerle">ESTAPA</th>
						<th width="300" class="centerle">CONCEPTO</th>
						<th width="150" class="centerle">PORCENTAJE</th>
						<?php 
							for($e=1;$e<=$i+1;$e++)
							echo "<th class='centerle'>MONTO PROPUESTA ".$e."</th>";
						?>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1.-ARRANQUE DEL PROYECTO</td>
						<td>ANTICIPO INICIAL</td>
						<td>60%</td>
						<?php 
							for($e=0;$e<=$i;$e++)
							echo "<td>$".number_format($escalas[$e]->precio*.6)."</td>";
						?>
							
					</tr>
					<tr>
						<td>2.-RECOPILACIÓN Y ESTUDIO DE INFORMACION</td>
						<td>SU ESTIMACIÓN ES DE 15 DÍAS, DEPENDERÁ DEL ENVÍO DE TODA LA INFORMACIÓN POR PARTE DEL CLIENTE</td>
						<td>20%</td>
						<?php 
							for($e=0;$e<=$i;$e++)
							echo "<td>$".number_format($escalas[$e]->precio*.2)."</td>";
						?>
							
					</tr>
					<tr>
						<td>3.-PRODUCCION</td>
						<td>ANTICIPO INICIAL</td>
						<td>15%</td>
						<?php 
							for($e=0;$e<=$i;$e++)
							echo "<td>$".number_format($escalas[$e]->precio*.15)."</td>";
						?>
							
					</tr>
					<tr>
						<td>4.-ENTREGA Y EMBARQUE</td>
						<td>ACEPTACIÓN VÍA FOTOS Y/O VIDEO, ANTES DE ENVÍO</td>
						<td>5%</td>
						<?php 
							for($e=0;$e<=$i;$e++)
							echo "<td>$".number_format($escalas[$e]->precio*.05)."</td>";
						?>
							
					</tr>
				</tbody>
			</table>
			<br><br>
			<div class="tsec">NOTAS IMPORTANTES:</div>
			<br>
			<div class="leftie">		
				<?= $configuraciones['tb1']; ?>
				<br><br><br>
				<?= $configuraciones['tb2']; ?>
				<br>
			</div>
			<div id="#firmas">
				<div id="#firma1">
					

				</div>
				<div id="#firma2">
					
					
				</div>
			</div>
		</div>




	</div>


