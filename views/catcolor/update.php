<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CtipoColor */

$this->title = 'Editar : ' . $model->cidtipo_color;
$this->render("_menu.php");
?>
<div class="ctipo-color-model-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
