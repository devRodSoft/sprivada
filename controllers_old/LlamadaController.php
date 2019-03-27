<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Llamada;
use app\models\Cotizacion;
use app\search\LlamadaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\search\CotizacionSearch;
use kartik\mpdf\Pdf;
use yii\helpers\Url;

/**
 * LlamadaController implements the CRUD actions for Llamada model.
 */
class LlamadaController extends Controller
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
     * Lists all Llamada models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('cotizacion')){
            $searchModel = new LlamadaSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            
            $query = LLamada::find();
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
     * Displays a single Llamada model.
     * @param integer $idllamada
     * @param integer $fk_lstatus
     * @param integer $fk_cotizacion
     * @return mixed
     */
    public function actionView($idllamada)
    {
        if(Yii::$app->user->can('cotizacion')){
            $model =  Llamada::findOne(['idllamada' => $idllamada]);
            $searchModel = new CotizacionSearch(['fk_llamada' => $model->idllamada,]);
            $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
            
            return $this->render('view', [
                'model' =>  $model ,'dataProvider'=>$dataProvider, 'searchModel' => $searchModel,
            ]);
        } else{
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new Llamada model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('cotizacion')){
            $model = new Llamada();
            if ($model->load(Yii::$app->request->post())) {
                $model->fk_lstatus =1;
               
                $model->save();
                return $this->redirect(['view', 'idllamada' => $model->idllamada, 'fk_lstatus' => $model->fk_lstatus]);
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
     * Updates an existing Llamada model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idllamada
     * @param integer $fk_lstatus
     * @param integer $fk_cotizacion
     * @return mixed
     */
    public function actionUpdate($idllamada)
    {
        if(Yii::$app->user->can('cotizacion')){
            $model =  Llamada::findOne(['idllamada' => $idllamada]);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idllamada' => $model->idllamada, 'fk_lstatus' => $model->fk_lstatus]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else{
            throw new ForbiddenHttpException;
        }

    }

     public function actionPrint($idcotizacion,$prospecto){
       //  Yii::$app->response->format = 'pdf';
        if(Yii::$app->user->can('cotizacion')){
            $modelCotizacion = $this->findCotizacion($idcotizacion);
            $extras = [ 'imprimir' => true , 'prospecto' =>$prospecto];
            $modelEscalas = $modelCotizacion->cotescalas;
            $modelConfig = $modelCotizacion->fkCotconfig;
            $this->layout = 'printl';
            return $this->render('print' , ['cotizaciones'=>$modelCotizacion ,  'escalas'=>$modelEscalas, 'configuraciones' => $modelConfig ,'extras'=>$extras]);
        } else{
            throw new ForbiddenHttpException;
        }
    }

     public function actionSendcot(){
       //  Yii::$app->response->format = 'pdf';
        if(Yii::$app->user->can('cotizacion')){
            $request = Yii::$app->request;
            $idllamada = $request->post('idllamada');  
            $fk_lstatus = $request->post('fk_lstatus');  
            $model = $model = Llamada::findOne(['idllamada' => $idllamada]);
            $model->fk_lstatus = $fk_lstatus+1;
            $cot =null;

            if ( $model->save()) {
                if($fk_lstatus==3){
                    $cot = Cotizacion::findOne(['fk_llamada' => $model->idllamada  , 'fk_cotestatus' => 1]  );
                    $cot->fk_cotestatus =2;
                    $cot->save();
                }
                return $this->redirect(['view', 'idllamada' => $model->idllamada, 'fk_lstatus' => $model->fk_lstatus]);
            } else {
                return $this->render('update', [
                    'model' => $model,]);
            }
        } else{
            throw new ForbiddenHttpException;
        }
    }

    public function actionRechazada($idcotizacion){
        if(Yii::$app->user->can('cotizacion')){
            $model = $this->findModel($idcotizacion);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $this->redirect(['index']);
            } else {
                return $this->renderAjax('update', [
                    'model' => $model,]);
            }
        } else{
            throw new ForbiddenHttpException;
        }
    }

    public function actionPdf($idcotizacion,$prospecto){
        if(Yii::$app->user->can('cotizacion')){
            $modelCotizacion = $this->findCotizacion($idcotizacion);
            $extras = [ 'imprimir' => null,'prospecto' =>$prospecto];
            $modelEscalas = $modelCotizacion->cotescalas;
            $modelConfig = $modelCotizacion->fkCotconfig;
            $this->layout = 'printl';
            $content=  $this->render('print' , ['cotizaciones'=>$modelCotizacion ,  'escalas'=>$modelEscalas, 'configuraciones' => $modelConfig,'extras'=>$extras]);
            $folio = $modelCotizacion->idcotizacion;
            $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8 , // leaner size using standard fonts
            'content' => $content,
            'format' => Pdf::FORMAT_LETTER , 
            'cssFile' => '@webroot/css/over.css',
            'options' => [
            'title' => 'Cotizacion No'.$folio,
            'subject' => 'Cotizacion No'.$folio
            ],
            'methods' => [
            //'SetHeader' => ['Generated By: Krajee Pdf Component||Generated On: ' . date("r")],
            'SetFooter' => ['|Página {PAGENO}|'],
            ]
            ]);
            return $pdf->render();
        } else{
            throw new ForbiddenHttpException;
        }
    }

    // public function actionPdf1(){
    //     $content = "<img src='".Url::to('@web/assets/img/menu/logomyp.jpg', true)."' width='173' class='frigthie' >";
    //     $folio = 23;
    //     $pdf = new Pdf([
    //         'mode' => Pdf::MODE_UTF8 , // leaner size using standard fonts
    //         'content' => $content,
    //         'format' => Pdf::FORMAT_LETTER , 
    //         'cssFile' => '@webroot/css/over.css',
    //         'options' => [
    //         'title' => 'Cotizacion No'.$folio,
    //         'subject' => 'Cotizacion No'.$folio
    //         ],
    //         'methods' => [
    //         //'SetHeader' => ['Generated By: Krajee Pdf Component||Generated On: ' . date("r")],
    //         'SetFooter' => ['|Página {PAGENO}|'],
    //         ]
    //         ]);
    //         return $pdf->render();

    // }

    /**
     * Deletes an existing Llamada model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idllamada
     * @param integer $fk_lstatus
     * @param integer $fk_cotizacion
     * @return mixed
     */
    public function actionDelete($idllamada, $fk_lstatus)
    {
        $this->findModel($idllamada, $fk_lstatus)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Llamada model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idllamada
     * @param integer $fk_lstatus
     * @param integer $fk_cotizacion
     * @return Llamada the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idllamada, $fk_lstatus)
    {
        if (($model = Llamada::findOne(['idllamada' => $idllamada, 'fk_lstatus' => $fk_lstatus])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findCotizacion($idcotizacion)
    {
        if (($model = Cotizacion::findOne(['idcotizacion' => $idcotizacion])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
