<?php

namespace app\controllers;

use Yii;
use app\models\CsubTipoGasto;
use app\search\CsubTipoGastoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * TsubgastoController implements the CRUD actions for CsubTipoGasto model.
 */
class TsubgastoController extends Controller
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
     * Lists all CsubTipoGasto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CsubTipoGastoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CsubTipoGasto model.
     * @param integer $idcsub_tipo_gasto
     * @param integer $fk_ctipo_gasto
     * @return mixed
     */
    public function actionView($idcsub_tipo_gasto, $fk_ctipo_gasto)
    {
        return $this->render('view', [
            'model' => $this->findModel($idcsub_tipo_gasto, $fk_ctipo_gasto),
        ]);
    }

    /**
     * Creates a new CsubTipoGasto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CsubTipoGasto();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CsubTipoGasto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idcsub_tipo_gasto
     * @param integer $fk_ctipo_gasto
     * @return mixed
     */
    public function actionUpdate($idcsub_tipo_gasto, $fk_ctipo_gasto)
    {
        $model = $this->findModel($idcsub_tipo_gasto, $fk_ctipo_gasto);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->redirect(['index']);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CsubTipoGasto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idcsub_tipo_gasto
     * @param integer $fk_ctipo_gasto
     * @return mixed
     */
    public function actionDelete($idcsub_tipo_gasto, $fk_ctipo_gasto)
    {
        $this->findModel($idcsub_tipo_gasto, $fk_ctipo_gasto)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CsubTipoGasto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idcsub_tipo_gasto
     * @param integer $fk_ctipo_gasto
     * @return CsubTipoGasto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idcsub_tipo_gasto, $fk_ctipo_gasto)
    {
        if (($model = CsubTipoGasto::findOne(['idcsub_tipo_gasto' => $idcsub_tipo_gasto, 'fk_ctipo_gasto' => $fk_ctipo_gasto])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
