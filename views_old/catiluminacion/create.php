<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ciluminacion */

$this->title = 'Nuevo';
$this->render("_menu");
?>
<div class="ciluminacion-model-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
