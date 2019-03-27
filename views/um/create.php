<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Um */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Compras Indirectas', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Ums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="um-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
