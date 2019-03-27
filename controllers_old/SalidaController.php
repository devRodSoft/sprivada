<?php

namespace app\controllers;

use Yii;
use app\models\Proyecto;
use app\models\ProyectoCosto;
use app\models\Almacen;
use app\models\Pcosto;
use app\models\Multiple;
use app\search\ProyectoSearch;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;
/**
 * CatiluminacionController implements the CRUD actions for CiluminacionModel model.
 */
class SalidaController extends Controller
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
     * Lists all Proyecto models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new ProyectoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionView($idproyecto){
	   return $this->redirect('/erp/proyecto/view?idproyecto='.$idproyecto);
	}

    /**
     * Displays a single Proyecto model.
     * @param integer $idproyecto
     * @param integer $fk_cliente
     * @param integer $fk_cnivel_complejidad
     * @param integer $fk_cestatus
     * @param integer $fk_ctipo_material
     * @param integer $fk_ctipo_color
     * @param integer $fk_ctipo_iluminacion
     * @param integer $fk_ccalibre_acrilico
     * @return mixed
     */
    public function actionCreate($idproyecto )
    {
         $proycos = new ProyectoCosto;
         $costos = [new Pcosto];

             if ($proycos->load(Yii::$app->request->post())) {

                $costos = Multiple::createMultiple(Pcosto::classname());
                Multiple::loadMultiple($costos, Yii::$app->request->post());

                //  // ajax validation
                // if (Yii::$app->request->isAjax) {
                //     Yii::$app->response->format = Response::FORMAT_JSON;
                //     return ArrayHelper::merge(
                //         ActiveForm::validateMultiple($costos),
                //         ActiveForm::validate($mov)
                //     );
                // }

                $valid =$proycos->validate();
                $valid = Multiple::validateMultiple($costos) && $valid;

                //AGREGAR PROYECTO COSTO
                //ELIMINAR ALMACEN
                $proycos->fk_movimiento =0;
                $sumatoria = 0;

                if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        if($flag = $proycos->save(false)){
                            foreach ($costos as $cosdet) {
                                $cos = new Pcosto();
                                $cos->costo = $cosdet->costo;
                                $cos->cantidad = $cosdet->cantidad;
                                $cos->fk_proyecto_costo = $proycos->idproyecto_costo;
                                $cos->codigo = $cosdet->codigo; 
                                $cos->familia =  $cosdet->familia;
                                $cos->material = $cosdet->material;
                                $cos->validate();
                                $guardado =  $cos->save();

                                $sumatoria += $cosdet->costo*$cosdet->cantidad;
                                    
                                //REDUCIMOS LA EXISTENCIA
                                $inventario = $this->findDetalle($cosdet->codigo);
                                $inventario->existencia = $inventario->existencia - $cosdet->cantidad;
                                $guardado &= $inventario->save(false);
                            
                                if (!$guardado) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }//TERMINA EL FOREACH
                            
                            $proy = $this->findProyecto($idproyecto);
                            $proy->costo = $proy->costo  + $sumatoria; 
                            $proy->save(false);
                            $transaction->commit();
                           return $this->redirect(['index']);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }
        }else {
            $proycos->fk_proyecto = $idproyecto;
            return $this->render('create', [
                'costos' => (empty($costos)) ? [new Pcosto] : $costos,
                'proyecto' => $this->findProyecto($idproyecto),
                'proycos' => $proycos,
            ]);
        }
    }


    public function actionGetmateriales(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $lista = array('data'=>Almacen::find()->asArray()->all());

        return $lista;
    }

    
    /**
     * Finds the Proyecto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idproyecto
     * @param integer $fk_cliente
     * @param integer $fk_cnivel_complejidad
     * @param integer $fk_cestatus
     * @param integer $fk_ctipo_material
     * @param integer $fk_ctipo_color
     * @param integer $fk_ctipo_iluminacion
     * @param integer $fk_ccalibre_acrilico
     * @return Proyecto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idproyecto, $fk_cliente, $fk_cnivel_complejidad, $fk_cestatus, $fk_ctipo_material, $fk_ctipo_color, $fk_ctipo_iluminacion, $fk_ccalibre_acrilico)
    {
        if (($model = Proyecto::findOne(['idproyecto' => $idproyecto, 'fk_cliente' => $fk_cliente, 'fk_cnivel_complejidad' => $fk_cnivel_complejidad, 'fk_cestatus' => $fk_cestatus, 'fk_ctipo_material' => $fk_ctipo_material, 'fk_ctipo_color' => $fk_ctipo_color, 'fk_ctipo_iluminacion' => $fk_ctipo_iluminacion, 'fk_ccalibre_acrilico' => $fk_ccalibre_acrilico])) !== null) {
            return $model;
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

    protected function findDetalle($codigo)
    {
        if (($inventarioalle = Almacen::findOne(['codigo' => $codigo])) !== null) {
            return $inventarioalle;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
