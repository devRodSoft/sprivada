<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Categoria */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Categorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
