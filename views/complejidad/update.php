<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NivelComplejidad */

$this->title = 'Editar : '.$model->idcnivel_complejidad;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['/dash/proyectos/']];
$this->params['breadcrumbs'][] = ['label' => 'Nivel de Complejidad', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="nivel-complejidad-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
