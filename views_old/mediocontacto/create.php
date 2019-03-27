<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mediocontacto */

$this->title = 'Nuevo';
$this->render("_menu");
?>
<div class="mediocontacto-model-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
