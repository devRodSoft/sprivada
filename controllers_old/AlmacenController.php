<?php


namespace app\controllers;

use Yii;
use app\models\Almacen;
use app\search\AlmacenSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;


/**
 * MaterialController implements the CRUD actions for Almacen model.
 */
class AlmacenController extends Controller
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
     * Lists all Almacen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlmacenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = Almacen::find();
        $dataExport = new ActiveDataProvider(['query' => $query,]);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataExport' => $dataExport,
        ]);
    }


    /**
     * Lists all Almacen models.
     * @return mixed
     */
    public function actionSearch()
    {
        $searchModel = new AlmacenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('lmaterial', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionValidation(){
         $model = new Almacen();
         if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->Response->format = 'json';
            return ActiveForm::validate($model);
        }
    }
    /**
     * Displays a single Almacen model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($idmaterial_almacen)
    {
        return $this->render('view', [
            'model' => $this->findModel($idmaterial_almacen),
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

       if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->Response->format = 'json';
            
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            $model->costo = 0;
            $model->costo_iva = 0;
            $model->existencia = 0;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Almacen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($idmaterial_almacen)
    {
        $model = $this->findModel($idmaterial_almacen);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

     public function actionVerifycode(){
        // some parameter from JS
        // ex. 127.0.0.1/?r=my-controller/quote&query=3
        // $code = 3;
         $code = Yii::$app->request->get('code');
      

        Yii::$app->response->format = 'json';
        $model = Almacen::findOne(['codigo'=>$code]);
         if($model!=null){
            $model->error = 0;
             return $model;
         }else{
             return array('error'=> 1);
        }
    }

    /**
     * Deletes an existing Almacen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($idmaterial_almacen)
    {
        $this->findModel($idmaterial_almacen)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Almacen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Almacen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Almacen::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
