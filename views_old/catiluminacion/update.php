<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ciluminacion */

$this->title = 'Editar : ' . $model->idctipo_iluminacion;
$this->render("_menu");
?>
<div class="ciluminacion-model-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
