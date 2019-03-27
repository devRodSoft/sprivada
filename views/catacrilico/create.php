<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CcalibreAcrilicoModel */

$this->title = 'Nuevo';
$this->render("_menu.php");
?>
<div class="ccalibre-acrilico-model-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
