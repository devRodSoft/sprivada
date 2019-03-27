<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */

$this->title = 'Editar : '.$model->idcategoria;

$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Categorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="categoria-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
