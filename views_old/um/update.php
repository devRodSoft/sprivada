<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Um */

$this->title = 'Editar : '.$model->idum;

$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Ums', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="um-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
