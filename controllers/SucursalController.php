<?php

namespace app\controllers;

use Yii;
use app\models\Sucursal;
use app\search\SucursalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SucursalController implements the CRUD actions for Sucursal model.
 */
class SucursalController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Sucursal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SucursalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sucursal model.
     * @param integer $idsucursal
     * @param integer $fkmunicipio
     * @param integer $fkestado
     * @return mixed
     */
    public function actionView($idsucursal, $fkmunicipio, $fkestado)
    {
        return $this->render('view', [
            'model' => $this->findModel($idsucursal, $fkmunicipio, $fkestado),
        ]);
    }

    /**
     * Creates a new Sucursal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sucursal();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idsucursal' => $model->idsucursal, 'fkmunicipio' => $model->fkmunicipio, 'fkestado' => $model->fkestado]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Sucursal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idsucursal
     * @param integer $fkmunicipio
     * @param integer $fkestado
     * @return mixed
     */
    public function actionUpdate($idsucursal, $fkmunicipio, $fkestado)
    {
        $model = $this->findModel($idsucursal, $fkmunicipio, $fkestado);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idsucursal' => $model->idsucursal, 'fkmunicipio' => $model->fkmunicipio, 'fkestado' => $model->fkestado]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Sucursal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idsucursal
     * @param integer $fkmunicipio
     * @param integer $fkestado
     * @return mixed
     */
    public function actionDelete($idsucursal, $fkmunicipio, $fkestado)
    {
        $this->findModel($idsucursal, $fkmunicipio, $fkestado)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sucursal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idsucursal
     * @param integer $fkmunicipio
     * @param integer $fkestado
     * @return Sucursal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idsucursal, $fkmunicipio, $fkestado)
    {
        if (($model = Sucursal::findOne(['idsucursal' => $idsucursal, 'fkmunicipio' => $fkmunicipio, 'fkestado' => $fkestado])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
