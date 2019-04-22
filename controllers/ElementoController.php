<?php

namespace app\controllers;

use Yii;
use app\models\Elemento;
use app\search\ElementoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ElementoController implements the CRUD actions for Elemento model.
 */
class ElementoController extends Controller
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
     * Lists all Elemento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ElementoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Elemento model.
     * @param integer $idelemento
     * @param integer $fkservicio
     * @param integer $fkpuesto
     * @return mixed
     */
    public function actionView($idelemento, $fkservicio, $fkpuesto)
    {
        return $this->render('view', [
            'model' => $this->findModel($idelemento, $fkservicio, $fkpuesto),
        ]);
    }

    /**
     * Creates a new Elemento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Elemento();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idelemento' => $model->idelemento, 'fkservicio' => $model->fkservicio, 'fkpuesto' => $model->fkpuesto]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Elemento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idelemento
     * @param integer $fkservicio
     * @param integer $fkpuesto
     * @return mixed
     */
    public function actionUpdate($idelemento, $fkservicio, $fkpuesto)
    {
        $model = $this->findModel($idelemento, $fkservicio, $fkpuesto);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idelemento' => $model->idelemento, 'fkservicio' => $model->fkservicio, 'fkpuesto' => $model->fkpuesto]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Elemento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idelemento
     * @param integer $fkservicio
     * @param integer $fkpuesto
     * @return mixed
     */
    public function actionDelete($idelemento, $fkservicio, $fkpuesto)
    {
        $this->findModel($idelemento, $fkservicio, $fkpuesto)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Elemento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idelemento
     * @param integer $fkservicio
     * @param integer $fkpuesto
     * @return Elemento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idelemento, $fkservicio, $fkpuesto)
    {
        if (($model = Elemento::findOne(['idelemento' => $idelemento, 'fkservicio' => $fkservicio, 'fkpuesto' => $fkpuesto])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
