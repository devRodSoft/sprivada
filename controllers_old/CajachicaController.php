<?php

namespace app\controllers;

use Yii;
use app\models\CajaChica;
use app\models\CuentaPagar;
use app\search\CajaChicaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
/**
 * CajachicaController implements the CRUD actions for CajaChica model.
 */
class CajachicaController extends Controller
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
     * Lists all CajaChica models.
     * @return mixed
     */
    public function actionIndex()
    {
         $query = CajaChica::find();
        $dataExport = new ActiveDataProvider(['query' => $query,]);
        
        $searchModel = new CajaChicaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataExport' => $dataExport,

        ]);
    }

    /**
     * Displays a single CajaChica model.
     * @param integer $idcaja_chica
     * @param integer $fk_cforma_pago
     * @param integer $fk_csub_tipo_gasto
     * @param integer $fk_centro_costo
     * @return mixed
     */
    public function actionView($idcaja_chica, $fk_cforma_pago, $fk_csub_tipo_gasto, $fk_centro_costo)
    {
        return $this->render('view', [
            'model' => $this->findModel($idcaja_chica, $fk_cforma_pago, $fk_csub_tipo_gasto, $fk_centro_costo),
        ]);
    }

    /**
     * Creates a new CajaChica model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CajaChica();
        $model->scenario = CajaChica::SCENARIO_CREATE;
        // $this->layout = "printl";
        
        if ($model->load(Yii::$app->request->post()) ) {
            

            $model->save();
            $cuenta = new CuentaPagar();
            $cuenta->folio_dcto = "I".sprintf("%06d", $model->idcaja_chica);
            $cuenta->tipo_dcto = "INDIRECTO";
            $cuenta->fecha_dcto = $model->fecha_comprachica;
            // $cuenta->fecha_dcto = date("Y-m-d") ;
            $cuenta->fecha_vencimiento = $this->add_date($cuenta->fecha_dcto , $model->dias ,0 ,0);
            $cuenta->deuda = $model->importe;
            $cuenta->fk_proveedor = 1;
            $cuenta->observacion = $model->caja_chica;


            if($model->stpagado =="1"){
                $cuenta->pagado =  $model->importe;
                $cuenta->st_pagado = 2;
                $cuenta->fk_metodo_pago = $model->metodo;
            }else{
                $cuenta->pagado = 0;
                $cuenta->st_pagado = 1;
                $cuenta->fk_metodo_pago = 1;
            }
            $cuenta->save();

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CajaChica model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idcaja_chica
     * @param integer $fk_cforma_pago
     * @param integer $fk_csub_tipo_gasto
     * @param integer $fk_centro_costo
     * @return mixed
     */
    public function actionUpdate($idcaja_chica, $fk_cforma_pago, $fk_csub_tipo_gasto, $fk_centro_costo)
    {
        // $this->layout = "printl";
        $model = $this->findModel($idcaja_chica, $fk_cforma_pago, $fk_csub_tipo_gasto, $fk_centro_costo);


        if ($model->load(Yii::$app->request->post()) ) {
            $model->validate();
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CajaChica model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idcaja_chica
     * @param integer $fk_cforma_pago
     * @param integer $fk_csub_tipo_gasto
     * @param integer $fk_centro_costo
     * @return mixed
     */
    public function actionDelete($idcaja_chica, $fk_cforma_pago, $fk_csub_tipo_gasto, $fk_centro_costo)
    {


        $folio_cuenta = "I".sprintf("%06d", $idcaja_chica);
        CuentaPagar::findOne(['folio_dcto' => $folio_cuenta])->delete();

        $this->findModel($idcaja_chica, $fk_cforma_pago, $fk_csub_tipo_gasto, $fk_centro_costo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CajaChica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idcaja_chica
     * @param integer $fk_cforma_pago
     * @param integer $fk_csub_tipo_gasto
     * @param integer $fk_centro_costo
     * @return CajaChica the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idcaja_chica, $fk_cforma_pago, $fk_csub_tipo_gasto, $fk_centro_costo)
    {
        if (($model = CajaChica::findOne(['idcaja_chica' => $idcaja_chica, 'fk_cforma_pago' => $fk_cforma_pago, 'fk_csub_tipo_gasto' => $fk_csub_tipo_gasto, 'fk_centro_costo' => $fk_centro_costo])) !== null) {
            return $model;
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
