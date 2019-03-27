<?php

namespace app\controllers;

use Yii;
use app\models\Ciluminacion;
use app\search\CiluminacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;

/**
 * CatiluminacionController implements the CRUD actions for CiluminacionModel model.
 */
class CatiluminacionController extends Controller
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
     * Lists all CiluminacionModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CiluminacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->post('hasEditable')) {
        $id = Yii::$app->request->post('editableKey');
        $obj = Ciluminacion::findOne($id);
        $out = Json::encode(['output'=>'', 'message'=>'']);
        $posted = current($_POST['Ciluminacion']);
        $post = ['Ciluminacion' => $posted];

        if ($obj->load($post)) {
        $obj->save();
        $output = '';

        // if (isset($posted['buy_amount'])) {
        // $output = Yii::$app->formatter->asDecimal($model->buy_amount, 2);
        // }

        $out = Json::encode(['output'=>$output, 'message'=>'']);
        }
        echo $out;
        return;
    }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CiluminacionModel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CiluminacionModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ciluminacion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CiluminacionModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->redirect(['index']);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CiluminacionModel model.
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
     * Finds the CiluminacionModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ciluminacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ciluminacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
