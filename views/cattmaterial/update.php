<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ctmaterial */

$this->title = 'Editar : ' . $model->idctipo_material;
$this->params['breadcrumbs'][] = ['label' => 'Catalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Tipo Material', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="ctmaterial-model-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
