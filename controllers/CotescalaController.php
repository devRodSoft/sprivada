<?php

namespace app\controllers;

use Yii;
use app\models\Cotescala;
use app\search\CotescalaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * CotescalaController implements the CRUD actions for Cotescala model.
 */
class CotescalaController extends Controller
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
     * Lists all Cotescala models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CotescalaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cotescala model.
     * @param integer $idcotescala
     * @param integer $fk_cotizacion
     * @return mixed
     */
    public function actionView($idcotescala, $fk_cotizacion)
    {
        return $this->render('view', [
            'model' => $this->findModel($idcotescala, $fk_cotizacion),
        ]);
    }

    /**
     * Creates a new Cotescala model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cotescala();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idcotescala' => $model->idcotescala, 'fk_cotizacion' => $model->fk_cotizacion]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Cotescala model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idcotescala
     * @param integer $fk_cotizacion
     * @return mixed
     */
    public function actionUpdate($idcotescala, $fk_cotizacion)
    {
        $model = $this->findModel($idcotescala, $fk_cotizacion);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idcotescala' => $model->idcotescala, 'fk_cotizacion' => $model->fk_cotizacion]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Cotescala model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idcotescala
     * @param integer $fk_cotizacion
     * @return mixed
     */
    public function actionDelete($idcotescala, $fk_cotizacion)
    {
        $this->findModel($idcotescala, $fk_cotizacion)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cotescala model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idcotescala
     * @param integer $fk_cotizacion
     * @return Cotescala the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idcotescala, $fk_cotizacion)
    {
        if (($model = Cotescala::findOne(['idcotescala' => $idcotescala, 'fk_cotizacion' => $fk_cotizacion])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
