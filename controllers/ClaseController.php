<?php

namespace app\controllers;

use Yii;
use app\models\Clase;
use app\models\Tipo;
use app\search\ClaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClaseController implements the CRUD actions for Clase model.
 */
class ClaseController extends Controller
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
     * Lists all Clase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Clase model.
     * @param integer $idclase
     * @param integer $fktipo
     * @return mixed
     */
    public function actionView($idclase, $fktipo)
    {
        return $this->render('view', [
            'model' => $this->findModel($idclase, $fktipo),
        ]);
    }

    /**
     * Creates a new Clase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Clase();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Clase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idclase
     * @param integer $fktipo
     * @return mixed
     */
    public function actionUpdate($idclase, $fktipo)
    {
        $model = $this->findModel($idclase, $fktipo);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Clase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idclase
     * @param integer $fktipo
     * @return mixed
     */
    public function actionDelete($idclase, $fktipo)
    {
        $this->findModel($idclase, $fktipo)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionTipos() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
        $id = end($_POST['depdrop_parents']);
        $selected_id = $_POST['depdrop_all_params']['selected_id']; 
        
        $list = Tipo::find()->andWhere(['fkgrupo' => $id])->asArray()->all();
        $selected  = null;
        if ($id != null && count($list) > 0) {
            $selected = '';
            foreach ($list as $i => $tipo) {
                $out[] = ['id' => $tipo['idtipo'], 'name' => $tipo['descripcion']];
                if ($i == 0) {
                    $selected = $tipo['idtipo'];
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
    
    

    /**
     * Finds the Clase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idclase
     * @param integer $fktipo
     * @return Clase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idclase, $fktipo)
    {
        if (($model = Clase::findOne(['idclase' => $idclase, 'fktipo' => $fktipo])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
