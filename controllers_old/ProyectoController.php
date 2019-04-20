<?php

namespace app\controllers;

use Yii;
use app\models\Proyecto;
use app\models\Pcosto;
use app\models\ProyectoCosto;
use app\models\ProyectoEmpleado;
use app\models\Cotizacion;
use app\models\Produccion;
use app\models\ProduccionValor;
use app\models\Llamada;
use app\models\Cotconfig;
use app\controllers\ProduccionController;
use app\search\ProyectoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;
use yii\data\ActiveDataProvider;
/**
 * ProyectoController implements the CRUD actions for Proyecto model.
 */
class ProyectoController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all Proyecto models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new ProyectoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = Proyecto::find();
        $dataExport = new ActiveDataProvider(['query' => $query,]);

        $query1 = Pcosto::find();
        $dataExportCosto = new ActiveDataProvider(['query' => $query1,]);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataExport' => $dataExport,
            'dataExportCosto' => $dataExportCosto,
        ]);
    }

    /**
     * Displays a single Proyecto model.
     * @param integer $idproyecto
     * @param integer $fk_cliente
     * @param integer $fk_cnivel_complejidad
     * @param integer $fk_cestatus
     * @param integer $fk_ctipo_material
     * @param integer $fk_ctipo_color
     * @param integer $fk_ctipo_iluminacion
     * @param integer $fk_ccalibre_acrilico
     * @return mixed
     */
    public function actionView($idproyecto)
    {
        $pcostos = ProyectoCosto::find()->select('idproyecto_costo')->where(['fk_proyecto'=> $idproyecto])->all();
        $ids = [];
        if(!empty($pcostos))
          foreach($pcostos as $row)
            array_push($ids,$row->idproyecto_costo);
        
        $query = Pcosto::find()->where([ 'in','fk_proyecto_costo', $ids]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $queryEmp = ProyectoEmpleado::find()->where(['fk_proyecto'=> $idproyecto]);
        $dataProviderEmp = new ActiveDataProvider([
            'query' => $queryEmp,
        ]);
       
        return $this->render('view', [
            'model' => $this->findModel($idproyecto),  
            'general' =>  $this->getValores($idproyecto),
            'dataProvider' => $dataProvider,
            'dataProviderEmp' => $dataProviderEmp,   ]);
    }

    /**
     * Creates a new Proyecto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($fk_cotizacion = 0 , $idllamada = 0)
    {
        if(Yii::$app->user->can('proyecto')){
            //SI NO LLEVA COTIZACION
            if($fk_cotizacion==0)
                $this->layout = 'printl';
            $model = new Proyecto();

            if ($model->load(Yii::$app->request->post()) ) {
                //GUARDAMOS EL PROYECTO
                $model->costo =0;
                $model->activo = 0;
                $model->st_terminado = 1;
                $model->fk_cestatus=1;
                $model->fk_cotizacion=$fk_cotizacion;
                $model->save();

                //ASIGNAMOS COTIZACION AL PROYECTO
                if($fk_cotizacion!=0){
                    $cot = Cotizacion::findOne(['idcotizacion' => $fk_cotizacion]);
                    $cot->fk_cotestatus = 3;
                    $cot->save();
                    $lla = Llamada::findOne(['idllamada'=>$idllamada]);
                    $lla->fk_lstatus= 5;
                    $lla->save();
                }

                $this->crearProduccion($model->idproyecto);


                // $user1 = Yii::$app->user->identity->username;
                // $query = "insert into desarrollo_valor ( avance , avance_ant , fk_proyecto , fk_desarrollo , created_at , updated_at , created_by , updated_by) ";
                // $query .="select 0 , 0 , $model->idproyecto , iddesarrollo , NOW() , NOW() ,'$user1' , '$user1' from desarrollo where st_hoja = 1";
                // $registros =  Yii::$app->db->createCommand($query)->execute();

                 return $this->redirect(['view', 'idproyecto' => $model->idproyecto, 'fk_cliente' => $model->fk_cliente, 'fk_cnivel_complejidad' => $model->fk_cnivel_complejidad, 'fk_cestatus' => $model->fk_cestatus, 'fk_ctipo_material' => $model->fk_ctipo_material, 'fk_ctipo_color' => $model->fk_ctipo_color, 'fk_ctipo_iluminacion' => $model->fk_ctipo_iluminacion, 'fk_ccalibre_acrilico' => $model->fk_ccalibre_acrilico]);
            } else {
                if($fk_cotizacion!=0){

                    $model->fk_cotizacion = $fk_cotizacion;
                    $model->idllamada = $idllamada;
                }
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else{
            throw new ForbiddenHttpException;
        }
    }


    public function actionCotizacion($idcotizacion)
    {
        if(Yii::$app->user->can('proyecto')){
            $model = new Proyecto();
            if ($model->load(Yii::$app->request->post()) ) {
                $model->costo =0;
                $model->st_terminado = 0;
                $model->fk_cestatus=1;
                $model->save();
                $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else{
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing Proyecto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idproyecto
     * @param integer $fk_cliente
     * @param integer $fk_cnivel_complejidad
     * @param integer $fk_cestatus
     * @param integer $fk_ctipo_material
     * @param integer $fk_ctipo_color
     * @param integer $fk_ctipo_iluminacion
     * @param integer $fk_ccalibre_acrilico
     * @return mixed
     */
    public function actionUpdate($idproyecto, $fk_cliente, $fk_cnivel_complejidad, $fk_cestatus, $fk_ctipo_material, $fk_ctipo_color, $fk_ctipo_iluminacion, $fk_ccalibre_acrilico)
    {
        if(Yii::$app->user->can('proyecto')){
            $this->layout = 'printl';
            $model = $this->findModel($idproyecto);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $this->redirect(['index']);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else{
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing Proyecto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idproyecto
     * @param integer $fk_cliente
     * @param integer $fk_cnivel_complejidad
     * @param integer $fk_cestatus
     * @param integer $fk_ctipo_material
     * @param integer $fk_ctipo_color
     * @param integer $fk_ctipo_iluminacion
     * @param integer $fk_ccalibre_acrilico
     * @return mixed
     */
    public function actionDelete($idproyecto)
    {
        $this->findModel($idproyecto)->delete();
        return $this->redirect(['index']);
        
    }



    public function actionProduccion($id)
    {
        $this->crearProduccion($id);
    }


    public function crearProduccion($id)
    {
        //GUARDAMOS EL DESARROLLO EN CEROS
        $fori = Produccion::find()->where(["!=", "puente" , "-1"])->all();
        $transaction = \Yii::$app->db->beginTransaction();
        try {
        foreach ($fori as $item) {
            $n1=0; $n2=0; $n3=0;
            if($item->nivel>1)
                $n1 = $this->buscarNivel(1,$item->idproduccion);
            if($item->nivel>2)
            $n2 = $this->buscarNivel(2,$item->idproduccion);
           
            if($item->nivel>3)
            $n3 = $this->buscarNivel(3,$item->idproduccion);
            
             
            $Desval = new ProduccionValor();
            $Desval->avance = 0;
            $Desval->avance_ant = 0;
            $Desval->fk_proyecto = $id;
            $Desval->fk_produccion = $item->idproduccion;
            $Desval->n1 = $n1;
            $Desval->n2 = $n2;
            $Desval->n3 = $n3;
            $Desval->st_hoja = (int)$item->st_hoja;
            $Desval->validate();
            $Desval->save();
        }
         $transaction->commit();
        } catch(Exception $e) {
           $transaction->rollBack();
           echo "error";
            
        }
       return $this->redirect(['index']);
    }

     private function buscarNivel($nivel , $id){
        $ide = $id;
        while(true){
            $desa = Produccion::findOne(['nodo'=> $id]);  
            if($desa==null){
                d($desa);
                d($ide);
                die();
            }
            if($nivel == $desa->nivel ){
                return $desa->nodo;
            }
            $id = $desa->puente;
        }

    }

    public function actionWallet($idproyecto, $fk_cliente, $fk_cnivel_complejidad, $fk_cestatus, $fk_ctipo_material, $fk_ctipo_color, $fk_ctipo_iluminacion, $fk_ccalibre_acrilico){

            $query = ProyectoCosto::find()->where(['fk_proyecto'=> $idproyecto]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('wallet', [
            'dataProvider' => $dataProvider,
        ]);


    }
   

    /**
     * Finds the Proyecto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idproyecto
     * @param integer $fk_cliente
     * @param integer $fk_cnivel_complejidad
     * @param integer $fk_cestatus
     * @param integer $fk_ctipo_material
     * @param integer $fk_ctipo_color
     * @param integer $fk_ctipo_iluminacion
     * @param integer $fk_ccalibre_acrilico
     * @return Proyecto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idproyecto)
    {
        if (($model = Proyecto::findOne(['idproyecto' => $idproyecto,])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //GRAFICAS
    public function getValores($idproyecto){
    $generales = ProduccionValor::find()->where(['fk_proyecto'=>$idproyecto , 'n1'=>0])->all();
    //OBTENER LA LISTA DE LOS VALORES GENERALES
    $genList=[];
    foreach ($generales as $item) {
        $it = $item->getAttributes();
        array_push($genList, ['descripcion'=> $item->fkProduccion->produccion , 'avance' => $it['avance'] , 'nivel'=>1 , 'hijos'=> $this->getTotalHijos($item->fk_produccion , $idproyecto)] );
    }
    return $genList;
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

  public function actionFinalizar($id){
        $query = "update produccion_valor set avance = 100 , avance_ant = 100 where fk_proyecto =".$id;
       //  $query .="select 0 , 0 , $id , iddesarrollo , NOW() , NOW() ,'$user1' , '$user1' from desarrollo where st_hoja = 1";
       $registros =  Yii::$app->db->createCommand($query)->execute();
       if($registros>0){
        $model = $this->findModel($id);
        $model->st_terminado = 3;
        $model->save();
        $this->redirect(['view','idproyecto'=> $id]);
    }else{
        $this->redirect(['index']);
    }
  }

}
