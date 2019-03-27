<?php

namespace app\controllers;

use Yii;
use app\models\Empleado;
use app\search\EmpleadoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * EmpleadoController implements the CRUD actions for Empleado model.
 */
class EmpleadoController extends Controller
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
     * Lists all Empleado models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmpleadoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Empleado model.
     * @param integer $idempleado
     * @param integer $fk_categoria
     * @return mixed
     */
    public function actionView($idempleado, $fk_categoria)
    {
        return $this->render('view', [
            'model' => $this->findModel($idempleado, $fk_categoria),
        ]);
    }

    /**
     * Creates a new Empleado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Empleado();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Empleado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idempleado
     * @param integer $fk_categoria
     * @return mixed
     */
    public function actionUpdate($idempleado, $fk_categoria)
    {
        $model = $this->findModel($idempleado, $fk_categoria);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           $this->redirect(['index']);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Empleado model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idempleado
     * @param integer $fk_categoria
     * @return mixed
     */
    public function actionDelete($idempleado, $fk_categoria)
    {
        $this->findModel($idempleado, $fk_categoria)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Empleado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idempleado
     * @param integer $fk_categoria
     * @return Empleado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idempleado, $fk_categoria)
    {
        if (($model = Empleado::findOne(['idempleado' => $idempleado, 'fk_categoria' => $fk_categoria])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
