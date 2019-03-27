<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ctmaterial */

$this->title = 'Nuevo';
$this->params['breadcrumbs'][] = ['label' => 'Catalogos', 'url' => ['/dash/catalogos/']];
$this->params['breadcrumbs'][] = ['label' => 'Tipo Material', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ctmaterial-model-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
