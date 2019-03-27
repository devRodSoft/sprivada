<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cotconfig */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['/dash/proyectos/']];
$this->params['breadcrumbs'][] = ['label' => 'Configuracion', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cotconfig-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
