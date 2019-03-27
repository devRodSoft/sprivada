<?php

namespace app\controllers;

use Yii;
use app\models\Cliente;
use app\search\ClienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ClienteController implements the CRUD actions for Cliente model.
 */
class ClienteController extends Controller
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
                    [
                        'allow' => true,
                         'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Cliente models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('cliente')){
            $searchModel = new ClienteSearch();
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
     * Displays a single Cliente model.
     * @param integer $idcliente
     * @param integer $fk_mediocontacto
     * @param integer $fk_estado
     * @return mixed
     */
    public function actionView($idcliente, $fk_mediocontacto, $fk_estado)
    {
        if(Yii::$app->user->can('cliente')){
        return $this->renderAjax('view', [
            'model' => $this->findModel($idcliente, $fk_mediocontacto, $fk_estado),
        ]);
        } else{
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new Cliente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if(Yii::$app->user->can('cliente')){
            $model = new Cliente();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
               $this->redirect(['index']);
            } else {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }
        } else{
            throw new ForbiddenHttpException;
        }
    }


    public function actionCreateret($fk_cotizacion=0,$idllamada=0)
    {

        if(Yii::$app->user->can('proyecto')){
            $model = new Cliente();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
               $this->redirect(['proyecto/create', 'idllamada'=> $idllamada , 'fk_cotizacion'=> $fk_cotizacion]);
            } else {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }
        } else{
            throw new ForbiddenHttpException;
        }
       
            
    }

    /**
     * Updates an existing Cliente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idcliente
     * @param integer $fk_mediocontacto
     * @param integer $fk_estado
     * @return mixed
     */
    public function actionUpdate($idcliente, $fk_mediocontacto, $fk_estado)
    {

        if(Yii::$app->user->can('cliente')){
            $model = $this->findModel($idcliente, $fk_mediocontacto, $fk_estado);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $this->redirect(['index']);
                //return $this->redirect(['view', 'idcliente' => $model->idcliente, 'fk_mediocontacto' => $model->fk_mediocontacto, 'fk_estado' => $model->fk_estado]);
            } else {
                return $this->renderAjax('update', [
                    'model' => $model,
                ]);
            }
        } else{
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing Cliente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idcliente
     * @param integer $fk_mediocontacto
     * @param integer $fk_estado
     * @return mixed
     */
    public function actionDelete($idcliente, $fk_mediocontacto, $fk_estado)
    {
        $this->findModel($idcliente, $fk_mediocontacto, $fk_estado)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cliente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idcliente
     * @param integer $fk_mediocontacto
     * @param integer $fk_estado
     * @return Cliente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idcliente, $fk_mediocontacto, $fk_estado)
    {
        if (($model = Cliente::findOne(['idcliente' => $idcliente, 'fk_mediocontacto' => $fk_mediocontacto, 'fk_estado' => $fk_estado])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
