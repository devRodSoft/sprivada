<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Movimiento */

$this->title = 'Nueva Salida';
$this->params['breadcrumbs'][] = ['label' => 'Nueva Salida', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salida-create">
	
    <h1><?= Html::encode($this->title)."</br></br>    Folio:$proyecto->idproyecto   Proyecto:$proyecto->proyecto"; ?></h1>
    <?= $this->render('_form', [
       'costos'=>$costos,
       'proyecto'=>$proyecto,
       'proycos'=>$proycos,

    ]) ?>

</div>
