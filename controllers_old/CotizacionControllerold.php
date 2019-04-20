<?php

namespace app\controllers;

use Yii;
use app\models\Cotizacion;
use app\models\Cotescala;
use app\models\CotescalaSearch;
use app\models\CotizacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
        $searchModel = new CotizacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cotizacion model.
     * @param integer $idcotizacion
     * @param integer $fk_proyecto
     * @return mixed
     */
    public function actionView($idcotizacion, $fk_proyecto)
    {
         $searchModel = new CotescalaSearch(['fk_cotizacion' => $idcotizacion,]);
        $escalaProvider = $searchModel->search(Yii::$app->request->getQueryParams());
 
        return $this->renderAjax('view', [
            'model' => $this->findModel($idcotizacion, $fk_proyecto),
            'escalaProvider'=>$escalaProvider, 'searchModel' => $searchModel,

        ]);
    }

    /**
     * Creates a new Cotizacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {   
        $request = Yii::$app->request;
        $proyecto = $request->get('proyecto');  
        $idproyecto = $request->get('idproyecto');  

        $model = new Cotizacion;
        $escalas = [new Cotescala];

       if ($model->load(Yii::$app->request->post()) ) {
             $escalas = Multiple::createMultiple(Cotescala::classname());
            Multiple::loadMultiple($escalas, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($escalas),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
           
            $valid = Multiple::validateMultiple($escalas) && $valid;
             $model->fecha = date("Y-m-d");
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
                        return $this->redirect(['view', 'idcotizacion' => $model->idcotizacion, 'fk_proyecto' => $model->fk_proyecto] );
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }



       
        } else {
            $model->proyecto = $proyecto;
            $model->fk_proyecto = $idproyecto;
            return $this->render('create', [
                'model' => $model,
                'escalas' => (empty($escalas)) ? [new Cotescala] : $escalas,
            ]);
        }


       
    }

        // $model = new Cotizacion();
        // $escala = new Cotescala();
        
        // if ($model->load(Yii::$app->request->post()) && $model->save();) {
        //     return $this->redirect(['view', 'idcotizacion' => $model->idcotizacion, 'fk_proyecto' => $model->fk_proyecto]);
        // } else {
        //     $request = Yii::$app->request;
        //     $model->fk_proyecto = $request->get('idproyecto');  
        //     $model->proyecto = $request->get('proyecto');  

        //     $model->fecha = date("Y-m-d");
        //     return $this->render('create', [
        //         'model' => $model,
        //         'escala' => (empty($escala)? [new cotescala()] : $cotescala)
        //     ]);
        // }
    

    /**
     * Updates an existing Cotizacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idcotizacion
     * @param integer $fk_proyecto
     * @return mixed
     */
    public function actionUpdate($idcotizacion, $fk_proyecto)
    {
        $model = $this->findModel($idcotizacion, $fk_proyecto);

        if ($model->load(Yii::$app->request->post()) ) {
            

            $model->save();
            return $this->redirect(['view', 'idcotizacion' => $model->idcotizacion, 'fk_proyecto' => $model->fk_proyecto]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Cotizacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idcotizacion
     * @param integer $fk_proyecto
     * @return mixed
     */
    public function actionDelete($idcotizacion, $fk_proyecto)
    {
        $this->findModel($idcotizacion, $fk_proyecto)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cotizacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idcotizacion
     * @param integer $fk_proyecto
     * @return Cotizacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idcotizacion, $fk_proyecto)
    {
        if (($model = Cotizacion::findOne(['idcotizacion' => $idcotizacion, 'fk_proyecto' => $fk_proyecto])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
