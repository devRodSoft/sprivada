<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = 'Editar : '.$model->idproyecto;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['/dash/proyectos/']];
$this->params['breadcrumbs'][] = ['label' => 'Proyecto', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="proyecto-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
