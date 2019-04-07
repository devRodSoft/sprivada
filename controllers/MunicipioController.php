<?php

namespace app\controllers;

use Yii;
use app\models\Municipio;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmpresaController implements the CRUD actions for Empresa model.
 */
class MunicipioController extends Controller
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
     * Displays a single Empresa model.
     * @param integer $id
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
        $id = end($_POST['depdrop_parents']);
        $selected_id = $_POST['depdrop_all_params']['selected_id']; 
        $list = Municipio::find()->andWhere(['fkestado' => $id])->asArray()->all();
        $selected  = null;
        if ($id != null && count($list) > 0) {
            $selected = '';
            foreach ($list as $i => $muni) {
                $out[] = ['id' => $muni['idmunicipio'], 'name' => $muni['descripcion']];
                if ($i == 0) {
                    $selected = $muni['idmunicipio'];
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
