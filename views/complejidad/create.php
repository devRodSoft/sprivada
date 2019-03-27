<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NivelComplejidad */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['/dash/proyectos/']];
$this->params['breadcrumbs'][] = ['label' => 'Nivel de Complejidad', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nivel-complejidad-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
