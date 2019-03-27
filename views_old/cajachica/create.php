<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CajaChica */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Egresos', 'url' => ['/dash/egresos/']];
$this->params['breadcrumbs'][] = ['label' => 'Indirectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="caja-chica-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
