<?php

namespace app\controllers;

use Yii;
use app\models\Almacen;
use app\models\Clase;
use app\search\AlmacenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AlmacenController implements the CRUD actions for Almacen model.
 */
class AlmacenController extends Controller
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
     * Lists all Almacen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlmacenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Almacen model.
     * @param integer $idalmacen
     * @param integer $fkgrupo
     * @param integer $fktipo
     * @param integer $fkclase
     * @return mixed
     */
    public function actionView($idalmacen, $fkgrupo, $fktipo, $fkclase)
    {
        return $this->render('view', [
            'model' => $this->findModel($idalmacen, $fkgrupo, $fktipo, $fkclase),
        ]);
    }

    /**
     * Creates a new Almacen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Almacen();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Almacen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idalmacen
     * @param integer $fkgrupo
     * @param integer $fktipo
     * @param integer $fkclase
     * @return mixed
     */
    public function actionUpdate($idalmacen, $fkgrupo, $fktipo, $fkclase)
    {
        $model = $this->findModel($idalmacen, $fkgrupo, $fktipo, $fkclase);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Almacen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idalmacen
     * @param integer $fkgrupo
     * @param integer $fktipo
     * @param integer $fkclase
     * @return mixed
     */
    public function actionDelete($idalmacen, $fkgrupo, $fktipo, $fkclase)
    {
        $this->findModel($idalmacen, $fkgrupo, $fktipo, $fkclase)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Almacen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idalmacen
     * @param integer $fkgrupo
     * @param integer $fktipo
     * @param integer $fkclase
     * @return Almacen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idalmacen, $fkgrupo, $fktipo, $fkclase)
    {
        if (($model = Almacen::findOne(['idalmacen' => $idalmacen, 'fkgrupo' => $fkgrupo, 'fktipo' => $fktipo, 'fkclase' => $fkclase])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionClases()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
        $id = end($_POST['depdrop_parents']);
        $selected_id = $_POST['depdrop_all_params']['selected_id']; 
        $list = Clase::find()->andWhere(['fktipo' => $id])->asArray()->all();
        $selected  = null;
        if ($id != null && count($list) > 0) {
            $selected = '';
            foreach ($list as $i => $muni) {
                $out[] = ['id' => $muni['idclase'], 'name' => $muni['descripcion']];
                if ($i == 0) {
                    $selected = $muni['idclase'];
                }
                if($selected_id!=null)
                    $selected = $selected_id;
            }
            // Shows how you can preselect a value
            return ['output' => $out, 'selected' => $selected];
        }
         }
        return ['output' => '', 'selected' => ''];
    }
}
