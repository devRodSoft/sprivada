<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mediocontacto */

$this->title = 'Editar : ' . $model->idmediocontacto;
$this->render("_menu");
?>
<div class="mediocontacto-model-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
