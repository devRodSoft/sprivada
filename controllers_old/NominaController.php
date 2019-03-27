<?php

namespace app\controllers;

use Yii;
use app\models\Empleado;
use app\models\ProyectoEmpleado;
use app\models\ProduccionValor;
use app\models\Proyecto;
use app\models\ProyectoCosto;
use app\models\Pcosto;
use app\models\Nomina;
use app\models\NominaDetalle;
use app\models\Rptnomina;
use app\models\VwProyectoEmpleado;
use app\controllers\ProyectoController;
use app\search\NominaSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use kartik\mpdf\Pdf;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class NominaController extends Controller
{

	private $arr_prod=[4,5,7,8];
	 public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [   'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    public function actionCreate()
    {
    	if(Yii::$app->user->can('nomina')){
	    	$tomemp = 0;
	    	$sumaPorcentajes = 0;
	    	$numProyectos= 0;
	    	$totalEmpleado = 0;
	    	
	    	
	    	//ASIGNACION DE FOLIO A LA NOMINA
	    	$folio = $this->getFolio();


	    	//ID DE PROYECTOS
	    	$idproys = $this->getProyectos();
	    	
	    	
	    	//OBTENER TODOS EMPLEADOS LOS EXISTENTES EN LOS PROYECTOS  PARA LA NOMINA
	    	$empleados = ProyectoEmpleado::find()->where(['in' , 'fk_proyecto' , $idproys ])->groupBy(['fk_empleado'])->all();
	    	$costos = ",";
	    	//FOREACH DE EMPLEADOS	 
	    	foreach ($empleados as $emp){ 
	    		$totalEmpleado = 0;
				
				if($this->saveEmployee($emp, $idproys)){
					//CREACION DE ENCABEZADO NOMINA
		    		$nomina = new Nomina();
			    	$nomina->fk_empleado = $emp->fk_empleado;
			    	$nomina->nombre = $emp->fkEmpleado->nombre;
			    	$nomina->alias = $emp->fkEmpleado->alias;
			    	$nomina->empleado_total = 0;
			    	$nomina->porcentaje_total = 0;
			    	$nomina->folio = $folio;
			    	$nomina->save();

			    	$sumaPorcentajes = 0;
		    		$numProyectos= 0;

			    	//OBTENER PROYECTOS DEL EMPLEADO
			    	$proyemp = ProyectoEmpleado::find()->where(['in' , 'fk_proyecto' , $idproys ])->andWhere(['fk_empleado' => $emp->fk_empleado])->all();

					//FOREACH DE EMPLEADO-PROYECTO	    	
			    	foreach ($proyemp as $it) {
			    		//PROMEDIO 
			    		$avgPrevius = ProduccionValor::find()->where(['fk_proyecto'=>$it->fk_proyecto,'fk_produccion'=>$this->arr_prod])->average('avance_ant');
		        		$avgActual = ProduccionValor::find()->where(['fk_proyecto'=>$it->fk_proyecto,'fk_produccion'=>$this->arr_prod])->average('avance');
		        		$avgDif = number_format($avgActual - $avgPrevius,2,".","");


		        		//CREAR OBJETO DEL PROYECTO
		        		$proy = Proyecto::findOne(['idproyecto'=>$it->fk_proyecto]);
		        		if($avgDif > 0){
		        			
		        			
			        		$sumaPorcentajes += $avgDif;
			        		$numProyectos++;

			        		//PORCENTAJE DE GANANCIA DEL PROYECTO
			        		$tganancia = $proy->precio * ($proy->moporcentaje / 100);
			        		
			        		//PORCENTAJE AJUSTADO AL AVANCE DEL PROYECTO
			        		$total = number_format($tganancia * ($avgDif/100),2,".","");

			        		
			        		
			        		//CADENA PARA NO REPETIR COSTO AL PROYECTO
			        		$pos = strpos($costos,",".$it->fk_proyecto.",");
							if ($pos === false) {
			        			$costos .=  $it->fk_proyecto.",";

			        			//ENCABEZADO COSTO
			        			$cos_enc = new ProyectoCosto();
			        			$cos_enc->fk_movimiento = 0;
			        			$cos_enc->fk_proyecto = $it->fk_proyecto;
			        			$cos_enc->folio = "N".date("Y-m-d");
			        			$cos_enc->solicitante = Yii::$app->user->identity->username;
			        			$cos_enc->validate();
			        			$cos_enc->save();

			        			//DETALLE DE COSTO
			        			$cos_det = new Pcosto();
			        			$cos_det->codigo = "NOMINA";
			        			$cos_det->familia ="NOMINA";
			        			$cos_det->material = "NOMINA ".date("Y-m-d");
			        			$cos_det->costo = $total;
			        			$cos_det->cantidad = 1;
			        			$cos_det->fk_proyecto_costo= $cos_enc->idproyecto_costo;
			        			$cos_det->save();

			        			//ACTUALIZAMOS EL COSTO DEL PROYECTO
			        			$proy->costo += $total;
			        			if($avgActual == 100)
			        				$proy->st_terminado =3;
			        			$proy->save();
							} //TERMINA FOREACH DE EMPLEADO-PROYECTO

							//DETALLE DE LA NOMINA X PROYECTO
			        		$nomdet = new NominaDetalle();
			        		$nomdet->fk_nomina = $nomina->idnomina;
			        		$nomdet->fk_proyecto = $it->fk_proyecto;
			        		$nomdet->proyecto = $proy->proyecto;
			        		$nomdet->monto = (($emp->porcentaje/100)*$total);
			        		$nomdet->avance = $avgDif;
			        		$nomdet->porcentaje_pago = $it->porcentaje;
			        		$nomdet->monto_total = $total;
			        		$nomdet->validate();
			        		$nomdet->save();

			        		$valores = $this->getValores($nomdet->fk_proyecto);
			        		$rpt = new Rptnomina();
			        		$rpt->fkproyecto = $it->fk_proyecto;
			        		$rpt->folio_nomina = $folio;
				            $rpt->proyecto = $nomdet->proyecto;
				            $rpt->empleado = $nomina->nombre;
				            $rpt->porproyecto = $proy->moporcentaje;
				            $rpt->monto_proyecto = $tganancia;
				            $rpt->porparticipacion = $nomdet->porcentaje_pago;
				            $rpt->monto_participacion = $nomdet->monto;
				            $rpt->porgeneral = $avgActual;
				            $rpt->porpreliminares = $valores[0]['avance'];
				            $rpt->porplaneacion = $valores[1]['avance'];
				            $rpt->porfabricacion = $valores[2]['avance'];
				            $rpt->porpintura = $valores[3]['avance'];
				            $rpt->poriluminacion = $valores[4]['avance'];
				            $rpt->pormontaje = $valores[5]['avance'];
				            $rpt->porentrega = $valores[6]['avance'];
				            $rpt->save();
				            // $rpt->created_at = 
							// $rpt->updated_at = 
				            // $rpt->created_by = 
				            // $rpt->updated_by = 


			        		$totalEmpleado+= $nomdet->monto;
		        		}//SI EXISTE DIFERENCIA

			    	}//TERMINA FOREACH DE EMPLEADO-PROYECTO

			    	if($numProyectos> 0){
				    	//ACTUALIZAR PORCENTAJE Y TOTAL POR EMPLEADO
				    	$nomenc =Nomina::findOne(['idnomina'=>$nomina->idnomina]);
				    	$nomenc->empleado_total = $totalEmpleado;
				    	$nomenc->porcentaje_total =  number_format($sumaPorcentajes / $numProyectos,2,".","");
				    	$nomenc->save();
				    	
			    	}

			    }//SAVE EMPLOYEE
	    	}//END FOREACH EMPLEADOS
	    	//COMENTAR SI ESTA EN FASE DE PRUEBAS
	    	$this->transferirAvance($idproys); //ACTUALIZAR
	    	return $this->redirect(['index']);
    	} else{
            throw new ForbiddenHttpException;
    	}
    }




    private function saveEmployee($emp,$idproys)
    {
    	$proyemp = ProyectoEmpleado::find()->where(['in' , 'fk_proyecto' , $idproys ])->andWhere(['fk_empleado' => $emp->fk_empleado])->all();
		foreach ($proyemp as $it) {
		//PROMEDIO 
			$avgPrevius = ProduccionValor::find()->where(['fk_proyecto'=>$it->fk_proyecto,'fk_produccion'=>$this->arr_prod])->average('avance_ant');
			$avgActual = ProduccionValor::find()->where(['fk_proyecto'=>$it->fk_proyecto,'fk_produccion'=>$this->arr_prod])->average('avance');
			$avgDif = number_format($avgActual - $avgPrevius,2,".","");

			if($avgDif > 0)
				return true;
		}
		return false;
    }

    private function getFolio(){
    	$tam = Nomina::find()->Count('idnomina');
    	if($tam==0)
    		return 1;
    	else
    		return 1 + Nomina::find()->Max('folio');
    }

    public function actionIndex(){

    	if(Yii::$app->user->can('vnomina')){
    		$query = NominaDetalle::find();
        	$dataExport = new ActiveDataProvider(['query' => $query,]);
			$query = Nomina::find()->groupBy('folio');

			$sempMenos100 = VwProyectoEmpleado::find();
			$empMenos100 = new ActiveDataProvider(['query' => $sempMenos100,]);

			$dataProvider = new ActiveDataProvider([
		    'query' => $query,
		    'pagination' => [
		        'pageSize' => 10,
		    ],
		    'sort' => [
		        'defaultOrder' => [
		            'folio' => SORT_DESC,
		        ]
			],]);

		    return $this->render('index', [
		        // 'searchModel' => $searchModel,
		        'dataProvider' => $dataProvider,
		        'dataExport' => $dataExport,
		        'proyectos'=> $this->getProyectos(),
		        'empleados'=> $empMenos100,
		    ]);
	    } else{
            throw new ForbiddenHttpException;
    	}
    }

    private function transferirAvance($proyectos){
    	  
    	foreach ($proyectos as $proy) {
    		$query = "update produccion_valor set avance_ant = avance where fk_proyecto =".$proy ;
       		$registros =  Yii::$app->db->createCommand($query)->execute();
    	}
    }

    public function actionTest()
    {


    	$h = $this->getValores(5);
    	d($h[0]['avance']);
    	d($h[1]['avance']);
    	die();
    	foreach ($proyectos as $proy) {
    		$query = "update produccion_valor set avance_ant = avance where fk_proyecto =".$proy ;
    		d($query);
    		die();
       		$registros =  Yii::$app->db->createCommand($query)->execute();
    	}
    }

    private function getProyectos(){
		$proyectos = Proyecto::find()->where(['st_terminado'=>'2'])->all();
		$idproys = [];
    	
    	foreach ($proyectos as $proy) {
	    	$avgPrevius = ProduccionValor::find()->where(['fk_proyecto'=>$proy->idproyecto,'fk_produccion'=>$this->arr_prod])->average('avance_ant');
			$avgActual = ProduccionValor::find()->where(['fk_proyecto'=>$proy->idproyecto,'fk_produccion'=>$this->arr_prod])->average('avance');
			$avgDif = number_format($avgActual - $avgPrevius,2,".","");
			// d([$proy['idproyecto'] , $avgPrevius , $avgActual ,$avgDif]);
			if($avgDif > 0)
				array_push($idproys, $proy->idproyecto);
    	}
    	return $idproys;
    }

    public function actionView($folio){
    	$this->layout = 'printl';
    	return $this->render('view', [
            'model' => $this->findModel($folio),
        ]);
      
    }

    public function actionPdf($folio){
    	$model = $this->findModel($folio);
        $extras = [ 'imprimir' => null];
        $this->layout = 'printl';
        $content=  $this->render('print' , ['model' => $model]);
        $pdf = new Pdf([
        'mode' => Pdf::MODE_UTF8 , // leaner size using standard fonts
        'content' => $content,
        'format' => Pdf::FORMAT_LETTER , 
        'cssFile' => '@webroot/css/nomina.css',
        'options' => [
        'title' => 'Nomina No'.$folio,
        'subject' => ''
        ],
        'methods' => [
        //'SetHeader' => ['Generated By: Krajee Pdf Component||Generated On: ' . date("r")],
        'SetFooter' => ['|Página {PAGENO}|'],
        ]
        ]);
        return $pdf->render();
    }

     protected function findModel($folio)
    {   $model = Nomina::find()->where(['folio' => $folio])->all();
        if (sizeof($model) > 0 ) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //REPORTE NOMINA
    //GRAFICAS
    public function getValores($idproyecto){
    $generales = ProduccionValor::find()->where(['fk_proyecto'=>$idproyecto , 'n1'=>0])->all();
    //OBTENER LA LISTA DE LOS VALORES GENERALES
    return $generales;
    //  d($genList);
    // die();

  }

  private function getTotalHijos($fkproduccion , $idproyecto){
    $itemsn1 = $this->getHijos(1,$fkproduccion, $idproyecto);
    $itemn2 = [];
    $itemn3 = [];
    $itemn4 = [];
    foreach ($itemsn1 as $key => $item) {
      if($this->getHijos(2,$item['fk'], $idproyecto)!=null){
        $itemsn1[$key]['hijos']=$this->getHijos(2,$item['fk'] , $idproyecto) ;
        foreach ($itemsn1[$key]['hijos'] as $key1 => $item1) {
          if($this->getHijos(3,$item1['fk'], $idproyecto)!=null){
            $itemsn1[$key]['hijos'][$key1]['hijos'] =$this->getHijos(3,$item1['fk'], $idproyecto);
          }
        } 
      }
    }        
    return $itemsn1;  
  }

    

  private function getHijos($nivel, $fkproduccion , $idproyecto){
    if($nivel==1)
      $items = ProduccionValor::find()->where([ 'fk_proyecto' => $idproyecto , 'n1'=>$fkproduccion , 'n2'=>0 , 'n3'=>0 ])->all();
    if($nivel==2)
     $items = ProduccionValor::find()->where(['fk_proyecto' => $idproyecto ,  'n2'=>$fkproduccion , 'n3'=>0 ])->all();
    if($nivel==3)
     $items = ProduccionValor::find()->where([ 'fk_proyecto' => $idproyecto , 'n3'=>$fkproduccion  ])->all();
    //OBTENER LA LISTA DE LOS VALORES items
    $res = [];
    if($items!= null){}
    foreach ($items as $item) {
      $it = $item->getAttributes();
      array_push($res,  [ 'fk' => $item->fk_produccion ,  'descripcion'=> $item->fkProduccion->produccion , 'avance' => $it['avance'] , 'nivel'=>$nivel+1] );
    }
    if(empty($res))
      return null;
    return $res;
  }

}
