<?php

namespace app\controllers;

use Yii;
use app\models\CuentaPagar;
use app\search\CuentaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
/**
 * CuentaController implements the CRUD actions for CuentaPagar model.
 */
class CuentaController extends Controller
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
     * Lists all CuentaPagar models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('cuenta')){
            $searchModel = new CuentaSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $query = CuentaPagar::find();
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
     * Displays a single CuentaPagar model.
     * @param integer $idcuenta_pagar
     * @param integer $fk_metodo_pago
     * @param integer $fk_proveedor
     * @return mixed
     */
    public function actionView($idcuenta_pagar, $fk_metodo_pago)
    {
        if(Yii::$app->user->can('cuenta')){
            return $this->render('view', [
                'model' => $this->findModel($idcuenta_pagar, $fk_metodo_pago),
            ]);
        } else{
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new CuentaPagar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('cuenta')){
            $model = new CuentaPagar();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idcuenta_pagar' => $model->idcuenta_pagar, 'fk_metodo_pago' => $model->fk_metodo_pago]);
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
     * Updates an existing CuentaPagar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idcuenta_pagar
     * @param integer $fk_metodo_pago
     * @param integer $fk_proveedor
     * @return mixed
     */
    public function actionUpdate($idcuenta_pagar, $fk_metodo_pago)
    {
        if(Yii::$app->user->can('cuenta')){
            $model = $this->findModel($idcuenta_pagar, $fk_metodo_pago);

            if ($model->load(Yii::$app->request->post()) ) {
                if($model->deuda == $model->pagado){
                    $model->st_pagado = 2;
                }else if($model->pagado > 0){
                    $model->st_pagado = 3;
                }

                $model->save();
                return $this->redirect(['index']);
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
     * Deletes an existing CuentaPagar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idcuenta_pagar
     * @param integer $fk_metodo_pago
     * @param integer $fk_proveedor
     * @return mixed
     */
    public function actionDelete($idcuenta_pagar, $fk_metodo_pago)
    {
        if(Yii::$app->user->can('cuenta')){
            $this->findModel($idcuenta_pagar, $fk_metodo_pago)->delete();
            return $this->redirect(['index']);
        } else{
            throw new ForbiddenHttpException;
        }
    }


    public function actionAclaracion($idcuenta_pagar, $fk_metodo_pago)
    {
        if(Yii::$app->user->can('cuenta')){
            $model =  $this->findModel($idcuenta_pagar, $fk_metodo_pago);

            if ($model->load(Yii::$app->request->post()) ) {
                $model->st_pagado = 4;
                $model->save();
            return $this->redirect(['view', 'idcuenta_pagar' => $model->idcuenta_pagar, 'fk_metodo_pago' => $model->fk_metodo_pago]);
            } else {
            return $this->renderAjax('aclaracion', ['model' => $model,]);
            }
        } else{
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Finds the CuentaPagar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idcuenta_pagar
     * @param integer $fk_metodo_pago
     * @param integer $fk_proveedor
     * @return CuentaPagar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idcuenta_pagar, $fk_metodo_pago)
    {
        if (($model = CuentaPagar::findOne(['idcuenta_pagar' => $idcuenta_pagar, 'fk_metodo_pago' => $fk_metodo_pago])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

   
}
