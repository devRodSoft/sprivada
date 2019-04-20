<?php

use yii\helpers\Html;

use yii\grid\GridView;
use app\custom\GlypIcon;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<?=Html::img("@web/assets/img/menu/sign-warning.png" ,['style'=>["width"=>"128px;float:left;"]]); ?>
<?=  "<h1 style='margin-top:50px;'>".$error."</h1>"; ?>