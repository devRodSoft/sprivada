<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CtipoColor */

$this->title = 'Nuevo';
$this->render("_menu.php");
?>
<div class="ctipo-color-model-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
