<?php

namespace app\controllers;

use Yii;
use app\models\ProyectoEmpleado;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Empleado;
/**
 * ProempController implements the CRUD actions for ProyectoEmpleado model.
 */
class ProempController extends Controller
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
     * Lists all ProyectoEmpleado models.
     * @return mixed
     */
    public function actionIndex($fk_proyecto)
    {
       $query = ProyectoEmpleado::find()->where(['fk_proyecto'=> $fk_proyecto]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProyectoEmpleado model.
     * @param integer $idproyecto_empleado
     * @param integer $fk_proyecto
     * @param integer $fk_empleado
     * @return mixed
     */
    public function actionView($idproyecto_empleado, $fk_proyecto, $fk_empleado)
    {
        return $this->render('view', [
            'model' => $this->findModel($idproyecto_empleado, $fk_proyecto, $fk_empleado),
        ]);
    }

    /**
     * Creates a new ProyectoEmpleado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($fk_proyecto)
    {
        $model = new ProyectoEmpleado();
        $model->scenario = 'create';

        // if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
        //     Yii::$app->response->format
        // }
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) ) {
            $model->save();
            return $this->redirect(['/proyecto/view',  'idproyecto' => $model->fk_proyecto]);
        } else {
            $tmp = ProyectoEmpleado::find()->select('fk_empleado')->where(['fk_proyecto'=>$fk_proyecto])->all();
            $seleccionados = [];
            foreach ($tmp as $item) {
                $a = $item->getAttributes();
                array_push($seleccionados, $a['fk_empleado']);
            }
            
            $empleados = ArrayHelper::map(Empleado::find()->where(['not in','idempleado',$seleccionados])->all(),'idempleado' , 'alias');

            $model->fk_proyecto = $fk_proyecto;
            return $this->renderAjax('create', [
                'model' => $model,
                'empleados'=>$empleados,
            ]);
        }
    }

    /**
     * Updates an existing ProyectoEmpleado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idproyecto_empleado
     * @param integer $fk_proyecto
     * @param integer $fk_empleado
     * @return mixed
     */
    public function actionUpdate($idproyecto_empleado, $fk_proyecto, $fk_empleado)
    {
        $model = $this->findModel($idproyecto_empleado, $fk_proyecto, $fk_empleado);
        $model->scenario = 'update';
        
         if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['proyecto/view/'  , 'idproyecto' => $fk_proyecto]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProyectoEmpleado model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idproyecto_empleado
     * @param integer $fk_proyecto
     * @param integer $fk_empleado
     * @return mixed
     */
    public function actionDelete($idproyecto_empleado, $fk_proyecto, $fk_empleado)
    {
        $this->findModel($idproyecto_empleado, $fk_proyecto, $fk_empleado)->delete();

        return $this->redirect(['proyecto/view/'  , 'idproyecto' => $fk_proyecto]);
    }

    /**
     * Finds the ProyectoEmpleado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idproyecto_empleado
     * @param integer $fk_proyecto
     * @param integer $fk_empleado
     * @return ProyectoEmpleado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idproyecto_empleado, $fk_proyecto, $fk_empleado)
    {
        if (($model = ProyectoEmpleado::findOne(['idproyecto_empleado' => $idproyecto_empleado, 'fk_proyecto' => $fk_proyecto, 'fk_empleado' => $fk_empleado])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
