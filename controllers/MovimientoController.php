<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\CHtml;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Multiple;
use app\models\Movimiento;
use app\models\Almacen;
use app\models\CuentaPagar;
use app\models\MovimientoDetalle;
use app\models\ProyectoCosto;
use app\models\Pcosto;
use app\models\Proyecto;
use app\search\MovimientoSearch;
use app\search\MovimientoDetalleSearch;
use yii\data\ActiveDataProvider;
/**
 * MovimientoController implements the CRUD actions for Movimiento model.
 */
class MovimientoController extends Controller
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
     * Lists all Movimiento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MovimientoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = MovimientoDetalle::find();
        $dataExport = new ActiveDataProvider(['query' => $query,]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataExport' => $dataExport,
        ]);
    }

    /**
     * Displays a single Movimiento model.
     * @param integer $idmovimiento
     * @param integer $fk_orden_compra
     * @param integer $fk_tipo_documento
     * @param integer $fk_proveedor
     * @return mixed
     */
    public function actionView($idmovimiento, $fk_tipo_documento, $fk_proveedor)
    {
        $searchModel = new MovimientoDetalleSearch();
        $params['MovimientoDetalleSearch']['fk_movimiento'] = $idmovimiento;
        $dataProvider = $searchModel->search($params);

        return $this->render('view', [
            'model' => $this->findModel($idmovimiento, $fk_tipo_documento, $fk_proveedor),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Creates a new Movimiento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $mov = new Movimiento();
         $almacenes = [new MovimientoDetalle];
         $lista = Almacen::find()->asArray()->all();



        if ($mov->load(Yii::$app->request->post()) ) {
            $almacenes = Multiple::createMultiple(MovimientoDetalle::classname());

            Multiple::loadMultiple($almacenes, Yii::$app->request->post());

             // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($almacenes),
                    ActiveForm::validate($mov)
                );
            }

            $valid = $mov->validate();
            $valid = Multiple::validateMultiple($almacenes) && $valid;

            //ASIGNAR DEUDA
            $deuda = new CuentaPagar();
            $deuda->folio_dcto = $mov->folio_dcto;
            $deuda->tipo_dcto = $mov->fkTipoDocumento->tipo_documento;
            $deuda->fecha_dcto = $mov->fecha_movimiento;
            $deuda->fecha_vencimiento = $this->add_date($mov->fecha_movimiento,$mov->fkProveedor->diacredito);
            $deuda->fk_proveedor = $mov->fk_proveedor;
            $deuda->deuda =  $mov->total_mvto;

            if($mov->stpagado =="1"){
                $deuda->pagado =  $mov->total_mvto;
                $deuda->st_pagado = 2;
                $deuda->fk_metodo_pago = $mov->metodo;
            }else{
                $deuda->pagado = 0;
                $deuda->st_pagado = 1;
                $deuda->fk_metodo_pago = 1;
            }
            $deuda->save(false);

            $sumatoria = 0;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    $mov->fk_proyecto = 0;
                    if($mov->stproyecto ==1){
                        $mov->fk_proyecto = $mov->proyecto;
                    }

                    if ($flag = $mov->save(false)) {

                      $proycos = new ProyectoCosto ();
                      $proycos->fk_movimiento = $mov->idmovimiento;
                      $proycos->fk_proyecto =  $mov->proyecto;
                      $proycos->solicitante = $mov->solicitante;
                      $proycos->folio ="E".$mov->idmovimiento;
                      $proycos->validate();
                      $proycos->save();

                        foreach ($almacenes as $movdet) {

                            //ASIGNAR MOVIMIENTO A CADA ITEM
                            $movdet->fk_movimiento = $mov->idmovimiento;
                            $movdet->iva = $movdet->costo * .16;

                            //ASIGNAR PRECIO AL ALMACEN
                            $inventario = $this->findDetalle($movdet->fk_material_almacen);
                            $inventario->costo = $movdet->costo;
                            $inventario->costo_iva = $movdet->costo*1.16;
                            if($mov->stproyecto ==1){

                                $costo = new Pcosto();
                                $costo->costo = $inventario->costo_iva;
                                $costo->cantidad = $movdet->cantidad;
                                $costo->codigo = $movdet->fk_material_almacen; 
                                $costo->familia =  $inventario->familia;
                                $costo->material = $inventario->material_almacen;
                                $costo->fk_proyecto_costo = $proycos->idproyecto_costo;
                                $costo->validate();
                                $costo->save(false);
                                
                                $sumatoria += $inventario->costo_iva*$movdet->cantidad;
                            }else{
                                $inventario->existencia += $movdet->cantidad;
                            }
                                $inventario->save(false);
                            if (! ($flag = $movdet->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                         if($mov->stproyecto ==1){
                            $proy = $this->findProyecto($mov->proyecto);
                            $proy->costo = $proy->costo  + $sumatoria; 
                            $proy->save(false);
                        }


                    if ($flag) {
                        $transaction->commit();
                       return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            
        } else {
            $mov->stpagado = false;
            $mov->stproyecto = false;

            return $this->render('create', [

                'model' => $mov,
                'almacenes' => (empty($almacenes)) ? [new MovimientoDetalle] : $almacenes,
                'lista'=>$lista
            ]);
        }
    }

    /**
     * Updates an existing Movimiento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idmovimiento
     * @param integer $fk_orden_compra
     * @param integer $fk_tipo_documento
     * @param integer $fk_proveedor
     * @return mixed
     */
    public function actionUpdate($idmovimiento, $fk_orden_compra, $fk_tipo_documento, $fk_proveedor)
    {
        $model = $this->findModel($idmovimiento, $fk_orden_compra, $fk_tipo_documento, $fk_proveedor);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idmovimiento' => $model->idmovimiento, 'fk_orden_compra' => $model->fk_orden_compra, 'fk_tipo_documento' => $model->fk_tipo_documento, 'fk_proveedor' => $model->fk_proveedor]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionGetmateriales(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $lista = array('data'=>Almacen::find()->asArray()->all());

        return $lista;
    }
    /**
     * Deletes an existing Movimiento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idmovimiento
     * @param integer $fk_orden_compra
     * @param integer $fk_tipo_documento
     * @param integer $fk_proveedor
     * @return mixed
     */
    public function actionDelete($idmovimiento, $fk_tipo_documento, $fk_proveedor)
    {

        $mov = $this->findModel($idmovimiento, $fk_tipo_documento, $fk_proveedor);

        if($mov->fk_proyecto > 0){
            //DESCONTAR EL COSTO AL PROYECTO
            $proy = $this->findProyecto($mov->fk_proyecto);
            $proy->costo -=   $mov->total_mvto;
            $proy->save(false);
            //ELIMINAR DE UNO POR UNO
            ProyectoCosto::deleteAll(['fk_movimiento' => $idmovimiento]);

            
        }else{

            $inventarios =MovimientoDetalle::find()->where(['fk_movimiento' => $idmovimiento])->all();
            foreach ($inventarios as $inv) {
                $alm = $this->findDetalle($inv->fk_material_almacen);
                $alm->existencia -=  $inv->cantidad;
                $alm->save(false);
            }

        }
        
        $deuda = $this->findDeuda($mov->folio_dcto , $mov->total_mvto);
        if($deuda)
            $deuda->delete();
        $mov->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Movimiento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idmovimiento
     * @param integer $fk_orden_compra
     * @param integer $fk_tipo_documento
     * @param integer $fk_proveedor
     * @return Movimiento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idmovimiento, $fk_tipo_documento, $fk_proveedor)
    {
        if (($model = Movimiento::findOne(['idmovimiento' => $idmovimiento, 'fk_tipo_documento' => $fk_tipo_documento, 'fk_proveedor' => $fk_proveedor])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


     protected function findDetalle($codigo)
    {
        if (($inventarioalle = Almacen::findOne(['codigo' => $codigo])) !== null) {
            return $inventarioalle;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

     protected function findProyecto($id)
    {
        if (($proyec = Proyecto::findOne(['idproyecto' => $id])) !== null) {
            return $proyec;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

     protected function findDeuda($folio , $total)

      
    {
        if (($ret = CuentaPagar::findOne(['folio_dcto' => $folio , 'deuda' => $total])) !== null) {
            return $ret;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

        function add_date($givendate,$day=0,$mth=0,$yr=0) {
      $cd = strtotime($givendate);
      $newdate = date('Y-m-d h:i:s', mktime(date('h',$cd),
    date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
    date('d',$cd)+$day, date('Y',$cd)+$yr));
      return $newdate;
              }
}
