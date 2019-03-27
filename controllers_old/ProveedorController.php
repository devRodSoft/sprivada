<?php

namespace app\controllers;

use Yii;
use yii\widgets\ActiveForm;
use app\models\Proveedor;
use app\search\ProveedorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ProveedorController implements the CRUD actions for Proveedor model.
 */
class ProveedorController extends Controller
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
     * Lists all Proveedor models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('proveedor')){
            $searchModel = new ProveedorSearch();
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
     * Displays a single Proveedor model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('proveedor')){
        return $this->render('view', [
            'model' => $this->findModel($id),]);
        } else{
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new Proveedor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('proveedor')){
            $model = new Proveedor();

            if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
                Yii::$app->response->format = 'json';
                return ActiveForm::validate($model);
            }
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

    /**
     * Updates an existing Proveedor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {   
        if(Yii::$app->user->can('proveedor')){
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $this->redirect(['index']);
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
     * Deletes an existing Proveedor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Proveedor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Proveedor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Proveedor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
