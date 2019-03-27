<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class DashController extends Controller
{
    

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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        // $a = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        // d($a);
        // die();
        $this->layout = "erpl";

        $links =  [];
        // if(Yii::$app->user->can('catalogo'))
            array_push($links,["nombre" => "CATALOGOS" , "link"=>"dash/catalogos" , "img" => "@web/assets/img/menu/folder.png"]);
        // if(Yii::$app->user->can('cliente'))
        //     array_push($links,["nombre" => "CLIENTES" , "link"=>"cliente" , "img" => "@web/assets/img/menu/team.png"]);
        // if(Yii::$app->user->can('cotizacion'))
        //     array_push($links,["nombre" => "LLAMADAS Y COTIZACIONES" , "link"=>"llamada" , "img" => "@web/assets/img/menu/phone.png"]);
        // if(Yii::$app->user->can('vproyecto'))
        //     array_push($links,["nombre" => "PROYECTOS" , "link"=>"proyecto" , "img" => "@web/assets/img/menu/bank.png"]);
        // if(Yii::$app->user->can('egreso'))
        //     array_push($links,["nombre" => "EGRESOS" , "link"=>"dash/egresos" , "img" => "@web/assets/img/menu/money.png"]);
        // if(Yii::$app->user->can('valmacen')||Yii::$app->user->can('calmacen'))
        //     array_push($links,["nombre" => "ALMACEN" , "link"=>"dash/almacen" , "img" => "@web/assets/img/menu/box.png"]);
        // if(Yii::$app->user->can('cuenta'))
        //     array_push($links,["nombre" => "CUENTAS POR PAGAR" , "link"=>"cuenta" , "img" => "@web/assets/img/menu/account.png"]);
        // if(Yii::$app->user->can('produccion'))
        //     array_push($links,["nombre" => "PRODUCCION" , "link"=>"produccion" , "img" => "@web/assets/img/menu/settings.png"]);
        // if(Yii::$app->user->can('vnomina'))
        //     array_push($links,["nombre" => "NOMINA" , "link"=>"nomina" , "img" => "@web/assets/img/menu/check.png"]);
        // if(Yii::$app->user->can('user'))
        //     array_push($links,["nombre" => "USUARIO" , "link"=>"user/admin" , "img" => "@web/assets/img/menu/root.png"]);
            
        return $this->render('catalogos' ,[ "links"=>$links]);
    }

  

    public function actionLogin()
    {
        $this->layout = "erpl";
         if (!Yii::$app->user->isGuest) {
             return $this->render('login', [
                'model' => $model,
            ]);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact()
    {
        $this->layout = "erpl";
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
            return $this->render('contact', [
            'model' => $model,
        ]);
    }





     public function actionEgresos()
    {
        if(Yii::$app->user->can('egreso')){
           $this->layout = "erpl";
             $links =  [
            ["nombre" => "INDIRECTOS" , "link"=>"cajachica" , "img" => "@web/assets/img/menu/money.png"],
            ["nombre" => "COMPRAS" , "link"=>"ordencompra" , "img" => "@web/assets/img/menu/cart.png"],
            ];
            return $this->render('catalogos',[ "links"=>$links] );
        }else{
            throw new ForbiddenHttpException;
        }
    }

    public function  actionRbac(){
        $this->layout = "erpl";
        $links =  [
        ["nombre" => "ROL" , "link"=>"/rbac/role" , "img" => "@web/assets/img/menu/root.png"],
        ["nombre" => "PERMISO" , "link"=>"/rbac/permission" , "img" => "@web/assets/img/menu/root.png"],
        ["nombre" => "ASIGNACION" , "link"=>"/rbac/assignment" , "img" => "@web/assets/img/menu/root.png"]];
        return $this->render('clientes',[ "links"=>$links] );
    }

    public function actionCatalogos()
    {
        if(Yii::$app->user->can('catalogo')){
           $this->layout = "erpl";
             $links =  [

            ["nombre" => "empresa" , "link"=>"empresa" , "img" => "@web/assets/img/menu/bank.png"],
            // ["nombre" => "CLIENTES" , "link"=>"dash/catcliente" , "img" => "@web/assets/img/menu/team.png"],
            // ["nombre" => "COMPRAS INDIRECTAS" , "link"=>"dash/catindirecta" , "img" => "@web/assets/img/menu/money.png"],
            // ["nombre" => "PROVEEDORES" , "link"=>"proveedor" , "img" => "@web/assets/img/menu/proveedor.png"],
            // ["nombre" => "UM" , "link"=>"um" , "img" => "@web/assets/img/menu/measure.png"],
            // ["nombre" => "EMPLEADOS" , "link"=>"dash/catempleado" , "img" => "@web/assets/img/menu/empleado.png"],

            ];
            return $this->render('catalogos',[ "links"=>$links] );
        }else{
            throw new ForbiddenHttpException;
        }
    }

    public function actionCatempleado()
    {
        if(Yii::$app->user->can('catalogo')){
            $this->layout = "erpl";
            $links =  [
            ["nombre" => "EMPLEADO" , "link"=>"empleado" , "img" => "@web/assets/img/menu/empleado.png"],
            ["nombre" => "CATEGORIA" , "link"=>"categoria" , "img" => "@web/assets/img/menu/category.png"],
            ];
            return $this->render('catalogos' ,[ "links"=>$links]);
        } else{
            throw new ForbiddenHttpException;
        }
    }
    
    public function  actionCatempresa(){
        if(Yii::$app->user->can('catalogo')){
            $this->layout = "erpl";
            $links =  [
            // ["nombre" => "ILUMINACION" , "link"=>"cat/iluminacion" , "img" => "@web/assets/img/menu/light.png"],
            // ["nombre" => "COLOR" , "link"=>"cat/color" , "img" => "@web/assets/img/menu/colorwheel.png"],
            // ["nombre" => "ACRILICO" , "link"=>"cat/acrilico" , "img" => "@web/assets/img/menu/acrilic.png"],
            // ["nombre" => "TIPO MATERIAL" , "link"=>"cat/tmaterial" , "img" => "@web/assets/img/menu/crate.png"],
            // ["nombre" => "ESTATUS" , "link"=>"cestatus" , "img" => "@web/assets/img/menu/list.png"],
            // ["nombre" => "COMPLEJIDAD" , "link"=>"complejidad" , "img" => "@web/assets/img/menu/glove.png"],
            // ["nombre" => "PIE DE PAGINA" , "link"=>"cotconfig" , "img" => "@web/assets/img/menu/bank.png"]
            ];
            return $this->render('catalogos',[ "links"=>$links] );
        } else{
            throw new ForbiddenHttpException;
        }
    }

    public function  actionCatcliente(){
         if(Yii::$app->user->can('catalogo')){
            $this->layout = "erpl";
            $links =  [
               ["nombre" => "MEDIO CONTACTO" , "link"=>"mediocontacto" , "img" => "@web/assets/img/menu/envelope.png"],
            ];
            return $this->render('catalogos',[ "links"=>$links] );
         } else{
            throw new ForbiddenHttpException;
        }
    }

    public function actionAlmacen(){
        if(Yii::$app->user->can('valmacen')||Yii::$app->user->can('calmacen')){
            $this->layout = "erpl";
            $links =  [];
            array_push($links,["nombre" => "INVENTARIO" , "link"=>"almacen" , "img" => "@web/assets/img/menu/box.png"]);
            if(Yii::$app->user->can('calmacen'))
            array_push($links,["nombre" => "ENTRADAS" , "link"=>"movimiento" , "img" => "@web/assets/img/menu/entry.png"]);
         if(Yii::$app->user->can('salida'))
            array_push($links,["nombre" => "SALIDAS" , "link"=>"salida" , "img" => "@web/assets/img/menu/acrilic.png"]);
            // ["nombre" => "AJUSTES" , "link"=>"cat/tmaterial" , "img" => "@web/assets/img/menu/crate.png"],
            return $this->render('catalogos',[ "links"=>$links] );
        } else{
            throw new ForbiddenHttpException;
        }
    }

    public function actionCatindirecta(){
        if(Yii::$app->user->can('catalogo')){
             $this->layout = "erpl";
              $links =  [  ["nombre" => "CENTRO COSTOS" , "link"=>"centro" , "img" => "@web/assets/img/menu/envelope.png"],
            ["nombre" => "FORMA DE PAGO" , "link"=>"fpago" , "img" => "@web/assets/img/menu/glove.png"],
            ["nombre" => "TIPO DE GASTO" , "link"=>"tgasto" , "img" => "@web/assets/img/menu/bank.png"],
            ["nombre" => "SUBTIPO DE GASTO" , "link"=>"tsubgasto" , "img" => "@web/assets/img/menu/bank.png"],
           ];
             return $this->render('catalogos',[ "links"=>$links] );
        } else{
            throw new ForbiddenHttpException;
        }
    }

    public function actionProceso(){
        return $this->render('enproceso' );
    }
}
