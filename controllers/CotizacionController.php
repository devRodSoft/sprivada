<?php

namespace app\controllers;

use Yii;
use app\models\Cotizacion;
use app\models\Cotescala;
use app\search\CotizacionSearch;
use app\search\CotescalaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Llamada;
use app\models\Multiple;


/**
 * CotizacionController implements the CRUD actions for Cotizacion model.
 */
class CotizacionController extends Controller
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
     * Lists all Cotizacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('cotizacion')){
            $searchModel = new CotizacionSearch();        
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else{
            throw new ForbiddenHttpException;
        }
        
    }

    /**
     * Displays a single Cotizacion model.
     * @param integer $idcotizacion
     * @param integer $fk_cotestatus
     * @return mixed
     */
    public function actionView($idcotizacion, $fk_cotestatus)
    {

        if(Yii::$app->user->can('cotizacion')){
            $searchModel = new CotescalaSearch(['fk_cotizacion' => $idcotizacion,]);
            $escalaProvider = $searchModel->search(Yii::$app->request->getQueryParams());
            $this->layout = 'printl';
            return $this->render('view', [
                'model' => $this->findModel($idcotizacion, $fk_cotestatus),
                'escalaProvider'=>$escalaProvider, 'searchModel' => $searchModel,

            ]);
        } else{
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new Cotizacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($fk_llamada)
    {
        if(Yii::$app->user->can('cotizacion')){
            $model = new Cotizacion();
            $escalas = [new Cotescala];

            if ($model->load(Yii::$app->request->post()) ) {
                $escalas = Multiple::createMultiple(Cotescala::classname());
                //CARGAR MULTIPLES ESCALAS
                Multiple::loadMultiple($escalas, Yii::$app->request->post());

                 // ajax validation
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ArrayHelper::merge(
                        ActiveForm::validateMultiple($escalas),
                        ActiveForm::validate($model)
                    );
                }
                $model->fecha = date("Y-m-d");
                $model->fk_cotestatus = 1;
                if(!$model->st_iluminacion)
                    $model->iluminacion="";

                if($model->st_sitio == 0){
                    $model->sitio = $this->getSitio(); 
                }

                $valid = $model->validate();
                $valid = Multiple::validateMultiple($escalas) && $valid;

                if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $model->save(false)) {
                            $cot = $cot = Llamada::findOne(['idllamada' => $model->fk_llamada]);
                            // $cot->fk_cotizacion = $model->idcotizacion;
                            $cot->fk_lstatus = 2;
                            $cot->save(false);
                            
                            foreach ($escalas as $esc) {
                                $esc->fk_cotizacion = $model->idcotizacion;
                                if (! ($flag = $esc->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                             return $this->redirect(['/llamada/view', 'idllamada' => $fk_llamada]);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }
                
            } else {
                $model->sitio = $this->getSitio();
                $model->fk_llamada = $fk_llamada;
                return $this->render('create', [
                    'model' => $model,
                    'escalas' => (empty($escalas)) ? [new Cotescala] : $escalas,]);
            }
        } else{
            throw new ForbiddenHttpException;
        }
    }

    private function getSitio(){
        $texto = "<p>Base compuesta de bastidor de pino y/o MDF y cubierta o superficie de MDF de <strong>6mm</strong> de espesor.</p>";
       $texto .="<p>El sitio se representar&aacute; de acuerdo a los planos proporcionados por el arquitecto. Todas las piezas del sitio se fabricar&aacute;n ";
       $texto .="en una combinaci&oacute;n de l&aacute;minas de acr&iacute;lico y MDF de diferentes espesores seg&uacute;n sea requerido. Las piezas se cortar&aacute;n en";
       $texto .="l&aacute;ser para su ensamble y terminado.</p> <p>Niveles generales del terreno, niveles de desplante de edificaciones y de calles seg&uacute;n planos de nivel.</p>";
       $texto .= "<p>Se grabar&aacute;n todas las l&iacute;neas de dise&ntilde;o y textura de pisos sobre la superficie de los materiales.</p>";
       $texto .= "<p>Aplicaci&oacute;n de color en todas las superficies del sitio basado en especificaciones proporcionadas por el cliente (color y textura de los materiales)</p>"; 
       return  $texto;
    }

    /**
     * Updates an existing Cotizacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idcotizacion
     * @param integer $fk_cotestatus
     * @return mixed
     */
    public function actionDuplicate($idcotizacion, $fk_cotestatus,$fk_llamada)
    {
        if(Yii::$app->user->can('cotizacion')){
            $model = $this->findModel($idcotizacion, $fk_cotestatus);
            $model->fk_llamada = $fk_llamada;
           
            $escalas = $model->cotescalas;
            $model->isNewRecord = true;

             if ($model->load(Yii::$app->request->post()) ) {
                
                $model->idcotizacion = null;
                $escalas = Multiple::createMultiple(Cotescala::classname());
                //CARGAR MULTIPLES ESCALAS
                Multiple::loadMultiple($escalas, Yii::$app->request->post());
                 // ajax validation
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ArrayHelper::merge(
                        ActiveForm::validateMultiple($escalas),
                        ActiveForm::validate($model)
                    );
                }
                $model->fecha = date("Y-m-d");
                $model->fk_cotestatus = 1;
                $model->observacion = '';
                //VALIDACION
                $valid = $model->validate();
                $valid = Multiple::validateMultiple($escalas) && $valid;
               
                $llama = Llamada::findOne(['idllamada' => $model->fk_llamada]);
                $llama->fk_lstatus = 2;
                $llama->save(false);

                if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $model->save(false)) {
                            foreach ($escalas as $esc) {
                                $esc->fk_cotizacion = $model->idcotizacion;
                                if (! ($flag = $esc->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                             return $this->redirect(['/llamada/view', 'idllamada' => $fk_llamada]);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }
                
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'escalas' => (empty($escalas)) ? [new Cotescala] : $escalas,
                ]);
            }
        } else{
            throw new ForbiddenHttpException;
        }
    }

    public function actionRechazada($idcotizacion, $fk_llamada){
        if(Yii::$app->user->can('cotizacion')){
            //modelo cotizacion
            $model = Cotizacion::findOne(['idcotizacion' => $idcotizacion]);
            //modelo llamada
            $llaa = Llamada::findOne(['idllamada'=> $fk_llamada]);
            if ($model->load(Yii::$app->request->post()) ) {
                //update llamada estatus resuelto
                $llaa->fk_lstatus = 5;
                $llaa->save();
                //update cotizacion estatus  rechazada
                $model->fk_cotestatus = 4;
                $model->save();
                $this->redirect(['/llamada/view' , 'idllamada'=>$fk_llamada] );
            } else {
                return $this->renderAjax('rechazada', [
                    'model' => $model,
                ]);
            }
        } else{
            throw new ForbiddenHttpException;
        }
    }

    public function actionVencida($idcotizacion, $fk_llamada){
        if(Yii::$app->user->can('cotizacion')){
            $this->layout="printl";
            $model = Cotizacion::findOne(['idcotizacion' => $idcotizacion]);
            if ($model->load(Yii::$app->request->post()) ) {
                $model->save();
                $this->redirect(['/llamada/view' , 'idllamada'=>$fk_llamada] );
            } else {
                return $this->render('vencida', [
                    'model' => $model,
                ]);
            }
        } else{
            throw new ForbiddenHttpException;
        }
    }

    public function actionStatus($idcotizacion, $fk_llamada){
        if(Yii::$app->user->can('cotizacion')){
            $this->layout="printl";
            $model = Cotizacion::findOne(['idcotizacion' => $idcotizacion]);
            if ($model->load(Yii::$app->request->post()) ) {
                $model->save();
                $this->redirect(['/llamada/view' , 'idllamada'=>$idllamada] );
            } else {
                return $this->renderAjax('status', [
                    'model' => $model,
                ]);
            }
        } else{
            throw new ForbiddenHttpException;
        }
    }





    /**
     * Deletes an existing Cotizacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idcotizacion
     * @param integer $fk_cotestatus
     * @return mixed
     */
    public function actionDelete($idcotizacion, $fk_cotestatus , $fk_llamada)
    {
        $this->findModel($idcotizacion, $fk_cotestatus)->delete();
        return $this->redirect(["llamada/view?idllamada=$fk_llamada"]);
    }

    /**
     * Finds the Cotizacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idcotizacion
     * @param integer $fk_cotestatus
     * @return Cotizacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idcotizacion, $fk_cotestatus)
    {
        if (($model = Cotizacion::findOne(['idcotizacion' => $idcotizacion, 'fk_cotestatus' => $fk_cotestatus])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findLlamada($idcotizacion){
         if (($model = Llamada::findOne(['fk_cotizacion' => $idcotizacion])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
