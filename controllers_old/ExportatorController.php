<?php

namespace app\controllers;

use Yii;
use app\models\Llamada;
use app\search\LlamadaSearch;
use app\models\Pcosto;
use app\models\Proyecto;
use app\search\ProyectoSearch;
use app\search\AlmacenSearch
;use app\search\CuentaSearch;

use app\search\OrdenProductoSearch;
use app\search\MovimientoDetalleSearch;
use app\search\CajaChicaSearch;
use app\search\NominaDetSearch;



use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;


/**
 * MaterialController implements the CRUD actions for Almacen model.
 */
class ExportatorController extends Controller
{
    /**
     * @inheritdoc
     */
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
              
    //             'rules' => [
    //                 [
    //                     'allow' => true,
    //                      'roles' => ['@'],
    //                 ],
    //             ],
    //         ],
    //     ];
    // }

   


    
    /**
     * Displays a single Almacen model.
     * @param integer $id
     * @return mixed
     */
    //LISTO
    public function actionLlamada()
    {
        $searchModel = new LlamadaSearch();
        // $dataProvider = Llamada::find()->all();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // d($dataProvider);
        // die();

        return $this->render('ellamada', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
    }

    //LISTO
     public function actionProyecto()
    {
        $searchModel = new ProyectoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('eproyecto', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
    }

    //LISTO
    public function actionCostoproyecto()
    {
        $query = Pcosto::find();
        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        return $this->render('ecostoproy', [
                'dataProvider' => $dataProvider,
            ]);
    }

    //LISTO
    public function actionAlmacen()
    {
         $searchModel = new AlmacenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('ealmacen', [
                'dataProvider' => $dataProvider,
            ]);
    }
    ///LISTO
     public function actionCuenta()
    {
         $searchModel = new CuentaSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('ecuenta', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
    }

    //LISTO
    public function actionCompra(){

        $searchModel = new OrdenProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        return $this->render('ecompra', [
            'searchModel'=>$searchModel , 'dataProvider'=>$dataProvider,
        ]);


    }

    //LISTO
    public function actionEntrada(){

        $searchModel = new MovimientoDetalleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        return $this->render('eentrada', [
            'searchModel'=>$searchModel , 'dataProvider'=>$dataProvider,
        ]);


    }

    //LISTO
     public function actionIndirecto(){

        $searchModel = new CajaChicaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        
        return $this->render('eindirecto', [
            'searchModel'=>$searchModel , 'dataProvider'=>$dataProvider,
        ]);
    }



    //LISTO
     public function actionNomina(){

        $searchModel = new NominaDetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        
        return $this->render('enomina', [
            'searchModel'=>$searchModel , 'dataProvider'=>$dataProvider,
        ]);
    }







}
