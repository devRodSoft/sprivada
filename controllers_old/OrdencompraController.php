<?php

namespace app\controllers;

use Yii;
use app\models\OrdenCompra;
use app\models\OrdenProducto;
use app\search\OrdenCompraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Multiple;
use app\search\OrdenProductoSearch;
use yii\data\ActiveDataProvider;
/**
 * OrdencompraController implements the CRUD actions for OrdenCompra model.
 */
class OrdencompraController extends Controller
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
     * Lists all OrdenCompra models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdenCompraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = OrdenProducto::find();
        $dataExport = new ActiveDataProvider(['query' => $query,]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataExport' => $dataExport,
        ]);
    }

    /**
     * Displays a single OrdenCompra model.
     * @param integer $id_orden_compra
     * @param integer $fk_proveedor
     * @param integer $fk_compra_producto
     * @return mixed
     */
    public function actionView($id_orden_compra)
    {   
        $model = $this->findModel($id_orden_compra);
        $searchModel = new OrdenProductoSearch(['fk_orden_compra' => $id_orden_compra,]);
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        return $this->render('view', [
            'model' => $model,'searchModel'=>$searchModel , 'dataProvider'=>$dataProvider,
        ]);
    }

    /**
     * Creates a new OrdenCompra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrdenCompra();
        $productos = [new OrdenProducto];

        if ($model->load(Yii::$app->request->post())) {
            $productos = Multiple::createMultiple(OrdenProducto::classname()); 

             Multiple::loadMultiple($productos, Yii::$app->request->post());
             // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($productos),
                    ActiveForm::validate($model)
                );
            }
         
            $model->fecha_compra = date("Y-m-d");
            $valid = $model->validate();
           
            $valid = Multiple::validateMultiple($productos) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        $id = $model->id_orden_compra;
                        
                        


                        foreach ($productos as $pro) {
                            $pro->fk_orden_compra = $id;
                            if (! ($flag = $pro->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                         return $this->redirect(['/ordencompra/view', 'id_orden_compra' => $id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                 'productos' => (empty($productos)) ? [new OrdenProducto] : $productos,
            ]);
        }
    }

    /**
     * Updates an existing OrdenCompra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_orden_compra
     * @param integer $fk_proveedor
     * @param integer $fk_compra_producto
     * @return mixed
     */
    public function actionUpdate($id_orden_compra, $fk_proveedor, $fk_compra_producto)
    {
        $model = $this->findModel($id_orden_compra, $fk_proveedor, $fk_compra_producto);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_orden_compra' => $model->id_orden_compra, 'fk_proveedor' => $model->fk_proveedor, 'fk_compra_producto' => $model->fk_compra_producto]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OrdenCompra model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_orden_compra
     * @param integer $fk_proveedor
     * @param integer $fk_compra_producto
     * @return mixed
     */
    public function actionDelete($id_orden_compra, $fk_proveedor)
    {
        $this->findModel($id_orden_compra)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OrdenCompra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_orden_compra
     * @param integer $fk_proveedor
     * @param integer $fk_compra_producto
     * @return OrdenCompra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_orden_compra)
    {
        if (($model = OrdenCompra::findOne(['id_orden_compra' => $id_orden_compra])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
