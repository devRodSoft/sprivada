<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DesarrolloValor */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/cindirectas/']];
$this->params['breadcrumbs'][] = ['label' => 'Desarrollo Valors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desarrollo-valor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
