<?php

namespace app\controllers;

use Yii;
use app\models\ProduccionValor;
use app\search\ProduccionSearch;
use app\search\ProyectoSearch;
use app\models\Produccion;
use app\models\Proyecto;
use app\models\ProyectoEmpleado;
use app\models\Rptnomina;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ProduccionController implements the CRUD actions for ProduccionValor model.
 */
class ProduccionController extends Controller
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
    if(Yii::$app->user->can('vproduccion')){
      $searchModel = new ProyectoSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      $query = Rptnomina::find();
      $dataExport = new ActiveDataProvider(['query' => $query,]);
      
      return $this->render('index', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
          'dataExport' => $dataExport,
      ]);
    } else{
            throw new ForbiddenHttpException;
    }
  }

  /**
  * Displays a single ProduccionValor model.
  * @param integer $iddesarollo_valor
  * @param integer $fk_proyecto
  * @param integer $fk_desarrollo
  * @return mixed
  */
  public function actionView($idproyecto)
  {   
    if(Yii::$app->user->can('vproduccion')){
      // $this->crearNomina($idproyecto);
      $proy = Proyecto::findOne(['idproyecto' => $idproyecto,]);
      $searchModel = new ProduccionSearch();
      $params = Yii::$app->request->queryParams;
      $params["ProduccionSearch"]["fk_proyecto"] = $idproyecto;
      $parametros = $params;
      $dataProvider = $searchModel->search($params);
      // $this->getValores($idproyecto);
      return $this->render('view', [
          'model' => $this->findModel($idproyecto),
          'general' =>  $this->getValores($idproyecto),
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
          'proyecto'=>$proy
      ]);
    } else{
            throw new ForbiddenHttpException;
    }
  }

  /**
  * Creates a new ProduccionValor model.
  * If creation is successful, the browser will be redirected to the 'view' page.
  * @return mixed
  */
  public function actionCreate()
  {
    if(Yii::$app->user->can('produccion')){
      $model = new ProduccionValor();

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return $this->redirect(['view', 'iddesarollo_valor' => $model->iddesarollo_valor, 'fk_proyecto' => $model->fk_proyecto, 'fk_desarrollo' => $model->fk_desarrollo]);
      } else {
          return $this->render('create', [
              'model' => $model,
          ]);
      }
    } else{
            throw new ForbiddenHttpException;
        }  
  }


  public function actionSigfase($idproyecto){
    
    if(Yii::$app->user->can('sigfase')){
      $model = Proyecto::findOne(['idproyecto' => $idproyecto,]);

      if ($model->load(Yii::$app->request->post()) ) {

          if($model->st_iluminacion==0){
            
            $query = "update produccion_valor set avance = 100 , avance_ant = 100 where fk_proyecto =".$idproyecto ." and n1=6  or fk_produccion=6";
           $registros =  Yii::$app->db->createCommand($query)->execute();
            
          }
              $model->fase =2 ;
              $model->save();
              return $this->redirect(['view', 'idproyecto' => $model->idproyecto]);
      } else {
          return $this->render('sig_fase', [
              'model' => $model,
          ]);
      }
    } else{
            throw new ForbiddenHttpException;
        }  
  
}


  public function getValores($idproyecto){
    $generales = ProduccionValor::find()->where(['fk_proyecto'=>$idproyecto , 'n1'=>0])->all();
    //OBTENER LA LISTA DE LOS VALORES GENERALES
    $genList=[];
    foreach ($generales as $item) {
        $it = $item->getAttributes();
        array_push($genList, ['descripcion'=> $item->fkProduccion->produccion , 'avance' => $it['avance'] , 'nivel'=>1 , 'hijos'=> $this->getTotalHijos($item->fk_produccion , $idproyecto)] );
    }
    return $genList;
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

    /**
     * Updates an existing ProduccionValor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $iddesarollo_valor
     * @param integer $fk_proyecto
     * @param integer $fk_desarrollo
     * @return mixed
     */
    // public function actionUpdate($iddesarollo_valor, $fk_proyecto, $fk_desarrollo)
  public function actionUpdate($idproyecto)
  {
    if(Yii::$app->user->can('produccion')){
      $proyecto = Proyecto::findOne(['idproyecto'=>$idproyecto]);
    
      $searchModel = new ProduccionSearch();
      $params = Yii::$app->request->queryParams;
      $params["ProduccionSearch"]["fk_proyecto"] = $idproyecto;
      $params["ProduccionSearch"]["st_hoja"] = 1;

    if(!isset($params["ProduccionSearch"]["n2"]))
        $params["ProduccionSearch"]["n2"] = "";
    if(!isset($params["ProduccionSearch"]["n3"]))  
         $params["ProduccionSearch"]["n3"] = "";
      

    //SI PUEDE PINTURA 
    if( $proyecto->fase  == 0){
         return $this->render('fase_error' , ['error'=>'Error en el sistema por favor Contacte el Administrador']);
     }

    //SI PUEDE PINTURA 
    if(Yii::$app->user->can('ppintura')  &&  $proyecto->fase  == 1){
         return $this->render('fase_error' , ['error'=>'Continua en fase de Analisis']);
    }
    //SI PUEDE DESARROLLO
    if(Yii::$app->user->can('pdesarrollo')  &&  $proyecto->fase  == 1){
        return $this->render('fase_error' , ['error'=>'Continua en fase de Analisis']);
    }
    //SI PUEDE PANALISIS  
    if(Yii::$app->user->can('panalisis')  &&  $proyecto->fase  > 1){
         return $this->render('fase_error' , ['error'=>'Fase de Analisis Terminada']);
    }

    if(Yii::$app->user->can('panalisis')){
     if(!isset($params["ProduccionSearch"]["n1"] )|| $params["ProduccionSearch"]["n1"] == ""){
      $params["ProduccionSearch"]["n1"]=2;
     } 
    }else if(Yii::$app->user->can('ppintura')){
      $params["ProduccionSearch"]["n1"]=5;

    }else if(Yii::$app->user->can('pdesarrollo')){
     if(!isset($params["ProduccionSearch"]["n1"] )|| $params["ProduccionSearch"]["n1"] == ""){
      $params["ProduccionSearch"]["n1"]=4;
     } 
   }

    $dataProvider = $searchModel->search($params);
    $n2 = ArrayHelper::map(Produccion::find()->where(['nivel'=>2 ])->orderBy('nodo')->asArray()->all(), 'idproduccion', 'produccion');
    $n3 = ArrayHelper::map(Produccion::find()->where(['nivel'=>3])->orderBy('nodo')->asArray()->all(), 'idproduccion', 'produccion');
    if(Yii::$app->user->can('panalisis')){
      $n1 = ArrayHelper::map(Produccion::find()->where(['nivel'=>1 , 'nodo'=>[2,3]])->orderBy('nodo')->asArray()->all(), 'idproduccion', 'produccion');
    }else if(Yii::$app->user->can('ppintura')){
      $n1 = ArrayHelper::map(Produccion::find()->where(['nivel'=>1 , 'nodo'=>5])->orderBy('nodo')->asArray()->all(), 'idproduccion', 'produccion');
    }
    else if(Yii::$app->user->can('pdesarrollo')){
      $n1 = ArrayHelper::map(Produccion::find()->where(['nivel'=>1 , 'nodo'=>[4,7,8]])->orderBy('nodo')->asArray()->all(), 'idproduccion', 'produccion');
    }
    else{
      $n1 = ArrayHelper::map(Produccion::find()->where(['nivel'=>1])->orderBy('nodo')->asArray()->all(), 'idproduccion', 'produccion');
    }

    // }else if(){
    //   if(Yii::$app->user->can('cliente')){
        
    // }


    if(!empty($params["ProduccionSearch"]['n1'])){
     
      if($params["ProduccionSearch"]['n1']!=""){
        $n2 =   ArrayHelper::map(Produccion::find()->where(['nivel'=>2 , 'puente'=>$params["ProduccionSearch"]['n1'] ])->orderBy('nodo')->asArray()->all(), 'idproduccion', 'produccion');
        $n3 = ArrayHelper::map(Produccion::find()->where(['nivel'=>3])->orderBy('nodo')->asArray()->all(), 'idproduccion', 'produccion');
        if($params["ProduccionSearch"]['n2']!=""){
          $n3=ArrayHelper::map(Produccion::find()->where(['nivel'=>3, 'puente'=>$params["ProduccionSearch"]['n2']])->orderBy('nodo')->asArray()->all(), 'idproduccion', 'produccion');
        }
      }
    }
    
    if (Yii::$app->request->post('hasEditable')) {
      // instantiate your book model for saving
      $objValor =  Json::decode(Yii::$app->request->post('editableKey'));
      $model = ProduccionValor::findOne($objValor['idproduccion_valor']);
      
      // store a default json response as desired by editable
      $out = Json::encode(['output'=>$model, 'message'=>'']);
      $posted = current($_POST['ProduccionValor']);
      $post = ['ProduccionValor' => $posted];

      $proy = Proyecto::findOne(['idproyecto' => $idproyecto,]);
      if($proy->st_terminado == 1){
        $proy->st_terminado =2;
        $proy->save();
      }


      if ($model->load($post)) {
        // $model->scenario = 'update';
        $model->avance_ant = $model->avance;
        $output = $model->validate();
        
        $model->save();
        $output = '';

        if (isset($posted['avance'])) {
          $output = Yii::$app->formatter->asDecimal( $model->avance, 2);
          $this->updatePorcentaje($idproyecto, $model->n3,$model->n2,$model->n1);               
        }
        $out = Json::encode(['output'=>$output, 'message'=>'']);
      }
      // return ajax json encoded response and exit
      echo $out;
      return;
    }
      return $this->render('update', [
        'proyecto'=> $proyecto,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
         'n3'=>$n3,
         'n2'=>$n2,
         'n1'=>$n1,]);
    } else{
            throw new ForbiddenHttpException;
        }
  }

   
  private function updatePorcentaje($idproyecto, $n3,$n2 , $n1){


    if($n3>0){
      $o3 = ProduccionValor::findOne(['fk_produccion' => $n3 ,  'fk_proyecto' => $idproyecto]);
      $avgn3 = ProduccionValor::find()->where(['n3'=>$n3  , 'fk_proyecto' => $idproyecto])->average('avance');
      $o3->avance = $avgn3;
      $o3->save();
    }
    if($n2>0){
      $o2 = ProduccionValor::findOne(['fk_produccion' => $n2 , 'fk_proyecto' => $idproyecto]);
      $avgn2 = ProduccionValor::find()->where(['n2'=>$n2 ,'n3'=>0 , 'fk_proyecto' => $idproyecto])->average('avance');
      $o2->avance = $avgn2;
      $o2->save();
    }

    $o1 = ProduccionValor::findOne(['fk_produccion' => $n1, 'fk_proyecto' => $idproyecto]);
    $avgn1 = ProduccionValor::find()->where(['n1'=>$n1  , 'n2'=>0 ,'n3'=>0  , 'fk_proyecto' => $idproyecto])->average('avance');
    $o1->avance = $avgn1;
    $o1->save();
    
  }

  public function actionTest(){
   
    $this->recalcularPromedio();
  }
  /**
  * Finds the ProduccionValor model based on its primary key value.
  * If the model is not found, a 404 HTTP exception will be thrown.
  * @param integer $iddesarollo_valor
  * @param integer $fk_proyecto
  * @param integer $fk_desarrollo
  * @return ProduccionValor the loaded model
  * @throws NotFoundHttpException if the model cannot be found
  */
  protected function findModel($fk_proyecto)
  {
    if (($model = ProduccionValor::findOne(['fk_proyecto' => $fk_proyecto])) !== null) {
        return $model;
    } else {
        throw new NotFoundHttpException('The requested page does not exist.');
    }
  }

  private function crearNomina($idproyecto){
      //GUARDAMOS EL DESARROLLO EN CEROS
        //$proval = ProduccionValor::find()->where([ "fk_proyecto" => $idproyecto])->all();
        if(Yii::$app->user->can('nomina')){
        $avgPrevius = ProduccionValor::find()->where(['fk_proyecto'=>$idproyecto])->andWhere(['<' , 'fk_produccion' , '8' ])->andWhere(['>' , 'fk_produccion' , '3' ])->average('avance_ant');
        $avgActual = ProduccionValor::find()->where(['fk_proyecto'=>$idproyecto])->andWhere(['<' , 'fk_produccion' , '8' ])->andWhere(['>' , 'fk_produccion' , '3' ])->average('avance');
        $avgDif = number_format($avgActual - $avgPrevius,2,".","");

        $proy = Proyecto::findOne(['idproyecto'=>$idproyecto]);
        $tganancia = $proy->precio * ($proy->moporcentaje / 100);
        $total = number_format($tganancia * ($avgDif/100),2,".","");

        $empleados = ProyectoEmpleado::find()->where(['fk_proyecto'=>$idproyecto])->all();
        foreach ($empleados as $emp) {
          $t = $emp->fk_empleado." - ".$emp->porcentaje." - ".(($emp->porcentaje/100)*$total);
        }

        // die();

        // $transaction = \Yii::$app->db->beginTransaction();
        // try {
        // foreach ($proval as $item) {
           
        // }
        //  $transaction->commit();
        // } catch(Exception $e) {
        //    $transaction->rollBack();
            
        // }
                   
       //  $user1 = Yii::$app->user->identity->username;
        
       //  //CREAR DESARROLLO
       //  $query = "insert into desarrollo_valor ( avance , avance_ant , fk_proyecto , fk_desarrollo , created_at , updated_at , created_by , updated_by) ";
       //  $query .="select 0 , 0 , $id , iddesarrollo , NOW() , NOW() ,'$user1' , '$user1' from desarrollo where st_hoja = 1";
       // $registros =  Yii::$app->db->createCommand($query)->execute();
       // return $this->redirect(['index']);
      } else{
            throw new ForbiddenHttpException;
      }
  }

  private function recalcularPromedio()
  {
    $promedios  = ProduccionValor::find()->where(['st_hoja'=>1 ])->andWhere(['>', 'avance', '0'])->all();
    foreach ($promedios as $pro) {
      $this->updatePorcentaje($pro->fk_proyecto, $pro->n3,$pro->n2 , $pro->n1);
    }

    
  }
}
